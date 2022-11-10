<?php
namespace codexpert\Woolementor_Pro;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use codexpert\Woolementor\Controls\Group_Control_Gradient_Text;

class Order_Review extends Widget_Base {

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


		$this->start_controls_section(
			'order_notes_title',
			[
				'label' => __( 'Section Title', 'woolementor-pro' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
            'order_review_title_show',
            [
                'label'         => __( 'Show/Hide Title', 'woolementor-pro' ),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => __( 'Show', 'woolementor-pro' ),
                'label_off'     => __( 'Hide', 'woolementor-pro' ),
                'return_value'  => 'yes',
                'default'       => 'yes',
            ]
        );
		//order_button_text
		$this->add_control(
		    'order_review_title_text',
		    [
		        'label' 		=> __( 'Text', 'woolementor-pro' ),
		        'type' 			=> Controls_Manager::TEXT,
		        'default' 		=> __( 'Order Review', 'woolementor-pro' ) ,
                'condition' => [
                    'order_review_title_show' => 'yes'
                ],
		        'dynamic' 		=> [
		            'active' 		=> true,
		        ]
		    ]
		);

		$this->add_control(
			'order_review_title_tag',
			[
				'label' 	=> __( 'HTML Tag', 'woolementor-pro' ),
				'type' 		=> Controls_Manager::SELECT,
				'default' 	=> 'h3',
				'options' 	=> [
					'h1'  => __( 'H1', 'woolementor-pro' ),
					'h2'  => __( 'H2', 'woolementor-pro' ),
					'h3'  => __( 'H3', 'woolementor-pro' ),
					'h4'  => __( 'H4', 'woolementor-pro' ),
					'h5'  => __( 'H5', 'woolementor-pro' ),
					'h6'  => __( 'H6', 'woolementor-pro' ),
				],
                'condition' => [
                    'order_review_title_show' => 'yes'
                ],
			]
		);

		$this->add_control(
            'order_review_title_alignment',
            [
                'label' 	   => __( 'Alignment', 'woolementor-pro' ),
                'type' 		   => Controls_Manager::CHOOSE,
                'options' 	   => [
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
                'default' 	=> 'left',
                'toggle' 	=> true,
                'condition' => [
                    'order_review_title_show' => 'yes'
                ],
                'selectors' => [
                    '{{WRAPPER}} .wl-order-review-title' => 'text-align: {{VALUE}};',
                ],
            ]
        );

		$this->end_controls_section();

		//section title style
		$this->start_controls_section(
			'order_review_title_style',
			[
				'label' => __( 'Title', 'woolementor-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'order_review_title_show' => 'yes'
                ],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'order_review_title_typographyrs',
				'label' 	=> __( 'Typography', 'woolementor-pro' ),
				'scheme' 	=> Typography::TYPOGRAPHY_3,
				'selector' 	=> '{{WRAPPER}} .wl-order-review-title',
			]
		);

		$this->add_group_control(
			Group_Control_Gradient_Text::get_type(),
			[
				'name' => 'order_review_title_color',
				'selector' => '{{WRAPPER}} .wl-order-review-title',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' 		=> 'order_review_input_background_color',
				'label' 	=> __( 'Background', 'woolementor-pro' ),
				'types' 	=> [ 'classic', 'gradient' ],
				'selector' 	=> '{{WRAPPER}} .wl-order-review-title',
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 		=> 'order_review_title_border',
				'label' 	=> __( 'Border', 'woolementor-pro' ),
				'selector' 	=> '{{WRAPPER}} .wl-order-review-title',
				'separator' => 'before',
			]
		);

        $this->add_control(
			'order_review_title_border_radius',
			[
				'label' 	=> __( 'Border Redius', 'woolementor-pro' ),
				'type' 		=> Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .wl-order-review-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'order_review_title_padding',
			[
				'label' 	=> __( 'Padding', 'woolementor-pro' ),
				'type' 		=> Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .wl-order-review-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'order_review_title_margin',
			[
				'label'         => __( 'Margin', 'woolementor-pro' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .wl-order-review-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();


		/**
		 * Table border controll
		 */
		$this->start_controls_section(
			'order_table_border_style',
			[
				'label' => __( 'Table Sell Border', 'woolementor-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name'      => 'table_border_type',
		        'label'     => __( 'Border', 'woolementor-pro' ),
		        'selector'  => '{{WRAPPER}} .wl-order-review table tr td,
		        				{{WRAPPER}} .wl-order-review table tr th',
		    ]
		);

		$this->end_controls_section();

		/**
		 * Table Header controll
		 */
		$this->start_controls_section(
			'order_table_header_style',
			[
				'label' => __( 'Table Header', 'woolementor-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'order_thead_typographyrs',
				'label' 	=> __( 'Typography', 'woolementor-pro' ),
				'scheme' 	=> Typography::TYPOGRAPHY_3,
				'selector' 	=> '{{WRAPPER}} .wl-order-review thead tr th',
			]
		);


        $this->add_control(
			'order_thead_color',
			[
				'label'     => __( 'Text Color', 'woolementor-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wl-order-review thead tr th' => 'color: {{VALUE}}',
				],
			]
		);

        $this->add_control(
			'order_thead_bg_color',
			[
				'label'     => __( 'Background', 'woolementor-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wl-order-review thead tr th' => 'background-color: {{VALUE}}',
				],
			]
		);


		$this->add_control(
            'order_thead_alignment',
            [
                'label' 	   => __( 'Alignment', 'woolementor-pro' ),
                'type' 		   => Controls_Manager::CHOOSE,
                'options' 	   => [
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
                'default' 	=> 'left',
                'toggle' 	=> true,
                'selectors' => [
                    '{{WRAPPER}} .wl-order-review thead tr th' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
        	'order_thead_padding',
        	[
        		'label' => __( 'Padding', 'woolementor-pro' ),
        		'type' => Controls_Manager::DIMENSIONS,
        		'size_units' => [ 'px', '%', 'em' ],
        		'selectors' => [
        			'{{WRAPPER}} .wl-order-review thead tr th' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        		],
        	]
        );

		$this->end_controls_section();

		/**
		 * Table body controll
		 */
		$this->start_controls_section(
			'order_tbody_style',
			[
				'label' => __( 'Table Body', 'woolementor-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'order_tbody_typographyrs',
				'label' 	=> __( 'Typography', 'woolementor-pro' ),
				'scheme' 	=> Typography::TYPOGRAPHY_3,
				'selector' 	=> '{{WRAPPER}} .wl-order-review tbody tr td',
			]
		);


        $this->add_control(
			'order_tbody_color',
			[
				'label'     => __( 'Text Color', 'woolementor-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wl-order-review tbody tr td' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'order_tbody_bg_color',
			[
				'label'     => __( 'Background', 'woolementor-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wl-order-review tbody tr td' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
            'order_tbody_alignment',
            [
                'label' 	   => __( 'Alignment', 'woolementor-pro' ),
                'type' 		   => Controls_Manager::CHOOSE,
                'options' 	   => [
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
                'default' 	=> 'left',
                'toggle' 	=> true,
                'selectors' => [
                    '{{WRAPPER}} .wl-order-review tbody tr td' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
        	'order_tbody_padding',
        	[
        		'label' => __( 'Padding', 'woolementor-pro' ),
        		'type' => Controls_Manager::DIMENSIONS,
        		'size_units' => [ 'px', '%', 'em' ],
        		'selectors' => [
        			'{{WRAPPER}} .wl-order-review table tbody tr td' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        			'{{WRAPPER}} .wl-order-review table tbody tr td span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        			'{{WRAPPER}} .wl-order-review table tbody tr td ul' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        		],
        	]
        );

		$this->end_controls_section();


		/**
		 * Table footer controll
		 */
		$this->start_controls_section(
			'order_tfoot_style',
			[
				'label' => __( 'Table Footer', 'woolementor-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'order_tfoot_typographyrs',
				'label' 	=> __( 'Typography', 'woolementor-pro' ),
				'scheme' 	=> Typography::TYPOGRAPHY_3,
				'selector' 	=> '{{WRAPPER}} .wl-order-review tfoot tr td,
								{{WRAPPER}} .wl-order-review tfoot tr th',
			]
		);


        $this->add_control(
			'order_tfoot_color',
			[
				'label'     => __( 'Text Color', 'woolementor-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wl-order-review tfoot tr td,
					 {{WRAPPER}} .wl-order-review tfoot tr th' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'order_tfoot_bg_color',
			[
				'label'     => __( 'Background', 'woolementor-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wl-order-review tfoot tr td,
					 {{WRAPPER}} .wl-order-review tfoot tr th' => 'background-color: {{VALUE}}',
				],
			]
		);


		$this->add_control(
            'order_tfoot_alignment',
            [
                'label' 	   => __( 'Alignment', 'woolementor-pro' ),
                'type' 		   => Controls_Manager::CHOOSE,
                'options' 	   => [
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
                'default' 	=> 'left',
                'toggle' 	=> true,
                'selectors' => [
                    '{{WRAPPER}} .wl-order-review tfoot tr td,
					 {{WRAPPER}} .wl-order-review tfoot tr th' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
        	'order_tfoot_padding',
        	[
        		'label' => __( 'Padding', 'woolementor-pro' ),
        		'type' => Controls_Manager::DIMENSIONS,
        		'size_units' => [ 'px', '%', 'em' ],
        		'selectors' => [
        			'{{WRAPPER}} .wl-order-review tfoot tr td,
					 {{WRAPPER}} .wl-order-review tfoot tr th' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        		],
        	]
        );

		$this->end_controls_section();

	}

	protected function render() {
		if ( ( is_checkout() && !empty( is_wc_endpoint_url('order-received') ) ) ) return;
		
		$settings = $this->get_settings_for_display();
		extract( $settings );

		/**
		 * Load attributes
		 */
		$this->render_editing_attributes();
		wc()->frontend_includes();
		
		if( is_null( WC()->cart ) ) {
			include_once WC_ABSPATH . 'includes/wc-cart-functions.php';
			include_once WC_ABSPATH . 'includes/class-wc-cart.php';
			wc_load_cart();
		}
		
		if( 'yes' == $order_review_title_show ): 

			printf( '<%1$s %2$s>%3$s</%1$s>',
				esc_attr( $order_review_title_tag ),
				$this->get_render_attribute_string( 'order_review_title_text' ),
				esc_html( $order_review_title_text )
			);

		endif; 
		?>

		<div class="wl-order-review">
			<?php wc_get_template( 'checkout/review-order.php', [ 'checkout' => WC()->checkout() ] ); ?>
		</div>
		
		<?php
		/**
		 * Load Script
		 */
		$this->render_script();
	}

	protected function render_script() {
		?>
		<script type="text/javascript">
			jQuery(function($){
				$( '#billing_state, #billing_city, #billing_postcode' ).on( 'change', function() {
					$( document.body ).trigger( 'update_checkout' );
				} )
			})
		</script>
		<?php
	}

	private function render_editing_attributes() {
		$this->add_inline_editing_attributes( 'order_review_title_text', 'none' );
		$this->add_render_attribute( 'order_review_title_text', 'class', 'wl-order-review-title' );
	}
}

