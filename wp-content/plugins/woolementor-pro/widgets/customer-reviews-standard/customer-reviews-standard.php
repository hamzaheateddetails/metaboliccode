<?php
namespace codexpert\Woolementor_Pro;

use Elementor\Utils;
use Elementor\Repeater;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use codexpert\Woolementor\Controls\Group_Control_Gradient_Text;

class Customer_Reviews_Standard extends Widget_Base {

	public $id;

	public function __construct( $data = [], $args = null ) {
	    parent::__construct( $data, $args );

	    $this->id = woolementor_get_widget_id( __CLASS__ );
	    $this->widget = woolementor_get_widget( $this->id );
	    
		// Are we in debug mode?
		$min = defined( 'WOOLEMENTOR_PRO_DEBUG' ) && WOOLEMENTOR_PRO_DEBUG ? '' : '.min';

		wp_register_style( "woolementor-{$this->id}", plugins_url( "assets/css/style{$min}.css", __FILE__ ), [], '1.1' );
	}

	public function get_script_depends() {
		return [ "woolementor-{$this->id}", 'slick' ];
	}

	public function get_style_depends() {
		return [ "woolementor-{$this->id}", 'slick' ];
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
		 * Components
		 */
		$this->start_controls_section(
			'section_content_components',
			[
				'label' => __( 'Components', 'woolementor-pro' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

        $this->add_control(
			'review_name_switcher',
			[
				'label' 		=> __( 'Name', 'woolementor-pro' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Show', 'woolementor-pro' ),
				'label_off' 	=> __( 'Hide', 'woolementor-pro' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'yes',
			]
		);

        $this->add_control(
			'review_description_switcher',
			[
				'label' 		=> __( 'Description', 'woolementor-pro' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Show', 'woolementor-pro' ),
				'label_off' 	=> __( 'Hide', 'woolementor-pro' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'yes',
			]
		);

        $this->add_control(
			'review_rating_switcher',
			[
				'label' 		=> __( 'Start Rating', 'woolementor-pro' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Show', 'woolementor-pro' ),
				'label_off' 	=> __( 'Hide', 'woolementor-pro' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'yes',
			]
		);

        $this->add_control(
			'review_comment_switcher',
			[
				'label' 		=> __( 'Comment', 'woolementor-pro' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Show', 'woolementor-pro' ),
				'label_off' 	=> __( 'Hide', 'woolementor-pro' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'yes',
			]
		);

        $this->add_control(
			'review_date_switcher',
			[
				'label' 		=> __( 'Date', 'woolementor-pro' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Show', 'woolementor-pro' ),
				'label_off' 	=> __( 'Hide', 'woolementor-pro' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'yes',
			]
		);

        $this->add_control(
			'review_photo_switcher',
			[
				'label' 		=> __( 'Photo', 'woolementor-pro' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Show', 'woolementor-pro' ),
				'label_off' 	=> __( 'Hide', 'woolementor-pro' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'yes',
			]
		);

        $this->add_control(
			'review_quote_switcher',
			[
				'label' 		=> __( 'Quote', 'woolementor-pro' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Show', 'woolementor-pro' ),
				'label_off' 	=> __( 'Hide', 'woolementor-pro' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'yes',
			]
		);

		$this->end_controls_section();

		/**
		 * repeater
		 */
		$this->start_controls_section(
			'review_section_repeater',
			[
				'label' 		=> __( 'Reviews', 'woolementor-pro' ),
				'tab' 			=> Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'review_repeater_name', [
				'label' 		=> __( 'Name', 'woolementor-pro' ),
				'type' 			=> Controls_Manager::TEXT,
				'default' 		=> __( 'Jone Doe' , 'woolementor-pro' ),
				'label_block' 	=> true,
			]
		);

		$repeater->add_control(
			'review_repeater_description', [
				'label' 		=> __( 'Description', 'woolementor-pro' ),
				'type' 			=> Controls_Manager::TEXT,
				'default' 		=> __( 'Dhaka, Bangladesh' , 'woolementor-pro' ),
				'label_block' 	=> true,
			]
		);

		$repeater->add_control(
			'review_repeater_rating', [
				'label' 		=> __( 'Rating (Out of 5)', 'woolementor-pro' ),
				'type' 			=> Controls_Manager::NUMBER,
				'min' 			=> 1,
				'max' 			=> 5,
				'default'		=> 4,
			]
		);

		$repeater->add_control(
			'review_repeater_date', [
				'label' 		=> __( 'Date', 'woolementor-pro' ),
				'type' 			=> Controls_Manager::DATE_TIME,
				'picker_options'=> array( 'enableTime' => false, 'dateFormat' => 'j F, Y' ),
				'default'		=> date( 'j F, Y' )
			]
		);

		$repeater->add_control(
			'review_repeater_comment', [
				'label' 		=> __( 'Comment', 'woolementor-pro' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'default'		=>	__( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. In libero dicta porro veritatis, dignissimos perferendis harum illum consequatur qui nulla minima reiciendis voluptatibus delectus voluptas quis alias, laboriosam. Optio rerum doloribus similique molestiae obcaecati dolores ipsam laborum perspiciatis voluptatum officia assumenda repellat, magni veniam, quod. Amet quibusdam id dicta corporis corrupti.', 'woolementor-pro' ),
			]
		);

		$repeater->add_control(
			'review_repeater_photo', [
				'label' 		=> __( 'Photo', 'woolementor-pro' ),
				'type' 			=> Controls_Manager::MEDIA,
				'default' 		=> [
					'url' 	=> Utils::get_placeholder_image_src(),
				],
			]
		);


        $repeater->add_control(
			'review_photo_align',
			[
				'label' => __( 'Photo Alignment', 'woolementor-pro' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'wl-left' => [
						'title' => __( 'Left', 'woolementor-pro' ),
						'icon' => 'fa fa-align-left',
					],
					'wl-center' => [
						'title' => __( 'Center', 'woolementor-pro' ),
						'icon' => 'fa fa-align-center',
					],
					'wl-right' => [
						'title' => __( 'Right', 'woolementor-pro' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'wl-center',
				'toggle' => true,
				'separator' => 'before'
			]
		);

		$this->add_control(
			'review_repeater_items',
			[
				'label' 		=> __( 'Review List', 'woolementor-pro' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'review_repeater_name' 		=> __( 'John Doe', 'woolementor-pro' ),
						'review_repeater_comment' 	=> __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. In libero dicta porro veritatis, dignissimos perferendis harum illum consequatur qui nulla minima reiciendis voluptatibus delectus voluptas quis alias, laboriosam.', 'woolementor-pro' ),
					],
					[
						'review_repeater_name' 		=> __( 'Jane Doe', 'woolementor-pro' ),
						'review_repeater_comment' 	=> __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. In libero dicta porro veritatis, dignissimos perferendis harum illum consequatur qui nulla minima reiciendis voluptatibus delectus voluptas quis alias, laboriosam.', 'woolementor-pro' ),
					],
					[
						'review_repeater_name' 		=> __( 'John Roe', 'woolementor-pro' ),
						'review_repeater_comment' 	=> __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. In libero dicta porro veritatis, dignissimos perferendis harum illum consequatur qui nulla minima reiciendis voluptatibus delectus voluptas quis alias, laboriosam.', 'woolementor-pro' ),
					],
					[
						'review_repeater_name' 		=> __( 'John Roe', 'woolementor-pro' ),
						'review_repeater_comment' 	=> __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. In libero dicta porro veritatis, dignissimos perferendis harum illum consequatur qui nulla minima reiciendis voluptatibus delectus voluptas quis alias, laboriosam.', 'woolementor-pro' ),
					],
				],
				'title_field' 	=> '{{{ review_repeater_name }}}',
			]
		);

		$this->end_controls_section();

		/**
		 * Animation
		 */
		$this->start_controls_section(
			'section_content_settings',
			[
				'label' => __( 'Slider Animation', 'woolementor-pro' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
            'animation_speed',
            [
                'label' 		=> __( 'Animation Speed', 'woolementor-pro' ),
                'type' 			=> Controls_Manager::NUMBER,
                'min' 			=> 100,
                'step' 			=> 10,
                'max' 			=> 10000,
                'default' 		=> 300,
                'description' 	=> __( 'Slide speed in milliseconds', 'woolementor-pro' ),
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label' 		=> __( 'Autoplay?', 'woolementor-pro' ),
                'type' 			=> Controls_Manager::SWITCHER,
                'label_on' 		=> __( 'Yes', 'woolementor-pro' ),
                'label_off' 	=> __( 'No', 'woolementor-pro' ),
                'return_value' 	=> 'yes',
                'default' 		=> 'yes',
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'autoplay_speed',
            [
                'label' 		=> __( 'Autoplay Speed', 'woolementor-pro' ),
                'type' 			=> Controls_Manager::NUMBER,
                'min' 			=> 100,
                'step' 			=> 100,
                'max' 			=> 10000,
                'default' 		=> 3000,
                'description' 	=> __( 'Autoplay speed in milliseconds', 'woolementor-pro' ),
                'condition' 	=> [
                    'autoplay' 	=> 'yes'
                ],
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'infinite_loop',
            [
                'label' 		=> __( 'Infinite Loop?', 'woolementor-pro' ),
                'type' 			=> Controls_Manager::SWITCHER,
                'label_on' 		=> __( 'Yes', 'woolementor-pro' ),
                'label_off' 	=> __( 'No', 'woolementor-pro' ),
                'return_value' 	=> true,
                'default' 		=> true,
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'navigation',
            [
                'label' 		=> __( 'Navigation', 'woolementor-pro' ),
                'type' 			=> Controls_Manager::SELECT,
                'options' 		=> [
                    'none' 		=> __( 'None', 'woolementor-pro' ),
                    'arrow' 	=> __( 'Arrow', 'woolementor-pro' ),
                    'dots' 		=> __( 'Dots', 'woolementor-pro' ),
                    'both' 		=> __( 'Arrow & Dots', 'woolementor-pro' ),
                ],
                'default' 		=> 'none',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $this->add_control(
			'arrow_icon_left',
			[
				'label' 		=> __( 'Arrow Icon Left', 'woolementor-pro' ),
				'type' 			=> Controls_Manager::ICONS,
				'default' 		=> [
					'value' 	=> 'fa fa-chevron-left',
					'library' => 'solid',
				],
				'condition' 	=> [
                    'navigation' => array( 'arrow', 'both' ),
                ],
			]
		);

        $this->add_control(
			'arrow_icon_right',
			[
				'label' 		=> __( 'Arrow Icon Right', 'woolementor-pro' ),
				'type' 			=> Controls_Manager::ICONS,
				'default' 		=> [
					'value' 	=> 'fa fa-chevron-right',
					'library' => 'solid',
				],
				'condition' 	=> [
                    'navigation' => array( 'arrow', 'both' ),
                ],
			]
		);

		$this->add_responsive_control(
            'slides_show',
            [
                'label' 			=> __( 'Show at Once', 'woolementor-pro' ),
                'type' 				=> Controls_Manager::NUMBER,
                'max' 				=> 12,
				'desktop_default' 	=> 4,
				'tablet_default' 	=> 2,
				'mobile_default'	=> 1,
                'frontend_available' => true,
            ]
        );

		$this->end_controls_section();

		/**
		 * Style
		 * Card
		 */
		$this->start_controls_section(
            '_section_review_card_style',
            [
                'label' => __( 'Card', 'woolementor-pro' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

		$this->add_responsive_control(
			'review_card_border_radius',
			[
				'label'         => __( 'Border Radius', 'woolementor-pro' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .wl-crvs-review-single' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'review_card_padding',
			[
				'label'         => __( 'Padding', 'woolementor-pro' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em' ],
				'selectors'     => [
					'{{WRAPPER}} .wl-crvs-review-single' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'review_card_margin',
			[
				'label'         => __( 'Margin', 'woolementor-pro' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em' ],
				'selectors'     => [
					'{{WRAPPER}} .wl-crvs-review-single' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
            'review_card_background_tabs_hr',
            [
                'type' => Controls_Manager::DIVIDER,
                'style' => 'thick',
            ]
        );

        $this->add_control(
			'review_card_background_heading',
			[
				'label' => __( 'Background', 'woolementor-pro' ),
				'type' => Controls_Manager::HEADING,
			]
		);

        $this->start_controls_tabs( 'review_card_background_tabs' );

        $this->start_controls_tab(
            'review_card_background_normal',
            [
                'label' => __( 'Normal', 'woolementor-pro' ),
            ]
        );

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'review_card_border_normal',
				'label'         => __( 'Border', 'woolementor-pro' ),
				'selector'      => '{{WRAPPER}} .wl-crvs-review-single',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'review_card_background_normal',
				'label' => __( 'Background', 'woolementor-pro' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .wl-crvs-review-single',
			]
		);

        $this->end_controls_tab();

        $this->start_controls_tab(
            'review_card_background_hover',
            [
                'label' => __( 'Hover', 'woolementor-pro' ),
            ]
        );

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'review_card_border_hover',
				'label'         => __( 'Border', 'woolementor-pro' ),
				'selector'      => '{{WRAPPER}} .wl-crvs-review-single:hover',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'review_card_background_color_hover',
				'label' => __( 'Background', 'woolementor-pro' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .wl-crvs-review-single:hover',
			]
		);

		$this->add_control(
            'review_card_background_hover_transition',
            [
                'label'     => __( 'Transition Duration', 'woolementor-pro' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px'    => [
                        'max'   => 3,
                        'step'  => 0.1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .wl-crvs-review-single:hover' => 'transition-duration: {{SIZE}}s',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

		/**
		 * Name
		 */
		$this->start_controls_section(
			'review_name_full',
			[
				'label' => __( 'Name', 'woolementor-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'review_name_switcher' => 'yes'
                ],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'review_name_typographyrs',
				'label' 	=> __( 'Typography', 'woolementor-pro' ),
				'scheme' 	=> Typography::TYPOGRAPHY_3,
				'selector' 	=> '{{WRAPPER}} .wl-crvs-review-author h3',
			]
		);

		$this->start_controls_tabs(
            'review_name_tabs',
            [
                'separator' => 'before',
            ]
        );
		$this->start_controls_tab(
            'review_name',
            [
                'label' => __( 'Normal', 'woolementor-pro' ),
            ]
        );  
        
		$this->add_group_control(
            Group_Control_Gradient_Text::get_type(),
            [
                'name' => 'review_name_color',
                'selector' => '{{WRAPPER}} .wl-crvs-review-author h3',
            ]
        );
		 
        $this->end_controls_tab();

		$this->start_controls_tab(
            'review_name_hover',
            [
                'label' => __( 'Hover', 'woolementor-pro' ),
            ]
        ); 

        $this->add_group_control(
            Group_Control_Gradient_Text::get_type(),
            [
                'name' => 'review_name_color_hover',
                'selector' => '{{WRAPPER}} .wl-crvs-review-single:hover .wl-crvs-review-author h3',
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

		$this->end_controls_section();

		/**
		 * Description
		 */
		$this->start_controls_section(
			'review_description_full',
			[
				'label' => __( 'Description', 'woolementor-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'review_name_switcher' => 'yes'
                ],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'review_description_typographyrs',
				'label' 	=> __( 'Typography', 'woolementor-pro' ),
				'scheme' 	=> Typography::TYPOGRAPHY_3,
				'selector' 	=> '{{WRAPPER}} .wl-crvs-review-author-details span',
			]
		);

		$this->start_controls_tabs(
            'review_description_tabs',
            [
                'separator' => 'before',
            ]
        );
		$this->start_controls_tab(
            'review_description',
            [
                'label' => __( 'Normal', 'woolementor-pro' ),
            ]
        );  

        $this->add_control(
			'review_description_color',
			[
				'label' => __( 'Text Color', 'woolementor-pro' ),
				'type' => 	Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wl-crvs-review-author-details span' => 'color: {{VALUE}}',
				],
			]
		);
		 
        $this->end_controls_tab();

		$this->start_controls_tab(
            'review_description_hover',
            [
                'label' => __( 'Hover', 'woolementor-pro' ),
            ]
        ); 

        $this->add_control(
			'review_description_color_hover',
			[
				'label' => __( 'Text Color', 'woolementor-pro' ),
				'type' => 	Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wl-crvs-review-single:hover .wl-crvs-review-author-details span' => 'color: {{VALUE}}',
				],
			]
		);
        $this->end_controls_tab();
        $this->end_controls_tabs();

		$this->end_controls_section();

		/**
		 * Date
		 */
		$this->start_controls_section(
			'review_date_full',
			[
				'label' => __( 'Date', 'woolementor-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'review_date_switcher' => 'yes'
                ],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'review_date_typographyrs',
				'label' 	=> __( 'Typography', 'woolementor-pro' ),
				'scheme' 	=> Typography::TYPOGRAPHY_3,
				'selector' 	=> '{{WRAPPER}} .wl-crvs-review-date',
			]
		);

		$this->start_controls_tabs(
            'review_date_tabs',
            [
                'separator' => 'before',
            ]
        );
		$this->start_controls_tab(
            'review_date',
            [
                'label' => __( 'Normal', 'woolementor-pro' ),
            ]
        );        

		$this->add_control(
			'review_date_color',
			[
				'label' => __( 'Text Color', 'woolementor-pro' ),
				'type' => 	Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wl-crvs-review-date' => 'color: {{VALUE}}',
				],
			]
		);
		 
        $this->end_controls_tab();

		$this->start_controls_tab(
            'review_date_hover',
            [
                'label' => __( 'Hover', 'woolementor-pro' ),
            ]
        );        

		$this->add_control(
			'review_date_color_hover',
			[
				'label' => __( 'Text Color', 'woolementor-pro' ),
				'type' => 	Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wl-crvs-review-single:hover .wl-crvs-review-date' => 'color: {{VALUE}}',
				],
			]
		);
        $this->end_controls_tab();
        $this->end_controls_tabs();

		$this->end_controls_section();

        /**
         * star_rating
         */
        $this->start_controls_section(
            'review_rating',
            [
                'label' 		=> __( 'Rating', 'woolementor-pro' ),
                'tab'   		=> Controls_Manager::TAB_STYLE,
                'condition'     => [
                    'review_rating_switcher' => 'yes'
                ],
            ]
        );

        $this->add_control(
			'review_rating_blockicon',
			[
				'label' 		=> __( 'Block Icon', 'woolementor-pro' ),
				'type' 			=> Controls_Manager::ICONS,
				'default' 		=> [
					'value' 	=> 'fas fa-star',
					'library' 	=> 'solid',
				],
			]
		);

        $this->add_control(
			'review_rating_half_blockicon',
			[
				'label' 		=> __( 'Half Block Icon', 'woolementor-pro' ),
				'type' 			=> Controls_Manager::ICONS,
				'default' 		=> [
					'value' 	=> 'fas fa-star-half-alt',
					'library' 	=> 'solid',
				],
			]
		);

        $this->add_control(
			'review_rating_empty_icon',
			[
				'label' 		=> __( 'Empty Icon', 'woolementor-pro' ),
				'type' 			=> Controls_Manager::ICONS,
				'default' 		=> [
					'value' 	=> 'far fa-star',
					'library' 	=> 'solid',
				],
			]
		);

        $this->add_responsive_control(
            'review_rating_icon_size',
            [
                'label'     	=> __( 'Icon Size', 'woolementor-pro' ),
                'type'      	=> Controls_Manager::SLIDER,
                'size_units'	=> [ 'px', 'em' ],
                'selectors' 	=> [
                    '{{WRAPPER}} .wl-crvs-review-author-rating' => 'font-size: {{SIZE}}{{UNIT}}',
                ],
            ]
        );        

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'review_rating_box_border',
				'label' => __( 'Border', 'woolementor-pro' ),
				'selector' => '{{WRAPPER}} .wl-crvs-review-author-rating',
				'separator' => 'before'
			]
		);

		$this->add_control(
            'review_rating_box_border_radius',
            [
                'label' => __( 'Border Radius', 'woolementor-pro' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .wl-crvs-review-author-rating' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );		

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'review_rating_box_shadow',
				'label' => __( 'Box Shadow', 'woolementor-pro' ),
				'selector' => '{{WRAPPER}} .wl-crvs-review-author-rating',
			]
		);

		$this->add_control(
			'review_rating_box_padding',
			[
				'label' => __( 'Padding', 'woolementor-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .wl-crvs-review-author-rating' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'review_rating_box_margin',
			[
				'label' => __( 'Margin', 'woolementor-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .wl-crvs-review-author-rating' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs(
            'review_rating_box_tabs',
            [
                'separator' => 'before',
            ]
        );
		$this->start_controls_tab(
            'review_rating_box',
            [
                'label' => __( 'Normal', 'woolementor-pro' ),
            ]
        );

        $this->add_control(
			'review_rating_color',
			[
				'label' => __( 'Icon Color', 'woolementor-pro' ),
				'type' => 	Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wl-crvs-review-author-rating i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .wl-crvs-review-author-rating span strong' => 'color: {{VALUE}}',
				],
			]
		);	

        $this->add_control(
			'review_rating_box_bg_color',
			[
				'label' => __( 'Icon Background', 'woolementor-pro' ),
				'type' => 	Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wl-crvs-review-author-rating' => 'background: {{VALUE}}',
				],
			]
		);
		 
        $this->end_controls_tab();

		$this->start_controls_tab(
            'review_rating_box_hover',
            [
                'label' => __( 'Hover', 'woolementor-pro' ),
            ]
        );

        $this->add_control(
			'review_rating_color_hover',
			[
				'label' => __( 'Icon Color', 'woolementor-pro' ),
				'type' => 	Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wl-crvs-review-single:hover .wl-crvs-review-author-rating i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .wl-crvs-review-single:hover .wl-crvs-review-author-rating span strong' => 'color: {{VALUE}}',
				],
			]
		);	

        $this->add_control(
			'review_rating_box_bg_color_hover',
			[
				'label' => __( 'Icon Background', 'woolementor-pro' ),
				'type' => 	Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wl-crvs-review-single:hover .wl-crvs-review-author-rating' => 'background: {{VALUE}}',
				],
			]
		);
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();

		/**
		 * Comment
		 */
		$this->start_controls_section(
			'review_comment_full',
			[
				'label' => __( 'Comment', 'woolementor-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'review_comment_switcher' => 'yes'
                ],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'review_comment_typographyrs',
				'label' 	=> __( 'Typography', 'woolementor-pro' ),
				'scheme' 	=> Typography::TYPOGRAPHY_3,
				'selector' 	=> '{{WRAPPER}} .wl-crvs-review-details p',
			]
		);

		$this->start_controls_tabs(
            'review_comment_tabs',
            [
                'separator' => 'before',
            ]
        );
		$this->start_controls_tab(
            'review_comment',
            [
                'label' => __( 'Normal', 'woolementor-pro' ),
            ]
        );		

        $this->add_control(
			'review_comment_color',
			[
				'label' => __( 'Text Color', 'woolementor-pro' ),
				'type' => 	Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wl-crvs-review-details p' => 'color: {{VALUE}}',
				],
			]
		);
		 
        $this->end_controls_tab();

		$this->start_controls_tab(
            'review_comment_hover',
            [
                'label' => __( 'Hover', 'woolementor-pro' ),
            ]
        );

        $this->add_control(
			'review_comment_color_hover',
			[
				'label' => __( 'Text Color', 'woolementor-pro' ),
				'type' => 	Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wl-crvs-review-single:hover .wl-crvs-review-details p' => 'color: {{VALUE}}',
				],
			]
		);
        $this->end_controls_tab();
        $this->end_controls_tabs();

		$this->end_controls_section();

		/**
		 * User Image controls
		 */
		$this->start_controls_section(
			'review_photo',
			[
				'label' => __( 'Photo', 'woolementor-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'review_photo_switcher' => 'yes'
                ],
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' 		=> 'review_photo_thumbnail',
				'default' 	=> 'thumbnail',
			]
		);

		$this->add_responsive_control(
			'review_photo_width',
			[
				'label' 	=> __( 'Image Width', 'woolementor-pro' ),
				'type' 		=> Controls_Manager::SLIDER,
				'size_units'=> [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .wl-crvs-review-img img' => 'width: {{SIZE}}{{UNIT}}',
				],
				'range' 	=> [
					'px' 	=> [
						'min' 	=> 1,
						'max' 	=> 300
					],
					'em' 	=> [
						'min' 	=> 1,
						'max' 	=> 30
					],
				],
			]
		);

		$this->add_responsive_control(
			'review_photo_height',
			[
				'label' 	=> __( 'Image Height', 'woolementor-pro' ),
				'type' 		=> Controls_Manager::SLIDER,
				'size_units'=> [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .wl-crvs-review-img img' => 'height: {{SIZE}}{{UNIT}}',
				],
                'range'     => [
                    'px'    => [
                        'min'   => 1,
                        'max'   => 300
                    ],
                    'em'    => [
                        'min'   => 1,
                        'max'   => 30
                    ],
                ],
			]
		);

		$this->add_control(
			'review_photo_offset_toggle',
			[
				'label' 		=> __( 'Offset', 'woolementor-pro' ),
				'type' 			=> Controls_Manager::POPOVER_TOGGLE,
				'label_off' 	=> __( 'None', 'woolementor-pro' ),
				'label_on' 		=> __( 'Custom', 'woolementor-pro' ),
				'return_value' 	=> 'yes',
			]
		);

		$this->start_popover();

		$this->add_responsive_control(
			'review_photo_image_transform_x',
			[
				'label' 	=> __( 'Image Transform X', 'woolementor-pro' ),
				'type' 		=> Controls_Manager::SLIDER,
				'size_units'=> [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .wl-crvs-review-img' => 'top: {{SIZE}}{{UNIT}}',
				],
                'range'     => [
                    'px'    => [
                        'min'   => -200,
                        'max'   => 200
                    ],
                ],
				'condition' 	=> [
					'review_photo_offset_toggle' => 'yes'
				],
			]
		);

		$this->add_responsive_control(
			'review_photo_image_transform_Y',
			[
				'label' 	=> __( 'Image Transform Y', 'woolementor-pro' ),
				'type' 		=> Controls_Manager::SLIDER,
				'size_units'=> [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .wl-crvs-review-img' => 'left: {{SIZE}}{{UNIT}}',
				],
                'range'     => [
                    'px'    => [
                        'min'   => -200,
                        'max'   => 200
                    ],
                ],
				'condition' 	=> [
					'review_photo_offset_toggle' => 'yes'
				],
			]
		);

		$this->end_popover();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 		=> 'review_photo_border',
				'label' 	=> __( 'Border', 'woolementor-pro' ),
				'selector' 	=> '{{WRAPPER}} .wl-crvs-review-img img',
			]
		);

		$this->add_responsive_control(
			'review_photo_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'woolementor-pro' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wl-crvs-review-img img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 		=> 'review_photo_box_shadow',
				'label' 	=> __( 'Box Shadow', 'woolementor-pro' ),
				'selector' 	=> '{{WRAPPER}} .wl-crvs-review-img img',
			]
		);

		$this->end_controls_section();

		/**
		 * Navigation - Arrow 
		 */
		$this->start_controls_section(
            '_section_style_arrow',
            [
                'label' 		=> __( 'Navigation - Arrow', 'woolementor-pro' ),
                'tab'   		=> Controls_Manager::TAB_STYLE,
                'condition' 	=> [
                    'navigation' => array( 'arrow', 'both' ),
                ],
            ]
        );

        $this->add_control(
            'arrow_position_toggle',
            [
                'label' 		=> __( 'Position', 'woolementor-pro' ),
                'type' 			=> Controls_Manager::POPOVER_TOGGLE,
                'label_off' 	=> __( 'None', 'woolementor-pro' ),
                'label_on' 		=> __( 'Custom', 'woolementor-pro' ),
                'return_value' 	=> 'yes',
            ]
        );

        $this->start_popover();

        $this->add_responsive_control(
            'arrow_position_y',
            [
                'label' 		=> __( 'Vertical', 'woolementor-pro' ),
                'type' 			=> Controls_Manager::SLIDER,
                'size_units' 	=> ['px'],
                'condition' 	=> [
                    'arrow_position_toggle' => 'yes'
                ],
                'range' 		=> [
                    'px' 		=> [
                        'min' 	=> 0,
                        'max' 	=> 500,
                    ],
                ],
                'selectors' 	=> [
                    '{{WRAPPER}} .slick-prev, {{WRAPPER}} .slick-next' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'arrow_position_x',
            [
                'label' 		=> __( 'Horizontal', 'woolementor-pro' ),
                'type' 			=> Controls_Manager::SLIDER,
                'size_units' 	=> ['px'],
                'condition' 	=> [
                    'arrow_position_toggle' => 'yes'
                ],
                'range' 		=> [
                    'px' 		=> [
                        'min' 	=> -100,
                        'max' 	=> 250,
                    ],
                ],
                'selectors' 	=> [
                    '{{WRAPPER}} .slick-prev' => 'left: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .slick-next' => 'right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_popover();

        $this->add_responsive_control(
			'arrow_icon_size',
			[
				'label'     => __( 'Icon Size', 'woolementor-pro' ),
				'type'      => Controls_Manager::SLIDER,
				'size_units'=> [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .wl-crvs-review-silder .slick-next' => 'font-size: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .wl-crvs-review-silder .slick-prev' => 'font-size: {{SIZE}}{{UNIT}}',
				],
			]
		);

        $this->add_responsive_control(
			'arrow_area_size',
			[
				'label'     => __( 'Area Size', 'woolementor-pro' ),
				'type'      => Controls_Manager::SLIDER,
				'size_units'=> [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .wl-crvs-review-silder .slick-next' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .wl-crvs-review-silder .slick-prev' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' 			=> 'arrow_border',
                'selector' 		=> '{{WRAPPER}} .slick-prev, {{WRAPPER}} .slick-next',
            ]
        );

        $this->add_responsive_control(
            'arrow_border_radius',
            [
                'label' 		=> __( 'Border Radius', 'woolementor-pro' ),
                'type' 			=> Controls_Manager::DIMENSIONS,
                'size_units' 	=> [ 'px', '%' ],
                'selectors' 	=> [
                    '{{WRAPPER}} .slick-prev, {{WRAPPER}} .slick-next' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                ],
            ]
        );

        $this->start_controls_tabs( '_tabs_arrow' );

        $this->start_controls_tab(
            '_tab_arrow_normal',
            [
                'label' 		=> __( 'Normal', 'woolementor-pro' ),
            ]
        );

        $this->add_control(
            'arrow_color',
            [
                'label' 		=> __( 'Icon Color', 'woolementor-pro' ),
                'type' 			=> Controls_Manager::COLOR,
                'default' 		=> '',
                'selectors' 	=> [
                    '{{WRAPPER}} .slick-prev, {{WRAPPER}} .slick-next' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'arrow_bg_color',
            [
                'label' 		=> __( 'Background Color', 'woolementor-pro' ),
                'type' 			=> Controls_Manager::COLOR,
                'selectors' 	=> [
                    '{{WRAPPER}} .slick-prev, {{WRAPPER}} .slick-next' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tab_arrow_hover',
            [
                'label' => __( 'Hover', 'woolementor-pro' ),
            ]
        );

        $this->add_control(
            'arrow_hover_color',
            [
                'label' => __( 'Icon Color', 'woolementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slick-prev:hover, {{WRAPPER}} .slick-next:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'arrow_hover_bg_color',
            [
                'label' => __( 'Background Color', 'woolementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slick-prev:hover, {{WRAPPER}} .slick-next:hover' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'arrow_hover_border_color',
            [
                'label' => __( 'Border Color', 'woolementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'arrow_border_border!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .slick-prev:hover, {{WRAPPER}} .slick-next:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();

        /**
		 * Navigation - Dots
		 */
        $this->start_controls_section(
            '_section_style_dots',
            [
                'label' => __( 'Navigation - Dots', 'woolementor-pro' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' 	=> [
                    'navigation' => array( 'dots', 'both' ),
                ],
            ]
        );

        $this->add_responsive_control(
			'arrow_dots_size',
			[
				'label'     => __( 'Dots Size', 'woolementor-pro' ),
				'type'      => Controls_Manager::SLIDER,
				'size_units'=> [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .wl-crvs-review-silder .slick-dots li button::before' => 'font-size: {{SIZE}}{{UNIT}}',
				],
			]
		);

        $this->add_responsive_control(
            'dots_nav_position_y',
            [
                'label' => __( 'Vertical Position', 'woolementor-pro' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 500,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .slick-dots' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'dots_nav_spacing',
            [
                'label' => __( 'Spacing', 'woolementor-pro' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .slick-dots li' => 'margin-right: calc({{SIZE}}{{UNIT}} / 2); margin-left: calc({{SIZE}}{{UNIT}} / 2);',
                ],
            ]
        );

        $this->add_responsive_control(
            'dots_nav_align',
            [
                'label' => __( 'Alignment', 'woolementor-pro' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'woolementor-pro' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'woolementor-pro' ),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'woolementor-pro' ),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .slick-dots' => 'text-align: {{VALUE}}'
                ]
            ]
        );

        $this->start_controls_tabs( '_tabs_dots' );
        $this->start_controls_tab(
            '_tab_dots_normal',
            [
                'label' => __( 'Normal', 'woolementor-pro' ),
            ]
        );

        $this->add_control(
            'dots_nav_color',
            [
                'label' => __( 'Color', 'woolementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slick-dots li button:before' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tab_dots_hover',
            [
                'label' => __( 'Hover', 'woolementor-pro' ),
            ]
        );

        $this->add_control(
            'dots_nav_hover_color',
            [
                'label' => __( 'Color', 'woolementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slick-dots li button:hover:before' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tab_dots_active',
            [
                'label' => __( 'Active', 'woolementor-pro' ),
            ]
        );

        $this->add_control(
            'dots_nav_active_color',
            [
                'label' => __( 'Color', 'woolementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slick-dots .slick-active button:before' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        /**
		 * Quote
		 */
		$this->start_controls_section(
			'review_quote_full',
			[
				'label' => __( 'Quote', 'woolementor-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'review_quote_switcher' => 'yes'
                ],
			]
		);

		$this->add_responsive_control(
            'review_quote_size',
            [
                'label' => __( 'Icon Size', 'woolementor-pro' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .wl-crvs-review-quote' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
			'review_quote_icon_left',
			[
				'label' => __( 'Left Icon', 'woolementor-pro' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-quote-left',
					'library' => 'solid',
				],
			]
		);

        $this->add_control(
			'review_quote_icon_right',
			[
				'label' => __( 'Right Icon', 'woolementor-pro' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-quote-right',
					'library' => 'solid',
				],
			]
		);
		$this->start_controls_tabs(
            'review_quote',
            [
                'separator' => 'before',
            ]
        );
		$this->start_controls_tab(
            'review_card_background',
            [
                'label' => __( 'Normal', 'woolementor-pro' ),
            ]
        );

		$this->add_control(
			'review_quote_color',
			[
				'label' => __( 'Icon Color', 'woolementor-pro' ),
				'type' => 	Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wl-crvs-review-quote' => 'color: {{VALUE}}',
				],
			]
		);
		 
        $this->end_controls_tab();

		$this->start_controls_tab(
            'review_quote_background_hover',
            [
                'label' => __( 'Hover', 'woolementor-pro' ),
            ]
        );
        $this->add_control(
			'review_quote_color_hover',
			[
				'label' => __( 'Icon Color', 'woolementor-pro' ),
				'type' => 	Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wl-crvs-review-single:hover .wl-crvs-review-quote' => 'color: {{VALUE}}',
				],
			]
		);
        $this->end_controls_tab();
        $this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function render() {

		$settings 	= $this->get_settings_for_display();
		$id 		= $this->get_id();
		extract( $settings );
		?>

		<div class="wl-crvs-review-area">
			<div class="wl-crvs-review-silder reviews-carousel-<?php echo esc_attr( $id ) ?>">

				<?php foreach ( $review_repeater_items as $item ): ?>

					<div class="wl-crvs-review-single <?php echo esc_attr( $item['review_photo_align'] ); ?>" id="wl-crvs-review-<?php echo esc_attr( $item['_id'] ); ?>">

						<?php if ( 'yes' == $review_photo_switcher ): ?>
							<div class="wl-crvs-review-img">
								<?php 
									if ( !empty( $item['review_repeater_photo']['id'] ) ) {
										echo wp_get_attachment_image( $item['review_repeater_photo']['id'], $review_photo_thumbnail_size );
									}
									else{
										echo '<img src="'. esc_url( $item['review_repeater_photo']['url'] ) .'">';
									}
								?>
							</div>
						<?php endif; ?>

						
						<div class="wl-crvs-review-inner">

							<?php if ( 'yes' == $review_quote_switcher ): ?>
								<span class="wl-crvs-review-quote"><i class="<?php echo esc_attr( $review_quote_icon_left['value'] ); ?>"></i></span>
							<?php endif; ?>

							<div class="wl-crvs-review-author">
								<div class="wl-crvs-review-author-details">

									<?php if ( 'yes' == $review_name_switcher ): ?>
										<h3><?php echo esc_html( $item['review_repeater_name'] ); ?></h3>
									<?php endif; ?>

									<?php if ( 'yes' == $review_description_switcher ): ?>
										<span><?php echo esc_html( $item['review_repeater_description'] ); ?></span>
									<?php endif; ?>

								</div>

								<?php if ( !empty( $item['review_repeater_rating'] ) && 'yes' == $review_rating_switcher ): ?>
									<div class="wl-crvs-review-author-rating">
										<span>
											<?php for ( $i = 0; $i < 5; $i++ ) { 

												if ( $i < $item['review_repeater_rating'] ) {
													echo '<i class="'. esc_attr( $review_rating_blockicon['value'] ) .'"></i>';
												}
												else{
													echo '<i class="'. esc_attr( $review_rating_empty_icon['value'] ) .'"></i>';
												}
											} ?>
											<strong><?php echo esc_html( $item['review_repeater_rating'] ); ?>/5</strong>
										</span>
									</div>
								<?php endif; ?>
								
							</div>

							<?php if ( 'yes' == $review_comment_switcher ): ?>
								<div class="wl-crvs-review-details">
									<p><?php echo esc_html( $item['review_repeater_comment'] ); ?></p>
								</div>
							<?php endif; ?>

							<?php if ( 'yes' == $review_date_switcher ): ?>
								<div class="wl-crvs-review-date"><?php echo esc_html( $item['review_repeater_date'] ); ?></div>
							<?php endif; ?>

							<?php if ( 'yes' == $review_quote_switcher ): ?>
								<span class="wl-crvs-review-quote wl-right"><i class="<?php echo esc_attr( $review_quote_icon_right['value'] ); ?>"></i></span>
							<?php endif; ?>

						</div>

					</div>

				<?php endforeach; ?>
				
			</div>
		</div>

		<?php
		/**
		 * Load Script
		 */
		$this->render_script();
	}

	protected function render_script() {
		$settings 	= $this->get_settings_for_display();
		$id 		= $this->get_id();
		extract( $settings );

		$slick_config = [
        	'autoplay'			=> $autoplay,
        	'autoplay_speed'	=> $autoplay_speed,
        	'animation_speed'	=> $animation_speed,
        	'infinite_loop'		=> $infinite_loop,
        	'navigation'		=> $navigation,
        	'slides_show'		=> $slides_show,
        	'slides_show_mobile'=> $slides_show_mobile,
        	'slides_show_tablet'=> $slides_show_tablet,
        	'arrow_icon_left'	=> $arrow_icon_left,
        	'arrow_icon_right'	=> $arrow_icon_right,
        ];
		?>
		<script type="text/javascript">

            jQuery(function($){
            	var config 	= <?php echo json_encode( $slick_config ); ?>;
            	var $loop 	= config.infinite_loop ? true : false;
            	var $autoplay 	= config.autoplay ? true : false;

            	if ( 'none' == config.navigation ) {
            		$arrows = false;
            		$dots 	= false;
            	}
            	else if( 'arrow' == config.navigation ) {
            		$arrows = true;
            		$dots 	= false;
            	}
            	else if( 'dots' == config.navigation ) {
            		$arrows = false;
            		$dots 	= true;
            	}
            	else {
            		$arrows = true;
            		$dots 	= true;
            	}

            	if ( config.arrow_icon_left ) {
            		var $prevArrow = '<button type="button" class="slick-prev"><i class="'+ config.arrow_icon_left.value +'"></i></button>'
            	} else {
            		var $prevArrow = false
            	}

            	if ( config.arrow_icon_right ) {
            		var $nextArrow = '<button type="button" class="slick-next"><i class="'+ config.arrow_icon_right.value +'"></i></button>'
            	} else {
            		var $nextArrow = false
            	}

            	$('.reviews-carousel-<?php echo esc_attr( $id ); ?>' ).slick({
				  	infinite: $loop,
				  	autoplay: $autoplay,
				  	autoplaySpeed: config.autoplay_speed,
				  	speed: config.animation_speed,
				  	slidesToShow: parseInt(config.slides_show),
				  	slidesToScroll: parseInt(config.slides_show),
				  	arrows: $arrows,
				  	dots: $dots,
                    prevArrow: $prevArrow,
                    nextArrow: $nextArrow,

                    responsive: [
				    {
				      breakpoint: 1024,
				      settings: {
				        slidesToShow: parseInt(config.slides_show),
				        slidesToScroll: parseInt(config.slides_show),
				      }
				    },
				    {
				      breakpoint: 769,
				      settings: {
				        slidesToShow: parseInt(config.slides_show_tablet),
				        slidesToScroll: parseInt(config.slides_show_tablet),
				      }
				    },
				    {
				      breakpoint: 481,
				      settings: {
				      slidesToShow: parseInt(config.slides_show_mobile),
				        slidesToScroll: parseInt(config.slides_show_mobile),
				      }
				    }
				  ]
				});
            })
        </script>

        <?php
	}
}
