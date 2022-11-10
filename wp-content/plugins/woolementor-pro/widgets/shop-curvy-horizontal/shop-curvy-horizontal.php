<?php
namespace codexpert\Woolementor_Pro;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Background;
use codexpert\Woolementor\Controls\Group_Control_Gradient_Text;

class Shop_Curvy_Horizontal extends Widget_Base {

    public $id;

    public function __construct( $data = [], $args = null ) {
        parent::__construct( $data, $args );

        $this->id       = woolementor_get_widget_id( __CLASS__ );
        $this->widget   = woolementor_get_widget( $this->id );
        
        // Are we in debug mode?
        $min = defined( 'WOOLEMENTOR_PRO_DEBUG' ) && WOOLEMENTOR_PRO_DEBUG ? '' : '.min';

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
         * Settings controls
         */
        $this->start_controls_section(
            '_section_settings',
            [
                'label' 		=> __( 'Layout', 'woolementor-pro' ),
                'tab'   		=> Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_responsive_control(
            'columns',
            [
                'label'     	=> __( 'Columns', 'woolementor-pro' ),
                'type'      	=> Controls_Manager::SELECT,
                'options'   	=> [
                    1 => __( '1 Column', 'woolementor-pro' ),
                    2 => __( '2 Columns', 'woolementor-pro' ),
                    3 => __( '3 Columns', 'woolementor-pro' ),
                    4 => __( '4 Columns', 'woolementor-pro' ),
                    6 => __( '6 Columns', 'woolementor-pro' ),
                ],
                'desktop_default'   => 2,
                'tablet_default'    => 1,
                'mobile_default'    => 1,
                'style_transfer'    => true,
            ]
        );

        $this->add_control(
            'alignment',
            [
                'label'     	=> __( 'Content Alignment', 'woolementor-pro' ),
                'type'      	=>Controls_Manager::CHOOSE,
                'options'   	=> [
                    'wl-sch-left' 	=> [
                        'title'     => __( 'Left', 'woolementor-pro' ),
                        'icon'      => 'fa fa-align-left',
                    ],
                    'wl-sch-right' => [
                        'title'     => __( 'Right', 'woolementor-pro' ),
                        'icon'      => 'fa fa-align-right',
                    ],
                ],
                'default'  		=> 'wl-sch-left',
                'toggle'    	=> false,
            ]
        );

        $this->end_controls_section();

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
         * Product Image
         */
        $this->start_controls_section(
            'section_content_product_image',
            [
                'label' 		=> __( 'Product Image', 'woolementor-pro' ),
                'tab'   		=> Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'image_on_click',
            [
                'label'     	=> __( 'On Click', 'woolementor-pro' ),
                'type'      	=> Controls_Manager::SELECT,
                'options'   	=> [
                    'none'          => __( 'None', 'woolementor-pro' ),
                    'zoom'          => __( 'Zoom', 'woolementor-pro' ),
                    'product_page'  => __( 'Product Page', 'woolementor-pro' ),
                ],
                'default'   	=> 'none',
            ]
        );

        $this->end_controls_section();

        /**
         * Product Description
         */
        $this->start_controls_section(
            'section_content_product_desc',
            [
                'label' 		=> __( 'Product Description', 'woolementor-pro' ),
                'tab'   		=> Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'product_desc_show_hide',
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
         * Icon Position
         */
        $this->start_controls_section(
            'section_content_icon_position',
            [
                'label' 		=> __( 'Icon Position', 'woolementor-pro' ),
                'tab'   		=> Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'icon_position_alignment',
            [
                'label'     	=> __( 'Alignment', 'woolementor-pro' ),
                'type'      	=> Controls_Manager::CHOOSE,
                'options'   	=> [
                    'bottom'        => [
                        'title'     => __( 'Bottom', 'woolementor-pro' ),
                        'icon'      => 'fas fa-grip-lines',
                    ],
                    'side'      => [
                        'title'     => __( 'Side', 'woolementor-pro' ),
                        'icon'      => 'fas fa-grip-lines-vertical',
                    ],
                ],
                'default'   	=> 'bottom',
                'toggle'    	=> false,
            ]
        );

        $this->end_controls_section();

        /**
         * Sale Ribbon controls
         */
        $this->start_controls_section(
            'section_content_sale_ribbon',
            [
                'label' => __( 'Sale Ribbon', 'woolementor' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'sale_ribbon_show_hide',
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
            'sale_ribbon_text',
            [
                'label'         => __( 'On Sale Test', 'woolementor' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => __( 'Sale', 'woolementor' ),
                'placeholder'   => __( 'Type your title here', 'woolementor' ),
            ]
        );

        $this->end_controls_section();

        /**
         * Sale Ribbon controls
         */
        $this->start_controls_section(
            'section_content_stock',
            [
                'label' => __( 'Stock Ribbon', 'woolementor' ),
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
                'label' 		=> __( 'Cart', 'woolementor-pro' ),
                'tab'   		=> Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'cart_show_hide',
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
         * Wishlist controls
         */
        $this->start_controls_section(
            'section_content_wishlist',
            [
                'label'         => __( 'Wishlist', 'woolementor-pro' ),
                'tab'           => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'wishlist_show_hide',
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
                'label' 		=> __( 'Pagination', 'woolementor-pro' ),
                'tab'   		=> Controls_Manager::TAB_CONTENT,
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
         * Product Style controls
         */
        $this->start_controls_section(
            'style_section_box',
            [
                'label' 		=> __( 'Card', 'woolementor-pro' ),
                'tab'   		=> Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'widget_box_height',
            [
                'label'     => __( 'Box Height', 'woolementor-pro' ),
                'type'      => Controls_Manager::SLIDER,
                'size_units'=> [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .wl-sch-single-widget' => 'height: {{SIZE}}{{UNIT}}',
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
                'desktop_default' => [
                    'size' => 220,
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'size' => 230,
                    'unit' => 'px',
                ],
                'mobile_default' => [
                    'size' => 100,
                    'unit' => '%',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'widget_box_background',
                'label'     => __( 'Background', 'woolementor-pro' ),
                'types'     => [ 'classic', 'gradient' ],
                'selector'  => '{{WRAPPER}} .wl-sch-single-widget',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      	=> 'widget_box_border',
                'label'     	=> __( 'Border', 'woolementor-pro' ),
                'selector'  	=> '{{WRAPPER}} .wl-sch-single-widget',
                'separator'     => 'before'
            ]
        );

        $this->add_responsive_control(
            'widget_box_border_radius',
            [
                'label'         => __( 'Border Radius', 'woolementor-pro' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .wl-sch-single-widget' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'      	=> 'widget_box_shadow',
                'label'     	=> __( 'Box Shadow', 'woolementor-pro' ),
                'selector'  	=> '{{WRAPPER}} .wl-sch-single-widget',
            ]
        );

        $this->add_responsive_control(
            'widget_box_shadow_margin',
            [
                'label'         => __( 'Margin', 'woolementor-pro' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%', 'em' ],
                'selectors'     => [
                    '{{WRAPPER}} .wl-sch-single-product' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                'label' 		=> __( 'Product Title', 'woolementor-pro' ),
                'tab'   		=> Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Gradient_Text::get_type(),
            [
                'name' => 'title_color',
                'selector' => '{{WRAPPER}} .wl-gradient-heading',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      	=> 'title_typography',
                'label'     	=> __( 'Typography', 'woolementor-pro' ),
                'scheme'    	=> Typography::TYPOGRAPHY_3,
                'selector'  	=> '{{WRAPPER}} .wl-sch-product-name a',
            ]
        );

        $this->end_controls_section();

        /**
         * Product Price
         */
        $this->start_controls_section(
            'section_style_price',
            [
                'label' 		=> __( 'Product Price', 'woolementor-pro' ),
                'tab'   		=> Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'price_color',
            [
                'label'     	=> __( 'Color', 'woolementor-pro' ),
                'type'      	=> Controls_Manager::COLOR,
                'selectors' 	=> [
                     '{{WRAPPER}} .wl-sch-product-info h2.wl-sch-price' => 'color: {{VALUE}}', 
                     '{{WRAPPER}} .wl-sch-product-info h2.wl-sch-price  .amount ' => 'color: {{VALUE}}', 
                    '{{WRAPPER}} .wl-sch-product-info h2.wl-sch-price ins .woocommerce-Price-amount.amount' => 'color: {{VALUE}}',
                     '{{WRAPPER}} .wl-sch-product-info h2.wl-sch-price > .amount' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      	=> 'price_size_typography',
                'label'     	=> __( 'Typography', 'woolementor-pro' ),
                'scheme'    	=> Typography::TYPOGRAPHY_3,
                'selector'  	=> '{{WRAPPER}} .wl-sch-product-info h2.wl-sch-price ins, {{WRAPPER}} .wl-icons-side .wl-sch-price h2, {{WRAPPER}} .wl-sch-product-info h2.wl-sch-price > .amount',
            ]
        );

        $this->add_control(
            'sale_price_show_hide',
            [
                'label'         => __( 'Show Sale Price', 'woolementor-pro' ),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => __( 'Show', 'your-plugin' ),
                'label_off'     => __( 'Hide', 'your-plugin' ),
                'return_value'  => 'block',
                'default'       => 'none',
                'separator'     => 'before',
                'selectors'     => [
                    '{{WRAPPER}} .wl-sch-product-info h2.wl-sch-price del, {{WRAPPER}} .wl-sch-product-info h2.wl-sch-price del' => 'display: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'sale_price_color',
            [
                'label'     	=> __( 'Color', 'woolementor-pro' ),
                'type'      	=> Controls_Manager::COLOR,
                'selectors' 	=> [
                    '{{WRAPPER}} .wl-sch-product-info h2.wl-sch-price del'=> 'color: {{VALUE}}',
                    '{{WRAPPER}} .wl-sch-product-info h2.wl-sch-price del' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .wl-sch-product-info h2.wl-sch-price del .amount' => 'color: {{VALUE}}',
                ],
                'condition' 	=> [
                    'sale_price_show_hide' => 'block'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      	=> 'sale_price_size_typography',
                'label'     	=> __( 'Typography', 'woolementor-pro' ),
                'scheme'    	=> Typography::TYPOGRAPHY_3,
                'selector'  	=> '{{WRAPPER}} .wl-sch-product-info h2.wl-sch-price del,{{WRAPPER}} .wl-icons-side .wl-sch-price h2 del',
                'condition' 	=> [
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
                'label' 		=> __( 'Currency Symbol', 'woolementor-pro' ),
                'tab'   		=> Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'price_currency',
            [
                'label'     	=> __( 'Color', 'woolementor-pro' ),
                'type'      	=> Controls_Manager::COLOR,
                'selectors' 	=> [
                    '{{WRAPPER}} .woocommerce-Price-currencySymbol' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      	=> 'price_currency_typography',
                'label'     	=> __( 'Typography', 'woolementor-pro' ),
                'scheme'    	=> Typography::TYPOGRAPHY_3,
                'selector'  	=> '{{WRAPPER}} .woocommerce-Price-currencySymbol',
            ]
        );

        $this->end_controls_section();

        /**
         * Product Image controls
         */
        $this->start_controls_section(
            'section_style_image',
            [
                'label' 		=> __( 'Product Image', 'woolementor-pro' ),
                'tab'   		=> Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'      	=> 'image_thumbnail',
                'exclude'   	=> [ 'custom' ],
                'include'   	=> [],
                'default'   	=> 'large',
            ]
        );

        $this->add_responsive_control(
            'image_width',
            [
                'label'     	=> __( 'Image Width', 'woolementor-pro' ),
                'type'      	=> Controls_Manager::SLIDER,
                'size_units'	=> [ 'px', '%', 'em' ],
                'selectors' 	=> [
                    '{{WRAPPER}} .wl-sch-product-img img' => 'width: {{SIZE}}{{UNIT}}',
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
                'label'     	=> __( 'Image Height', 'woolementor-pro' ),
                'type'      	=> Controls_Manager::SLIDER,
                'size_units'	=> [ 'px', '%', 'em' ],
                'selectors' 	=> [
                    '{{WRAPPER}} .wl-sch-product-img img' => 'height: {{SIZE}}{{UNIT}}',
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
            'image_box_height',
            [
                'label'     	=> __( 'Image Box Height', 'woolementor-pro' ),
                'type'      	=> Controls_Manager::SLIDER,
                'size_units'	=> [ 'px', 'em' ],
                'selectors' 	=> [
                    '{{WRAPPER}} .wl-sch-product-img' => 'height: {{SIZE}}{{UNIT}}',
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
            'image_margin',
            [
                'label'         => __( 'Margin', 'woolementor-pro' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%', 'em' ],
                'selectors'     => [
                    '{{WRAPPER}} .wl-sch-product-img img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator'     => 'before',
            ]
        );

        $this->add_responsive_control(
            'image_padding',
            [
                'label'         => __( 'Padding', 'woolementor-pro' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%', 'em' ],
                'selectors'     => [
                    '{{WRAPPER}} .wl-sch-product-img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      	=> 'image_border',
                'label'     	=> __( 'Border', 'woolementor-pro' ),
                'selector'  	=> '{{WRAPPER}} .wl-sch-product-img img',
            ]
        );

        $this->add_responsive_control(
            'image_border_radius',
            [
                'label'         => __( 'Border Radius', 'woolementor-pro' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .wl-sch-product-img img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'      	=> 'image_box_shadow',
                'label'     	=> __( 'Box Shadow', 'woolementor-pro' ),
                'selector'  	=> '{{WRAPPER}} .wl-sch-product-img img',
            ]
        );

        $this->start_controls_tabs(
            'image_effects',
            [
                'separator' 	=> 'before'
            ]
        );

        $this->start_controls_tab(
            'image_effects_normal',
            [
                'label'     	=> __( 'Normal', 'woolementor-pro' ),
            ]
        );

        $this->add_control(
            'image_opacity',
            [
                'label'     	=> __( 'Opacity', 'woolementor-pro' ),
                'type'      	=> Controls_Manager::SLIDER,
                'range'     	=> [
                    'px'    		=> [
                        'max'   		=> 1,
                        'min'   		=> 0.10,
                        'step'  		=> 0.01,
                    ],
                ],
                'selectors' 	=> [
                    '{{WRAPPER}} .wl-sch-product-img img' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Css_Filter::get_type(),
            [
                'name'      	=> 'image_css_filters',
                'selector'  	=> '{{WRAPPER}} .wl-sch-product-img img',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab( 'image_hover',
            [
                'label'     	=> __( 'Hover', 'woolementor-pro' ),
            ]
        );

        $this->add_control(
            'image_opacity_hover',
            [
                'label'     	=> __( 'Opacity', 'woolementor-pro' ),
                'type'      	=> Controls_Manager::SLIDER,
                'range'     	=> [
                    'px'    		=> [
                        'max'   		=> 1,
                        'min'   		=> 0.10,
                        'step'  		=> 0.01,
                    ],
                ],
                'selectors' 	=> [
                    '{{WRAPPER}} .wl-sch-product-img img:hover' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Css_Filter::get_type(),
            [
                'name'      	=> 'image_css_filters_hover',
                'selector'  	=> '{{WRAPPER}} .wl-sch-product-img img:hover',
            ]
        );

        $this->add_control(
            'image_hover_transition',
            [
                'label'     	=> __( 'Transition Duration', 'woolementor-pro' ),
                'type'      	=> Controls_Manager::SLIDER,
                'range'     	=> [
                    'px'    		=> [
                        'max'   		=> 3,
                        'step'  		=> 0.1,
                    ],
                ],
                'selectors' 	=> [
                    '{{WRAPPER}} .wl-sch-product-img img:hover' => 'transition-duration: {{SIZE}}s',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        /**
         * Product Description
         */
        $this->start_controls_section(
            'section_style_desc',
            [
                'label' 		=> __( 'Product Description', 'woolementor-pro' ),
                'tab'   		=> Controls_Manager::TAB_STYLE,
                'condition'     => [
                    'product_desc_show_hide' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'product_desc_color',
            [
                'label'     	=> __( 'Color', 'woolementor-pro' ),
                'type'      	=> Controls_Manager::COLOR,
                'selectors' 	=> [
                    '{{WRAPPER}} .wl-sch-product-desc p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      	=> 'product_desc_typography',
                'label'     	=> __( 'Typography', 'woolementor-pro' ),
                'scheme'    	=> Typography::TYPOGRAPHY_3,
                'selector'  	=> '{{WRAPPER}} .wl-sch-product-desc p',
            ]
        );

        $this->add_control(
			'product_desc_words_count',
			[
				'label' 		=> __( 'Words Count', 'woolementor-pro' ),
				'type' 			=> Controls_Manager::NUMBER,
				'default' 		=> 8,
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
                'label'         => __( 'Block Icon', 'woolementor-pro' ),
                'type'          => Controls_Manager::ICONS,
                'default'       => [
                    'value'     => 'fas fa-star',
                    'library'   => 'solid',
                ],
            ]
        );

        $this->add_control(
            'star_rating_empty_icon',
            [
                'label'         => __( 'Empty Icon', 'woolementor-pro' ),
                'type'          => Controls_Manager::ICONS,
                'default'       => [
                    'value'     => 'far fa-star',
                    'library'   => 'solid',
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
                    '{{WRAPPER}} .wl-sch-rating' => 'font-size: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} .wl-sch-rating span ' => 'font-size: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
            'star_rating_color',
            [
                'label'     	=> __( 'Color', 'woolementor-pro' ),
                'type'      	=> Controls_Manager::COLOR,
                'selectors' 	=> [
                    '{{WRAPPER}} .wl-sch-rating' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .wl-sch-rating span' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

        /**
        * Sale Ribbon Styleing 
        */

        $this->start_controls_section(
            'section_style_sale_ribbon',
            [
                'label' => __( 'Sale Ribbon', 'woolementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'sale_ribbon_offset_toggle',
            [
                'label'         => __( 'Offset', 'woolementor' ),
                'type'          => Controls_Manager::POPOVER_TOGGLE,
                'label_off'     => __( 'None', 'woolementor' ),
                'label_on'      => __( 'Custom', 'woolementor' ),
                'return_value'  => 'yes',
            ]
        );

        $this->start_popover();

        $this->add_responsive_control(
            'media_offset_x',
            [
                'label'         => __( 'Offset Left', 'woolementor' ),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px'],
                'condition'     => [
                    'sale_ribbon_offset_toggle' => 'yes'
                ],
                'range'         => [
                    'px'        => [
                        'min'   => -1000,
                        'max'   => 1000,
                    ],
                ],
                'selectors'     => [
                    '{{WRAPPER}} .wl-sch-corner-ribbon' => 'left: {{SIZE}}{{UNIT}}'
                ],
                'render_type'   => 'ui',
            ]
        );

        $this->add_responsive_control(
            'media_offset_y',
            [
                'label'         => __( 'Offset Top', 'woolementor' ),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px'],
                'condition'     => [
                    'sale_ribbon_offset_toggle' => 'yes'
                ],
                'range'         => [
                    'px'        => [
                        'min'   => -1000,
                        'max'   => 1000,
                    ],
                ],
                'selectors'     => [
                    '{{WRAPPER}} .wl-sch-corner-ribbon' => 'top: {{SIZE}}{{UNIT}}',
                ],
            ]
        );
        $this->end_popover();

        $this->add_responsive_control(
            'sale_ribbon_width',
            [
                'label'     => __( 'Width', 'woolementor' ),
                'type'      => Controls_Manager::SLIDER,
                'size_units'=> [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .wl-sch-corner-ribbon' => 'width: {{SIZE}}{{UNIT}}',
                ],
                'range'     => [
                    'px'    => [
                        'min'   => 50,
                        'max'   => 500
                    ]
                ],
            ]
        );

        $this->add_responsive_control(
            'sale_ribbon_transform',
            [
                'label'     => __( 'Transform', 'woolementor' ),
                'type'      => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .wl-sch-corner-ribbon' => '-webkit-transform: rotate({{SIZE}}deg); transform: rotate({{SIZE}}deg);',
                ],
                'range'     => [
                    'px'    => [
                        'min'   => 0,
                        'max'   => 360
                    ]
                ],
            ]
        );

        $this->add_control(
            'sale_ribbon_font_color',
            [
                'label'     => __( 'Color', 'woolementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wl-sch-corner-ribbon' => 'color: {{VALUE}}',
                ],
                'separator' => 'before'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'content_typography',
                'label'     => __( 'Typography', 'woolementor' ),
                'scheme'    => Typography::TYPOGRAPHY_3,
                'selector'  => '{{WRAPPER}} .wl-sch-corner-ribbon',
            ]
        );

        $this->add_control(
            'sale_ribbon_background',
            [
                'label'         => __( 'Background', 'woolementor' ),
                'type'          => Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .wl-sch-corner-ribbon' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'sale_ribbon_padding',
            [
                'label'         => __( 'Padding', 'woolementor' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%', 'em' ],
                'selectors'     => [
                    '{{WRAPPER}} .wl-sch-corner-ribbon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default'       => [
                    'top'           => '0',
                    'right'         => '12',
                    'bottom'        => '0',
                    'left'          => '12',
                ],
                'separator' => 'after'
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'          => 'sale_ribbon_border',
                'label'         => __( 'Border', 'woolementor' ),
                'selector'      => '{{WRAPPER}} .wl-sch-corner-ribbon',
            ]
        );

        $this->add_responsive_control(
            'sale_ribbon_border_radius',
            [
                'label'         => __( 'Border Radius', 'woolementor' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .wl-sch-corner-ribbon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

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

        $this->add_control(
            'stock_offset_toggle',
            [
                'label'         => __( 'Offset', 'woolementor' ),
                'type'          => Controls_Manager::POPOVER_TOGGLE,
                'label_off'     => __( 'None', 'woolementor' ),
                'label_on'      => __( 'Custom', 'woolementor' ),
                'return_value'  => 'yes',
            ]
        );

        $this->start_popover();

        $this->add_responsive_control(
            'stock_media_offset_x',
            [
                'label'         => __( 'Offset Left', 'woolementor' ),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px', '%'],
                'condition'     => [
                    'stock_offset_toggle' => 'yes'
                ],
                'range'         => [
                    'px'        => [
                        'min'   => -1000,
                        'max'   => 1000,
                    ],
                    '%'        => [
                        'min'   => 0,
                        'max'   => 100,
                    ],
                ],
                'selectors'     => [
                    '{{WRAPPER}} .wl-sch-stock' => 'left: {{SIZE}}{{UNIT}}'
                ],
                'render_type'   => 'ui',
            ]
        );

        $this->add_responsive_control(
            'stock_media_offset_y',
            [
                'label'         => __( 'Offset Top', 'woolementor' ),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px', '%'],
                'condition'     => [
                    'stock_offset_toggle' => 'yes'
                ],
                'range'         => [
                    'px'        => [
                        'min'   => -1000,
                        'max'   => 1000,
                    ],
                    '%'        => [
                        'min'   => 0,
                        'max'   => 100,
                    ],
                ],
                'selectors'     => [
                    '{{WRAPPER}} .wl-sch-stock' => 'top: {{SIZE}}{{UNIT}}',
                ],
            ]
        );
        $this->end_popover();

        $this->add_responsive_control(
            'stock_ribbon_width',
            [
                'label'     => __( 'Width', 'woolementor' ),
                'type'      => Controls_Manager::SLIDER,
                'size_units'=> [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .wl-sch-stock' => 'width: {{SIZE}}{{UNIT}}',
                ],
                'range'     => [
                    'px'    => [
                        'min'   => 50,
                        'max'   => 500
                    ]
                ],
            ]
        );

        $this->add_responsive_control(
            'stock_ribbon_transform',
            [
                'label'     => __( 'Transform', 'woolementor' ),
                'type'      => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .wl-sch-stock' => '-webkit-transform: rotate({{SIZE}}deg); transform: rotate({{SIZE}}deg);',
                ],
                'range'     => [
                    'px'    => [
                        'min'   => 0,
                        'max'   => 360
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
                    '{{WRAPPER}} .wl-sch-stock' => 'color: {{VALUE}}',
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
                'selector'  => '{{WRAPPER}} .wl-sch-stock',
            ]
        );

        $this->add_control(
            'stock_ribbon_background',
            [
                'label'         => __( 'Background', 'woolementor' ),
                'type'          => Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .wl-sch-stock' => 'background: {{VALUE}}',
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
                    '{{WRAPPER}} .wl-sch-stock' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'after'
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'          => 'stock_ribbon_border',
                'label'         => __( 'Border', 'woolementor' ),
                'selector'      => '{{WRAPPER}} .wl-sch-stock',
            ]
        );

        $this->add_responsive_control(
            'stock_ribbon_border_radius',
            [
                'label'         => __( 'Border Radius', 'woolementor' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .wl-sch-stock' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                'label' 		=> __( 'Cart Button', 'woolementor-pro' ),
                'tab'   		=> Controls_Manager::TAB_STYLE,
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
                'label'     	=> __( 'Icon Size', 'woolementor-pro' ),
                'type'      	=> Controls_Manager::SLIDER,
                'size_units'	=> [ 'px', 'em' ],
                'selectors' 	=> [
                    '{{WRAPPER}} .wl-sch-product-cart i' => 'font-size: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'cart_area_size',
            [
                'label'     	=> __( 'Area Size', 'woolementor-pro' ),
                'type'      	=> Controls_Manager::SLIDER,
                'size_units'	=> [ 'px', 'em' ],
                'selectors' 	=> [
                    '{{WRAPPER}} .wl-sch-product-cart a' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'cart_area_line_height',
            [
                'label'         => __( 'Line Height', 'woolementor-pro' ),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => [ 'px', 'em' ],
                'selectors'     => [
                    '{{WRAPPER}} .wl-sch-product-cart a' => 'line-height: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .wl-sch-product-cart a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .wl-sch-product-cart .added_to_cart.wc-forward::after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                'label'         => __( 'Color', 'woolementor-pro' ),
                'type'          => Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .wl-sch-product-cart a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'cart_icon_bg',
            [
                'label'         => __( 'Background', 'woolementor-pro' ),
                'type'          => Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .wl-sch-product-cart a' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'          => 'cart_border',
                'label'         => __( 'Border', 'woolementor-pro' ),
                'selector'      => '{{WRAPPER}} .wl-sch-product-cart a',
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
                    '{{WRAPPER}} .wl-sch-product-cart a:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'cart_icon_bg_hover',
            [
                'label'     => __( 'Background', 'woolementor-pro' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wl-sch-product-cart a:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'          => 'cart_border_hover',
                'label'         => __( 'Border', 'woolementor-pro' ),
                'selector'      => '{{WRAPPER}} .wl-sch-product-cart a:hover',
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
                    '{{WRAPPER}} .added_to_cart.wc-forward::after' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'cart_icon_bg_view_cart',
            [
                'label'     => __( 'Background', 'woolementor-pro' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .added_to_cart.wc-forward::after' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'cart_icon_view_cart_top',
            [
                'label'     => __( 'Margin Top', 'woolementor-pro' ),
                'type'      => Controls_Manager::SLIDER,
                'size_units'=> [ 'px', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .wl-sch-product-cart .added_to_cart.wc-forward::after' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'cart_icon_view_cart_left',
            [
                'label'     => __( 'Margin Left', 'woolementor-pro' ),
                'type'      => Controls_Manager::SLIDER,
                'size_units'=> [ 'px', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .wl-sch-product-cart .added_to_cart.wc-forward::after' => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'          => 'cart_border_view_cart',
                'label'         => __( 'Border', 'woolementor-pro' ),
                'selector'      => '{{WRAPPER}} .wl-sch-product-cart .added_to_cart.wc-forward::after',
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
                'label' 		=> __( 'Wishlist Button', 'woolementor-pro' ),
                'tab'   		=> Controls_Manager::TAB_STYLE,
                'condition'     => [
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
                'label'     	=> __( 'Icon Size', 'woolementor-pro' ),
                'type'      	=> Controls_Manager::SLIDER,
                'size_units'	=> [ 'px', 'em' ],
                'selectors' 	=> [
                    '{{WRAPPER}} .wl-sch-product-fav i' => 'font-size: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'wishlist_area_size',
            [
                'label'     	=> __( 'Area Size', 'woolementor-pro' ),
                'type'      	=> Controls_Manager::SLIDER,
                'size_units'	=> [ 'px', 'em' ],
                'selectors' 	=> [
                    '{{WRAPPER}} .wl-sch-product-fav' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'wishlist_area_line_height',
            [
                'label'         => __( 'Line Height', 'woolementor-pro' ),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => [ 'px', 'em' ],
                'selectors'     => [
                    '{{WRAPPER}} .wl-sch-product-fav' => 'line-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'wishlist_icon_color',
            [
                'label'     	=> __( 'Color', 'woolementor-pro' ),
                'type'      	=> Controls_Manager::COLOR,
                'selectors' 	=> [
                    '{{WRAPPER}} .wl-sch-product-fav a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'wishlist_icon_bg',
            [
                'label'     	=> __( 'Background', 'woolementor-pro' ),
                'type'      	=> Controls_Manager::COLOR,
                'selectors' 	=> [
                    '{{WRAPPER}} .wl-sch-product-fav' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'          => 'wishlist_border',
                'label'         => __( 'Border', 'woolementor-pro' ),
                'selector'      => '{{WRAPPER}} .wl-sch-product-fav',
            ]
        );

        $this->add_responsive_control(
            'wishlist_border_radius',
            [
                'label'         => __( 'Border Radius', 'woolementor-pro' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .wl-sch-product-fav' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        /**
         * Pagination
         */
        $this->start_controls_section(
            'section_style_pagination',
            [
                'label' 		=> __( 'Pagination', 'woolementor-pro' ),
                'tab'   		=> Controls_Manager::TAB_STYLE,
                'condition'     => [
                    'pagination_show_hide' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'pagination_alignment',
            [
                'label'         => __( 'Alignment', 'woolementor-pro' ),
                'type'          => Controls_Manager::CHOOSE,
                'options'       => [
                    'left'          => [
                        'title'         => __( 'Left', 'woolementor-pro' ),
                        'icon'          => 'fa fa-align-left',
                    ],
                    'center'        => [
                        'title'         => __( 'Center', 'woolementor-pro' ),
                        'icon'          => 'fa fa-align-center',
                    ],
                    'right'         => [
                        'title'         => __( 'Right', 'woolementor-pro' ),
                        'icon'          => 'fa fa-align-right',
                    ],
                ],
                'default'       => 'center',
                'toggle'        => true,
                'selectors'     => [
                    '{{WRAPPER}} .wl-sch-pagination' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'pagination_left_icon',
            [
                'label'     => __( 'Left Icon', 'woolementor-pro' ),
                'type'      => Controls_Manager::ICONS,
                'default'   => [
                    'value'     => 'fa fa-arrow-left',
                    'library'   => 'solid',
                ],
                'separator'     => 'before'
            ]
        );
        
        $this->add_control(
            'pagination_right_icon',
            [
                'label'     => __( 'Right Icon', 'woolementor-pro' ),
                'type'      => Controls_Manager::ICONS,
                'default'   => [
                    'value'     => 'fa fa-arrow-right',
                    'library'   => 'solid',
                ],
            ]
        );

        $this->add_responsive_control(
            'pagination_icon_size',
            [
                'label'     	=> __( 'Font Size', 'woolementor-pro' ),
                'type'      	=> Controls_Manager::SLIDER,
                'size_units'	=> [ 'px', 'em' ],
                'selectors' 	=> [
                    '{{WRAPPER}} .wl-sch-pagination .page-numbers' => 'font-size: {{SIZE}}{{UNIT}}',
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
                    '{{WRAPPER}} .wl-sch-pagination .page-numbers' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
      
        $this->start_controls_tabs(
            'pagination_separator',
            [
                'separator' 	=> 'before'
            ]
        );

        $this->start_controls_tab(
            'pagination_normal_item',
            [
                'label'     	=> __( 'Normal', 'woolementor-pro' ),
            ]
        );

        $this->add_control(
            'pagination_color',
            [
                'label'     	=> __( 'Color', 'woolementor-pro' ),
                'type'      	=> Controls_Manager::COLOR,
                'selectors' 	=> [
                    '{{WRAPPER}} .wl-sch-pagination .page-numbers' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'pagination_icon_bg',
            [
                'label'     	=> __( 'Background', 'woolementor-pro' ),
                'type'      	=> Controls_Manager::COLOR,
                'selectors' 	=> [
                    '{{WRAPPER}} .wl-sch-pagination .page-numbers' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'          => 'pagination_border',
                'label'         => __( 'Border', 'woolementor-pro' ),
                'selector'      => '{{WRAPPER}} .wl-sch-pagination .page-numbers',
            ]
        );

        $this->add_responsive_control(
            'pagination_border_radius',
            [
                'label'         => __( 'Border Radius', 'woolementor-pro' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .wl-sch-pagination .page-numbers' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'pagination_current_item',
            [
                'label'     	=> __( 'Active', 'woolementor-pro' ),
            ]
        );

        $this->add_control(
            'pagination_current_item_color',
            [
                'label'     	=> __( 'Color', 'woolementor-pro' ),
                'type'      	=> Controls_Manager::COLOR,
                'selectors' 	=> [
                    '{{WRAPPER}} .wl-sch-pagination .page-numbers.current' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'pagination_current_item_bg',
            [
                'label'     	=> __( 'Background', 'woolementor-pro' ),
                'type'      	=> Controls_Manager::COLOR,
                'selectors' 	=> [
                    '{{WRAPPER}} .wl-sch-pagination .page-numbers.current' => 'background: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'          => 'pagination_current_item_border',
                'label'         => __( 'Border', 'woolementor-pro' ),
                'selector'      => '{{WRAPPER}} .wl-sch-pagination .page-numbers.current',
            ]
        );

        $this->add_responsive_control(
            'pagination_current_item_border_radius',
            [
                'label'         => __( 'Border Radius', 'woolementor-pro' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .wl-sch-pagination .page-numbers.current' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab( 'pagination_hover',
            [
                'label'     	=> __( 'Hover', 'woolementor-pro' ),
            ]
        );

        $this->add_control(
            'pagination_hover_item_color',
            [
                'label'     	=> __( 'Color', 'woolementor-pro' ),
                'type'      	=> Controls_Manager::COLOR,
                'selectors' 	=> [
                    '{{WRAPPER}} .wl-sch-pagination .page-numbers:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'pagination_hover_item_bg',
            [
                'label'     	=> __( 'Background', 'woolementor-pro' ),
                'type'      	=> Controls_Manager::COLOR,
                'selectors' 	=> [
                    '{{WRAPPER}} .wl-sch-pagination .page-numbers:hover' => 'background: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'          => 'pagination_hover_item_border',
                'label'         => __( 'Border', 'woolementor-pro' ),
                'selector'      => '{{WRAPPER}} .wl-sch-pagination .page-numbers:hover',
            ]
        );

        $this->add_responsive_control(
            'pagination_hover_item_border_radius',
            [
                'label'         => __( 'Border Radius', 'woolementor-pro' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .wl-sch-pagination .page-numbers:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'pagination_hover_transition',
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
                    '{{WRAPPER}} .wl-sch-pagination .page-numbers:hover' => 'transition-duration: {{SIZE}}s',
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

        /**
         * Load attributes
         */
        $this->render_editing_attributes();
        
        $products = woolementor_query_products( $settings );
        $user_id  = get_current_user_id();
        $wishlist = woolementor_get_wishlist( $user_id );
        ?>

        <div class="wl-sch-product-style">
            <div class="cx-container">

                <?php
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
                        ?>
                        <div class="cx-col-md-<?php echo esc_html( 12 / $columns ); ?> cx-col-sm-<?php echo esc_html( 12 / $columns_tablet ); ?> cx-col-xs-<?php echo esc_html( 12 / $columns_mobile ); ?>">
                            <div class="wl-sch-single-product <?php echo esc_attr( $alignment ); ?> wl-icons-<?php echo esc_attr( $icon_position_alignment ); ?>">
                                <div class="wl-sch-single-widget">

                                    <?php if( 'outofstock' == $product->get_stock_status() && 'yes' == $stock_show_hide ): ?>
                                        <div class="wl-sch-stock">
                                            <?php echo $stock_ribbon_text; ?>
                                        </div>
                                    <?php endif; ?>

                                    <div class="wl-sch-product-img">

                                        <?php if ( 'none' == $image_on_click ): ?>
                                            <img src="<?php echo esc_html( $thumbnail ); ?>" alt="<?php echo esc_attr( $product->get_name() ); ?>"/>  
                                        <?php elseif ( 'zoom' == $image_on_click ) : ?>
                                            <a id="wl-product-image-zoom" href="<?php echo esc_html( $thumbnail ); ?>"><img src="<?php echo esc_html( $thumbnail ); ?>" alt=""/></a>
                                        <?php elseif ( 'product_page' == $image_on_click ) : ?>
                                            <a href="<?php the_permalink(); ?>">
                                                <img src="<?php echo esc_html( $thumbnail ); ?>" alt="<?php echo esc_attr( $product->get_name() ); ?>"/>                              
                                            </a>
                                        <?php endif ?>
                                        
                                    </div>

                                    <?php if ( 'bottom' == $icon_position_alignment ): ?>

                                    <div class="wl-sch-product-details">
                                        <div class="wl-sch-product-info">

                                            <?php if ( 'yes' == $sale_ribbon_show_hide && $product->is_on_sale() ): ?>
                                                <div class="wl-sch-corner-ribbon">
                                                    <?php
                                                    printf( '<span %1$s>%2$s</span>',
                                                        $this->get_render_attribute_string( 'sale_ribbon_text' ),
                                                        esc_html( $settings['sale_ribbon_text' ] )
                                                    );
                                                    ?>
                                                </div>
                                            <?php endif; ?>

                                            <div class="wl-sch-product-name">
                                                <a <?php echo $this->get_render_attribute_string( 'title_color' ); ?> href="<?php the_permalink(); ?>"><?php echo esc_html( $product->get_name() ); ?></a>
                                            </div>

                                            <?php if ( 'yes' == $product_desc_show_hide ): ?>
	                                           <div class="wl-sch-product-desc">
	                                           		<p><?php echo wp_trim_words( $product->get_short_description(), $product_desc_words_count ); ?></p>
	                                           </div>
                                            <?php endif; ?>

                                            <h2 class="wl-sch-price"><?php echo $product->get_price_html(); ?></h2>

                                            <?php if ( 'yes' == $star_rating_show_hide ): ?>
                                                <div class="wl-sch-rating">
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
                                                </div>
                                            <?php endif; ?>

                                        </div>

                                        <div class="wl-sch-info-icons">

                                            <?php if ( 'yes' == $wishlist_show_hide ): ?>
                                                <div class="wl-sch-product-fav">
                                                    <a href="#" class="ajax_add_to_wish <?php echo esc_attr( $fav_item ); ?>" data-product_id="<?php echo $product_id; ?>">
                                                        <i class="<?php echo esc_attr( $wishlist_icon['value'] ); ?>"></i>
                                                    </a>
                                                </div>
                                            <?php endif;

                                            if ( 'yes' == $wishlist_show_hide && 'yes' == $cart_show_hide ): ?>
                                                <div class="wl-sch-divider"></div>
                                            <?php endif;

                                            if ( 'yes' == $cart_show_hide ):
                                                if ( 'simple' == $product->get_type() ): ?>
                                                    <div class="wl-sch-product-cart">
                                                        <div class="wl-cart-area">
                                                            <a href="?add-to-cart=<?php echo $product_id; ?>" data-quantity="1" class="product_type_<?php echo esc_attr( $product->get_type() ); ?> add_to_cart_button ajax_add_to_cart" data-product_id="<?php echo $product_id; ?>" title="<?php echo _e( 'Add to Cart', 'woolementor-pro' ) ?>" ><i class="<?php echo esc_attr( $cart_icon['value'] ); ?>"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                <?php else: ?>
                                                    <div class="wl-sch-product-cart">
                                                        <a href="<?php echo esc_url( get_permalink( $product_id ) ); ?>" class="product_type_<?php echo esc_attr( $product->get_type() ); ?> add_to_cart_button ajax_add_to_cart"  ><i class="<?php echo esc_attr( $cart_icon['value'] ); ?>"></i></a>
                                                    </div>
                                                <?php endif;
                                            endif; ?>

                                        </div>
                                    </div>

                                    <?php else: ?>

                                    <div class="wl-sch-product-details">

                                    	<?php if ( 'yes' == $wishlist_show_hide ): ?>
                                            <div class="wl-sch-product-fav">
                                                <a href="#" class="ajax_add_to_wish <?php echo esc_attr( $fav_item ); ?>" data-product_id="<?php echo $product_id; ?>">
                                                <i class="<?php echo esc_attr( $wishlist_icon['value'] ); ?>"></i>
                                            </a>
                                            </div>
                                        <?php endif; ?>

                                        <div class="wl-sch-product-info">

                                            <div class="wl-sch-product-name">
                                                <a href="<?php the_permalink(); ?>"><?php echo esc_html( $product->get_name() ); ?></a>
                                            </div>

                                            <?php if ( 'yes' == $star_rating_show_hide ): ?>
                                                <div class="wl-sch-rating">
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
                                                </div>
                                            <?php endif;

                                            if ( 'yes' == $product_desc_show_hide ): ?>
	                                           <div class="wl-sch-product-desc">
	                                           		<p><?php echo wp_trim_words( $product->get_short_description(), $product_desc_words_count ); ?></p>
	                                           </div>
                                            <?php endif; ?>

                                        </div>

                                        <div class="wl-sch-info-icons">

                                           <div class="wl-sch-price">
                                              <h2><?php echo $product->get_price_html(); ?></h2>
                                           </div>

                                           <?php if ( 'yes' == $cart_show_hide ):
                                                if ( 'simple' == $product->get_type() ): ?>
                                                    <div class="wl-sch-product-cart">
                                                        <div class="wl-cart-area">
                                                            <a href="?add-to-cart=<?php echo $product_id; ?>" data-quantity="1" class="product_type_<?php echo esc_attr( $product->get_type() ); ?> add_to_cart_button ajax_add_to_cart" data-product_id="<?php echo $product_id; ?>" title="<?php echo _e( 'Add to Cart', 'woolementor-pro' ) ?>" ><i class="<?php echo esc_attr( $cart_icon['value'] ); ?>"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                <?php else: ?>
                                                    <div class="wl-sch-product-cart">
                                                        <a href="<?php echo esc_url( get_permalink( $product_id ) ); ?>" class="product_type_<?php echo esc_attr( $product->get_type() ); ?> add_to_cart_button ajax_add_to_cart"  ><i class="<?php echo esc_attr( $cart_icon['value'] ); ?>"></i></a>
                                                    </div>
                                                <?php endif;
                                            endif; ?>

                                        </div>
                                    </div>
                                    
                                    <?php endif ?>

                                </div>
                            </div>
                        </div>

                    <?php endwhile; wp_reset_query(); else: 

                    echo '<p>' . __( 'No Product Found!', 'woolementor-pro' ) . '</p>';

                endif; ?>

            </div>
        </div>

        <?php if ( 'yes' == $pagination_show_hide ):

            echo '<div class="wl-sch-pagination">';

            /**
            * woolementor pagination
            */
            woolementor_pagination( $products, $pagination_left_icon, $pagination_right_icon ); 

            echo '</div>';

        endif;
    }

    private function render_editing_attributes() {
        $this->add_render_attribute( 'title_color', 'class', 'wl-gradient-heading' );
    }
}