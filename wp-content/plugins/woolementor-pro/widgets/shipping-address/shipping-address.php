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

class Shipping_Address extends Widget_Base {

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
			'shipping_title',
			[
				'label' => __( 'Section Title', 'woolementor-pro' ),
				'tab' 	=> Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
            'shipping_title_show',
            [
                'label'         => __( 'Show/Hide Title', 'woolementor-pro' ),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => __( 'Show', 'woolementor-pro' ),
                'label_off'     => __( 'Hide', 'woolementor-pro' ),
                'return_value'  => 'yes',
                'default'       => 'yes',
            ]
        );
		$this->add_control(
		    'shipping_title_text',
		    [
		        'label' 		=> __( 'Text', 'woolementor-pro' ),
		        'type' 			=> Controls_Manager::TEXT,
		        'default' 		=> __( 'Shipping Address', 'woolementor-pro' ),
                'condition' 	=> [
                    'shipping_title_show' => 'yes'
                ],
		        'dynamic' 		=> [
		            'active' 		=> true,
		        ]
		    ]
		);

		$this->add_control(
			'payment_title_tag',
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
                    'shipping_title_show' => 'yes'
                ],
			]
		);

		$this->add_control(
            'shipping_title_alignment',
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
                    'shipping_title_show' => 'yes'
                ],
                'selectors' => [
                    '{{WRAPPER}} .wl-shipping-title' => 'text-align: {{VALUE}};',
                ],
            ]
        );

		$this->end_controls_section();

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Shipping Fields', 'woolementor-pro' ),
				'tab' 	=> Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'default_checked',
			[
				'label'	 	=> __( 'Default Checked?', 'woolementor-pro' ),
				'type' 		=> Controls_Manager::SWITCHER,
				'label_on' 	=> __( 'Yes', 'woolementor-pro' ),
				'label_off' => __( 'No', 'woolementor-pro' ),
				'return_value' 	=> 'yes',
				'default' 		=> '',
			]
		);

        $this->add_control(
            'shipping_toggle_caption',
            [
                'label' 		=> __( 'Toggle Caption', 'woolementor-pro' ),
                'type' 			=> Controls_Manager::TEXT,
                'default' 		=> __( 'Ship to a different address?', 'woolementor-pro' ),
                'separator' 	=> 'after',
                'dynamic' 		=> [
                    'active' 		=> true,
                ]
            ]
        );

		$repeater = new Repeater();

		$repeater->add_control(
			'shipping_input_label', [
				'label' 	=> __( 'Input Label', 'woolementor-pro' ),
				'type' 		=> Controls_Manager::TEXT,
				'default' 	=> __( 'New Section' , 'woolementor-pro' ),
				'label_block' 	=> true,
				'separator' 	=> 'after',
			]
		);

		$repeater->add_control(
			'shipping_input_class', [
				'label' 	=> __( 'Class Name', 'woolementor-pro' ),
				'type' 		=> Controls_Manager::SELECT,
				'default' 	=> 'form-row-wide',
				'options' 	=> [
					'form-row-first' 	=> 'form-row-first',
					'form-row-last' 	=> 'form-row-last',
					'form-row-wide' 	=> 'form-row-wide',
				],
			]
		);

		$repeater->add_control(
			'shipping_input_type', [
				'label' 	=> __( 'Input Type', 'woolementor-pro' ),
				'type' 		=> Controls_Manager::SELECT2,
				'default' 	=> 'text',
				'options' 	=> [
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
			'shipping_input_options', [
				'label' 	=> __( 'Options', 'woolementor-pro' ),
				'type' 		=> Controls_Manager::TEXTAREA,
				'default' 	=> implode( PHP_EOL, [ __( 'Option 1', 'woolementor-pro' ), __( 'Option 2', 'woolementor-pro' ), __( 'Option 3', 'woolementor-pro' ) ] ),
				'label_block' 	=> true,
				'conditions' 	=> [
					'relation' 	=> 'or',
					'terms' 	=> [
						[
							'name' 		=> 'shipping_input_type',
							'operator' 	=> '==',
							'value' 	=> 'select',
						],
						[
							'name' 		=> 'shipping_input_type',
							'operator' 	=> '==',
							'value' 	=> 'radio',
						],
					],
				],
			]
		);

		$repeater->add_control(
			'shipping_input_name', [
				'label' 		=> __( 'Field Name', 'woolementor-pro' ),
				'type' 			=> Controls_Manager::TEXT,
				'default' 		=> 'name_' . rand( 111, 999 ),
				'label_block' 	=> true,
			]
		);

		$repeater->add_control(
			'shipping_input_placeholder', [
				'label' 		=> __( 'Placeholder', 'woolementor-pro' ),
				'type' 			=> Controls_Manager::TEXT,
				'default' 		=> __( 'Placeholder' , 'woolementor-pro' ),
				'label_block' 	=> true,
			]
		);

		$repeater->add_control(
			'shipping_input_autocomplete', [
				'label' 		=> __( 'Autocomplete Value', 'woolementor-pro' ),
				'type' 			=> Controls_Manager::TEXT,
				'default' 		=> __( 'Given value' , 'woolementor-pro' ),
				'label_block' 	=> true,
			]
		);

		$repeater->add_control(
			'shipping_input_required',
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
			'shipping_form_items',
			[
				'label' 		=> __( '', 'woolementor-pro' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> woolementor_checkout_fields( 'shipping' ),
				'title_field' 	=> '{{{ shipping_input_label }}}',
			]
		);

		$this->end_controls_section();

		//section title style
		$this->start_controls_section(
			'shipping_title_style',
			[
				'label' 	=> __( 'Title', 'woolementor-pro' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
                'condition' => [
                    'shipping_title_show' => 'yes'
                ],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'shipping_title_typographyrs',
				'label' 	=> __( 'Typography', 'woolementor-pro' ),
				'scheme' 	=> Typography::TYPOGRAPHY_3,
				'selector' 	=> '{{WRAPPER}} .wl-shipping-title',
			]
		);

		$this->add_group_control(
			Group_Control_Gradient_Text::get_type(),
			[
				'name' 		=> 'shipping_title_color',
				'selector' 	=> '{{WRAPPER}} .wl-shipping-title',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' 			=> 'shipping_input_background_color',
				'label' 		=> __( 'Background', 'woolementor-pro' ),
				'types' 		=> [ 'classic', 'gradient' ],
				'selector' 		=> '{{WRAPPER}} .wl-shipping-title',
				'separator' 	=> 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'shipping_title_border',
				'label' 		=> __( 'Border', 'woolementor-pro' ),
				'selector' 		=> '{{WRAPPER}} .wl-shipping-title',
				'separator' 	=> 'before',
			]
		);

        $this->add_control(
			'shipping_title_border_radius',
			[
				'label' 		=> __( 'Border Redius', 'woolementor-pro' ),
				'type'			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wl-shipping-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'shipping_title_padding',
			[
				'label' 		=> __( 'Padding', 'woolementor-pro' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wl-shipping-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'shipping_title_margin',
			[
				'label'         => __( 'Margin', 'woolementor-pro' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .wl-shipping-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		/**
		 * Input Color
		 */
		$this->start_controls_section(
			'shipping_toggle',
			[
				'label' => __( 'Toggle Caption', 'woolementor-pro' ),
				'tab' 	=> Controls_Manager::TAB_STYLE,
			]
		);


		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'shipping_toggle_typographyrs',
				'label' 	=> __( 'Typography', 'woolementor-pro' ),
				'scheme' 	=> Typography::TYPOGRAPHY_3,
				'selector' 	=> '{{WRAPPER}} .shipping-checkbox-caption',
			]
		);

		$this->add_control(
			'shipping_toggle_color',
			[
				'label'     => __( 'Text Color', 'woolementor-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .shipping-checkbox-caption' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		/**
		 * Input Label Color
		 */
		$this->start_controls_section(
			'shipping_style',
			[
				'label' => __( 'Labels', 'woolementor-pro' ),
				'tab' 	=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'shipping_label_typographyrs',
				'label' 	=> __( 'Typography', 'woolementor-pro' ),
				'scheme' 	=> Typography::TYPOGRAPHY_3,
				'selector' 	=> '{{WRAPPER}} .wl-shipping label',
			]
		);


        $this->add_control(
			'shipping_label_color',
			[
				'label'     => __( 'Text Color', 'woolementor-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wl-shipping label' => 'color: {{VALUE}}',
				],
			]
		);

        $this->add_control(
        	'shipping_label_padding',
        	[
        		'label' => __( 'Padding', 'woolementor-pro' ),
        		'type' 	=> Controls_Manager::DIMENSIONS,
        		'size_units' 	=> [ 'px', '%', 'em' ],
        		'selectors' 	=> [
        			'{{WRAPPER}} .wl-shipping label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        		],
        	]
        );

		$this->add_control(
			'shipping_label_line_hight',
			[
				'label' 		=> __( 'Line Height', 'woolementor-pro' ),
				'type' 			=> Controls_Manager::SLIDER,
				'size_units' 	=> [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' 	=> 20,
						'max' 	=> 100,
						'step' 	=> 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' 	=> [
					'unit' 	=> 'px',
					'size' 	=> 25,
				],
				'selectors' => [
					'{{WRAPPER}} .wl-shipping label' => 'line-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		/**
		 * Input Color
		 */
		$this->start_controls_section(
			'shipping_input_style',
			[
				'label' => __( 'Input Fields', 'woolementor-pro' ),
				'tab' 	=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'shipping_input_typographyrs',
				'label' 	=> __( 'Typography', 'woolementor-pro' ),
				'scheme' 	=> Typography::TYPOGRAPHY_3,
				'selector' 	=> '{{WRAPPER}} .wl-shipping input, 
								{{WRAPPER}} .wl-shipping select, 
								{{WRAPPER}} .wl-shipping option,
								{{WRAPPER}} .wl-shipping textarea',
			]
		);

		$this->add_control(
			'shipping_input_color',
			[
				'label'     => __( 'Input Text Color', 'woolementor-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
								'{{WRAPPER}} .wl-shipping input, 
								 {{WRAPPER}} .wl-shipping select, 
								 {{WRAPPER}} .wl-shipping option,
								 {{WRAPPER}} .wl-shipping textarea' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'shipping_input_background_color',
			[
				'label'     => __( 'Background Color', 'woolementor-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
								'{{WRAPPER}} .wl-shipping input, 
								 {{WRAPPER}} .wl-shipping select, 
								 {{WRAPPER}} .wl-shipping option,
								 {{WRAPPER}} .wl-shipping .select2-container .select2-selection--single,
								 {{WRAPPER}} .wl-shipping textarea' => 'background-color: {{VALUE}}',
				],
			]
		);

        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 		=> 'shipping_input_border',
				'label' 	=> __( 'Border', 'woolementor-pro' ),
				'separator' => 'before',
				'selector' 	=> '{{WRAPPER}} .wl-shipping input, 
								{{WRAPPER}} .wl-shipping select,
								{{WRAPPER}} .wl-shipping .select2-container .select2-selection--single,
								{{WRAPPER}} .wl-shipping textarea',
			]
		);

        $this->add_control(
			'shipping_input_border_radius',
			[
				'label' => __( 'Border Redius', 'woolementor-pro' ),
				'type' 	=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wl-shipping input, 
					 {{WRAPPER}} .wl-shipping select,
					 {{WRAPPER}} .wl-shipping textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'shipping_input_padding',
			[
				'label' => __( 'Padding', 'woolementor-pro' ),
				'type' 	=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wl-shipping input, 
					 {{WRAPPER}} .wl-shipping select,
					 {{WRAPPER}} .wl-shipping textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
			$_woolementor_checkout_fields['shipping'] = $shipping_form_items;
			update_option( '_woolementor_checkout_fields', $_woolementor_checkout_fields );
		}

		$checked = $default_checked == 'yes' ? 'checked' : '';
		$shipping_fields = [];
		foreach( $shipping_form_items as $item ) {	
			$shipping_fields[ sanitize_text_field( $item['shipping_input_name'] ) ] = 
		        [
		            'label'			=> sanitize_text_field( $item['shipping_input_label'] ),
		            'type'			=> $item['shipping_input_type'],
		            'required'		=> $item['shipping_input_required'] == 'true' ? true : false,
		            'class'			=> is_array( $item['shipping_input_class'] ) ? $item['shipping_input_class'] : explode( ' ', $item['shipping_input_class'] ),
		            'autocomplete'	=> sanitize_text_field( $item['shipping_input_autocomplete'] ), 
		            'placeholder'	=> sanitize_text_field( $item['shipping_input_placeholder'] ), 
		            'priority'		=> 10,
		        ];
		        
	        if ( isset( $item['shipping_input_options'] ) ) {
	        	$options = explode( PHP_EOL, $item['shipping_input_options'] );
	        	$new_options = [];
	        	foreach ( $options as $option ) {
	        		$new_options[ strtolower( $option ) ] = $option;
	        	}
	        	$shipping_fields[ sanitize_text_field( $item['shipping_input_name'] ) ]['options'] = $new_options;
	        }
		}

		if( 'yes' == $shipping_title_show ):

			printf( '<%1$s %2$s>%3$s</%1$s>',
				esc_attr( $payment_title_tag ),
				$this->get_render_attribute_string( 'shipping_title_text' ),
				esc_html( $shipping_title_text )
			);

		endif; 
		?>

		<p id="shipping-checkbox" class="shipping-checkbox-area">
			<label class="shipping-checkbox-label">
				<input id="shipping-checkbox-input" class="shipping-checkbox-input" type="checkbox" name="ship_to_different_address" value="1" <?php echo $checked; ?>> <span class="shipping-checkbox-caption"><?php echo esc_html( $shipping_toggle_caption ); ?></span>
			</label>
		</p>
		<div class="wl-shipping">
			<?php

			foreach ( $shipping_fields as $key => $field ) {
				woocommerce_form_field( $key, $field, WC()->checkout->get_value( $key ) );
			}
		?>
		</div>
			
		<?php
		/**
		 * Load Script
		 */
		$this->render_script();
	}

	private function render_editing_attributes() {
		$this->add_inline_editing_attributes( 'shipping_title_text', 'none' );
		$this->add_render_attribute( 'shipping_title_text', 'class', 'wl-shipping-title' );
	}

	protected function render_script() {
		$settings 	= $this->get_settings_for_display();
		extract( $settings );
		?>
		<script type="text/javascript">
			jQuery(function($){
				<?php if ( 'yes' != $default_checked ) :  ?> 
					$('.wl-shipping').hide()
				<?php endif; ?>
            	$('.shipping-checkbox-area').on('click',function () {
        	        if ($('.shipping-checkbox-input').is(':checked')) {
        	        	$('.wl-shipping').slideDown()
        	        }else{
        	        	$('.wl-shipping').slideUp()
        	        }
        	    });
        	})
		</script>
		<?php
	}
}

