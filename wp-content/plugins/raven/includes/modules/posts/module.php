<?php
namespace Raven\Modules\Posts;

defined( 'ABSPATH' ) || die();

use Raven\Utils;
use Raven\Base\Module_Base;
use Raven\Modules\Posts\Post;
use Raven\Modules\Posts\Carousel;

class Module extends Module_Base {

	public $actions = [];

	public function __construct() {
		parent::__construct();

		add_action( 'pre_get_posts', [ $this, 'fix_query_offset' ], 1 );
		add_filter( 'found_posts', [ $this, 'fix_query_found_posts' ], 1, 2 );

		add_action( 'wp_ajax_raven_get_render_posts', [ $this, 'ajax_get_render_posts' ] );
		add_action( 'wp_ajax_nopriv_raven_get_render_posts', [ $this, 'ajax_get_render_posts' ] );

		// For posts element.
		$this->add_action( 'post_classic_post', new Post\Actions\Post_Classic() );
		$this->add_action( 'post_cover_post', new Post\Actions\Post_Cover() );

		// For carousel element.
		$this->add_action( 'carousel_classic_post', new Carousel\Actions\Post_Classic() );
		$this->add_action( 'carousel_cover_post', new Carousel\Actions\Post_Cover() );
	}

	public function get_widgets() {
		return [ 'posts', 'posts-carousel' ];
	}

	public function add_action( $action_id, $instance ) {
		if ( ! isset( $this->actions[ $action_id ] ) ) {
			$this->actions[ $action_id ] = $instance;
		}
	}

	public function get_actions( $action_id ) {
		if ( isset( $this->actions[ $action_id ] ) ) {
			return $this->actions[ $action_id ];
		}

		return $this->actions;
	}

	public function ajax_get_render_posts() {
		$post_id       = filter_input( INPUT_POST, 'post_id' );
		$model_id      = filter_input( INPUT_POST, 'model_id' );
		$paged         = filter_input( INPUT_POST, 'paged' );
		$category      = filter_input( INPUT_POST, 'category' );
		$archive_query = filter_input( INPUT_POST, 'archive_query' );

		if ( false !== $archive_query ) {
			$archive_query          = json_decode( $archive_query, true );
			$archive_query['paged'] = $paged;
		}

		if ( empty( $post_id ) ) {
			wp_send_json_error( new \WP_Error( 'no_post_id', 'No post_id defined.' ) );
		}

		if ( empty( $model_id ) ) {
			wp_send_json_error( new \WP_Error( 'no_model_id', 'No model_id defined.' ) );
		}

		$elementor = \Elementor\Plugin::$instance;

		$meta = $elementor->documents->get( $post_id )->get_elements_data();

		$posts_data = Utils::find_element_recursive( $meta, $model_id );

		if ( ! empty( $paged ) ) {
			$posts_data['settings']['paged'] = intval( $paged );
		}

		if ( ! empty( $category ) ) {
			$posts_data['settings']['category'] = intval( $category );
		}

		$widget = $elementor->elements_manager->create_element_instance( $posts_data );

		if ( ! $widget ) {
			wp_send_json_error();
		}

		$queried_posts = $widget->ajax_get_queried_posts( $archive_query );

		wp_send_json_success( $queried_posts );
	}

	public function fix_query_offset( &$query ) {
		if ( ! empty( $query->query_vars['offset_proper'] ) ) {
			if ( $query->is_paged ) {
				$query->set( 'offset', $query->query_vars['offset_proper'] + ( ( $query->query_vars['paged'] - 1 ) * $query->query_vars['posts_per_page'] ) );
				return;
			}

			$query->set( 'offset', $query->query_vars['offset_proper'] );
		}
	}

	public function fix_query_found_posts( $found_posts, $query ) {
		$offset_proper = $query->get( 'fix_pagination_offset' );

		if ( $offset_proper ) {
			$found_posts -= $offset_proper;
		}

		return $found_posts;
	}
}
