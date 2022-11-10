<?php
namespace codexpert\Woolementor_Pro;

use Elementor\Utils;
use Elementor\Repeater;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Color;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use codexpert\Woolementor\Controls\Group_Control_Gradient_Text;

class Sales_Notification extends Widget_Base {

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

		/**
		 * Product Title
		 */
		$this->start_controls_section(
			'sectio_cat',
			[
				'label' 		=> __( 'Content', 'woolementor-pro' ),
				'tab' 			=> Controls_Manager::TAB_CONTENT,
			]
		);

        $this->add_control(
			'notification_from',
			[
				'label' 		=> __( 'Content Source', 'woolementor-pro' ),
				'type' 			=> Controls_Manager::SELECT2,
				'options' 		=> [
					'this_site'  	=> __( 'From This Site', 'woolementor-pro' ),
					'from_api' 		=> __( 'From API', 'woolementor-pro' ),
				],
				'default' 		=> 'this_site',
				'label_block' 	=> true,
			]
		);

		$this->add_control(
			'api_url',
			[
				'label' 		=> __( 'API URL', 'woolementor-pro' ),
				'type' 			=> Controls_Manager::URL,
				'placeholder' 	=> 'https://your-link.com/api',
				'default' 		=> [
					'url' => '',
				],
				'label_block' 	=> true,
				'description' 	=> __( 'REST API URL to fetch order data from.', 'woolementor-pro' ),
                'condition' => [
            		'notification_from' => 'from_api'
                ],
			]
		);

