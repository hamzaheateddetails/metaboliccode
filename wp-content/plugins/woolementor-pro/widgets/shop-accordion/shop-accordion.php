<?php
namespace codexpert\Woolementor_Pro;

use Elementor\Widget_Base;
use Elementor\Control_Icon;
use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Background;
use codexpert\Woolementor\Controls\Group_Control_Gradient_Text;

class Shop_Accordion extends Widget_Base {

	public $id;

	public function __construct( $data = [], $args = null ) {
	    parent::__construct( $data, $args );

	    $this->id = woolementor_get_widget_id( __CLASS__ );
	    $this->widget = woolementor_get_widget( $this->id );
	    
		// Are we in debug mode?
		$min = defined( 'WOOLEMENTOR_PRO_DEBUG' ) && WOOLEMENTOR_PRO_DEBUG ? '' : '.min';

	    wp_enqueue_script( 'jquery-ui-accordion' );
		wp_register_style( "woolementor-{$this->id}", plugins_url( "assets/css/style{$min}.css", __FILE__ ), [], '1.1' );
	}

	public function get_script_depends() {
		return [ "woolementor-{$this->id}", 'fancybox' ];
	}

	public function get_style_depends() {
		return [ "woolementor-{$this->id}", 'fancybox' ];
	}

	public function get_name() {
		return $this->id;
	}

	public function get_title() {
		return $this->widget['title'];
	}

	public function get_icon() {
		return $this->widget['icon'];
	}

	public function get_categories() {
		return $this->widget['categories'];
	}

