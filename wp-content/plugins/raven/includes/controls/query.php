<?php
/**
 * Adds query control. This control will fetch different type of data e.g post, author, term, taxonomy based on query param.
 *
 * @package Raven
 * @since 1.9.4
 */

namespace Raven\Controls;

use Elementor\Control_Select2;
use WP_Error;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Query extends Control_Select2 {

	const QUERY_SOURCE_POST = 'post';

	const QUERY_SOURCE_AUTHOR = 'author';

	const QUERY_SOURCE_TAX = 'tax';

	const QUERY_MAX_RESULT = 15;

	public function get_type() {
		return 'raven_query';
	}

	/**
	 *  Control default settings.
	 *
	 * @since 1.9.4
	 *
	 * @return array
	 */
	protected function get_default_settings() {
		return array_merge( parent::get_default_settings(), [
			'query' => [
				'source' => 'post', // post, author, term, taxonomy.
				'control_query' => [], // Replace query object value from control.
			],
		] );
	}

	/**
	 * Get query results.
	 *
	 * @since 1.9.4
	 * @since 1.10.0 Supports autocomplete for terms and authors.
	 * @access public
	 *
	 * @param array $data Ajax params.
	 *
	 * @return array
	 */
	public static function query_autocomplete( $request ) {
		if ( empty( $request['source'] ) || empty( $request['query'] ) ) {
			return new \WP_Error( 'ControlQueryAutocomplete', 'Empty or incomplete data' );
		}

		add_filter( 'posts_search', [ self::class, 'search_by_title_only' ], 10, 2 );

		$results = [];

		switch ( $request['source'] ) {
			case self::QUERY_SOURCE_POST:
				$post_query = new \WP_Query( static::get_autocomplete_post_query( $request['query'] ) );

				foreach ( $post_query->posts as $post ) {
					$results[] = [
						'id'   => $post->ID,
						'text' => $post->post_title,
					];
				}
				break;
			case self::QUERY_SOURCE_AUTHOR:
				$author_query = new \WP_User_Query( static::get_autocomplete_author_query( $request['query'] ) );

				foreach ( $author_query->get_results() as $author ) {
					$results[] = [
						'id'   => $author->ID,
						'text' => $author->display_name,
					];
				}
				break;
			case self::QUERY_SOURCE_TAX:
				$tax_query = get_terms( static::get_autocomplete_tax_query( $request['query'] ) );

				foreach ( $tax_query as $term ) {
					$results[] = [
						'id'   => $term->term_id,
						'text' => static::get_term_name_with_parents( $term ),
					];
				}
				break;
		}

		return [
			'results' => $results,
		];
	}

	/**
	 * Get post query.
	 *
	 * @since 1.10.0
	 *
	 * @param array $query Query args.
	 *
	 * @return array
	 */
	public static function get_autocomplete_post_query( $query ) {
		$query = array_merge( [
			'posts_per_page' => self::QUERY_MAX_RESULT,
			'no_found_rows'  => true,
		], $query );
		if ( $query['include'] ) {
			$query['post__in'] = $query['include'];
			unset( $query['include'] );
		}
		if ( $query['exclude'] ) {
			$query['post__not_in'] = $query['exclude'];
			unset( $query['exclude'] );
		}

		// Filter query in search_by_title_only.
		$query['raven_query'] = true;

		return $query;
	}

	/**
	 * Get author query.
	 *
	 * @since 1.10.0
	 *
	 * @param array $query Query args.
	 *
	 * @return array
	 */
	public static function get_autocomplete_author_query( $query ) {
		$query = array_merge( [
			'number'         => self::QUERY_MAX_RESULT,
			'who'            => 'authors',
			'fields'         => [ 'ID', 'display_name' ],
			'search_columns' => [ 'user_login', 'user_nicename' ],
			'count_total'    => false,
		], $query );
		if ( $query['s'] ) {
			$query['search'] = "*{$query['s']}*";
			unset( $query['s'] );
		}
		return $query;
	}

	/**
	 * Get tax query.
	 *
	 * @since 1.10.0
	 *
	 * @param array $query Query args.
	 *
	 * @return array
	 */
	public static function get_autocomplete_tax_query( $query ) {
		$query = array_merge( [
			'number'     => self::QUERY_MAX_RESULT,
			'hide_empty' => false,
			'count'      => false,
			'pad_counts' => false,
		], $query );
		if ( $query['s'] ) {
			$query['name__like'] = $query['s'];
			unset( $query['s'] );
		}
		return $query;
	}

	/**
	 * Search Posts by title only.
	 *
	 * @since 1.10.0
	 *
	 * @access public
	 *
	 * @param string $search Search clause.
	 * @param WP_Query $wp_query WP_Query instance.
	 * @return string
	 */
	public static function search_by_title_only( $search, $wp_query ) {
		global $wpdb;

		if ( empty( $search ) ) {
			return $search;
		}

		$q = $wp_query->query_vars;

		if ( empty( $q['raven_query'] ) ) {
			return $search;
		}

		$n         = ! empty( $q['exact'] ) ? '' : '%';
		$search    = '';
		$searchand = '';

		foreach ( (array) $q['search_terms'] as $term ) {
			$term = esc_sql( $wpdb->esc_like( $term ) );

			$search .= "{$searchand}($wpdb->posts.post_title LIKE '{$n}{$term}{$n}')";

			$searchand = ' AND ';
		}

		if ( ! empty( $search ) ) {
			$search = " AND ({$search}) ";

			if ( ! is_user_logged_in() ) {
				$search .= " AND ($wpdb->posts.post_password = '') ";
			}
		}

		return $search;
	}

	/**
	 * Get term name with parents.
	 *
	 * @since 1.9.5
	 *
	 * @param \WP_Term $term
	 * @param int $max
	 *
	 * @return string
	 */
	private static function get_term_name_with_parents( \WP_Term $term, $max = 3 ) {
		if ( 0 === $term->parent ) {
			return $term->name;
		}

		$separator = is_rtl() ? ' < ' : ' > ';
		$test_term = $term;

		$names = [];

		while ( $test_term->parent > 0 ) {
			$test_term = get_term( $test_term->parent );

			if ( ! $test_term ) {
				break;
			}

			$names[] = $test_term->name;
		}

		$names = array_reverse( $names );

		if ( count( $names ) < ( $max ) ) {
			return implode( $separator, $names ) . $separator . $term->name;
		}

		$name_string = '';

		for ( $i = 0; $i < ( $max - 1 ); $i++ ) {
			$name_string .= $names[ $i ] . $separator;
		}

		return $name_string . '...' . $separator . $term->name;
	}
}
