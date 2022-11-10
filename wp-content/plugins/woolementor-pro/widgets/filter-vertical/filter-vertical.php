<?php
namespace codexpert\Woolementor_Pro;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use codexpert\Woolementor\Controls\Group_Control_Gradient_Text;

class Filter_Vertical extends Widget_Base {

	public $id;

	public function __construct( $data = [], $args = null ) {
	    parent::__construct( $data, $args );

	    $this->id = woolementor_get_widget_id( __CLASS__ );
	    $this->widget = woolementor_get_widget( $this->id );
	    
		// Are we in debug mode?
		$min = defined( 'WOOLEMENTOR_PRO_DEBUG' ) && WOOLEMENTOR_PRO_DEBUG ? '' : '.min';

		wp_register_style( "woolementor-{$this->id}", plugins_url( "assets/css/style{$min}.css", __FILE__ ), [], '1.1' );

		wp_enqueue_script( 'jquery-ui-slider' );
	}

	public function get_script_depends() {
		return [ "woolementor-{$this->id}" ];
	}

	public function get_style_depends() {
		return [ "woolementor-{$this->id}" ];
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
		 * Settings controls
		 */
		$this->start_controls_section(
			'fv_general',
			[
				'label' 		=> __( 'Components', 'woolementor-pro' ),
				'tab'   		=> Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
            'woolementor_taxonomies',
            [
                'label'     => __( 'Filter Items', 'woolementor-pro' ),
                'type' 	    => Controls_Manager::SELECT2,
                'options'   => woolementor_get_taxonomies(),
                'separator' 		=> 'before',
                'multiple'          => true,
                'style_transfer' 	=> true,
                'label_block' 		=> true,
            ]
        );

		$this->end_controls_section();

		$this->start_controls_section(
			'fv_section_header',
			[
				'label' 		=> __( 'Header', 'woolementor-pro' ),
				'tab'   		=> Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'fv_header_show_hide',
			[
				'label'         => __( 'Show Header', 'woolementor-pro' ),
				'type'          => Controls_Manager::SWITCHER,
				'label_on'      => __( 'Show', 'woolementor-pro' ),
				'label_off'     => __( 'Hide', 'woolementor-pro' ),
				'return_value'  => 'yes',
				'default'       => 'yes',
			]
		);

		$this->add_control(
			'fv_section_header_text',
			[
				'label' => __( 'Heading Text', 'woolementor-pro' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'Filter',
				'condition' => [
                    'fv_header_show_hide' => 'yes'
                ],
				'placeholder' => __( 'Type Section title here', 'woolementor-pro' ),
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'fv_section_form_action',
			[
				'label' 		=> __( 'Form Action', 'woolementor' ),
				'tab'   		=> Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'form_action_show',
			[
				'label' 		=> __( 'Form Submits To', 'woolementor' ),
				'type' 			=> Controls_Manager::SELECT2,
				'options'		=> [
					'current'	=> __( 'Current Page', 'woolementor' ),
					'different'	=> __( 'Different Page', 'woolementor' ),
				],
				'default' 		=> 'current',
			]
		);

        $this->add_control(
            'form_action',
            [
                'label'     => __( 'Action URL', 'woolementor' ),
                'type' 	    => Controls_Manager::TEXT,
                'placeholder' => get_home_url( null, 'search' ),
				'condition' => [
                    'form_action_show' => 'different'
                ],
            ]
        );

		$this->end_controls_section();

		/*
		*sort_by_show_hide
		*/

		$this->start_controls_section(
			'fv__search',
			[
				'label' 		=> __( 'Search Form', 'woolementor-pro' ),
				'tab'   		=> Controls_Manager::TAB_CONTENT,
			]
		);

        $this->add_control(
			'filter_vertical_search',
			[
				'label' 		=> __( 'Search', 'woolementor-pro' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Show', 'woolementor-pro' ),
				'label_off' 	=> __( 'Hide', 'woolementor-pro' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'yes',
			]
		);

		$this->add_control(
			'fv_search_text',
			[
				'label' 	  => __( 'Search Text', 'woolementor-pro' ),
				'type' 		  => Controls_Manager::TEXT,
				'placeholder' => __( 'Type Section title here', 'woolementor-pro' ),
				'default' 	  => 'Search',
				'condition'   => [
                    'filter_vertical_search' => 'yes'
                ],
			]
		);

		$this->add_control(
			'search_box_icon',
			[
				'label' 	=> __( 'Search Icon', 'woolementor-pro' ),
				'type' 		=> Controls_Manager::ICONS,
				'default' 	=> [
					'value' => 'fa fa-search',
					'library' => 'solid',
				],
				'condition'   => [
                    'filter_vertical_search' => 'yes'
                ],
				'separator'		=> 'before'
			]
		);

		$this->end_controls_section();

		
		/*
		*price_by_show_hide
		*/

		$this->start_controls_section(
			'fv_price_by',
			[
				'label' 		=> __( 'Price', 'woolementor-pro' ),
				'tab'   		=> Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'fv_price_by_show_hide',
			[
				'label'         => __( 'Show Price filter', 'woolementor-pro' ),
				'type'          => Controls_Manager::SWITCHER,
				'label_on'      => __( 'Show', 'woolementor-pro' ),
				'label_off'     => __( 'Hide', 'woolementor-pro' ),
				'return_value'  => 'yes',
				'default'       => 'yes',
			]
		);

		$this->add_control(
			'fv_price_text',
			[
				'label' 	  => __( 'Price Text', 'woolementor-pro' ),
				'type' 		  => Controls_Manager::TEXT,
				'placeholder' => __( 'Type Section title here', 'woolementor-pro' ),
				'default' 	  => 'Price',
				'condition'   => [
                    'fv_price_by_show_hide' => 'yes'
                ],
			]
		);

		$this->end_controls_section();
		
		/*
		*sort_by_show_hide
		*/

		$this->start_controls_section(
			'fv_sort_by',
			[
				'label' 		=> __( 'Sort By', 'woolementor-pro' ),
				'tab'   		=> Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'fv_sort_by_show_hide',
			[
				'label'         => __( 'Show Sort By filter', 'woolementor-pro' ),
				'type'          => Controls_Manager::SWITCHER,
				'label_on'      => __( 'Show', 'woolementor-pro' ),
				'label_off'     => __( 'Hide', 'woolementor-pro' ),
				'return_value'  => 'yes',
				'default'       => 'yes',
			]
		);

		$this->add_control(
			'fv_sort_text',
			[
				'label' 	  => __( 'Sort Text', 'woolementor-pro' ),
				'type' 		  => Controls_Manager::TEXT,
				'rows' 		  => 10,
				'placeholder' => __( 'Type Section title here', 'woolementor-pro' ),
				'default' 	  => 'Sort By',
				'condition'   => [
                    'fv_sort_by_show_hide' => 'yes'
                ],
			]
		);

		$this->end_controls_section();

		/*
		*Order_by_show_hide
		*/

		$this->start_controls_section(
			'fv_order',
			[
				'label' 		=> __( 'Order', 'woolementor-pro' ),
				'tab'   		=> Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'fv_order_show_hide',
			[
				'label'         => __( 'Show order filter', 'woolementor-pro' ),
				'type'          => Controls_Manager::SWITCHER,
				'label_on'      => __( 'Show', 'woolementor-pro' ),
				'label_off'     => __( 'Hide', 'woolementor-pro' ),
				'return_value'  => 'yes',
				'default'       => 'yes',
			]
		);

		$this->add_control(
			'fv_order_text',
			[
				'label' 	  => __( 'Order Text', 'woolementor-pro' ),
				'type' 		  => Controls_Manager::TEXT,
				'rows' 		  => 10,
				'placeholder' => __( 'Type Section title here', 'woolementor-pro' ),
				'default' 	  => 'Order',
				'condition'   => [
                    'fv_order_show_hide' => 'yes'
                ],
			]
		);

		$this->end_controls_section();

		/*
		*Button show hide and text
		*/

		$this->start_controls_section(
			'_buttons',
			[
				'label' 		=> __( 'Buttons', 'woolementor-pro' ),
				'tab'   		=> Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'filter_verticle_clear',
			[
				'label' 		=> __( 'Clear Button', 'woolementor-pro' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Show', 'woolementor-pro' ),
				'label_off' 	=> __( 'Hide', 'woolementor-pro' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'yes',
                'separator' 		=> 'before',
			]
		);

		$this->add_control(
			'clear_btn_text',
			[
				'label' 		=> __( 'CLear Button Text', 'woolementor-pro' ),
				'type' 			=> Controls_Manager::TEXT,
				'default' 		=> __( 'Clear All', 'woolementor-pro' ),
				'placeholder' 	=> __( 'Type your text here', 'woolementor-pro' ),
				'condition' => [
                    'filter_verticle_clear' => 'yes'
                ],
                'separator' 		=> 'after',
			]
		);

        $this->add_control(
			'filter_verticle_apply',
			[
				'label' 		=> __( 'Apply Button', 'woolementor-pro' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Show', 'woolementor-pro' ),
				'label_off' 	=> __( 'Hide', 'woolementor-pro' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'yes',
			]
		);

		$this->add_control(
			'apply_btn_text',
			[
				'label' 		=> __( 'Apply Button Text', 'woolementor-pro' ),
				'type' 			=> Controls_Manager::TEXT,
				'default' 		=> __( 'Apply', 'woolementor-pro' ),
				'placeholder' 	=> __( 'Type your text here', 'woolementor-pro' ),
				'condition' => [
                    'filter_verticle_apply' => 'yes'
                ],
			]
		);

		$this->end_controls_section();

		/**
		 * Descriptio style Section
		 */
		$this->start_controls_section(
			'fv_header_style',
			[
				'label'			=> __( 'Section Title', 'woolementor-pro' ),
				'tab'   		=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'fv_header_text_align',
			[
				'label' 		=> __( 'Alignment', 'woolementor-pro' ),
				'type' 			=> Controls_Manager::CHOOSE,
				'options' 		=> [
					'left'	=> [
						'title'	=> __( 'Left', 'woolementor-pro' ),
						'icon'	=> 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'woolementor-pro' ),
						'icon' 	=> 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'woolementor-pro' ),
						'icon' 	=> 'fa fa-align-right',
					],
				],
				'default' 		=> 'left',
				'toggle' 		=> true,
				'selectors'     => [
					'{{WRAPPER}} .wl-fv-filter-heading' => 'text-align: {{VALUE}}',
				],
				'separator'		=>	'after'
			]
		);

		$this->add_group_control(
            Group_Control_Gradient_Text::get_type(),
            [
                'name' => 'filter_verticle_gradient_color',
                'selector' => '{{WRAPPER}} .wl-fv-filter-heading h3',
            ]
        );

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'filter_verticle_ypography',
				'label' => __( 'Typography', 'woolementor-pro' ),
				'scheme' => Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} .wl-fv-filter-heading h3',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'filter_verticle_border',
				'label'         => __( 'Border', 'woolementor-pro' ),
				'selector'      => '{{WRAPPER}} .wl-fv-filter-heading h3',
				'separator'		=> 'before'
			]
		);

		$this->add_responsive_control(
			'filter_verticle_border_radius',
			[
				'label'         => __( 'Border Radius', 'woolementor-pro' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%', 'em' ],
				'selectors'     => [
					'{{WRAPPER}} .wl-fv-filter-heading h3' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
					Group_Control_Background::get_type(),
					[
						'name' => 'filter_verticle_background',
						'label' => __( 'Background', 'woolementor-pro' ),
						'types' => [ 'classic', 'gradient'],
						'selector' => '{{WRAPPER}} .wl-fv-filter-heading',
					]
				);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'filter_verticle_box_shadow',
				'label' => __( 'Box Shadow', 'woolementor-pro' ),
				'selector' => '{{WRAPPER}} .wl-fv-filter-heading',
			]
		);

		$this->add_responsive_control(
			'fv_field_padding',
			[
				'label' 		=> __( 'Padding', 'woolementor-pro' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wl-fv-filter-heading h3' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'		=> 'before',
			]
		);

		$this->add_responsive_control(
			'fv_margin',
			[
				'label' 		=> __( 'Margin', 'woolementor-pro' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wl-fv-filter-heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		/**
		 * Search Box
		 */
		$this->start_controls_section(
			'filter_vertical_search_box',
			[
				'label'			=> __( 'Search Box', 'woolementor-pro' ),
				'tab'   		=> Controls_Manager::TAB_STYLE,
                'condition' => [
                    'filter_vertical_search' => 'yes'
                ],
			]
		);

        $this->add_control(
			'search_box_text_color',
			[
				'label' 	=> __( 'Text Color', 'woolementor-pro' ),
				'type' 		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wl-fv-filter-search input' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'search_box_background',
				'label' => __( 'Background', 'woolementor-pro' ),
				'types' => [ 'classic', 'gradient'],
				'selector' => '{{WRAPPER}} .wl-fv-filter-search input',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'search_box_typography',
				'label' => __( 'Typography', 'woolementor-pro' ),
				'scheme' => Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} .wl-fv-filter-search input',
			]
		);

        $this->add_control(
			'search_box_icon_color',
			[
				'label' 	=> __( 'Icon Color', 'woolementor-pro' ),
				'type' 		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wl-fv-search-button' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'search_box_border',
				'label'         => __( 'Border', 'woolementor-pro' ),
				'selector'      => '{{WRAPPER}} .wl-fv-filter-search input',
				'separator'		=> 'before'
			]
		);

		$this->add_responsive_control(
			'search_box_border_radius',
			[
				'label'         => __( 'Border Radius', 'woolementor-pro' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%', 'em' ],
				'selectors'     => [
					'{{WRAPPER}} .wl-fv-filter-search input' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'search_box_padding',
			[
				'label' 		=> __( 'Padding', 'woolementor-pro' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wl-fv-filter-search input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'		=> 'before',
			]
		);

		$this->add_responsive_control(
			'search_box_margin',
			[
				'label' 		=> __( 'Margin', 'woolementor-pro' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wl-fv-filter-search' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		/**
		 * Components style Section
		 */
		$this->start_controls_section(
			'fv_component_style',
			[
				'label'			=> __( 'Components', 'woolementor-pro' ),
				'tab'   		=> Controls_Manager::TAB_STYLE,
			]
		);

        $this->start_controls_tabs( 'filter_component_dropdown_tabs' );

        $this->start_controls_tab(
            'filter_component_dropdown_title',
            [
                'label' => __( 'Dropdown Title', 'woolementor-pro' ),
            ]
        );

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'component_typography',
				'label' => __( 'Typography', 'woolementor-pro' ),
				'scheme' => Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} .wl-fv-tab-label, .wl-fv-range-value div',
			]
		);


		$this->add_group_control(
            Group_Control_Gradient_Text::get_type(),
            [
                'name' => 'filter_verticle_comp_gradient_color',
                'selector' => '{{WRAPPER}} .wl-fv-tab-label, {{WRAPPER}} .wl-fv-range-value div span',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'filter_component_dropdown_items',
            [
                'label' => __( 'Dropdown Items', 'woolementor-pro' ),
            ]
        );

        $this->add_control(
			'filter_component_item_color',
			[
				'label' 		=> __( 'Text Color', 'woolementor-pro' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wl-fv-radio-custom-label span' => 'color: {{VALUE}}',
					'{{WRAPPER}} .wl-fv-checkbox-custom-label span' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'filter_component_item_typography',
				'label' => __( 'Typography', 'woolementor-pro' ),
				'scheme' => Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} .wl-fv-radio-custom-label span, .wl-fv-checkbox-custom-label span',
			]
		);

		$this->add_responsive_control(
            'filter_component_check_icon_size',
            [
                'label'     	=> __( 'Check Icon Size', 'woolementor-pro' ),
                'type'      	=> Controls_Manager::SLIDER,
                'size_units'	=> [ 'px', 'em' ],
                'selectors' 	=> [
                    '{{WRAPPER}} .wl-fv-checkbox-custom + .wl-fv-checkbox-custom-label::before, .wl-fv-radio-custom + .wl-fv-radio-custom-label::before' => 'width: {{SIZE}}{{UNIT}} !important; height: {{SIZE}}{{UNIT}} !important',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_responsive_control(
        	'fv_label_padding',
        	[
        		'label' 		=> __( 'Padding', 'woolementor-pro' ),
        		'type' 			=> Controls_Manager::DIMENSIONS,
        		'size_units' 	=> [ 'px', '%', 'em' ],
        		'selectors' 	=> [
        			'{{WRAPPER}} .wl-fv-tab-label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        		],
        		'separator'		=> 'before',
        	]
        );

        $this->add_responsive_control(
        	'fv_label_margin',
        	[
        		'label' 		=> __( 'Margin', 'woolementor-pro' ),
        		'type' 			=> Controls_Manager::DIMENSIONS,
        		'size_units' 	=> [ 'px', '%', 'em' ],
        		'selectors' 	=> [
        			'{{WRAPPER}} .wl-fv-tab-label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        		],
        	]
        );

		$this->end_controls_section();

		/**
		 * Button style Section wl-fv-btn-checkout
		 */
		$this->start_controls_section(
			'filter_horizontal_apply_button',
			[
				'label'			=> __( 'Apply Button', 'woolementor-pro' ),
				'tab'   		=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'apply_button_typography',
				'label' => __( 'Typography', 'woolementor-pro' ),
				'scheme' => Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} .wl-fv-btn-checkout',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'apply_button_box_shadow',
				'label' => __( 'Box Shadow', 'woolementor-pro' ),
				'selector' => '{{WRAPPER}} .wl-fv-btn-checkout',
				'separator'		=> 'before'
			]
		);

		$this->add_responsive_control(
			'apply_button_padding',
			[
				'label' 		=> __( 'Padding', 'woolementor-pro' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wl-fv-btn-checkout' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'		=> 'before',
			]
		);

		$this->add_responsive_control(
			'apply_button_margin',
			[
				'label' 		=> __( 'Margin', 'woolementor-pro' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wl-fv-btn-checkout' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs(
            'apply_normal_separator',
            [
                'separator' => 'before'
            ]
        );
        $this->start_controls_tab(
            'apply_btn_normal',
            [
                'label'     => __( 'Normal', 'woolementor-pro' ),
            ]
        );

        $this->add_control(
			'apply_button_text_color',
			[
				'label' 	=> __( 'Text Color', 'woolementor-pro' ),
				'type' 		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wl-fv-btn-checkout' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'apply_button_background',
				'label' => __( 'Background', 'woolementor-pro' ),
				'types' => [ 'classic', 'gradient'],
				'selector' => '{{WRAPPER}} .wl-fv-btn-checkout',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'apply_button_border',
				'label'         => __( 'Border', 'woolementor-pro' ),
				'selector'      => '{{WRAPPER}} .wl-fv-btn-checkout',				
			]
		);

		$this->add_responsive_control(
			'apply_button_border_radius',
			[
				'label'         => __( 'Border Radius', 'woolementor-pro' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%', 'em' ],
				'selectors'     => [
					'{{WRAPPER}} .wl-fv-btn-checkout' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

        $this->start_controls_tab(
            'apply_btn_hover',
            [
                'label'     => __( 'Hover', 'woolementor-pro' ),
            ]
        );

        $this->add_control(
			'apply_button_text_color_hover',
			[
				'label' 	=> __( 'Text Color', 'woolementor-pro' ),
				'type' 		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wl-fv-btn-checkout:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'apply_button_background_hover',
				'label' => __( 'Background', 'woolementor-pro' ),
				'types' => [ 'classic', 'gradient'],
				'selector' => '{{WRAPPER}} .wl-fv-btn-checkout:hover',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'apply_button_border_hover',
				'label'         => __( 'Border', 'woolementor-pro' ),
				'selector'      => '{{WRAPPER}} .wl-fv-btn-checkout:hover',				
			]
		);

		$this->add_responsive_control(
			'apply_button_border_radius_hover',
			[
				'label'         => __( 'Border Radius', 'woolementor-pro' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%', 'em' ],
				'selectors'     => [
					'{{WRAPPER}} .wl-fv-btn-checkout:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

	}

	protected function render() {

		$settings 			= $this->get_settings_for_display();
		extract( $settings );
		
		$currency_symbol 	= get_woocommerce_currency_symbol();
		$id = $this->get_id();
		$section_id = $this->get_raw_data()['id'];
		$action = $form_action_show == 'different' ? $form_action : '';

		/**
		 * Load attributes
		 */
		$this->render_editing_attributes();
		?>

		<div class="wl-fv-filters-area">
			<?php if ( 'yes' == $fv_header_show_hide ): ?>
				<div class="wl-fv-filter-heading-area">
					<div class="wl-fv-filter-heading">

						<?php 
						printf( '<h3 %s>%s</h3>',
				            $this->get_render_attribute_string( 'fv_section_header_text' ),
				            esc_html( $fv_section_header_text ) 
				        );
						?>

					</div>
				</div>
			<?php endif; ?>

			<form method="get" action="<?php echo esc_html( $action ) ?>">
				<div class="wl-fv-filters">

					<?php if ( 'yes' == $filter_vertical_search ): ?>
						<div class="wl-fv-single-filter-search">
							<div class="wl-fv-filter-search">
								<?php  
								$search = isset( $_GET['q'] ) ? $_GET['q'] : ''; 
								?>
								<input type="search" name="q" value="<?php echo esc_attr( $search ); ?>" placeholder="<?php echo esc_html( $fv_search_text ); ?>">
								<button class="wl-fv-search-button"><i class="<?php echo esc_attr( $search_box_icon['value'] ); ?>"></i></button>
							</div>
						</div>
					<?php endif;

					if( 'yes' == $fv_price_by_show_hide ): ?>
						<div class="wl-fv-single-filter wl-fv-single-filter-<?php echo $section_id; ?>">
							<input type="checkbox" id="fv-price-<?php echo esc_attr( $id ); ?>" checked>
							<label class="wl-fv-tab-label" for="fv-price-<?php echo esc_attr( $id ); ?>"><?php echo esc_html( $fv_price_text ); ?></label>
							<div class="wl-fv-filter-content">
								<div class="wl-fv-price-range-slider">
									<div id="slider-range" class="wl-fv-range-bar"></div>
									<div class="wl-fv-range-value">
										<div class="wl-fv-range-inner">
											<div class="wl-fv-range-input">
												<span class="wl-fv-currency">
													<?php echo esc_html( $currency_symbol ); ?>
												</span>
												<input class="wl-fv-amount" name="filter[min_price]" type="text" id="amount" readonly />
											</div>
											<span class="wl-fv-range-am"><?php _e( 'Min', 'woolementor-pro' ) ?></span>
										</div>
										<div class="wl-fv-range-inner"> 
											<div class="wl-fv-range-input">
												<span class="wl-fv-currency"><?php echo esc_html( $currency_symbol ); ?></span><input name="filter[max_price]" type="text" id="amax" class="wl-fv-amax" readonly />
											</div>
											<span class="wl-fv-range-am"><?php _e( 'Max', 'woolementor-pro' ) ?></span>
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php endif;

					if( 'yes' == $fv_sort_by_show_hide ): ?>
						<div class="wl-fv-single-filter wl-fv-single-filter-<?php echo $section_id; ?>">
							<input type="checkbox" id="order_vertical-<?php echo esc_attr( $id ); ?>">
							<label class="wl-fv-tab-label" for="order_vertical-<?php echo esc_attr( $id ); ?>"><?php echo esc_html( $fv_sort_text ); ?></label>
							<div class="wl-fv-filter-content" style="display: none;">
								<?php
								$sort_options = woolementor_order_options();
								foreach ( $sort_options as $key => $sort_option ):
									$checked = '';
									if ( isset( $_GET['filter']['orderby'] ) && $key == $_GET['filter']['orderby'] ) $checked = 'checked';
									?>	 
									<div>
										<input id="vertical_<?php echo $key; ?>" 
										class="wl-fv-radio-custom" 
										name="filter[orderby]" type="radio" 
										value="<?php echo esc_attr( $key ); ?>" <?php echo esc_attr( $checked ); ?>>
										<label for="vertical_<?php echo esc_attr( $key ); ?>" class="wl-fv-radio-custom-label">
											<span><?php echo esc_html( $sort_option ); ?></span>
										</label>
									</div>
								<?php endforeach; ?>
							</div>
						</div>
					<?php endif;

					if( 'yes' == $fv_order_show_hide ): ?>
						<div class="wl-fv-single-filter wl-fv-single-filter-<?php echo $section_id; ?>">
							<input type="checkbox" id="orderby_vertical-<?php echo esc_attr( $id ); ?>">
							<label class="wl-fv-tab-label" for="orderby_vertical-<?php echo esc_attr( $id ); ?>"><?php echo esc_html( $fv_order_text ); ?></label>
							<div class="wl-fv-filter-content" style="display: none;">
								<?php
								$sort_options = array(
									'ASC' 	=> __( 'ASC', 'woolementor-pro' ),
									'DESC' 	=> __( 'DESC', 'woolementor-pro' )
								);
								foreach ( $sort_options as $key => $sort_option ):
									$checked = '';
									if ( isset( $_GET['filter']['order'] ) && $key == $_GET['filter']['order'] ) $checked = 'checked';
									?>	 
									<div>
										<input id="vertical_<?php echo esc_attr( $key ); ?>" 
										class="wl-fv-radio-custom" 
										name="filter[order]" type="radio" 
										value="<?php echo esc_attr( $key ); ?>" <?php echo esc_attr( $checked ); ?>>
										<label for="vertical_<?php echo esc_attr( $key ); ?>" class="wl-fv-radio-custom-label">
											<span><?php echo esc_html( $sort_option ); ?></span>
										</label>
									</div>
								<?php endforeach; ?>
							</div>
						</div>
					<?php endif;

					if( ! empty( $woolementor_taxonomies ) ):
						foreach ( $woolementor_taxonomies as $_taxonomy ) :
							$taxonomy = get_taxonomy( $_taxonomy );
							?>

							<div class="wl-fv-single-filter wl-fv-single-filter-<?php echo $section_id; ?>">
								<input type="checkbox" id="fv-<?php echo esc_attr( $_taxonomy ); ?>">
								<label class="wl-fv-tab-label" for="fv-<?php echo esc_attr( $_taxonomy ); ?>">
									<?php echo esc_html( $taxonomy->labels->singular_name ); ?>
								</label>
								<div class="wl-fv-filter-content" style="display: none;">

									<?php 
									$get_terms = get_terms( $_taxonomy );
									foreach ( $get_terms as $term ):
										?>
										<div>
											<?php

											$checked = '';
											if( isset( $_GET['filter']['taxonomies'][$_taxonomy] ) && in_array( $term->slug, $_GET['filter']['taxonomies'][$_taxonomy] ) ) $checked = 'checked';
											?>
											<input id="<?php echo $_taxonomy.'_'.$term->slug; ?>" 
											class="wl-fv-checkbox-custom" 
											name="filter[taxonomies][<?php echo $taxonomy->name; ?>][]" 
											type="checkbox" value="<?php echo $term->slug; ?>" <?php echo esc_attr( $checked ); ?> >
											<label for="<?php echo $_taxonomy.'_'.$term->slug; ?>" class="wl-fv-checkbox-custom-label" >
												<span><?php echo esc_html( $term->name ); ?></span>
											</label>
										</div>
									<?php endforeach; ?>

								</div>
							</div>
						<?php endforeach; 
					endif;
					?>

				</div>
				<div class="wl-fv-flter-action-area">
					<div class="wl-fv-flter-action-left">
						
						<?php 
						if( 'yes' == $filter_verticle_clear ):

							global $wp;							
							printf( '<a %s href="%s">%s</a>',
			            		$this->get_render_attribute_string( 'clear_btn_text' ),
					            home_url( $wp->request ),
					            esc_html( $clear_btn_text ) 
					        );

				        endif; 
				        ?>

					</div>
					<div class="wl-fv-flter-action-right">

						<?php 
						if( 'yes' == $filter_verticle_apply ): 

							printf( '<button %s type="submit">%s</button>',
			            		$this->get_render_attribute_string( 'apply_btn_text' ),
					            esc_html( $apply_btn_text ) 
					        );

				        endif; 
				        ?>

					</div>
				</div>
			</form>
		</div>

		<?php
		/**
		 * Load Script
		 */
		$this->render_script();
	}

	private function render_editing_attributes() {
		$this->add_inline_editing_attributes( 'fv_section_header_text', 'basic' );

		$this->add_inline_editing_attributes( 'clear_btn_text', 'basic' );
		$this->add_render_attribute( 'clear_btn_text', 'class', 'wl-fv-clear-btn' );

		$this->add_inline_editing_attributes( 'apply_btn_text', 'basic' );
		$this->add_render_attribute( 'apply_btn_text', 'class', 'wl-fv-btn-checkout' );
	}

	protected function render_script() {
		$settings 			= $this->get_settings_for_display();
		extract( $settings );
		
		$section_id = $this->get_raw_data()['id'];
		?>

		<script type="text/javascript">
			jQuery(function($){
				var min_price = parseInt( WOOLEMENTOR.min_price )
				var max_price = parseInt( WOOLEMENTOR.max_price )
				$( ".wl-fv-range-bar" ).slider({
					range: true,
					min: min_price,
					max: max_price,
					values: [ WOOLEMENTOR.crnt_min, WOOLEMENTOR.crnt_max ],
					slide: function( event, ui ) {
						$( ".wl-fv-amount" ).val( ui.values[ 0 ] )
						+ $( ".wl-fv-amax" ).val( ui.values[ 1 ] ) ;
					}
				});
				$( ".wl-fv-amount" ).val(  $( ".wl-fv-range-bar" ).slider( "values", 0 ) );
				$( ".wl-fv-amax" ).val(  $( ".wl-fv-range-bar" ).slider( "values", 1 ) );

				$('.wl-fv-single-filter-<?php echo $section_id; ?> > label').click(function(e){
					var $par = $(this).parent()
					console.log($par)
					$('.wl-fv-filter-content',$par).slideToggle()
				})
			})
		</script>

		<?php
	}
}