	protected function _register_controls() {

		/**
         * Query controls
         */
        $this->start_controls_section(
            '_query_settings',
            [
                'label' => __( 'Query', 'woolementor-pro' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'custom_query',
            [
                'label'         => __( 'Custom Query', 'woolementor-pro' ),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => __( 'Yes', 'woolementor-pro' ),
                'label_off'     => __( 'No', 'woolementor-pro' ),
                'return_value'  => 'yes',
                'default'       => 'no',
            ]
        );

        $this->add_control(
            'number',
            [
                'label'     => __( 'Products per page', 'woolementor-pro' ),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 6,
            ]
        );

        $this->add_control(
            'order',
            [
                'label'         => __( 'Order', 'woolementor-pro' ),
                'type'          => Controls_Manager::SELECT,
                'default'       => 'ASC',
                'options'       => [
                    'ASC'       => __( 'ASC', 'woolementor-pro' ),
                    'DESC'      => __( 'DESC', 'woolementor-pro' ),
                ],
            ]
        );

        $this->add_control(
            'orderby',
            [
                'label'         => __( 'Order By', 'woolementor-pro' ),
                'type'          => Controls_Manager::SELECT,
                'default'       => 'ID',
                'options'       => woolementor_order_options(),
            ]
        );

        $this->start_controls_tabs(
            'custom_query_section_separator',
            [
                'separator' => 'before',
                'condition' => [
                    'custom_query' => 'yes'
                ],
            ]
        );

        $this->start_controls_tab(
            'custom_query_section_normal',
            [
                'label'     => __( 'Custom Query', 'woolementor-pro' ),
            ]
        );

        $this->add_control(
            'categories',
            [
                'label'     => __( 'Include Category', 'woolementor-pro' ),
                'type'      => Controls_Manager::SELECT2,
                'options'   => woolementor_get_terms(),
                'multiple'  => true,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'exclude_categories',
            [
                'label'     => __( 'Exclude Categories', 'woolementor-pro' ),
                'type'      => Controls_Manager::SELECT2,
                'options'   => woolementor_get_terms(),
                'multiple'  => true,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'include_products',
            [
                'label'         => __( 'Include Products', 'woolementor-pro' ),
                'type'          => Controls_Manager::TEXT,
                'label_block'   => 'block',
                'description'   => __( 'Separate values with comma delimiter', 'woolementor-pro' ),
            ]
        );

        $this->add_control(
            'exclude_products',
            [
                'label'         => __( 'Exclude Products', 'woolementor-pro' ),
                'type'          => Controls_Manager::TEXT,
                'label_block'   => 'block',
                'description'   => __( 'Separate values with comma delimiter', 'woolementor-pro' ),
            ]
        );

        $this->add_control(
            'sale_products_show_hide',
            [
                'label'         => __( "'On Sale' Products Only", 'woolementor' ),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => __( 'Yes', 'woolementor' ),
                'label_off'     => __( 'No', 'woolementor' ),
                'return_value'  => 'yes',
                'default'       => 'no',
            ]
        );

        $this->add_control(
            'out_of_stock',
            [
                'label'         => __( "Hide Stock out products", 'woolementor' ),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => __( 'Yes', 'woolementor' ),
                'label_off'     => __( 'No', 'woolementor' ),
                'return_value'  => 'yes',
                'default'       => '',
            ]
        );

        $this->add_control(
            'offset',
            [
                'label'         => __( 'Offset', 'woolementor-pro' ),
                'type'          => Controls_Manager::NUMBER,
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

		/**
		 * Image controls
		 */
		$this->start_controls_section(
			'section_content_product_image',
			[
				'label' => __( 'Product Image', 'woolementor-pro' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'image_on_click',
			[
				'label'     => __( 'On Click', 'woolementor-pro' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
					'none'          => __( 'None', 'woolementor-pro' ),
					'zoom'          => __( 'Zoom', 'woolementor-pro' ),
					'product_page'  => __( 'Product Page', 'woolementor-pro' ),
				],
				'default'   => 'none',
			]
		);

		$this->end_controls_section();

		/**
         * Sale Ribbon controls
         */
        $this->start_controls_section(
            'section_content_stock',
            [
                'label' => __( 'Stock text', 'woolementor' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'stock_show_hide',
            [
                'label'         => __( 'Show/Hide', 'woolementor' ),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => __( 'Show', 'woolementor' ),
                'label_off'     => __( 'Hide', 'woolementor' ),
                'return_value'  => 'yes',
                'default'       => 'yes',
            ]
        );

        $this->add_control(
            'stock_ribbon_text',
            [
                'label'         => __( 'Text', 'woolementor' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => __( 'Out Of Stock', 'woolementor' ),
                'placeholder'   => __( 'Type your text here', 'woolementor' ),
                'condition' => [
                    'stock_show_hide' => 'yes'
                ],
            ]
        );

        $this->end_controls_section();
		
		/**
		 * Cart controls
		 */
		$this->start_controls_section(
			'section_content_cart',
			[
				'label' => __( 'Cart', 'woolementor-pro' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'cart_show_hide',
			[
				'label' 		=> __( 'Show/Hide', 'woolementor-pro' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Show', 'woolementor-pro' ),
				'label_off' 	=> __( 'Hide', 'woolementor-pro' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'yes',
			]
		);

		$this->end_controls_section();
		
		/**
		 * Wishlist controls
		 */
		$this->start_controls_section(
			'section_content_wishlist',
			[
				'label' => __( 'Wishlist', 'woolementor-pro' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'wishlist_show_hide',
			[
				'label' 		=> __( 'Show/Hide', 'woolementor-pro' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Show', 'woolementor-pro' ),
				'label_off' 	=> __( 'Hide', 'woolementor-pro' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'yes',
			]
		);

		$this->end_controls_section();

		/**
         * Product Category
         */
        $this->start_controls_section(
            'section_product_category',
            [
                'label' 		=> __( 'Product Category', 'woolementor-pro' ),
                'tab'   		=> Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'product_category_show_hide',
            [
                'label'         => __( 'Show/Hide', 'woolementor-pro' ),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => __( 'Show', 'woolementor-pro' ),
                'label_off'     => __( 'Hide', 'woolementor-pro' ),
                'return_value'  => 'yes',
                'default'       => 'yes',
            ]
        );

        $this->add_control(
			'product_category_count',
			[
				'label' => __( 'Category Count', 'woolementor-pro' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 2,
			]
		);

        $this->end_controls_section();

		/**
         * Product Category
         */
        $this->start_controls_section(
            'section_product_tag',
            [
                'label' 		=> __( 'Product Tag', 'woolementor-pro' ),
                'tab'   		=> Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'product_tag_show_hide',
            [
                'label'         => __( 'Show/Hide', 'woolementor-pro' ),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => __( 'Show', 'woolementor-pro' ),
                'label_off'     => __( 'Hide', 'woolementor-pro' ),
                'return_value'  => 'yes',
                'default'       => 'yes',
            ]
        );

        $this->add_control(
			'product_tag_count',
			[
				'label' => __( 'Tag Count', 'woolementor-pro' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 2,
			]
		);

        $this->end_controls_section();

		/**
         * star_rating
         */
        $this->start_controls_section(
            'section_content_star_rating',
            [
                'label' 		=> __( 'Star Rating', 'woolementor-pro' ),
                'tab'   		=> Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'star_rating_show_hide',
            [
                'label'         => __( 'Show/Hide', 'woolementor-pro' ),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => __( 'Show', 'woolementor-pro' ),
                'label_off'     => __( 'Hide', 'woolementor-pro' ),
                'return_value'  => 'yes',
                'default'       => 'yes',
            ]
        );

        $this->end_controls_section();

		/**
		 * Pagination controls
		 */
		$this->start_controls_section(
			'section_content_pagination',
			[
				'label' => __( 'Pagination', 'woolementor-pro' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'pagination_show_hide',
			[
				'label'         => __( 'Show/Hide', 'woolementor-pro' ),
				'type'          => Controls_Manager::SWITCHER,
				'label_on'      => __( 'Show', 'woolementor-pro' ),
				'label_off'     => __( 'Hide', 'woolementor-pro' ),
				'return_value'  => 'yes',
				'default'       => 'yes',
			]
		);

		$this->end_controls_section();

		/**
		 * Row
		 */
		$this->start_controls_section(
			'section_style_row',
			[
				'label' => __( 'Row', 'woolementor-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'section_style_accordion_switcher',
			[
				'label' 		=> __( 'Open First Item by Default', 'plugin-domain' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'On', 'woolementor-pro' ),
				'label_off' 	=> __( 'Off', 'woolementor-pro' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'yes',
			]
		);

		$this->add_responsive_control(
			'section_style_row_padding',
			[
				'label' 		=> __( 'Padding', 'woolementor-pro' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wl-sa-single-accordion' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'section_style_row_margin',
			[
				'label' 		=> __( 'Margin', 'woolementor-pro' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wl-sa-single-accordion' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		/**
		 * Product Style controls
		 */
		$this->start_controls_section(
			'style_section_heading',
			[
				'label' 	=> __( 'Heading', 'woolementor-pro' ),
				'tab'   	=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'heading_text_align',
			[
				'label' 	=> __( 'Alignment', 'woolementor-pro' ),
				'type' 		=> Controls_Manager::CHOOSE,
				'options' 	=> [
					'left' 		=> [
						'title' => __( 'Left', 'woolementor-pro' ),
						'icon' 	=> 'fa fa-align-left',
					],
					'center' 	=> [
						'title' => __( 'Center', 'woolementor-pro' ),
						'icon' 	=> 'fa fa-align-center',
					],
					'right' 	=> [
						'title' => __( 'Right', 'woolementor-pro' ),
						'icon' 	=> 'fa fa-align-right',
					],
				],
				'default' 	=> 'left',
				'toggle' 	=> false,
				'selectors' 	=> [
					'{{WRAPPER}} .wl-sa-accordion-title' => 'text-align: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'heading_text_height',
			[
				'label' 	=> __( 'Height', 'woolementor-pro' ),
				'type' 		=> Controls_Manager::SLIDER,
				'size_units'=> [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .wl-sa-accordion-title' => 'height: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .wl-sa-accordion-title h2' => 'line-height: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .wl-sa-accordion-title span::before' => 'line-height: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .wl-sa-accordion-title span' => 'height: {{SIZE}}{{UNIT}}',
				],
				'range' 	=> [
					'px' 	=> [
						'min' 	=> 1,
						'max' 	=> 100
					],
					'em' 	=> [
						'min' 	=> 1,
						'max' 	=> 10
					],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' 		=> 'heading_box_background',
				'label' 	=> __( 'Background', 'woolementor-pro' ),
				'types' 	=> [ 'classic', 'gradient' ],
				'selector' 	=> '{{WRAPPER}} .wl-sa-accordion-title',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 		=> 'heading_border',
				'label' 	=> __( 'Border', 'woolementor-pro' ),
				'selector' 	=> '{{WRAPPER}} .wl-sa-accordion-title',
				'separator' => 'before'
			]
		);

		$this->add_responsive_control(
			'heading_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'woolementor-pro' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wl-sa-accordion-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 		=> 'heading_box_shadow',
				'label' 	=> __( 'Box Shadow', 'woolementor-pro' ),
				'selector' 	=> '{{WRAPPER}} .wl-sa-accordion-title',
			]
		);

		$this->add_responsive_control(
			'heading_box_shadow_padding',
			[
				'label' 		=> __( 'Padding', 'woolementor-pro' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wl-sa-accordion-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'heading_box_shadow_margin',
			[
				'label' 		=> __( 'Margin', 'woolementor-pro' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wl-sa-accordion-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs(
			'heading_box_tab',
			[
				'separator' => 'before'
			]
		);

		$this->start_controls_tab(
			'heading_box_normal',
			[
				'label' 	=> __( 'Collapsed Expanded', 'woolementor-pro' ),
			]
		);

		$this->add_control(
			'heading_box_collapse_color',
			[
				'label' 	=> __( 'Background Color', 'woolementor-pro' ),
				'type' 		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wl-sa-open .wl-sa-accordion-title' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'heading_box_icon_color',
			[
				'label' 	=> __( 'Icon Color', 'woolementor-pro' ),
				'type' 		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wl-sa-single-accordion.wl-sa-open .wl-sa-accordion-title span::before' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'heading_box_btn_color',
			[
				'label' 	=> __( 'Button Color', 'woolementor-pro' ),
				'type' 		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wl-sa-single-accordion.wl-sa-open .wl-sa-accordion-title span' => 'background: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'heading_box_hover',
			[
				'label' 	=> __( 'Collapsed Regular', 'woolementor-pro' ),
			]
		);

		$this->add_control(
			'heading_box_collapse_regular_bg',
			[
				'label' 	=> __( 'Background Color', 'woolementor-pro' ),
				'type' 		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wl-sa-accordion-title' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'heading_box_regular_icon_color',
			[
				'label' 	=> __( 'Icon Color', 'woolementor-pro' ),
				'type' 		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wl-sa-accordion-title span::before' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'heading_box_regular_btn_color',
			[
				'label' 	=> __( 'Button Color', 'woolementor-pro' ),
				'type' 		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wl-sa-accordion-title span' => 'background: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();

		/**
		 * Product Style controls
		 */
		$this->start_controls_section(
			'style_section_box',
			[
				'label' => __( 'Content Wrapper', 'woolementor-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' 		=> 'widget_box_background',
				'label' 	=> __( 'Background', 'woolementor-pro' ),
				'types' 	=> [ 'classic', 'gradient' ],
				'selector' 	=> '{{WRAPPER}} .wl-sa-accordion-content',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 		=> 'widget_box_border',
				'label' 	=> __( 'Border', 'woolementor-pro' ),
				'selector' 	=> '{{WRAPPER}} .wl-sa-accordion-content',
				'separator' => 'before'
			]
		);

		$this->add_responsive_control(
			'widget_box_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'woolementor-pro' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wl-sa-accordion-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 		=> 'widget_box_shadow',
				'label' 	=> __( 'Box Shadow', 'woolementor-pro' ),
				'selector' 	=> '{{WRAPPER}} .wl-sa-accordion-content',
			]
		);

		$this->add_responsive_control(
			'widget_box_shadow_padding',
			[
				'label' 		=> __( 'Padding', 'woolementor-pro' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wl-sa-accordion-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'widget_box_shadow_margin',
			[
				'label' 		=> __( 'Margin', 'woolementor-pro' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wl-sa-accordion-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		/**
		 * Product Title
		 */
		$this->start_controls_section(
			'section_style_title',
			[
				'label' => __( 'Product Title', 'woolementor-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
            Group_Control_Gradient_Text::get_type(),
            [
                'name' => 'title_gradient_color',
                'selector' => '{{WRAPPER}} .wl-sa-accordion-title h2',
            ]
        );

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'title_typography',
				'label' 	=> __( 'Typography', 'woolementor-pro' ),
				'scheme' 	=> Typography::TYPOGRAPHY_3,
				'selector' 	=> '{{WRAPPER}} .wl-sa-accordion-title h2',
			]
		);

		$this->end_controls_section();

		/**
		 * Product Short Dexcription
		 */
		$this->start_controls_section(
			'section_short_description',
			[
				'label' => __( 'Short Description', 'woolementor-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'short_description_show_hide',
			[
				'label'         => __( 'Show Content', 'woolementor-pro' ),
				'type'          => Controls_Manager::SWITCHER,
				'label_on'      => __( 'Show', 'woolementor-pro' ),
				'label_off'     => __( 'Hide', 'woolementor-pro' ),
				'return_value'  => 'yes',
				'default'       => 'yes',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'short_description_typography',
				'label'     => __( 'Typography', 'woolementor-pro' ),
				'scheme'    => Typography::TYPOGRAPHY_3,
				'selector'  => '{{WRAPPER}} .wl-sa-accordion-content p',
			]
		); 

		$this->add_control(
			'short_description_color',
			[
				'label'     => __( 'Color', 'woolementor-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wl-sa-accordion-content p' => 'color: {{VALUE}}',
				],
			]
		);

        $this->add_control(
			'product_desc_words_count',
			[
				'label' 		=> __( 'Words Count', 'woolementor-pro' ),
				'type' 			=> Controls_Manager::NUMBER,
				'default' 		=> 20,
			]
		);

		$this->end_controls_section();

		/**
		 * Product Category
		 */
		$this->start_controls_section(
			'section_style_category',
			[
				'label' => __( 'Product Category', 'woolementor-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' 	=> [
					'product_category_show_hide' => 'yes',
				],
			]
		);

		$this->start_controls_tabs(
			'category_label_separator',
			[
				'separator' => 'before'
			]
		);

		$this->start_controls_tab(
			'category_label',
			[
				'label' 	=> __( 'Label', 'woolementor-pro' ),
			]
		);

		$this->add_group_control(
            Group_Control_Gradient_Text::get_type(),
            [
                'name' => 'category_label_gradient_color',
                'selector' => '{{WRAPPER}} .wl-sa-accordion-cat span',
            ]
        );

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'category_label_typography',
				'label' 	=> __( 'Typography', 'woolementor-pro' ),
				'scheme' 	=> Typography::TYPOGRAPHY_3,
				'selector' 	=> '{{WRAPPER}} .wl-sa-accordion-cat span',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'category_text',
			[
				'label' 	=> __( 'Text', 'woolementor-pro' ),
			]
		);

		$this->add_group_control(
            Group_Control_Gradient_Text::get_type(),
            [
                'name' => 'category_gradient_color',
                'selector' => '{{WRAPPER}} .wl-sa-accordion-cat a',
            ]
        );

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'category_typography',
				'label' 	=> __( 'Typography', 'woolementor-pro' ),
				'scheme' 	=> Typography::TYPOGRAPHY_3,
				'selector' 	=> '{{WRAPPER}} .wl-sa-accordion-cat a',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		/**
		 * Product Tag
		 */
		$this->start_controls_section(
			'section_style_tag',
			[
				'label' => __( 'Product Tag', 'woolementor-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' 	=> [
					'product_category_show_hide' => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'tag_typography',
				'label' 	=> __( 'Typography', 'woolementor-pro' ),
				'scheme' 	=> Typography::TYPOGRAPHY_3,
				'selector' 	=> '{{WRAPPER}} span.wl-sa-tag',
			]
		);

		$this->start_controls_tabs(
			'tag_label_separator',
			[
				'separator' => 'before',
			]
		);

		$this->start_controls_tab(
			'tag_1',
			[
				'label' 	=> __( 'Tag One', 'woolementor-pro' ),
			]
		);

		$this->add_control(
			'tag_1_color',
			[
				'label'     => __( 'Color', 'woolementor-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wl-sa-tag:nth-child(3n+1) a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'tag_1_bg',
			[
				'label'     => __( 'Background ', 'woolementor-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wl-sa-tag:nth-child(3n+1)' => 'background: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tag_2',
			[
				'label' 	=> __( 'Tag Two', 'woolementor-pro' ),
			]
		);

		$this->add_control(
			'tag_2_color',
			[
				'label'     => __( 'Color', 'woolementor-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wl-sa-tag:nth-child(3n+2) a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'tag_2_bg',
			[
				'label'     => __( 'Background ', 'woolementor-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wl-sa-tag:nth-child(3n+2)' => 'background: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tag_3',
			[
				'label' 	=> __( 'Tag Three', 'woolementor-pro' ),
			]
		);

		$this->add_control(
			'tag_3_color',
			[
				'label'     => __( 'Color', 'woolementor-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wl-sa-tag:nth-child(3n) a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'tag_3_bg',
			[
				'label'     => __( 'Background ', 'woolementor-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wl-sa-tag:nth-child(3n)' => 'background: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();
		$this->end_controls_section();

		/**
		 * Product Price
		 */
		$this->start_controls_section(
			'section_style_price',
			[
				'label' => __( 'Product Price', 'woolementor-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'price_color',
			[
				'label'     => __( 'Color', 'woolementor-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wl-sa-product-info .wl-sa-price' => 'color: {{VALUE}}',
					'{{WRAPPER}} .wl-sa-product-info .wl-sa-price .amount' => 'color: {{VALUE}}',
					'{{WRAPPER}} .wl-sa-product-info .wl-sa-price ins.amount' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'price_size_typography',
				'label' 	=> __( 'Typography', 'woolementor-pro' ),
				'scheme' 	=> Typography::TYPOGRAPHY_3,
				'selector' 	=> '{{WRAPPER}} .wl-sa-product-info .wl-sa-price .amount , .wl-sa-product-info .wl-sa-price ins.amount',
			]
		);    

		$this->add_control(
			'sale_price_show_hide',
			[
				'label'			=> __( 'Show Sale Price', 'woolementor-pro' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Show', 'woolementor-pro' ),
				'label_off' 	=> __( 'Hide', 'woolementor-pro' ),
				'return_value' 	=> 'block',
				'default' 		=> 'none',
				'separator' 	=> 'before',
				'selectors' 	=> [
					'{{WRAPPER}} .wl-sa-product-info .wl-sa-price del' => 'display: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'sale_price_color',
			[
				'label'     => __( 'Color', 'woolementor-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wl-sa-product-info .wl-sa-price del .amount' => 'color: {{VALUE}}',
				],
				'condition' => [
					'sale_price_show_hide' => 'block'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'sale_price_size_typography',
				'label' 	=> __( 'Typography', 'woolementor-pro' ),
				'scheme' 	=> Typography::TYPOGRAPHY_3,
				'selector' 	=> '{{WRAPPER}} .wl-sa-product-info .wl-sa-price del .amount',
				'condition' => [
					'sale_price_show_hide' => 'block'
				],
			]
		);



		$this->end_controls_section();

		/**
		 * Product Currency Symbol
		 */
		$this->start_controls_section(
			'section_style_currency',
			[
				'label' => __( 'Currency Symbol', 'woolementor-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'price_currency',
			[
				'label'     => __( 'Color', 'woolementor-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wl-sa-price .woocommerce-Price-currencySymbol' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'price_currency_typography',
				'label' 	=> __( 'Typography', 'woolementor-pro' ),
				'scheme' 	=> Typography::TYPOGRAPHY_3,
				'selector' 	=> '{{WRAPPER}} .wl-sa-price .woocommerce-Price-currencySymbol',
			]
		);

		$this->end_controls_section();

		/**
		 * Product Image controls
		 */
		$this->start_controls_section(
			'section_style_image',
			[
				'label' => __( 'Product Image', 'woolementor-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' 		=> 'image_thumbnail',
				'exclude' 	=> [ 'custom' ],
				'include' 	=> [],
				'default' 	=> 'large',
			]
		);

		$this->add_responsive_control(
			'image_width',
			[
				'label' 	=> __( 'Image Width', 'woolementor-pro' ),
				'type' 		=> Controls_Manager::SLIDER,
				'size_units'=> [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .wl-sa-acordion-left img' => 'width: {{SIZE}}{{UNIT}}',
				],
				'range' 	=> [
					'px' 	=> [
						'min' 	=> 1,
						'max' 	=> 500
					],
					'em' 	=> [
						'min' 	=> 1,
						'max' 	=> 30
					],
				],
			]
		);

		$this->add_responsive_control(
			'image_height',
			[
				'label' 	=> __( 'Image Height', 'woolementor-pro' ),
				'type' 		=> Controls_Manager::SLIDER,
				'size_units'=> [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .wl-sa-acordion-left img' => 'height: {{SIZE}}{{UNIT}}',
				],
				'range' 	=> [
					'px' 	=> [
						'min' 	=> 50,
						'max' 	=> 500
					],
					'em' 	=> [
						'min' 	=> 5,
						'max' 	=> 50
					]
				],
			]
		);

		$this->add_responsive_control(
			'image_box_height',
			[
				'label' 	=> __( 'Image Box Height', 'woolementor-pro' ),
				'type' 		=> Controls_Manager::SLIDER,
				'size_units'=> [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .wl-sa-acordion-left' => 'height: {{SIZE}}{{UNIT}}',
				],
                'range'     => [
                    'px'    => [
                        'min'   => 1,
                        'max'   => 500
                    ],
                    'em'    => [
                        'min'   => 1,
                        'max'   => 30
                    ],
                ],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 		=> 'image_border',
				'label' 	=> __( 'Border', 'woolementor-pro' ),
				'selector' 	=> '{{WRAPPER}} .wl-sa-acordion-left img',
			]
		);

		$this->add_responsive_control(
			'image_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'woolementor-pro' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wl-sa-acordion-left img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 		=> 'image_box_shadow',
				'label' 	=> __( 'Box Shadow', 'woolementor-pro' ),
				'selector' 	=> '{{WRAPPER}} .wl-sa-acordion-left img',
			]
		);

		$this->start_controls_tabs(
			'image_effects',
			[
				'separator' => 'before'
			]
		);

		$this->start_controls_tab(
			'image_effects_normal',
			[
				'label' 	=> __( 'Normal', 'woolementor-pro' ),
			]
		);

		$this->add_control(
			'image_opacity',
			[
				'label' 	=> __( 'Opacity', 'woolementor-pro' ),
				'type' 		=> Controls_Manager::SLIDER,
				'range' 	=> [
					'px' 	=> [
						'max' 	=> 1,
						'min' 	=> 0.10,
						'step' 	=> 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .wl-sa-acordion-left img' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' 		=> 'image_css_filters',
				'selector' 	=> '{{WRAPPER}} .wl-sa-acordion-left img',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'image_hover',
			[
				'label' 	=> __( 'Hover', 'woolementor-pro' ),
			]
		);

		$this->add_control(
			'image_opacity_hover',
			[
				'label' 	=> __( 'Opacity', 'woolementor-pro' ),
				'type' 		=> Controls_Manager::SLIDER,
				'range' 	=> [
					'px' 	=> [
						'max' 	=> 1,
						'min' 	=> 0.10,
						'step' 	=> 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .wl-sa-acordion-left img:hover' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' 		=> 'image_css_filters_hover',
				'selector' 	=> '{{WRAPPER}} .wl-sa-acordion-left img:hover',
			]
		);

		$this->add_control(
			'image_hover_transition',
			[
				'label' 	=> __( 'Transition Duration', 'woolementor-pro' ),
				'type' 		=> Controls_Manager::SLIDER,
				'range' 	=> [
					'px' 	=> [
						'max' 	=> 3,
						'step' 	=> 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .wl-sa-acordion-left img:hover' => 'transition-duration: {{SIZE}}s',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		/**
        * Stock Ribbon Styleing 
        */

        $this->start_controls_section(
            'section_style_stock_ribbon',
            [
                'label' => __( 'Stock Ribbon', 'woolementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'stock_show_hide' => 'yes'
                ],
            ]
        );

        $this->add_responsive_control(
            'stock_ribbon_width',
            [
                'label'     => __( 'Width', 'woolementor' ),
                'type'      => Controls_Manager::SLIDER,
                'size_units'=> [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .wl-sa-stock' => 'width: {{SIZE}}{{UNIT}}',
                ],
                'range'     => [
                    'px'    => [
                        'min'   => 50,
                        'max'   => 500
                    ]
                ],
            ]
        );

        $this->add_control(
            'stock_ribbon_font_color',
            [
                'label'     => __( 'Color', 'woolementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wl-sa-stock' => 'color: {{VALUE}}',
                ],
                'separator' => 'before'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'stock_content_typography',
                'label'     => __( 'Typography', 'woolementor' ),
                'scheme'    => Typography::TYPOGRAPHY_3,
                'selector'  => '{{WRAPPER}} .wl-sa-stock',
            ]
        );

        $this->add_control(
            'stock_ribbon_background',
            [
                'label'         => __( 'Background', 'woolementor' ),
                'type'          => Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .wl-sa-stock' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'stock_ribbon_padding',
            [
                'label'         => __( 'Padding', 'woolementor' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%', 'em' ],
                'selectors'     => [
                    '{{WRAPPER}} .wl-sa-stock' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'after'
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'          => 'stock_ribbon_border',
                'label'         => __( 'Border', 'woolementor' ),
                'selector'      => '{{WRAPPER}} .wl-sa-stock',
            ]
        );

        $this->add_responsive_control(
            'stock_ribbon_border_radius',
            [
                'label'         => __( 'Border Radius', 'woolementor' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .wl-sa-stock' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
		
		/**
         * star_rating
         */
        $this->start_controls_section(
            'section_style_star_rating',
            [
                'label' 		=> __( 'Star Rating', 'woolementor-pro' ),
                'tab'   		=> Controls_Manager::TAB_STYLE,
                'condition'     => [
                    'star_rating_show_hide' => 'yes'
                ],
            ]
        );

        $this->add_control(
			'star_rating_blockicon',
			[
				'label' 	=> __( 'Block Icon', 'woolementor-pro' ),
				'type' 		=> Controls_Manager::ICONS,
				'default' 	=> [
					'value' 	=> 'fas fa-star',
					'library' 	=> 'solid',
				],
			]
		);

		$this->add_control(
			'star_rating_empty_icon',
			[
				'label' 	=> __( 'Empty Icon', 'woolementor-pro' ),
				'type' 		=> Controls_Manager::ICONS,
				'default' 	=> [
					'value' 	=> 'far fa-star',
					'library' 	=> 'solid',
				],
			]
		);

        $this->add_responsive_control(
            'star_rating_icon_size',
            [
                'label'     	=> __( 'Icon Size', 'woolementor-pro' ),
                'type'      	=> Controls_Manager::SLIDER,
                'size_units'	=> [ 'px', 'em' ],
                'selectors' 	=> [
                    '{{WRAPPER}} .wl-sa-rating' => 'font-size: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
            'star_rating_color',
            [
                'label'     	=> __( 'Color', 'woolementor-pro' ),
                'type'      	=> Controls_Manager::COLOR,
                'selectors' 	=> [
                    '{{WRAPPER}} .wl-sa-rating' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

		/**
		 * Cart Button
		 */
		$this->start_controls_section(
			'section_style_cart',
			[
				'label' => __( 'Cart Button', 'woolementor-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition'     => [
				    'cart_show_hide' => 'yes'
				],
			]
		);

		$this->add_control(
            'cart_icon',
            [
                'label'         => __( 'Icon', 'woolementor' ),
                'type'          => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default'       => [
                    'value'     => 'fa fa-shopping-cart',
                    'library'   => 'fa-solid',
                ],
                'recommended'   => [
                    'fa-regular' => [
                        'luggage-cart',
                        'opencart',
                    ],
                    'fa-solid'  => [
                        'shopping-cart',
                        'cart-arrow-down',
                        'cart-plus',
                        'luggage-cart',
                    ]
                ]
            ]
        );

		$this->add_responsive_control(
			'cart_icon_size',
			[
				'label'     => __( 'Icon Size', 'woolementor-pro' ),
				'type'      => Controls_Manager::SLIDER,
				'size_units'=> [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .wl-sa-info-icons .wl-sa-product-cart a' => 'font-size: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'cart_area_size',
			[
				'label'     => __( 'Area Size', 'woolementor-pro' ),
				'type'      => Controls_Manager::SLIDER,
				'size_units'=> [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .wl-sa-info-icons .wl-sa-product-cart a' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'cart_border_radius',
			[
				'label'         => __( 'Border Radius', 'woolementor-pro' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .wl-sa-info-icons .wl-sa-product-cart a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .wl-sa-product-cart .added_to_cart.wc-forward::after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs(
			'cart_normal_separator',
			[
				'separator' => 'before'
			]
		);

		$this->start_controls_tab(
			'cart_normal',
			[
				'label'     => __( 'Normal', 'woolementor-pro' ),
			]
		);

		$this->add_control(
			'cart_icon_color',
			[
				'label'     => __( 'Color', 'woolementor-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wl-sa-info-icons .wl-sa-product-cart a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'cart_icon_bg',
			[
				'label'     => __( 'Background', 'woolementor-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wl-sa-info-icons .wl-sa-product-cart a' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'cart_border',
				'label'         => __( 'Border', 'woolementor-pro' ),
				'selector'      => '{{WRAPPER}} .wl-sa-info-icons .wl-sa-product-cart a',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'cart_hover',
			[
				'label'     => __( 'Hover', 'woolementor-pro' ),
			]
		);

		$this->add_control(
			'cart_icon_color_hover',
			[
				'label'     => __( 'Color', 'woolementor-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wl-sa-info-icons .wl-sa-product-cart a:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'cart_icon_bg_hover',
			[
				'label'     => __( 'Background', 'woolementor-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wl-sa-info-icons .wl-sa-product-cart a:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'cart_border_hover',
				'label'         => __( 'Border', 'woolementor-pro' ),
				'selector'      => '{{WRAPPER}} .wl-sa-info-icons .wl-sa-product-cart a:hover',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'cart_view_cart',
			[
				'label'     => __( 'View Cart', 'woolementor-pro' ),
			]
		);

		$this->add_control(
			'cart_icon_color_view_cart',
			[
				'label'     => __( 'Color', 'woolementor-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wl-sa-product-cart .added_to_cart.wc-forward::after' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'cart_icon_bg_view_cart',
			[
				'label'     => __( 'Background', 'woolementor-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wl-sa-product-cart .added_to_cart.wc-forward::after' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'cart_border_view_cart',
				'label'         => __( 'Border', 'woolementor-pro' ),
				'selector'      => '{{WRAPPER}} .wl-sa-product-cart .added_to_cart.wc-forward::after',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		/**
		 * Wishlist Button
		 */
		$this->start_controls_section(
			'section_style_wishlist',
			[
				'label' => __( 'Wishlist Button', 'woolementor-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' 	=> [
					'wishlist_show_hide' => 'yes'
				],
			]
		);

		$this->add_control(
            'wishlist_icon',
            [
                'label'         => __( 'Icon', 'woolementor' ),
                'type'          => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default'       => [
                    'value'     => 'fa fa-heart',
                    'library'   => 'fa-solid',
                ],
                'recommended'   => [
                    'fa-regular' => [
                        'heart',
                    ],
                    'fa-solid'  => [
                        'heart',
                        'heart-broken',
                        'heartbeat',
                    ]
                ]
            ]
        );

		$this->add_responsive_control(
			'wishlist_icon_size',
			[
				'label'     => __( 'Icon Size', 'woolementor-pro' ),
				'type'      => Controls_Manager::SLIDER,
				'size_units'=> [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .wl-sa-info-icons .wl-sa-product-fav a' => 'font-size: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'wishlist_area_size',
			[
				'label'     => __( 'Area Size', 'woolementor-pro' ),
				'type'      => Controls_Manager::SLIDER,
				'size_units'=> [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .wl-sa-info-icons .wl-sa-product-fav a' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'wishlist_border_radius',
			[
				'label'         => __( 'Border Radius', 'woolementor-pro' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .wl-sa-info-icons .wl-sa-product-fav a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs(
			'wishlist_border_separator',
			[
				'separator' => 'before'
			]
		);

		$this->start_controls_tab(
			'wishlist_border_radius_normal',
			[
				'label'     => __( 'Normal', 'woolementor-pro' ),
			]
		);

		$this->add_control(
			'wishlist_icon_color_normal',
			[
				'label'     => __( 'Color', 'woolementor-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wl-sa-info-icons .wl-sa-product-fav a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'wishlist_icon_bg_normal',
			[
				'label'     => __( 'Background', 'woolementor-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wl-sa-info-icons .wl-sa-product-fav a' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'wishlist_border_normal',
				'label'         => __( 'Border', 'woolementor-pro' ),
				'selector'      => '{{WRAPPER}} .wl-sa-info-icons .wl-sa-product-fav a',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'wishlist_border_radius_hover',
			[
				'label'     => __( 'Hover', 'woolementor-pro' ),
			]
		);

		$this->add_control(
			'wishlist_icon_color_hover',
			[
				'label'     => __( 'Color', 'woolementor-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wl-sa-info-icons a.ajax_add_to_wish.fav-item' => 'color: {{VALUE}}',
					'{{WRAPPER}} .wl-sa-product-fav a:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'wishlist_icon_bg_hover',
			[
				'label'     => __( 'Background', 'woolementor-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wl-sa-info-icons a.ajax_add_to_wish.fav-item' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .wl-sa-product-fav a:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'wishlist_border_hover',
				'label'         => __( 'Border', 'woolementor-pro' ),
				'selector'      => '{{WRAPPER}} .wl-sa-info-icons a.ajax_add_to_wish.fav-item, {{WRAPPER}} .wl-sa-product-fav a:hover',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		/**
		 * Pagination
		 */
		$this->start_controls_section(
			'section_style_pagination',
			[
				'label' => __( 'Pagination', 'woolementor-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition'     => [
					'pagination_show_hide' => 'yes'
				],
			]
		);

		$this->add_control(
			'pagination_alignment',
			[
				'label' 	=> __( 'Alignment', 'woolementor-pro' ),
				'type' 		=> Controls_Manager::CHOOSE,
				'options' 	=> [
					'left' 		=> [
						'title' 	=> __( 'Left', 'woolementor-pro' ),
						'icon' 		=> 'fa fa-align-left',
					],
					'center' 	=> [
						'title' 	=> __( 'Center', 'woolementor-pro' ),
						'icon' 		=> 'fa fa-align-center',
					],
					'right' 	=> [
						'title' 	=> __( 'Right', 'woolementor-pro' ),
						'icon' 		=> 'fa fa-align-right',
					],
				],
				'default' 	=> 'center',
				'toggle' 	=> true,
				'selectors' => [
					'{{WRAPPER}} .wl-sa-pagination' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'pagination_left_icon',
			[
				'label' 	=> __( 'Left Icon', 'woolementor-pro' ),
				'type' 		=> Controls_Manager::ICONS,
				'default' 	=> [
					'value' => 'fa fa-arrow-left',
					'library' => 'solid',
				],
			]
		);

		$this->add_control(
			'pagination_right_icon',
			[
				'label' 	=> __( 'Right Icon', 'woolementor-pro' ),
				'type' 		=> Controls_Manager::ICONS,
				'default' 	=> [
					'value' => 'fa fa-arrow-right',
					'library' => 'solid',
				],
			]
		);

		$this->add_responsive_control(
			'pagination_icon_size',
			[
				'label'     => __( 'Font Size', 'woolementor-pro' ),
				'type'      => Controls_Manager::SLIDER,
				'size_units'=> [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .wl-sa-pagination .page-numbers' => 'font-size: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'pagination_item_margin',
			[
				'label'         => __( 'Margin', 'woolementor-pro' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em' ],
				'selectors'     => [
					'{{WRAPPER}} .wl-sa-pagination' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'pagination_item_padding',
			[
				'label'         => __( 'Padding', 'woolementor-pro' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em' ],
				'selectors'     => [
					'{{WRAPPER}} .wl-sa-pagination .page-numbers' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs(
			'pagination_separator',
			[
				'separator' => 'before'
			]
		);

		$this->start_controls_tab(
			'pagination_normal_item',
			[
				'label'     => __( 'Normal', 'woolementor-pro' ),
			]
		);

		$this->add_control(
			'pagination_color',
			[
				'label'     => __( 'Color', 'woolementor-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wl-sa-pagination .page-numbers' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'pagination_icon_bg',
			[
				'label'     => __( 'Background', 'woolementor-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wl-sa-pagination .page-numbers' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'pagination_border',
				'label'         => __( 'Border', 'woolementor-pro' ),
				'selector'      => '{{WRAPPER}} .wl-sa-pagination .page-numbers',
			]
		);

		$this->add_responsive_control(
			'pagination_border_radius',
			[
				'label'         => __( 'Border Radius', 'woolementor-pro' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .wl-sa-pagination .page-numbers' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'pagination_current_item',
			[
				'label'     => __( 'Active', 'woolementor-pro' ),
			]
		);

		$this->add_control(
			'pagination_current_item_color',
			[
				'label'     => __( 'Color', 'woolementor-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wl-sa-pagination .page-numbers.current' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'pagination_current_item_bg',
			[
				'label'     => __( 'Background', 'woolementor-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wl-sa-pagination .page-numbers.current' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'pagination_current_item_border',
				'label'         => __( 'Border', 'woolementor-pro' ),
				'selector'      => '{{WRAPPER}} .wl-sa-pagination .page-numbers.current',
			]
		);

		$this->add_responsive_control(
			'pagination_current_item_border_radius',
			[
				'label'         => __( 'Border Radius', 'woolementor-pro' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .wl-sa-pagination .page-numbers.current' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'pagination_hover',
			[
				'label'     => __( 'Hover', 'woolementor-pro' ),
			]
		);

		$this->add_control(
			'pagination_hover_item_color',
			[
				'label'     => __( 'Color', 'woolementor-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wl-sa-pagination .page-numbers:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'pagination_hover_item_bg',
			[
				'label'     => __( 'Background', 'woolementor-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wl-sa-pagination .page-numbers:hover' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'pagination_hover_item_border',
				'label'         => __( 'Border', 'woolementor-pro' ),
				'selector'      => '{{WRAPPER}} .wl-sa-pagination .page-numbers:hover',
			]
		);

		$this->add_responsive_control(
			'pagination_hover_item_border_radius',
			[
				'label'         => __( 'Border Radius', 'woolementor-pro' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .wl-sa-pagination .page-numbers:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'pagination_hover_transition',
			[
				'label' 	=> __( 'Transition Duration', 'woolementor-pro' ),
				'type' 		=> Controls_Manager::SLIDER,
				'range' 	=> [
					'px' 	=> [
						'max' 	=> 3,
						'step' 	=> 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .wl-sa-pagination .page-numbers:hover' => 'transition-duration: {{SIZE}}s',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

	}

	protected function render() {

		$settings = $this->get_settings_for_display();
		extract( $settings );
		$wishlist_id = $this->get_id();
		
		$products = woolementor_query_products( $settings );
		$user_id  = get_current_user_id();
        $wishlist = woolementor_get_wishlist( $user_id );
		?>

		<div class="cx-container">
			<div class="cx-row">
	         	<div class="cx-col-md-12 cx-col-sm-12">
	            	<div class="wl-sa-accordion-area">

						<?php
						$count = 1;
						if( $products->have_posts()) : 
							while( $products->have_posts()) : $products->the_post();
								$product_id = get_the_ID();
								$product    = wc_get_product( $product_id );
								$thumbnail  = get_the_post_thumbnail_url( $product_id, $image_thumbnail_size );
								$fav_product= in_array( $product_id, $wishlist );

								if ( !empty( $fav_product ) ) {
									$fav_item = 'fav-item';
								}
								else{
									$fav_item = '';
								}

								if ( $count == 1 && 'yes' == $section_style_accordion_switcher ) {
									$woolementor_open = 'wl-sa-open';
								}
								else{
									$woolementor_open = '';
								}
								?>
							 
								<!-- Single Product -->
								<div id="wl-sa-single-accordion-<?php echo esc_attr( $wishlist_id ) . esc_attr( $product_id ); ?>" class="wl-sa-single-accordion <?php echo esc_attr( $woolementor_open ); ?>">
									<div class="wl-sa-accordion-title wl-sa-item" data-id="<?php echo esc_attr( $wishlist_id ) . esc_attr( $product_id ); ?>">
										<h2><?php echo esc_html( $product->get_name() ); ?></h2><span></span>
									</div>
									<div class="wl-sa-accordion-content wl-sa-item-data">
										<div class="wl-sa-accordion-content-inner">
											<div class="wl-sa-acordion-left">
												<?php if ( 'none' == $image_on_click ): ?>
													<img src="<?php echo esc_html( $thumbnail ); ?>" alt="<?php echo esc_attr( $product->get_name() ); ?>"/>  
												<?php elseif ( 'zoom' == $image_on_click ) : ?>
													<a id="wl-sa-product-image-zoom" href="<?php echo esc_html( $thumbnail ); ?>"><img src="<?php echo esc_html( $thumbnail ); ?>" alt=""/></a>
												<?php elseif ( 'product_page' == $image_on_click ) : ?>
													<a href="<?php the_permalink(); ?>">
														<img src="<?php echo esc_html( $thumbnail ); ?>" alt="<?php echo esc_attr( $product->get_name() ); ?>"/>                              
													</a>
												<?php endif ?>
											</div>
											<div class="wl-sa-acordion-right">
												<div class="wl-sa-accordion-category">
													<?php if ( 'yes' == $product_category_show_hide ): ?>
														<span class="wl-sa-accordion-cat">
															<span><?php echo _e( 'CATEGORY :', 'woolementor-pro' ); ?></span> 
															<?php
															$terms_list = wc_get_product_category_list( $product_id );
															$term_list 	= explode( ',' , $terms_list );
															$terms 		= array_slice( $term_list, 0, $product_category_count );
															
															echo implode( ', ', $terms );
															?>
														</span> 
													<?php endif;

													if ( 'yes' == $star_rating_show_hide ): ?>
														<span class="wl-sa-rating">
															<?php 
				                                                for ( $i = 0; $i < 5; $i++ ) { 

				                                                    if ( $i < $product->get_average_rating() ) {
				                                                        echo '<i class="'. esc_attr( $star_rating_blockicon['value'] ) .'"></i>';
				                                                    }
				                                                    else{
				                                                        echo '<i class="'. esc_attr( $star_rating_empty_icon['value'] ) .'"></i>';
				                                                    }
				                                                }
				                                                ?>
															<span>(<?php echo $product->get_average_rating(); ?>)</span>
														</span>
													<?php endif;

													if ( 'yes' == $product_tag_show_hide ): ?>
														<?php 
															$tags_list = wc_get_product_tag_list( $product_id );
															$tag_list = explode( ',' , $tags_list );
															$tags = array_slice( $tag_list, 0, $product_tag_count );

															foreach ( $tags as $key => $tag ) {
																if( $tag ) {
																	echo '<span class="wl-sa-tag">'. $tag .'</span>';
																}
															}
														 ?>
													<?php endif;

													if( 'outofstock' == $product->get_stock_status() && 'yes' == $stock_show_hide ): ?>
													    <span class="wl-sa-stock">
													        <?php echo $stock_ribbon_text; ?>
													    </span>
													<?php endif; ?>
												</div>

												<?php if ( 'yes' == $short_description_show_hide ): ?>
													<div class="wl-sa-accordion-details">
														<p><?php echo wp_trim_words( $product->get_short_description(), $product_desc_words_count ); ?></p>
													</div>
												<?php endif; ?>

												
												<div class="wl-sa-product-details">

													<div class="wl-sa-product-info">
														<strong class="wl-sa-price"><?php echo $product->get_price_html(); ?></strong>
													</div>
													<div class="wl-sa-info-icons">
														<div class="wl-sa-product-page">
															<a href="<?php the_permalink(); ?>"><i class="fas fa-eye"></i></a>
														</div>
														<?php if ( 'yes' == $wishlist_show_hide ): 
															
															?>
															<div class="wl-sa-product-fav">
																<a href="#" class="ajax_add_to_wish <?php echo esc_attr( $fav_item ); ?>" data-product_id="<?php echo $product_id; ?>">
																	<i class="<?php echo esc_attr( $wishlist_icon['value'] ); ?>"></i>
																</a>
															</div>
														<?php endif;

														if ( 'yes' == $cart_show_hide ): ?>
															<?php if ( 'simple' == $product->get_type() ): ?>
																<div class="wl-sa-product-cart">
																	<div class="wl-cart-area">
																		<a href="?add-to-cart=<?php echo $product_id; ?>" data-quantity="1" class="product_type_<?php echo esc_attr( $product->get_type() ); ?> add_to_cart_button ajax_add_to_cart" data-product_id="<?php echo $product_id; ?>" ><i class="<?php echo esc_attr( $cart_icon['value'] ); ?>"></i></a>
																	</div>
																</div>
															<?php else: ?>
																<div class="wl-sa-product-cart">
																	<a href="<?php echo esc_url( get_permalink( $product_id ) ); ?>" class="product_type_<?php echo esc_attr( $product->get_type() ); ?> add_to_cart_button ajax_add_to_cart"  ><i class="<?php echo esc_attr( $cart_icon['value'] ); ?>"></i></a>
																</div>
															<?php endif;
														endif; ?>

													</div>
												</div>
											</div>
										</div>
									</div>
								</div>

							<?php $count++; endwhile; wp_reset_query(); else: 

							echo '<p>' . __( 'No Product Found!', 'woolementor-pro' ) . '</p>';

						endif; ?>
						
					</div>
				</div>
			</div>
		</div>

		<?php 

		if ( 'yes' == $pagination_show_hide ):

			echo '<div class="wl-sa-pagination">';

            /**
            * woolementor pagination
            */
            woolementor_pagination( $products, $pagination_left_icon, $pagination_right_icon ); 

            echo '</div>';

        endif;

    	$this->render_script();
	}

	protected function render_script() {
		?>
		<script>
			jQuery(function($) {
				$('.wl-sa-accordion-title').off().on('click', function(){
					var id = $(this).data('id');
					$(this).parents('.wl-sa-accordion-area').find('.wl-sa-accordion-content').parent().removeClass('wl-sa-open');
					$('#wl-sa-single-accordion-' + id).toggleClass('wl-sa-open');
				})
			});
		</script>
		<?php
	}
}