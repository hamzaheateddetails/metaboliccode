<?php
namespace codexpert\Woolementor_Pro;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Color;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;

class Shop_Table extends Widget_Base {

    public $id;

    public function __construct( $data = [], $args = null ) {
        parent::__construct( $data, $args );

        $this->id       = woolementor_get_widget_id( __CLASS__ );
        $this->widget   = woolementor_get_widget( $this->id );
        
        // Are we in debug mode?
        $min = defined( 'WOOLEMENTOR_PRO_DEBUG' ) && WOOLEMENTOR_PRO_DEBUG ? '' : '.min';

        wp_register_script( "woolementor-{$this->id}", plugins_url( "assets/js/script{$min}.js", __FILE__ ), ['jquery'], '1.1', true );

        wp_register_style( "woolementor-{$this->id}", plugins_url( "assets/css/style{$min}.css", __FILE__ ), [], '1.1' );
    }

    public function get_script_depends() {
        return [ "woolementor-{$this->id}", 'fancybox', 'dataTables' ];
    }

    public function get_style_depends() {
        return [ "woolementor-{$this->id}", 'fancybox', 'dataTables' ];
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
                'label'     => __( 'Columns', 'woolementor-pro' ),
                'tab'       => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'id_section',
            [
                'label'         => __( 'ID', 'woolementor-pro' ),
                'type'          => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'id_text',
            [
                'label'         => __( 'Label', 'woolementor-pro' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => __( 'ID', 'woolementor-pro' ),
                'placeholder'   => __( 'Type your title here', 'woolementor-pro' ),
                'label_block'   => true,           
            ]
        );

        $this->add_control(
            'id_visibility',
            [
                'label'         => __( 'Show on these devices', 'woolementor-pro' ),
                'type'          => Controls_Manager::SELECT2,
                'multiple'      => true,
                'options'       => [
                    'visible-md'    => __( 'Desktop', 'woolementor-pro' ),
                    'visible-sm'    => __( 'Tablet', 'woolementor-pro' ),
                    'visible-xs'    => __( 'Mobile', 'woolementor-pro' ),
                ],
                'default'       => [ 'visible-md', 'visible-sm', 'visible-xs' ],
                'label_block'   => true,
                'separator'     => 'after',
            ]
        );

        $this->add_control(
            'sale_ribbon_section',
            [
                'label'         => __( 'Sale Ribbon', 'woolementor-pro' ),
                'type'          => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(

            'show_sale_ribbon',
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
            'sale_ribbon_text',
            [
                'label'         => __( 'Text', 'woolementor-pro' ),
                'type'          => Controls_Manager::TEXT,
                'condition' => [
                   'show_sale_ribbon' => 'yes'
                ],
                'default'   => __( 'Sale', 'woolementor-pro' ),
            ]
        );

        $this->add_control(
            'image_section',
            [
                'label'         => __( 'Image', 'woolementor-pro' ),
                'type'          => Controls_Manager::HEADING,
                'separator'     => 'before',
            ]
        );

        $this->add_control(
            'image_text',
            [
                'label'         => __( 'Label', 'woolementor-pro' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => __( 'Image', 'woolementor-pro' ),
                'placeholder'   => __( 'Type your title here', 'woolementor-pro' ),
                'label_block'   => true,
            ]
        );

        $this->add_control(
            'image_visibility',
            [
                'label'         => __( 'Show on these devices', 'woolementor-pro' ),
                'type'          => Controls_Manager::SELECT2,
                'multiple'      => true,
                'options'       => [
                    'visible-md'    => __( 'Desktop', 'woolementor-pro' ),
                    'visible-sm'    => __( 'Tablet', 'woolementor-pro' ),
                    'visible-xs'    => __( 'Mobile', 'woolementor-pro' ),
                ],
                'default'       => [ 'visible-md', 'visible-sm', 'visible-xs' ],
                'label_block'   => true,
                'separator'     => 'after',
            ]
        );

        $this->add_control(
            'title_section',
            [
                'label'         => __( 'Title', 'woolementor-pro' ),
                'type'          => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'title_text',
            [
                'label'         => __( 'Label', 'woolementor-pro' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => __( 'Name', 'woolementor-pro' ),
                'placeholder'   => __( 'Type your title here', 'woolementor-pro' ),
                'label_block'   => true,
            ]
        );

        $this->add_control(
            'title_visibility',
            [
                'label'         => __( 'Show on these devices', 'woolementor-pro' ),
                'type'          => Controls_Manager::SELECT2,
                'multiple'      => true,
                'options'       => [
                    'visible-md'    => __( 'Desktop', 'woolementor-pro' ),
                    'visible-sm'    => __( 'Tablet', 'woolementor-pro' ),
                    'visible-xs'    => __( 'Mobile', 'woolementor-pro' ),
                ],
                'default'       => [ 'visible-md', 'visible-sm', 'visible-xs' ],
                'label_block'   => true,
                'separator'     => 'after',
            ]
        );

        $this->add_control(
            'category_section',
            [
                'label'         => __( 'Category', 'woolementor-pro' ),
                'type'          => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'category_text',
            [
                'label'         => __( 'Label', 'woolementor-pro' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => __( 'Category', 'woolementor-pro' ),
                'placeholder'   => __( 'Type your title here', 'woolementor-pro' ),
                'label_block'   => true,
            ]
        );

        $this->add_control(
            'category_visibility',
            [
                'label'         => __( 'Show on these devices', 'woolementor-pro' ),
                'type'          => Controls_Manager::SELECT2,
                'multiple'      => true,
                'options'       => [
                    'visible-md'    => __( 'Desktop', 'woolementor-pro' ),
                    'visible-sm'    => __( 'Tablet', 'woolementor-pro' ),
                    'visible-xs'    => __( 'Mobile', 'woolementor-pro' ),
                ],
                'default'       => [ 'visible-md', 'visible-sm', 'visible-xs' ],
                'label_block'   => true,
                'separator'     => 'after',
            ]
        );

        $this->add_control(
            'short_desc_section',
            [
                'label'         => __( 'Short Description', 'woolementor-pro' ),
                'type'          => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'short_desc_text',
            [
                'label'         => __( 'Label', 'woolementor-pro' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => __( 'Short Description', 'woolementor-pro' ),
                'placeholder'   => __( 'Type your title here', 'woolementor-pro' ),
                'label_block'   => true,
            ]
        );

        $this->add_control(
            'short_desc_visibility',
            [
                'label'         => __( 'Show on these devices', 'woolementor-pro' ),
                'type'          => Controls_Manager::SELECT2,
                'multiple'      => true,
                'options'       => [
                    'visible-md'    => __( 'Desktop', 'woolementor-pro' ),
                    'visible-sm'    => __( 'Tablet', 'woolementor-pro' ),
                    'visible-xs'    => __( 'Mobile', 'woolementor-pro' ),
                ],
                'default'       => [ 'visible-md', 'visible-sm', 'visible-xs' ],
                'label_block'   => true,
                'separator'     => 'after',
            ]
        );

        $this->add_control(
            'price_section',
            [
                'label'         => __( 'Price', 'woolementor-pro' ),
                'type'          => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'price_text',
            [
                'label'         => __( 'Label', 'woolementor-pro' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => __( 'Price', 'woolementor-pro' ),
                'placeholder'   => __( 'Type your title here', 'woolementor-pro' ),
                'label_block'   => true,
            ]
        );

        $this->add_control(
            'price_visibility',
            [
                'label'         => __( 'Show on these devices', 'woolementor-pro' ),
                'type'          => Controls_Manager::SELECT2,
                'multiple'      => true,
                'options'       => [
                    'visible-md'    => __( 'Desktop', 'woolementor-pro' ),
                    'visible-sm'    => __( 'Tablet', 'woolementor-pro' ),
                    'visible-xs'    => __( 'Mobile', 'woolementor-pro' ),
                ],
                'default'       => [ 'visible-md', 'visible-sm', 'visible-xs' ],
                'label_block'   => true,
                'separator'     => 'after',
            ]
        );

        $this->add_control(
            'action_section',
            [
                'label'         => __( 'Action', 'woolementor-pro' ),
                'type'          => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'action_text',
            [
                'label'         => __( 'Label', 'woolementor-pro' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => __( 'Action', 'woolementor-pro' ),
                'placeholder'   => __( 'Type your title here', 'woolementor-pro' ),
                'label_block'   => true,
            ]
        );

        $this->add_control(
            'action_visibility',
            [
                'label'         => __( 'Show on these devices', 'woolementor-pro' ),
                'type'          => Controls_Manager::SELECT2,
                'multiple'      => true,
                'options'       => [
                    'visible-md'    => __( 'Desktop', 'woolementor-pro' ),
                    'visible-sm'    => __( 'Tablet', 'woolementor-pro' ),
                    'visible-xs'    => __( 'Mobile', 'woolementor-pro' ),
                ],
                'default'       => [ 'visible-md', 'visible-sm', 'visible-xs' ],
                'label_block'   => true,
                'separator'     => 'after',
            ]
        );

        $this->add_control(
            'multiselect_visibility',
            [
                'label'         => __( 'Multiple Product Selection', 'woolementor-pro' ),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => __( 'Yes', 'woolementor-pro' ),
                'label_off'     => __( 'No', 'woolementor-pro' ),
                'return_value'  => 'yes',
                'default'       => '',
                'separator'     => 'before'
            ]
        );

        $this->add_control(
            'multiselect_text',
            [
                'label'         => __( 'Heading', 'woolementor-pro' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => __( 'Purchase', 'woolementor-pro' ),
                'placeholder'   => __( 'Type your title here', 'woolementor-pro' ),
                'condition' => [
                    'multiselect_visibility' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'multiselect_submit_text',
            [
                'label'         => __( 'Button Text', 'woolementor-pro' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => __( 'Add Selected To Cart', 'woolementor-pro' ),
                'placeholder'   => __( 'Type your text here', 'woolementor-pro' ),
                'condition' => [
                    'multiselect_visibility' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'table_header',
            [
                'label'     => __( 'Table Header', 'woolementor-pro' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    'top-header'        => __( 'Top Header', 'woolementor-pro' ),
                    'top-btm-header'    => __( 'Top & Bottom Headers', 'woolementor-pro' ),
                    'no-header'         => __( 'No Headers', 'woolementor-pro' ),
                ],
                'separator'         => 'before',
                'default'           => 'top-header',
                'style_transfer'    => true,
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
         * Data table controll
         */
        $this->start_controls_section(
            'section_content_data_table',
            [
                'label'     => __( 'DataTables', 'woolementor-pro' ),
                'tab'       => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'data_table_show_hide',
            [
                'label'         => __( 'Enable DataTables', 'woolementor-pro' ),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => __( 'Show', 'woolementor-pro' ),
                'label_off'     => __( 'Hide', 'woolementor-pro' ),
                'return_value'  => 'yes',
                'default'       => '',
                'description'   => sprintf( __( 'Check this to enable <a href="%s" target="_blank">DataTables</a> jQuery library', 'woolementor-pro' ), 'https://datatables.net/' ),
            ]
        );

        $this->end_controls_section();

        /**
         * Wishlist controls
         */
        $this->start_controls_section(
            'section_content_product_image',
            [
                'label'     => __( 'Product Image', 'woolementor-pro' ),
                'tab'       => Controls_Manager::TAB_CONTENT,
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
         * Quantity controls
         */
        $this->start_controls_section(
            'section_content_qty',
            [
                'label'     => __( 'Quantity Input', 'woolementor-pro' ),
                'tab'       => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'qty_show_hide',
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
                'label'     => __( 'Wishlist', 'woolementor-pro' ),
                'tab'       => Controls_Manager::TAB_CONTENT,
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
         * Cart controls
         */
        $this->start_controls_section(
            'section_content_cart',
            [
                'label'     => __( 'Cart', 'woolementor-pro' ),
                'tab'       => Controls_Manager::TAB_CONTENT,
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
         * Pagination controls
         */
        $this->start_controls_section(
            'section_content_pagination',
            [
                'label'         => __( 'Pagination', 'woolementor-pro' ),
                'tab'           => Controls_Manager::TAB_CONTENT,
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
         * Table Header
         */
        $this->start_controls_section(
            'tbl_header',
            [
                'label' => __( 'Table Header', 'woolementor-pro' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'tbl_header_alignment',
            [
                'label'     => __( 'Alignment', 'woolementor-pro' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'      => [
                        'title'     => __( 'Left', 'woolementor-pro' ),
                        'icon'      => 'fa fa-align-left',
                    ],
                    'center'    => [
                        'title'     => __( 'Center', 'woolementor-pro' ),
                        'icon'      => 'fa fa-align-center',
                    ],
                    'right'     => [
                        'title'     => __( 'Right', 'woolementor-pro' ),
                        'icon'      => 'fa fa-align-right',
                    ],
                ],
                'default'   => 'center',
                'toggle'    => true,
                'selectors' => [
                    '{{WRAPPER}} .wl-st-main_table th' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'background_color',
            [
                'label'     => __( 'Background Color', 'woolementor-pro' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wl-st-main_table th' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'th_text_color',
            [
                'label'     => __( 'Text Color', 'woolementor-pro' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wl-st-main_table th' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'title_typography',
                'label'     => __( 'Typography', 'woolementor-pro' ),
                'scheme'    => Typography::TYPOGRAPHY_1,
                'selector'  => '{{WRAPPER}} .wl-st-main_table th',
            ]
        );

        $this->end_controls_section();

        /**
         * Table Row
         */

        $this->start_controls_section(
            'section_row_design',
            [
                'label' => __( 'Table Row', 'woolementor-pro' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'tbl_row_alignment',
            [
                'label'     => __( 'Alignment', 'woolementor-pro' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'      => [
                        'title'     => __( 'Left', 'woolementor-pro' ),
                        'icon'      => 'fa fa-align-left',
                    ],
                    'center'    => [
                        'title'     => __( 'Center', 'woolementor-pro' ),
                        'icon'      => 'fa fa-align-center',
                    ],
                    'right'     => [
                        'title'     => __( 'Right', 'woolementor-pro' ),
                        'icon'      => 'fa fa-align-right',
                    ],
                ],
                'default'   => 'center',
                'toggle'    => true,
                'selectors' => [
                    '{{WRAPPER}} .wl-st-main_table td' => 'text-align: {{VALUE}};',
                    '{{WRAPPER}} .wl-st-info-icons' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'short_tbl_row_typography',
                'label'     => __( 'Typography', 'woolementor-pro' ),
                'scheme'    => Typography::TYPOGRAPHY_1,
                'selector'  => '{{WRAPPER}} .wl-st-main_table .wl-st-td,
                                {{WRAPPER}} .wl-st-main_table .wl-st-td a',
            ]
        ); 


        $this->add_control(
            'short_row_color_odd',
            [
                'label'     => __( 'Odd Row Color', 'woolementor-pro' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wl-st-main_table tr:nth-child(odd) td' => 'background-color: {{VALUE}}',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'short_row_text_color_odd',
            [
                'label'     => __( 'Odd Row Text Color', 'woolementor-pro' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wl-st-main_table tr:nth-child(odd) .wl-st-td,
                     {{WRAPPER}} .wl-st-main_table tr:nth-child(odd) .wl-st-td a' => 'color: {{VALUE}}',
                     '{{WRAPPER}} .wl-st-main_table tr:nth-child(odd) .wl-st-td .amount' => 'color: {{VALUE}}',
                     '{{WRAPPER}} .wl-st-main_table tr:nth-child(odd) .wl-st-td del .amount' => 'color: {{VALUE}}',
                     '{{WRAPPER}} .wl-st-main_table tr:nth-child(odd) .wl-st-td ins .amount' => 'color: {{VALUE}}',
                ],
                'separator' => 'after',
            ]
        );

        $this->add_control(
            'short_row_color_even',
            [
                'label'     => __( 'Even Row Color', 'woolementor-pro' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wl-st-main_table tr:nth-child(even) td' => 'background-color: {{VALUE}}',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'short_row_text_color_even',
            [
                'label'     => __( 'Even Row Text Color', 'woolementor-pro' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wl-st-main_table tr:nth-child(even) .wl-st-td,
                     {{WRAPPER}} .wl-st-main_table tr:nth-child(even) .wl-st-td a' => 'color: {{VALUE}}',
                     '{{WRAPPER}} .wl-st-main_table tr:nth-child(even) .wl-st-td .amount' => 'color: {{VALUE}}',
                     '{{WRAPPER}} .wl-st-main_table tr:nth-child(even) .wl-st-td del .amount' => 'color: {{VALUE}}',
                     '{{WRAPPER}} .wl-st-main_table tr:nth-child(even) .wl-st-td ins .amount' => 'color: {{VALUE}}',
                ],
                'separator' => 'after',
            ]
        );

        $this->end_controls_section();

        /**
         * Table border
         */
        $this->start_controls_section(
            'section_tbl_border',
            [
                'label' => __( 'Table Border', 'woolementor-pro' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'table_border_type',
                'label'     => __( 'Border', 'woolementor-pro' ),
                'selector'  => '{{WRAPPER}} .wl-st-main_table td, {{WRAPPER}} .wl-st-table-div .wl-st-main_table th',
            ]
        );

        $this->end_controls_section();

        /**
         * Sale Ribbon section Style
         */
        $this->start_controls_section(
            'style_section_sale_ribbon',
            [
                'label' => __( 'Sale Ribbon', 'woolementor-pro' ),
                'tab'   => Controls_Manager::TAB_STYLE,             
                'condition' => [
                    'show_sale_ribbon' => 'yes'
                ],

            ]
        );

        $this->add_control(
            'sale_ribbon_color',
            [
                'label' => __( 'Text Color', 'woolementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Color::get_type(),
                    'value' => Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .wl-st-sale' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'sale_ribbon_typography',
                'label'     => __( 'Typography', 'woolementor-pro' ),
                'scheme'    => Typography::TYPOGRAPHY_1,
                'selector'  => '{{WRAPPER}} .wl-st-sale',
                'separator' => 'after',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'sale_ribbon_bg_color',
                'label' => __( 'Front Side', 'woolementor-pro' ),
                'types' => [ 'classic', 'gradient'],
                'selector' => '{{WRAPPER}} .wl-st-sale',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'sale_border_type',
                'label'     => __( 'Border', 'woolementor-pro' ),
                'selector'  => '{{WRAPPER}} .wl-st-sale',
            ]
        );

        $this->add_control(
            'sale_ribbon_border_radius',
            [
                'label'         => __( 'Border Radius', 'woolementor-pro' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%' ],
                'separator'     => 'after',
                'selectors'     => [
                    '{{WRAPPER}} .wl-st-sale' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'Sale_ribbon_width',
            [
                'label' => __( 'Width', 'woolementor-pro' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 20,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .wl-st-sale' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'Sale_ribbon_height',
            [
                'label' => __( 'Height', 'woolementor-pro' ),
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
                'selectors' => [
                    '{{WRAPPER}} .wl-st-sale' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'sale_ribbon_padding',
            [
                'label'         => __( 'Padding', 'woolementor-pro' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%' ],
                'separator'     => 'after',
                'selectors'     => [
                    '{{WRAPPER}} .wl-st-sale' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'Sale_ribbon_rotation',
            [
                'label' => __( 'Rotation', 'woolementor-pro' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'deg' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 360,
                        'step' => 1,
                    ],                      
                ],
                'separator' => 'after',
                'selectors' => [
                    '{{WRAPPER}} .wl-st-sale' => 'transform: rotate({{SIZE}}deg);',
                ],
            ]
        );

        $this->add_control(
            'Sale_ribbon_x_position',
            [
                'label' => __( 'Position X', 'woolementor-pro' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => -80,
                        'max' => 300,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .wl-st-sale' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'Sale_ribbon_y_position',
            [
                'label' => __( 'Position Y', 'woolementor-pro' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => -180,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .wl-st-sale' => 'right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

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
            'sale_price_show_hide',
            [
                'label'         => __( 'Show Sale Price', 'woolementor-pro' ),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => __( 'Show', 'woolementor-pro' ),
                'label_off'     => __( 'Hide', 'woolementor-pro' ),
                'return_value'  => 'block',
                'default'       => 'none',
                'separator'     => 'before',
                'selectors'     => [
                    '{{WRAPPER}} .wl-st-main_table td del' => 'display: {{VALUE}}',
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
                    '{{WRAPPER}} .woocommerce-Price-currencySymbol' => 'color: {{VALUE}}',
                ],
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
                'condition' => [
                    'image_show' => 'yes'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'      => 'image_thumbnail',
                'exclude'   => [ 'custom' ],
                'include'   => [],
                'default'   => 'large',
            ]
        );

        $this->end_controls_section();

        /**
         * Quantity Field
         */
        $this->start_controls_section(
            'section_style_qty',
            [
                'label' => __( 'Quantity Input', 'woolementor-pro' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition'     => [
                    'qty_show_hide' => 'yes'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'qty_typography',
                'label'     => __( 'Typography', 'woolementor-pro' ),
                'scheme'    => Typography::TYPOGRAPHY_1,
                'selector'  => '{{WRAPPER}} .wl-st-info-icons .wl-st-qty',
            ]
        );

        $this->add_control(
            'qty_width',
            [
                'label' => __( 'Width', 'woolementor-pro' ),
                'type'  => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min'   => 0,
                        'max'   => 300,
                        'step'  => 1,
                    ],
                    '%' => [
                        'min'   => 0,
                        'max'   => 100,
                        'step'  => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .wl-st-info-icons .wl-st-qty' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'qty_color',
            [
                'label'     => __( 'Text Color', 'woolementor-pro' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wl-st-info-icons .wl-st-qty' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'qty_bg',
            [
                'label'     => __( 'Background', 'woolementor-pro' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wl-st-info-icons .wl-st-qty' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'          => 'qty_border',
                'label'         => __( 'Border', 'woolementor-pro' ),
                'selector'      => '{{WRAPPER}} .wl-st-info-icons .wl-st-qty',
            ]
        );

        $this->add_responsive_control(
            'qty_border_radius',
            [
                'label'         => __( 'Border Radius', 'woolementor-pro' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .wl-st-info-icons .wl-st-qty' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'qty_padding',
            [
                'label'         => __( 'Padding', 'woolementor-pro' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%' ],
                'separator'     => 'before',
                'selectors'     => [
                    '{{WRAPPER}} .wl-st-info-icons .wl-st-qty' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'qty_margin',
            [
                'label'         => __( 'Margin', 'woolementor-pro' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .wl-st-info-icons .wl-st-qty' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        /**
         * Wishlist Button
         */
        $this->start_controls_section(
            'section_style_wishlist',
            [
                'label' => __( 'Wishlist Button', 'woolementor-pro' ),
                'tab'   => Controls_Manager::TAB_STYLE,
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
                'label'     => __( 'Icon Size', 'woolementor-pro' ),
                'type'      => Controls_Manager::SLIDER,
                'size_units'=> [ 'px', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .wl-st-product-fav i' => 'font-size: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
            'wishlist_icon_area',
            [
                'label' => __( 'Area', 'woolementor-pro' ),
                'type'  => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min'   => 0,
                        'max'   => 300,
                        'step'  => 0.5,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 35,
                ],
                'selectors' => [
                    '{{WRAPPER}} .wl-st-product-fav i' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

         $this->add_control(
            'wishlist_icon_line_height',
            [
                'label' => __( 'Line Height', 'woolementor-pro' ),
                'type'  => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min'   => 0,
                        'max'   => 300,
                        'step'  => 0.5,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 35,
                ],
                'selectors' => [
                    '{{WRAPPER}} .wl-st-product-fav i' => 'line-height: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .wl-st-product-fav i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs(
            'wishlist_normal_separator',
            [
                'separator' => 'before'
            ]
        );

        $this->start_controls_tab(
            'wishlist_normal',
            [
                'label'     => __( 'Normal', 'woolementor-pro' ),
            ]
        );

        $this->add_control(
            'wishlist_icon_color',
            [
                'label'     => __( 'Color', 'woolementor-pro' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wl-st-product-fav i' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'wishlist_icon_bg',
            [
                'label'     => __( 'Background', 'woolementor-pro' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wl-st-product-fav i' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'          => 'wishlist_border',
                'label'         => __( 'Border', 'woolementor-pro' ),
                'selector'      => '{{WRAPPER}} .wl-st-product-fav i',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'wishlist_hover',
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
                    '{{WRAPPER}} .wl-st-product-fav i:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'wishlist_icon_bg_hover',
            [
                'label'     => __( 'Background', 'woolementor-pro' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wl-st-product-fav i:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'          => 'wishlist_border_hover',
                'label'         => __( 'Border', 'woolementor-pro' ),
                'selector'      => '{{WRAPPER}} .wl-st-product-fav i:hover',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'wishlist_active',
            [
                'label'     => __( 'Active', 'woolementor-pro' ),
            ]
        );

        $this->add_control(
            'wishlist_icon_color_active',
            [
                'label'     => __( 'Color', 'woolementor-pro' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wl-st-product-fav.button.ajax_add_to_wish.fav-item i' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'wishlist_icon_bg_active',
            [
                'label'     => __( 'Background', 'woolementor-pro' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wl-st-product-fav.button.ajax_add_to_wish.fav-item i' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'          => 'wishlist_border_active',
                'label'         => __( 'Border', 'woolementor-pro' ),
                'selector'      => '{{WRAPPER}} .wl-st-product-fav.button.ajax_add_to_wish.fav-item i',
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
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
                    '{{WRAPPER}} .wl-st-product-cart i' => 'font-size: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} .wl-st-info-icons .added_to_cart.wc-forward::after' => 'font-size: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
            'cart_icon_area',
            [
                'label' => __( 'Area', 'woolementor-pro' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                        'step' => 0.5,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 35,
                ],
                'selectors' => [
                    '{{WRAPPER}} .wl-st-product-cart i' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .wl-st-info-icons .added_to_cart.wc-forward::after' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'cart_icon_line_hight',
            [
                'label' => __( 'Line Height', 'woolementor-pro' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                        'step' => 0.5,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 35,
                ],
                'selectors' => [
                    '{{WRAPPER}} .wl-st-product-cart i' => 'line-height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .wl-st-info-icons .added_to_cart.wc-forward::after' => 'line-height: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .wl-st-product-cart i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .added_to_cart.wc-forward::after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .wl-st-product-cart i' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'cart_icon_bg',
            [
                'label'     => __( 'Background', 'woolementor-pro' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wl-st-product-cart i' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'          => 'cart_border',
                'label'         => __( 'Border', 'woolementor-pro' ),
                'selector'      => '{{WRAPPER}} .wl-st-product-cart i',
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
                    '{{WRAPPER}} .wl-st-product-cart i:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'cart_icon_bg_hover',
            [
                'label'     => __( 'Background', 'woolementor-pro' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wl-st-product-cart i:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'          => 'cart_border_hover',
                'label'         => __( 'Border', 'woolementor-pro' ),
                'selector'      => '{{WRAPPER}} .wl-st-product-cart i:hover',
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
                    '{{WRAPPER}} .wl-st-product-cart .added_to_cart.wc-forward::after' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'cart_icon_bg_view_cart',
            [
                'label'     => __( 'Background', 'woolementor-pro' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wl-st-product-cart .added_to_cart.wc-forward::after' => 'background: {{VALUE}}',
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
                    '{{WRAPPER}} .wl-st-product-cart .added_to_cart.wc-forward::after' => 'top: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .wl-st-product-cart .added_to_cart.wc-forward::after' => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'          => 'cart_border_view_cart',
                'label'         => __( 'Border', 'woolementor-pro' ),
                'selector'      => '{{WRAPPER}} .wl-st-product-cart .added_to_cart.wc-forward::after',
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        /**
         * Multiselect cart Button
         */
        $this->start_controls_section(
            'section_style_miltiple_cart_btn',
            [
                'label' => __( 'Multiselect cart Button', 'woolementor-pro' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition'     => [
                    'multiselect_visibility' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'miltiple_cart_btn_alignment',
            [
                'label'     => __( 'Alignment', 'woolementor-pro' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'      => [
                        'title'     => __( 'Left', 'woolementor-pro' ),
                        'icon'      => 'fa fa-align-left',
                    ],
                    'center'    => [
                        'title'     => __( 'Center', 'woolementor-pro' ),
                        'icon'      => 'fa fa-align-center',
                    ],
                    'right'     => [
                        'title'     => __( 'Right', 'woolementor-pro' ),
                        'icon'      => 'fa fa-align-right',
                    ],
                ],
                'default'   => 'right',
                'toggle'    => true,
                'selectors' => [
                    '{{WRAPPER}} .multiselect-submit-div' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'miltiple_cart_btn_typography',
                'label'     => __( 'Typography', 'woolementor-pro' ),
                'scheme'    => Typography::TYPOGRAPHY_1,
                'selector'  => '{{WRAPPER}} .multiselect-submit-div .multiselect-submit',
            ]
        );

        $this->add_responsive_control(
            'miltiple_cart_btn_margin',
            [
                'label'         => __( 'Margin', 'woolementor-pro' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .multiselect-submit-div' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'miltiple_cart_btn_padding',
            [
                'label'         => __( 'Padding', 'woolementor-pro' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .multiselect-submit-div .multiselect-submit' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'miltiple_cart_btn_border_radius',
            [
                'label'         => __( 'Border Radius', 'woolementor-pro' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .multiselect-submit-div .multiselect-submit' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs(
            'miltiple_cart_btn_separator',
            [
                'separator' => 'before'
            ]
        );

        $this->start_controls_tab(
            'miltiple_cart_btn_normal',
            [
                'label'     => __( 'Normal', 'woolementor-pro' ),
            ]
        );

        $this->add_control(
            'miltiple_cart_btn_color',
            [
                'label'     => __( 'Color', 'woolementor-pro' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .multiselect-submit-div .multiselect-submit' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'miltiple_cart_btn_bg',
            [
                'label'     => __( 'Background', 'woolementor-pro' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .multiselect-submit-div .multiselect-submit' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'          => 'miltiple_cart_btn_border',
                'label'         => __( 'Border', 'woolementor-pro' ),
                'selector'      => '{{WRAPPER}} .multiselect-submit-div .multiselect-submit',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'miltiple_cart_btn_hover',
            [
                'label'     => __( 'Hover', 'woolementor-pro' ),
            ]
        );

        $this->add_control(
            'miltiple_cart_btn_color_hover',
            [
                'label'     => __( 'Color', 'woolementor-pro' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .multiselect-submit-div .multiselect-submit:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'miltiple_cart_btn_bg_hover',
            [
                'label'     => __( 'Background', 'woolementor-pro' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .multiselect-submit-div .multiselect-submit:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'          => 'miltiple_cart_btn_border_hover',
                'label'         => __( 'Border', 'woolementor-pro' ),
                'selector'      => '{{WRAPPER}} .multiselect-submit-div .multiselect-submit:hover',
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();

        /**
         * Pagination Controll
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
                'label'        => __( 'Alignment', 'woolementor-pro' ),
                'type'         => Controls_Manager::CHOOSE,
                'options'      => [
                    'left'      => [
                        'title'     => __( 'Left', 'woolementor-pro' ),
                        'icon'      => 'fa fa-align-left',
                    ],
                    'center'    => [
                        'title'     => __( 'Center', 'woolementor-pro' ),
                        'icon'      => 'fa fa-align-center',
                    ],
                    'right'     => [
                        'title'     => __( 'Right', 'woolementor-pro' ),
                        'icon'      => 'fa fa-align-right',
                    ],
                ],
                'default'   => 'center',
                'toggle'    => true,
                'selectors' => [
                    '{{WRAPPER}} .wl-st-pagination' => 'text-align: {{VALUE}};',
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
                'separator' => 'before'
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
                'label'     => __( 'Font Size', 'woolementor-pro' ),
                'type'      => Controls_Manager::SLIDER,
                'size_units'=> [ 'px', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .wl-st-pagination .page-numbers' => 'font-size: {{SIZE}}{{UNIT}}',
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
                    '{{WRAPPER}} .wl-st-pagination .page-numbers' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .wl-st-pagination .page-numbers' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'pagination_icon_bg',
            [
                'label'     => __( 'Background', 'woolementor-pro' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wl-st-pagination .page-numbers' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'          => 'pagination_border',
                'label'         => __( 'Border', 'woolementor-pro' ),
                'selector'      => '{{WRAPPER}} .wl-st-pagination .page-numbers',
            ]
        );

        $this->add_responsive_control(
            'pagination_border_radius',
            [
                'label'         => __( 'Border Radius', 'woolementor-pro' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .wl-st-pagination .page-numbers' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .wl-st-pagination .page-numbers.current' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'pagination_current_item_bg',
            [
                'label'     => __( 'Background', 'woolementor-pro' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wl-st-pagination .page-numbers.current' => 'background: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'          => 'pagination_current_item_border',
                'label'         => __( 'Border', 'woolementor-pro' ),
                'selector'      => '{{WRAPPER}} .wl-st-pagination .page-numbers.current',
            ]
        );

        $this->add_responsive_control(
            'pagination_current_item_border_radius',
            [
                'label'         => __( 'Border Radius', 'woolementor-pro' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .wl-st-pagination .page-numbers.current' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .wl-st-pagination .page-numbers:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'pagination_hover_item_bg',
            [
                'label'     => __( 'Background', 'woolementor-pro' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wl-st-pagination .page-numbers:hover' => 'background: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'          => 'pagination_hover_item_border',
                'label'         => __( 'Border', 'woolementor-pro' ),
                'selector'      => '{{WRAPPER}} .wl-st-pagination .page-numbers:hover',
            ]
        );

        $this->add_responsive_control(
            'pagination_hover_item_border_radius',
            [
                'label'         => __( 'Border Radius', 'woolementor-pro' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .wl-st-pagination .page-numbers:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .wl-st-pagination .page-numbers:hover' => 'transition-duration: {{SIZE}}s',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

    }

    protected function render() {
        $settings       = $this->get_settings_for_display();
        extract( $settings );

        $this->render_editing_attributes();

        $data_table_show_hide = $settings['data_table_show_hide'] == 'yes' ? 'wl-st-data-table ' : '';
        $products = woolementor_query_products( $settings );
        $user_id  = get_current_user_id();
        $wishlist = woolementor_get_wishlist( $user_id );
        
        ?>
        <div class="wl-st-table-div">
        <?php if( 'yes' == $multiselect_visibility ): ?>
            <form method="POST" class="multiple-product-add-to-cart">
        <?php endif; ?>
            <div style="overflow-x:auto;">
                <table class="wl-st-main_table <?php echo $data_table_show_hide; ?>">  
                    <?php if ( $products->have_posts() && ( 'top-btm-header' == $table_header || 'top-header' == $table_header ) ) : ?>
                    <thead>
                        <tr>
                            <?php $this->render_table_heading(); ?>
                        </tr> 
                    </thead>

                <?php endif; 

                if( $products->have_posts() ) : 
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
                    <tr>

                        <?php 
                        if ( is_array( $id_visibility ) && count( $id_visibility ) > 0 ) {
                            printf( '<td class="wl-st-td %s">%d</td>',
                                esc_attr(  implode( ' ', (array)$id_visibility ) ),
                                esc_html( $product_id )
                            );
                        }

                        $image_visibility_class = '';
                        if ( is_array( $image_visibility ) && count( $image_visibility ) > 0 ) {
                            $image_visibility_class = implode( ' ', (array)$image_visibility );
                        }
                        ?>

                        <td class="wl-st-td wl-st-img <?php echo $image_visibility_class; ?>"> 
                            <?php if ( 'none' == $image_on_click ): ?>
                                <img src="<?php echo esc_url( $thumbnail ); ?>" alt="<?php echo esc_attr( $product->get_name() ); ?>"/>  
                            <?php elseif ( 'zoom' == $image_on_click ) : ?>
                                <a id="wl-st-product-image-zoom" href="<?php echo esc_url( $thumbnail ); ?>"><img src="<?php echo esc_url( $thumbnail ); ?>" alt=""/></a>
                            <?php elseif ( 'product_page' == $image_on_click ) : ?>
                                <a href="<?php the_permalink(); ?>">
                                    <img src="<?php echo esc_url( $thumbnail ); ?>" alt="<?php echo esc_attr( $product->get_name() ); ?>"/>         
                                </a>
                            <?php endif ?>
                        </td>

                        <td class="wl-st-td wl-st-name <?php echo implode( ' ', (array)$title_visibility ); ?>"> <?php echo $product->get_name(); ?> 

                            <?php if( 'yes' == $show_sale_ribbon && $product->is_on_sale() ): ?>
                                <span class="wl-st-sale">
                                    <?php echo esc_html( $sale_ribbon_text );  ?>                            
                                </span>
                            <?php endif; ?>

                        </td>

                        <?php 

                            if ( is_array( $id_visibility ) && count( $id_visibility ) > 0 ) {
                                printf( '<td class="wl-st-td %s">%s</td>',
                                    esc_attr( implode( ' ', (array)$category_visibility ) ),
                                    wc_get_product_category_list( $product_id )
                                );
                            }

                            if ( is_array( $id_visibility ) && count( $id_visibility ) > 0 ) {
                                printf( '<td class="wl-st-td %s">%s</td>',
                                    esc_attr( implode( ' ', (array)$short_desc_visibility ) ),
                                    wpautop( $product->get_short_description() )
                                );
                            }

                            if ( is_array( $id_visibility ) && count( $id_visibility ) > 0 ) {
                                printf( '<td class="wl-st-td %s">%s</td>',
                                    esc_attr( implode( ' ', (array)$price_visibility ) ),
                                    $product->get_price_html()
                                );
                            }
                                
                            $action_visibility_class = '';
                            if ( is_array( $action_visibility ) && count( $action_visibility ) > 0 ) {
                                $action_visibility_class = implode( ' ', (array)$action_visibility );
                            }
                        ?>
                        <td class="wl-st-td <?php echo $action_visibility_class; ?>"> 
                            <div class="wl-st-info-icons">
                                <?php if( 'yes' == $qty_show_hide ): 
                                    $hide = 'simple' != $product->get_type() ? 'hide' : '';
                                    ?>
                                    <input min='1' type="number" name="qty" class="wl-st-qty <?php echo $hide; ?>" value="1" >
                                <?php endif; ?>
                                <?php if ( 'yes' == $wishlist_show_hide ): ?>
                                    <a href="#" class="wl-st-product-fav button ajax_add_to_wish <?php echo esc_attr( $fav_item ); ?>" data-product_id="<?php echo $product_id; ?>"><i class="<?php echo esc_attr( $wishlist_icon['value'] ); ?>" ></i></a>
                                <?php endif ?>

                                <?php if ( 'yes' == $cart_show_hide ): ?>
                                    <?php if( 'simple' == $product->get_type() ) : ?>
                                        <div class="wl-st-product-cart">
                                            <a href="?add-to-cart=<?php echo $product_id; ?>" data-quantity="1" class="wl-st-product-cart button product_type_<?php echo esc_attr( $product->get_type() ); ?> add_to_cart_button ajax_add_to_cart" data-product_id="<?php echo $product_id; ?>" ><i class="<?php echo esc_attr( $cart_icon['value'] ); ?>"></i></a>
                                        </div>
                                    <?php else: ?>
                                        <div class="wl-st-product-cart">
                                            <a class="wl-st-product-cart button" href="<?php echo get_permalink( $product_id ); ?>"><i class="<?php echo esc_attr( $cart_icon['value'] ); ?>"></i></a>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>
                                
                            </div>
                        </td>

                    <?php if( 'yes' == $multiselect_visibility ): 
                        $disabled = 'simple' != $product->get_type() ? 'disabled' : '';
                        ?>
                        <td class="multiple_items">
                            <input type="checkbox" name="cart_item_ids[]" value="<?php echo $product_id; ?>" <?php echo $disabled; ?>>
                            <input class="multiple_qty" type="hidden" name="multiple_qty[<?php echo $product_id; ?>]" value="1">
                        </td>
                    <?php endif ?>
                </tr> 
                <?php endwhile; wp_reset_query(); ?>

                <?php if ('top-btm-header' == $table_header ) : ?>
                    <tfoot>
                        <tr>
                            <?php $this->render_table_heading(); ?>
                        </tr> 
                    </tfoot> 
                <?php endif ?>

                 <?php else: 

                    echo '<p>' . __( 'No Product Found!', 'woolementor-pro' ) . '</p>';

                endif; ?>
                </table>
            </div>

            <?php if( 'yes' == $multiselect_visibility ): ?>
                <div class="multiselect-submit-div">
                    <?php wp_nonce_field( 'woolementor' ); ?>
                    <input type="hidden" name="action" value="multiple-product-add-to-cart">
                    
                    <?php 
                        printf( '<input %s type="submit" value="%s">',
                            $this->get_render_attribute_string( 'multiselect_submit_text' ),
                            esc_attr( $multiselect_submit_text )
                        );
                    ?>
                    
                    <a class="button multiselect-view-cart" href="<?php echo wc_get_cart_url(); ?>" ><?php _e( 'View Cart', 'woolementor-pro' ); ?></a>
                </div>
                </form>
            <?php endif; ?>

        </div>
        
        <?php 
        if ( 'yes' == $pagination_show_hide ): ?>
            <div class="wl-st-pagination">

            <?php 

            /**
            * woolementor pagination
            */
            woolementor_pagination( $products, $pagination_left_icon, $pagination_right_icon ); 
            ?>
            
            </div>
        <?php endif;

        /**
         * Load Script
         */
        $this->render_script();
    }

    private function render_editing_attributes() {
        $settings           = $this->get_settings_for_display();
        extract( $settings );

        $id_class = '';
        if ( is_array( $id_visibility ) && count( $id_visibility ) > 0 ) {
            $id_class = implode( ' ', (array)$id_visibility );
        }

        $img_class = '';
        if ( is_array( $image_visibility ) && count( $image_visibility ) > 0 ) {
            $img_class = implode( ' ', (array)$image_visibility );
        }

        $title_class = '';
        if ( is_array( $title_visibility ) && count( $title_visibility ) > 0 ) {
            $title_class = implode( ' ', (array)$title_visibility );
        }

        $category_class = '';
        if ( is_array( $category_visibility ) && count( $category_visibility ) > 0 ) {
            $category_class = implode( ' ', (array)$category_visibility );
        }

        $desc_class = '';
        if ( is_array( $short_desc_visibility ) && count( $short_desc_visibility ) > 0 ) {
            $desc_class = implode( ' ', (array)$short_desc_visibility );
        }

        $price_class = '';
        if ( is_array( $price_visibility ) && count( $price_visibility ) > 0 ) {
            $price_class = implode( ' ', (array)$price_visibility );
        }

        $action_class = '';
        if ( is_array( $action_visibility ) && count( $action_visibility ) > 0 ) {
            $action_class = implode( ' ', (array)$action_visibility );
        }

        $class = 'wl-st-table-header';

        $this->add_inline_editing_attributes( 'id_text', 'none' );
        $this->add_render_attribute( 'id_text', 'class', $class .' '. $id_class );

        $this->add_inline_editing_attributes( 'image_text', 'none' );
        $this->add_render_attribute( 'image_text', 'class', $class .' '. $img_class );

        $this->add_inline_editing_attributes( 'title_text', 'none' );
        $this->add_render_attribute( 'title_text', 'class', $class .' '. $title_class );

        $this->add_inline_editing_attributes( 'category_text', 'none' );
        $this->add_render_attribute( 'category_text', 'class', $class .' '. $category_class );

        $this->add_inline_editing_attributes( 'short_desc_text', 'none' );
        $this->add_render_attribute( 'short_desc_text', 'class', $class .' '. $desc_class );

        $this->add_inline_editing_attributes( 'price_text', 'none' );
        $this->add_render_attribute( 'price_text', 'class', $class .' '. $price_class );

        $this->add_inline_editing_attributes( 'action_text', 'none' );
        $this->add_render_attribute( 'action_text', 'class', $class . ' wl-st-action-panel' .' '. $action_class );

        $this->add_inline_editing_attributes( 'multiselect_text', 'none' );
        $this->add_render_attribute( 'multiselect_text', 'class', '' );

        $this->add_inline_editing_attributes( 'multiselect_submit_text', 'none' );
        $this->add_render_attribute( 'multiselect_submit_text', 'class', 'multiselect-submit' );
    }

    private function render_table_heading() {
        $settings = $this->get_settings_for_display();
        extract( $settings );

        printf( '<th %s>%s</th>',
            $this->get_render_attribute_string( 'id_text' ),
            esc_html( $id_text )
        );

        printf( '<th %s>%s</th>',
            $this->get_render_attribute_string( 'image_text' ),
            esc_html( $image_text )
        );

        printf( '<th %s>%s</th>',
            $this->get_render_attribute_string( 'title_text' ),
            esc_html( $title_text )
        );

        printf( '<th %s>%s</th>',
            $this->get_render_attribute_string( 'category_text' ),
            esc_html( $category_text )
        );

        printf( '<th %s>%s</th>',
            $this->get_render_attribute_string( 'short_desc_text' ),
            esc_html( $short_desc_text )
        );

        printf( '<th %s>%s</th>',
            $this->get_render_attribute_string( 'price_text' ),
            esc_html( $price_text )
        );

        printf( '<th %s>%s</th>',
            $this->get_render_attribute_string( 'action_text' ),
            esc_html( $action_text )
        );

        if( 'yes' == $multiselect_visibility ):

            printf( '<th %s>%s</th>',
                $this->get_render_attribute_string( 'multiselect_text' ),
                esc_html( $multiselect_text )
            );

        endif; 
    }

    protected function render_script() {
        ?>
        <script type="text/javascript">
            jQuery(function($){
                $('.wl-st-data-table').DataTable();
            })
        </script>
        <?php
    }

    protected function _content_template() {

    }

}