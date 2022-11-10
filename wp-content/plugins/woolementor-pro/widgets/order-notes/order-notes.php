<?php
namespace codexpert\Woolementor_Pro;

use Elementor\Repeater;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use codexpert\Woolementor\Controls\Group_Control_Gradient_Text;

class Order_Notes extends Widget_Base {

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
            'order_notes_title_show',
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
		    'order_notes_title_text',
		    [
		        'label' 		=> __( 'Text', 'woolementor-pro' ),
		        'type' 			=> Controls_Manager::TEXT,
		        'default' 		=> __( 'Order Notes', 'woolementor-pro' ) ,
                'condition' => [
                    'order_notes_title_show' => 'yes'
                ],
		        'dynamic' 		=> [
		            'active' 		=> true,
		        ]
		    ]
		);

		$this->add_control(
			'order_notes_title_tag',
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
                    'order_notes_title_show' => 'yes'
                ],
			]
		);

		$this->add_control(
            'order_notes_title_alignment',
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
                    'order_notes_title_show' => 'yes'
                ],
                'selectors' => [
                    '{{WRAPPER}} .wl-pm-title' => 'text-align: {{VALUE}};',
                ],
            ]
        );

		$this->end_controls_section();

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Order Fields', 'woolementor-pro' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'order_input_label', [
				'label' => __( 'Input Label', 'woolementor-pro' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'New Section' , 'woolementor-pro' ),
				'label_block' => true,
				'separator' => 'after',
			]
		);

		$repeater->add_control(
			'order_input_class', [
				'label' => __( 'Class Name', 'woolementor-pro' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'form-row-wide',
				'options' => [
					'form-row-first' => 'form-row-first',
					'form-row-last' => 'form-row-last',
					'form-row-wide' => 'form-row-wide',
				],
			]
		);

		$repeater->add_control(
			'order_input_type', [
				'label' => __( 'Input Type', 'woolementor-pro' ),
				'type' => Controls_Manager::SELECT2,
				'default' => 'text',
				'options' => [
					'textarea'			=> __( 'Textarea', 'woolementor-pro' ),
					'checkbox'			=> __( 'Checkbox', 'woolementor-pro' ),
					'text'				=> __( 'Text', 'woolementor-pro' ),
					'password'			=> __( 'Password', 'woolementor-pro' ),
					'date'				=> __( 'Date', 'woolementor-pro' ),
					'number'			=> __( 'Number', 'woolementor-pro' ),
					'email'				=> __( 'Email', 'woolementor-pro' ),
					'url'				=> __( 'Url', 'woolementor-pro' ),
					'tel'				=> __( 'Tel', 'woolementor-pro' ),
					'select'			=> __( 'Select', 'woolementor-pro' ),
					'radio'				=> __( 'Radio', 'woolementor-pro' ),
				],
			]
		);

		$repeater->add_control(
			'order_input_options', [
				'label' => __( 'Options', 'woolementor-pro' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => implode( PHP_EOL, [ __( 'Option 1', 'woolementor-pro' ), __( 'Option 2', 'woolementor-pro' ), __( 'Option 3', 'woolementor-pro' ) ] ),
				'label_block' => true,
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'order_input_type',
							'operator' => '==',
							'value' => 'select',
						],
						[
							'name' => 'order_input_type',
							'operator' => '==',
							'value' => 'radio',
						],
					],
				],
			]
		);

		$repeater->add_control(
			'order_input_name', [
				'label' => __( 'Field Name', 'woolementor-pro' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'name_' . rand( 111, 999 ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'order_input_placeholder', [
				'label' => __( 'Placeholder', 'woolementor-pro' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Placeholder' , 'woolementor-pro' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'order_input_autocomplete', [
				'label' => __( 'Autocomplete Value', 'woolementor-pro' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Given value' , 'woolementor-pro' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'order_input_required',
			[
				'label'         => __( 'Required', 'woolementor-pro' ),
				'type'          => Controls_Manager::SWITCHER,
				'label_on'      => __( 'yes', 'woolementor-pro' ),
				'label_off'     => __( 'no', 'woolementor-pro' ),
				'return_value'  => true,
				'default'       => true,
			]
		);

		$this->add_control(
			'order_form_items',
			[
				'label' => __( '', 'woolementor-pro' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => woolementor_checkout_fields( 'order' ),
				'title_field' => '{{{ order_input_label }}}',
			]
		);

		$this->end_controls_section();

		//section title style
		$this->start_controls_section(
			'order_notes_title_style',
			[
				'label' => __( 'Title', 'woolementor-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'order_notes_title_show' => 'yes'
                ],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'order_notes_title_typographyrs',
				'label' 	=> __( 'Typography', 'woolementor-pro' ),
				'scheme' 	=> Typography::TYPOGRAPHY_3,
				'selector' 	=> '{{WRAPPER}} .wl-pm-title',
			]
		);

		$this->add_group_control(
			Group_Control_Gradient_Text::get_type(),
			[
				'name' => 'order_notes_title_color',
				'selector' => '{{WRAPPER}} .wl-pm-title',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' 		=> 'order_notes_background_color',
				'label' 	=> __( 'Background', 'woolementor-pro' ),
				'types' 	=> [ 'classic', 'gradient' ],
				'selector' 	=> '{{WRAPPER}} .wl-pm-title',
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 		=> 'order_notes_title_border',
				'label' 	=> __( 'Border', 'woolementor-pro' ),
				'selector' 	=> '{{WRAPPER}} .wl-pm-title',
				'separator' => 'before',
			]
		);


       $this->add_control(
			'order_notes_title_border_radius',
			[
				'label' 	=> __( 'Border Redius', 'woolementor-pro' ),
				'type' 		=> Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .wl-pm-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'order_notes_title_padding',
			[
				'label' 	=> __( 'Padding', 'woolementor-pro' ),
				'type' 		=> Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .wl-pm-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'order_notes_title_margin',
			[
				'label'         => __( 'Margin', 'woolementor-pro' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .wl-pm-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		/**
		 * Input Label Color
		 */
		$this->start_controls_section(
			'order_style',
			[
				'label' => __( 'Labels', 'woolementor-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'order_label_typographyrs',
				'label' 	=> __( 'Typography', 'woolementor-pro' ),
				'scheme' 	=> Typography::TYPOGRAPHY_3,
				'selector' 	=> '{{WRAPPER}} .wl-order-notes label',
			]
		);


        $this->add_control(
			'order_label_color',
			[
				'label'     => __( 'Text Color', 'woolementor-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wl-order-notes label' => 'color: {{VALUE}}',
				],
			]
		);

        $this->add_control(
        	'order_label_padding',
        	[
        		'label' => __( 'Padding', 'woolementor-pro' ),
        		'type' => Controls_Manager::DIMENSIONS,
        		'size_units' => [ 'px', '%', 'em' ],
        		'selectors' => [
        			'{{WRAPPER}} .wl-order-notes label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        		],
        	]
        );

		$this->add_control(
			'order_label_line_hight',
			[
				'label' => __( 'Line Height', 'plugin-domain' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 20,
						'max' => 100,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 25,
				],
				'selectors' => [
					'{{WRAPPER}} .wl-order-notes label' => 'line-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		/**
		 * Input Color
		 */
		$this->start_controls_section(
			'order_input_style',
			[
				'label' => __( 'Input Fields', 'woolementor-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'order_input_typographyrs',
				'label' 	=> __( 'Typography', 'woolementor-pro' ),
				'scheme' 	=> Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} .wl-order-notes input, 
								{{WRAPPER}} .wl-order-notes select, 
								{{WRAPPER}} .wl-order-notes option,
								{{WRAPPER}} .wl-order-notes textarea',
			]
		);

		$this->add_control(
			'order_input_color',
			[
				'label'     => __( 'Input Text Color', 'woolementor-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wl-order-notes input, 
					 {{WRAPPER}} .wl-order-notes select, 
					 {{WRAPPER}} .wl-order-notes option,
					 {{WRAPPER}} .wl-order-notes textarea' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'order_input_background_color',
			[
				'label'     => __( 'Background Color', 'woolementor-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wl-order-notes input, 
					 {{WRAPPER}} .wl-order-notes select, 
					 {{WRAPPER}} .wl-order-notes option,
					 {{WRAPPER}} .wl-order-notes textarea' => 'background-color: {{VALUE}}',
				],
			]
		);

        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 		=> 'order_input_border',
				'label' 	=> __( 'Border', 'woolementor-pro' ),
				'separator' => 'before',
				'selector' => '{{WRAPPER}} .wl-order-notes input, 
								{{WRAPPER}} .wl-order-notes select,
								{{WRAPPER}} .wl-order-notes textarea',
			]
		);

        $this->add_control(
			'order_input_border_radius',
			[
				'label' => __( 'Border Redius', 'woolementor-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .wl-order-notes input, 
					 {{WRAPPER}} .wl-order-notes select,
					 {{WRAPPER}} .wl-order-notes textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'order_input_padding',
			[
				'label' => __( 'Padding', 'woolementor-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .wl-order-notes input, 
					 {{WRAPPER}} .wl-order-notes select,
					 {{WRAPPER}} .wl-order-notes textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

		if( woolementor_is_edit_mode() ) {
			$_woolementor_checkout_fields = get_option( '_woolementor_checkout_fields', [] );
			$_woolementor_checkout_fields['order'] = $order_form_items;
			update_option( '_woolementor_checkout_fields', $_woolementor_checkout_fields );
		}

		$order_fields = [];
		foreach( $order_form_items as $item ) {	
			$order_fields[ sanitize_text_field( $item['order_input_name'] ) ] = 
	        [
	            'label'			=> sanitize_text_field( $item['order_input_label'] ),
	            'type'			=> $item['order_input_type'],
	            'required'		=> $item['order_input_required'] == 'true' ? true : false,
	            'class'			=> is_array( $item['order_input_class'] ) ? $item['order_input_class'] : explode( ' ', $item['order_input_class'] ),
	            'autocomplete'	=> sanitize_text_field( $item['order_input_autocomplete'] ), 
	            'placeholder'	=> sanitize_text_field( $item['order_input_placeholder'] ), 
	            'priority'		=> 10,
	        ];
	        if ( isset( $item['order_input_options'] ) ) {
	        	$options = explode( PHP_EOL, $item['order_input_options'] );
	        	$new_options = [];
	        	foreach ( $options as $option ) {
	        		$new_options[ strtolower( $option ) ] = $option;
	        	}
	        	$order_fields[ sanitize_text_field( $item['order_input_name'] ) ]['options'] = $new_options;
	        }
		}
		
		if( 'yes' == $order_notes_title_show ): 

			printf( '<%1$s %2$s>%3$s</%1$s>',
				esc_attr( $order_notes_title_tag ),
				$this->get_render_attribute_string( 'order_notes_title_text' ),
				esc_html( $order_notes_title_text )
			);

		endif; 
		?>

		<div class="wl-order-notes">
			<?php

			foreach ( $order_fields as $key => $field ) {
				woocommerce_form_field( $key, $field, WC()->checkout->get_value( $key ) );
			}
		?>
		</div>
		<?php
	}

	private function render_editing_attributes() {
		$this->add_inline_editing_attributes( 'order_notes_title_text', 'none' );
		$this->add_render_attribute( 'order_notes_title_text', 'class', 'wl-pm-title' );
	}
}