		$this->add_control(
			'enable_url',
			[
				'label' => __( 'Link To Product', 'woolementor-pro' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'ON', 'woolementor-pro' ),
				'label_off' => __( 'OFF', 'woolementor-pro' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

        $this->add_control(
			'notification_type',
			[
				'label' 		=> __( 'Content Type', 'woolementor-pro' ),
				'type' 			=> Controls_Manager::SELECT2,
				'options' 		=> [
					'real_data'  	=> __( 'Real Data', 'woolementor-pro' ),
					'fake_data' 	=> __( 'Fake Data', 'woolementor-pro' ),
					'both_data' 	=> __( 'Both ', 'woolementor-pro' ),
				],
				'default' 		=> 'fake_data',
				'label_block' 	=> true,
				'condition' 	=> [
					'notification_from' => 'this_site'
				],
			]
		);

		$this->add_control(
			'orders_limit',
			[
				'label' 		=> __( 'Number of Orders', 'woolementor-pro' ),
				'type' 			=> Controls_Manager::NUMBER,
				'default' 		=> 5,
				'label_block' 	=> true,
                'conditions' => [
            		'relation' => 'and',
            		'terms' => [
            			[
            				'name' => 'notification_type',
            				'operator' => 'in',
            				'value' => [ 'real_data', 'both_data' ],
            			],
            			[
            				'name' => 'notification_from',
            				'operator' => '==',
            				'value' => 'this_site',
            			],
            		],
                ],
			]
		);

		$this->add_control(
		    'orders_statuses',
		    [
		        'label'         => __( 'Order Statuses', 'woolementor-pro' ),
		        'type'          => Controls_Manager::SELECT2,
		        'multiple'       => true,
		        'separator'      => 'after',
		        'options'       => [
		            'completed'    => __( 'Completed', 'woolementor-pro' ),
		            'processing'   => __( 'Processing', 'woolementor-pro' ),
		        ],
		        'default'       => [ 'completed', 'processing', 'on-hold' ],
                'conditions' => [
                	'relation' => 'and',
            		'terms' => [
            			[
            				'name' => 'notification_type',
            				'operator' => 'in',
            				'value' => [ 'real_data', 'both_data' ],
            			],
            			[
            				'name' => 'notification_from',
            				'operator' => '==',
            				'value' => 'this_site',
            			],
            		],
                ],
		    ]
		);

		$this->add_control(
			'product_ids', [
				'label' => __( 'Specific Products', 'woolementor-pro' ),
				'type' 			=> Controls_Manager::SELECT2,
				'multiple' 		=> true,
				'label_block' 	=> true,
				'options' 		=> woolementor_get_posts( 'product', false ),
				'description' 	=> __( 'Select the products you want to show' , 'woolementor-pro' ),
				'conditions' 	=> [
					'relation' => 'and',
            		'terms' => [
            			[
            				'name' => 'notification_type',
            				'operator' => 'in',
            				'value' => [ 'real_data', 'both_data' ],
            			],
            			[
            				'name' => 'notification_from',
            				'operator' => '==',
            				'value' => 'this_site',
            			],
            		],
				],
			]
		);

        $repeater = new Repeater();

		$repeater->add_control(
			'customer_name', [
				'label' => __( 'Client Name', 'woolementor-pro' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'John Doe' , 'woolementor-pro' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'customer_address', [
				'label' => __( 'Client Address', 'woolementor-pro' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Neywork, USA' , 'woolementor-pro' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'product_name', [
				'label' => __( 'Product Name', 'woolementor-pro' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Item' , 'woolementor-pro' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'product_url', [
				'label' => __( 'Product URL', 'woolementor-pro' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'https://example.com' , 'woolementor-pro' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'product_image',
			[
				'label' => __( 'Choose Image', 'woolementor-pro' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater->add_control(
			'sold_at', [
				'label' => __( 'Notification Time', 'woolementor-pro' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '1 hours' , 'woolementor-pro' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'notifications',
			[
				'label' => __( 'Notification List', 'woolementor-pro' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'customer_name' => __( 'John Doe', 'woolementor-pro' ),
						'customer_address' => __( 'Newyork, USA', 'woolementor-pro' ),
						'product_name' => __( 't-shirt', 'woolementor-pro' ),
						'sold_at' => '1 hours'
					],
					[
						'customer_name' => __( 'John Max', 'woolementor-pro' ),
						'customer_address' => __( 'Newyork, USA', 'woolementor-pro' ),
						'product_name' => __( 't-shirt with logo', 'woolementor-pro' ),
						'sold_at' => '30 minutes'
					],
					[
						'customer_name' => __( 'Piter Jakson', 'woolementor-pro' ),
						'customer_address' => __( 'Newyork, USA', 'woolementor-pro' ),
						'product_name' => __( 'album', 'woolementor-pro' ),
						'sold_at' => '40 minutes'
					],
					[
						'customer_name' => __( 'Alen Jakson', 'woolementor-pro' ),
						'customer_address' => __( 'Newyork, USA', 'woolementor-pro' ),
						'product_name' => __( 'caset', 'woolementor-pro' ),
						'sold_at' => '20 minutes'
					],
				],
                'conditions' => [
                	'relation' => 'and',
            		'terms' => [
            			[
            				'name' => 'notification_type',
            				'operator' => 'in',
            				'value' => [ 'fake_data', 'both_data' ],
            			],
            			[
            				'name' => 'notification_from',
            				'operator' => '==',
            				'value' => 'this_site',
            			],
            		],
                ],
				'title_field' => '{{{ customer_name }}}',
			]
		);

		$this->add_control(
			'notification_duration',
			[
				'label' => __( 'Interval (millisecond)', 'woolementor-pro' ),
				'type' => Controls_Manager::SLIDER,
				'separator' 	=> 'before',
				'size_units' => [ 'ms' ],
				'range' => [
					'ms' => [
						'min' => 0,
						'max' => 60000,
						'step' => 10,
					],
				],
				'default' => [
					'unit' => 'ms',
					'size' => 3000,
				],
			]
		);

		$this->add_control(
			'notification_delay',
			[
				'label' => __( 'Delay (millisecond)', 'woolementor-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'ms' ],
				'range' => [
					'ms' => [
						'min' => 0,
						'max' => 60000,
						'step' => 10,
					],
				],
				'default' => [
					'unit' => 'ms',
					'size' => 1000,
				],
			]
		);


        $this->add_responsive_control(
            'alignment',
            [
                'label' 		=> __( 'Alignment', 'woolementor-pro' ),
                'type' 			=> Controls_Manager::CHOOSE,
                'options' 		=> [
                    'left' 		=> [
                        'title' 	=> __( 'Left', 'woolementor-pro' ),
                        'icon' 		=> 'fa fa-align-left',
                    ],
                    'right' 	=> [
                        'title' 	=> __( 'Right', 'woolementor-pro' ),
                        'icon' 		=> 'fa fa-align-right',
                    ],
                ],
                'toggle' 		=> true,
                'default' 		=> 'left',
            ]
        );

        $this->end_controls_section();

		/**
		 * Notification area
		 */
		$this->start_controls_section(
			'notification_style',
			[
				'label' => __( 'Card', 'woolementor-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'nt_background',
				'label' => __( 'Background', 'woolementor-pro' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .wl-sales-notification .notification',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'label' => __( 'Border', 'woolementor-pro' ),
				'selector' => '{{WRAPPER}} .wl-sales-notification .notification',
			]
		);

		$this->add_responsive_control(
			'card_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'woolementor-pro' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wl-sales-notification .notification' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'		=> 'after',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'label' => __( 'Box Shadow', 'woolementor-pro' ),
				'selector' => '{{WRAPPER}} .wl-sales-notification .notification',
			]
		);

		$this->add_responsive_control(
			'card_padding',
			[
				'label' 		=> __( 'Padding', 'woolementor-pro' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wl-sales-notification .notification' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'		=> 'before',
			]
		);

		$this->add_responsive_control(
			'position_x',
			[
				'label' => __( 'Position X', 'woolementor-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 15,
				],
				'selectors' 	=> [
					'{{WRAPPER}} .wl-sales-notification' => 'bottom: {{SIZE}}{{UNIT}};',
				],
				'separator'		=> 'before',
			]
		);

		$this->add_responsive_control(
			'position_l_y',
			[
				'label' => __( 'Position Y', 'woolementor-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 15,
				],
				'condition' 	=> [
                    'alignment' => 'left'
                ],
				'selectors' 	=> [
					'{{WRAPPER}} .wl-sales-notification.left' => 'left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'position_r_y',
			[
				'label' => __( 'Position Y', 'woolementor-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'condition' 	=> [
                    'alignment' => 'right'
                ],
				'selectors' 	=> [
					'{{WRAPPER}} .wl-sales-notification.right' => 'right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section(); 

		/**
		 * Notification area		 
		 */
		$this->start_controls_section(
			'image_style',
			[
				'label' => __( 'Image', 'woolementor-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
            'image_width',
            [
                'label' 	=> __( 'Image Width', 'woolementor-pro' ),
                'type' 		=> Controls_Manager::SLIDER,
				'size_units'=> [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .wl-sales-notification .notification .image' => 'width: {{SIZE}}{{UNIT}}',
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

        $this->add_responsive_control(
            'image_height',
            [
                'label' 	=> __( 'Image Height', 'woolementor-pro' ),
                'type' 		=> Controls_Manager::SLIDER,
				'size_units'=> [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .wl-sales-notification .notification .image' => 'height: {{SIZE}}{{UNIT}}',
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
				'name' => 'img_border',
				'label' => __( 'Border', 'woolementor-pro' ),
				'selector' => '{{WRAPPER}} .wl-sales-notification .notification .image',
			]
		);

		$this->add_responsive_control(
			'img_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'woolementor-pro' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wl-sales-notification .notification .image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'img_box_shadow',
				'label' => __( 'Box Shadow', 'woolementor' ),
				'selector' => '{{WRAPPER}} .wl-sales-notification .notification .image',
			]
		);

		$this->add_responsive_control(
			'img_padding',
			[
				'label' 		=> __( 'Padding', 'woolementor-pro' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wl-sales-notification .notification .image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'		=> 'before',
			]
		);

		$this->add_responsive_control(
			'img_margin',
			[
				'label' 		=> __( 'Margin', 'woolementor-pro' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wl-sales-notification .notification .image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'		=> 'after',
			]
		);

		$this->end_controls_section(); 

		/**
		 * Notification content area		 
		 */
		$this->start_controls_section(
			'content_style',
			[
				'label' => __( 'Content', 'woolementor-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> '_typography',
				'label' 	=> __( 'Typography', 'woolementor-pro' ),
				'scheme' 	=> Typography::TYPOGRAPHY_3,
				'selector' 	=> '{{WRAPPER}} .wl-sales-notification .notification .item_details',
			]
		);

		 $this->add_group_control(
            Group_Control_Gradient_Text::get_type(),
            [
                'name' => 'pricing_table_header_color',
                'selector' => '{{WRAPPER}} .wl-sales-notification .notification .item_details',
            ]
        );

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'content_border',
				'label' => __( 'Border', 'woolementor-pro' ),
				'selector' => '{{WRAPPER}} .wl-sales-notification .notification .item_details',
			]
		);

		$this->add_responsive_control(
			'content_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'woolementor-pro' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wl-sales-notification .notification .item_details' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'content_padding',
			[
				'label' 		=> __( 'Padding', 'woolementor-pro' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wl-sales-notification .notification .item_details' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'		=> 'before',
			]
		);

		$this->add_responsive_control(
			'content_margin',
			[
				'label' 		=> __( 'Margin', 'woolementor-pro' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wl-sales-notification .notification .item_details' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'		=> 'after',
			]
		);

		$this->end_controls_section(); 
	}

	public function time_elapsed_string($datetime, $full = false) {
	    $now = new \DateTime;
	    $ago = new \DateTime($datetime);
	    $diff = $now->diff($ago);

	    $diff->w = floor($diff->d / 7);
	    $diff->d -= $diff->w * 7;

	    $string = array(
	        'y' => 'year',
	        'm' => 'month',
	        'w' => 'week',
	        'd' => 'day',
	        'h' => 'hour',
	        'i' => 'minute',
	        's' => 'second',
	    );
	    foreach ($string as $k => &$v) {
	        if ($diff->$k) {
	            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
	        } else {
	            unset($string[$k]);
	        }
	    }

	    if (!$full) $string = array_slice($string, 0, 1);
	    return $string ? implode(', ', $string) : 'few seconds';
	}

	public function woolementor_get_orders( $limit, $status ){
		if( !function_exists( 'WC' ) ) return false;

		$query = new \WC_Order_Query( array(
		    'limit' => $limit,
		    'order' => 'DESC',
		    'status' => $status,
		    'return' => 'ids',
		) );

		$orders = $query->get_orders();

		if ( count( $orders ) > 0 ) {
			return $orders;
		}

		return false;
	}

	protected function render() {
		
		$settings = $this->get_settings_for_display();
        extract( $settings );

        if ( $notification_from == 'from_api' ) {
        	$api_response 	= wp_remote_get( $api_url['url'] );
        	$api_data 		= wp_remote_retrieve_body( $api_response );
        	$notifications 	= json_decode( $api_data, ARRAY_A );
        }

        else if( $notification_from == 'this_site' && ( $notification_type == 'real_data' || $notification_type == 'both_data' ) ) {

        	$_notifications = [];
        	$product_ids =explode( ',', $product_ids);
        	$order_ids = $this->woolementor_get_orders( $orders_limit, $orders_statuses );

        	if( !empty( $order_ids ) ) {
	        	foreach ( $order_ids as $key => $order_id ) {
	        		$order = wc_get_order( $order_id );
	        		$time_diff 	  	 = $this->time_elapsed_string( $order->get_date_created() );
	        		$billing_name 	 = $order->get_billing_first_name() .' '.$order->get_billing_last_name();
	        		$billing_address = $order->get_billing_city() .', '.$order->get_billing_state().', '.$order->get_billing_country();

	        		$_items = $order->get_items();
	        		$items = [];

	        		if ( !empty($product_ids) ) {
	        			foreach ( $_items as $item_id => $item ) {
	        				if (in_array( $item->get_product_id(), $product_ids)) {
	        					$items[] = $item;
	        				}
	        			}
	        		}else{
	        			$items = $_items;
	        		}

	        		foreach ( $items as $item_id => $item ) {
	        		   	$product_id 	= $item->get_product_id();
	        		   	$product 		= $item->get_product();
	        		   	$product_image 	= get_the_post_thumbnail_url( $product_id );
	        		   	$item_name 		= $item->get_name();
    		   			$product_url 	= get_the_permalink( $item->get_product_id() );

	        		   	$_notifications[] = [
	        		   		'customer_name' 		=> $billing_name,
	        		   		'customer_address' 		=> $billing_address,
	        		   		'product_name' 	=> $item_name,
	        		   		'product_url' 	=> $product_url,
	        		   		'product_image' => [ 'url' => $product_image ],
	        		   		'sold_at' 			=> $time_diff
	        		   	];
	        		}
	        	}
	        }

	        elseif( woolementor_is_edit_mode() && empty( $order_ids ) ) {
				_e( 'No order found!', 'woolementor-pro' );
			}

			if( $notification_type == 'real_data' ) $notifications = $_notifications;
			if( $notification_type == 'both_data' ) $notifications = array_merge( $notifications, $_notifications );
		}

		if( woolementor_is_edit_mode() ){
			echo woolementor_notice( __( 'The actual sales notification shows at the bottom left/right of this page!', 'woolementor-pro' ) );
		}
		
		if( empty( $notifications ) ) return;
        ?>

        <div class="wl-sales-notification <?php echo $alignment; ?>">

        	<?php do_action( 'woolementor_product_cat_start' ); ?>

        	<div class="notifications-wrapper">
        		<div class="notifications">
        			<?php 
        			foreach ( $notifications as $key => $notification ) :

        				if ( woolementor_is_edit_mode() &&  $key == 1 ) break;

    					if ( $enable_url == 'yes' ) {
    						echo "<a href='" . $notification['product_url'] . "'>";
    					}
        				?>
        					<div class="notification notific-<?php echo $key; ?>">
	        					<div class="notific-inner">
		        					<div class="image">
		        						<img src='<?php echo $notification["product_image"]["url"]; ?>' />
		        					</div>
		        					<div class="item_details">
		        						<p><strong><?php echo $notification['customer_name']; ?></strong> <?php _e( 'from', 'woolementor-pro' ); ?> 
		        							<strong><?php echo $notification['customer_address']; ?></strong></p>
		        						<p><?php _e( 'Purchased ', 'woolementor-pro' ); ?> <strong><?php echo $notification['product_name']; ?></strong></p>
		        						<p class="wl-sn-time"><?php echo $notification['sold_at']; ?> <?php _e( 'ago', 'woolementor-pro' ); ?></p>
		        					</div>
		        				</div>
	        				</div>
        				<?php 
    					if ( $enable_url == 'yes' ) {
    						echo "</a>";
    					}
        			endforeach; ?>
        		</div>
        	</div>

        	<?php
			/**
			 * Load Script
			 */
			$this->render_script( $notifications );

			do_action( 'woolementor_product_cat_end' ); ?>

        </div>

        <?php   	
	}

	protected function render_script( $all_notifications ) {
		$settings = $this->get_settings_for_display();
	    extract( $settings );

	    if ( woolementor_is_edit_mode() ) {
	    	?>
	    	<script type="text/javascript">
	    		jQuery(function($){
	    			$(".wl-sales-notification").show();
	    			$(".notific-0").show();
	    		})
	    	</script>
	    	<?php
	    	return;
	    }
		?>
		<script type="text/javascript">
    		jQuery(function($){
    			var duration = <?php echo $notification_duration['size']; ?>;
    			var delay = <?php echo $notification_delay['size']; ?>;
    			InitialFlip();
    			function InitialFlip() {
    			    setTimeout(SecondFlip, duration);
    			}
    			function SecondFlip() {
    				let total = <?php echo count($all_notifications); ?>;
    				let rand = Math.floor(Math.random() * total);
    			    $(".notification").hide();
    			    $(".wl-sales-notification").hide();
    			    setTimeout(function() {
    			        $(".wl-sales-notification").toggle();
    			        $(".notific-"+rand).toggle();
    			        InitialFlip();
    			    }, delay);
    			}
    		})
    	</script>
		<?php
	}
}

