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

class category extends Widget_Base {

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
                'label' => __( 'Layout', 'woolementor-pro' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

		$this->add_responsive_control(
            'columns',
            [
                'label'     => __( 'Columns', 'woolementor-pro' ),
                'type' 	    => Controls_Manager::SELECT2,
                'options'   => [
                    1 => __( '1 Column', 'woolementor-pro' ),
                    2 => __( '2 Columns', 'woolementor-pro' ),
                    3 => __( '3 Columns', 'woolementor-pro' ),
                    4 => __( '4 Columns', 'woolementor-pro' ),
                    6 => __( '6 Columns', 'woolementor-pro' ),
                ],
                'separator' 		=> 'before',
                'desktop_default' 	=> 3,
                'tablet_default' 	=> 2,
                'mobile_default' 	=> 1,
                'style_transfer' 	=> true,
            ]
        );

        $this->add_control(
			'alignment',
			[
				'label'		=> __( 'Content Layout', 'woolementor-pro' ),
				'type' 		=>Controls_Manager::CHOOSE,
				'options' 	=> [
					'left' 	=> [
						'title' 	=> __( 'Image Left', 'woolementor-pro' ),
						'icon' 		=> 'fa fa-align-left',
					],
					'full' 	=> [
						'title' 	=> __( 'Image Full Width', 'woolementor-pro' ),
						'icon' 		=> 'fa fa-arrows-alt',
					],
                    'right'     => [
                        'title'     => __( 'Image Right', 'woolementor-pro' ),
                        'icon'      => 'fa fa-align-right',
                    ],
				],
				'default' 	=> 'left',
                'toggle'    => false,
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
                'type'          => Controls_Manager::SELECT2,
                'default'       => 'name',
                'options'       => woolementor_order_options(),
            ]
        );

        $this->add_control(
            'hide_empty',
            [
                'label'         => __( 'Hide empty categories', 'woolementor-pro' ),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => __( 'Show', 'woolementor-pro' ),
                'label_off'     => __( 'Hide', 'woolementor-pro' ),
                'return_value'  => 'yes',
                'default'       => 'yes',
            ]
        );

        $this->add_control(
            'custom_query',
            [
                'label'         => __( 'Custom Query', 'woolementor-pro' ),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => __( 'Show', 'woolementor-pro' ),
                'label_off'     => __( 'Hide', 'woolementor-pro' ),
                'return_value'  => 'yes',
                'default'       => '',
            ]
        );

        $this->start_controls_tabs(
            'custom_query_controlls',
            [
                'condition'     => [
                    'custom_query' => 'yes'
                ],
            ]
        );

        $this->start_controls_tab(
            'custom_query_tab',
            [
                'label'     => __( 'Custom Query', 'woolementor-pro' ),
                
            ]
        );

        $this->add_control(
            'exclude',
            [
                'label'     => __( 'Exclude Category', 'woolementor-pro' ),
                'type'      => Controls_Manager::SELECT2,
                'options'   => woolementor_get_terms(),
                'multiple'  => true,
                'label_block' => true,
            ]
        );

        $parent_options = [ 0 => __( 'Only Top Level', 'woolementor-pro' ) ] + woolementor_get_terms();
        $this->add_control(
            'child_of',
            [
                'label'     => __( 'Parent Category', 'woolementor-pro' ),
                'description'    => __( 'Show only child categories of this category.', 'woolementor-pro' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => $parent_options,
                'multiple'  => true,
                'label_block' => true,
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
			'image_show_hide',
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
		 * Sale Ribbon controls
		 */
		$this->start_controls_section(
            'section_content_product_count',
            [
                'label' => __( 'Product Count', 'woolementor-pro' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
			'product_count',
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
		 * Category Style controls
		 */
		$this->start_controls_section(
            'style_section_box',
            [
                'label' => __( 'Card', 'woolementor-pro' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'widget_card_height',
            [
                'label'     => __( 'Card Height', 'woolementor-pro' ),
                'type'      => Controls_Manager::SLIDER,
                'size_units'=> [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .wl-category' => 'height: {{SIZE}}{{UNIT}}',
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
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 		=> 'widget_card_shadow',
				'label' 	=> __( 'Box Shadow', 'woolementor-pro' ),
				'selector' 	=> '{{WRAPPER}} .wl-category',
			]
		);

		$this->add_responsive_control(
			'widget_card_shadow_padding',
			[
				'label' 		=> __( 'Padding', 'woolementor-pro' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wl-category' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control(
            'widget_card_shadow_margin',
            [
                'label'         => __( 'Margin', 'woolementor-pro' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%', 'em' ],
                'selectors'     => [
                    '{{WRAPPER}} .wl-category' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs(
            'card_hover_section',
            [
                'separator' => 'before'
            ]
        );

        $this->start_controls_tab( 
            'card_normal',
            [
                'label'     => __( 'Normal', 'woolementor-pro' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'widget_card_background',
                'label'     => __( 'Background', 'woolementor-pro' ),
                'types'     => [ 'classic', 'gradient' ],
                'selector'  => '{{WRAPPER}} .wl-category',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'widget_card_border',
                'label'     => __( 'Border', 'woolementor-pro' ),
                'selector'  => '{{WRAPPER}} .wl-category',
                'separator' => 'before'
            ]
        );

        $this->end_controls_tab();
        $this->start_controls_tab( 
            'card_hover',
            [
                'label'     => __( 'Hover', 'woolementor-pro' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'widget_card_background_hover',
                'label'     => __( 'Background', 'woolementor-pro' ),
                'types'     => [ 'classic', 'gradient' ],
                'selector'  => '{{WRAPPER}} .wl-category:hover',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'widget_card_border_hover',
                'label'     => __( 'Border', 'woolementor-pro' ),
                'selector'  => '{{WRAPPER}} .wl-category:hover',
                'separator' => 'before'
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_responsive_control(
            'card_border_radius',
            [
                'label'         => __( 'Border Radius', 'woolementor-pro' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%', 'em' ],
                'selectors'     => [
                    '{{WRAPPER}} .wl-category' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

		$this->end_controls_section();

        /**
         * Category Image
         */
        $this->start_controls_section(
            'section_style_image',
            [
                'label' => __( 'Image', 'woolementor-pro' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'widget_image_height',
            [
                'label'     => __( 'Image Height', 'woolementor-pro' ),
                'type'      => Controls_Manager::SLIDER,
                'size_units'=> [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .wl-category .wl-ctgry-img.left img' => 'height: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} .wl-category .wl-ctgry-img.right img' => 'height: {{SIZE}}{{UNIT}}',
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
            'image_border_radius',
            [
                'label'         => __( 'Border Radius', 'woolementor-pro' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%', 'em' ],
                'selectors'     => [
                    '{{WRAPPER}} .wl-ctgry-img img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        /**
         * Category Title
         */
        $this->start_controls_section(
            'section_style_title',
            [
                'label' => __( 'Title', 'woolementor-pro' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'title_typography',
				'label' 	=> __( 'Typography', 'woolementor-pro' ),
				'scheme' 	=> Typography::TYPOGRAPHY_3,
				'selector' 	=> '{{WRAPPER}} .wl-ctgry-title',
			]
		);
        $this->start_controls_tabs(
            'title_hover_section',
            [
                'separator' => 'before'
            ]
        );

        $this->start_controls_tab( 
            'title_normal',
            [
                'label'     => __( 'Normal', 'woolementor-pro' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Gradient_Text::get_type(),
            [
                'name'      => 'title_color',
                'selector'  => '{{WRAPPER}} .wl-ctgry-title',
            ]
        );

        $this->end_controls_tab();
        $this->start_controls_tab( 
            'title_hover',
            [
                'label'     => __( 'Hover', 'woolementor-pro' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Gradient_Text::get_type(),
            [
                'name'      => 'title_color_hover',
                'selector'  => '{{WRAPPER}} .wl-ctgry-title:hover',
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();


        /**
         * Category Description
         */
        $this->start_controls_section(
            'section_style_count',
            [
                'label' => __( 'Product Count', 'woolementor-pro' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'desc_typography',
                'label'     => __( 'Typography', 'woolementor-pro' ),
                'scheme'    => Typography::TYPOGRAPHY_3,
                'selector'  => '{{WRAPPER}} .wl-ctgry-desc',
            ]
        );
        $this->start_controls_tabs(
            'desc_hover_section',
            [
                'separator' => 'before'
            ]
        );

        $this->start_controls_tab( 
            'desc_normal',
            [
                'label'     => __( 'Normal', 'woolementor-pro' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Gradient_Text::get_type(),
            [
                'name'      => 'desc_color',
                'selector'  => '{{WRAPPER}} .wl-ctgry-desc',
            ]
        );

        $this->end_controls_tab();
        $this->start_controls_tab( 
            'desc_hover',
            [
                'label'     => __( 'Hover', 'woolementor-pro' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Gradient_Text::get_type(),
            [
                'name'      => 'desc_color_hover',
                'selector'  => '{{WRAPPER}} .wl-ctgry-desc:hover',
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();

	}

	protected function render() {  

		$settings = $this->get_settings_for_display();        
        extract( $settings );

        $flex   = $alignment == 'full' ? '' : 'flex';
        $empty  = $hide_empty == 'yes' ? 1 : 0 ;

        $args   = array(
                'taxonomy'     => 'product_cat',
                'orderby'      => $orderby,
                'order'        => $order,
                'show_count'   => 1,
                'pad_counts'   => 0,
                'hierarchical' => 1,
                'title_li'     => '',
                'hide_empty'   => $empty,
         );
        
        if ( $custom_query == '' && is_tax() ) {
            $term       = get_queried_object();
            $term_id    = $term->term_id;
            $args['child_of'] = $term_id;
        }
        if ( !empty($exclude) ) {
            $args['exclude'] = $exclude;
        }

        if ( !is_null( $child_of ) && $child_of == 0 ) {
            $args['parent'] = $child_of;
        }
        else {
            $args['child_of'] = $child_of;
        }

        $categories = get_categories( $args );

        ?>

		<div class="wl-categories">
			<div class="cx-container">
				<?php foreach ($categories as $key => $category ): 
                    $thumb_id = get_term_meta( $category->term_id, 'thumbnail_id', true );
                    $term_img = wp_get_attachment_url(  $thumb_id );
                    $cat_url = get_category_link( $category->term_id );

                    if ( $thumb_id ) {
                        $img = $term_img;
                    }
                    else {
                       $img = wc_placeholder_img_src(); 
                    }
                    ?>
					<div class="cx-col-md-<?php echo esc_html( 12 / $columns ); ?> cx-col-sm-<?php echo esc_html( 12 / $columns_tablet ); ?> cx-col-xs-<?php echo esc_html( 12 / $columns_mobile ); ?>">
						<a href="<?php echo $cat_url; ?>">
                            <div class="wl-category <?php echo $flex; ?>">
                                <?php if( ('left' == $alignment || 'full' == $alignment) && 'yes' == $image_show_hide ): ?>
                                    <div class="wl-ctgry-img <?php echo $alignment; ?>">
                                        <img src="<?php echo $img; ?>">
                                    </div>
                                <?php endif; ?>
                                <div class="wl-ctgry-content <?php echo $alignment; ?>">
                                    <h5 class="wl-ctgry-title"><?php echo $category->name; ?></h5>
                                    <?php if( 'yes' == $product_count ): ?>
                                        <div class="wl-ctgry-desc">
                                            <?php 
                                            $product_text = $category->count <= 1 ? __( ' Product', 'woolementor-pro' ) : __( ' Products', 'woolementor-pro' );
                                            echo $category->count . $product_text; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <?php if( 'right' == $alignment && 'yes' == $image_show_hide ): ?>
                                    <div class="wl-ctgry-img <?php echo $alignment; ?>">
                                       <img src="<?php echo $img; ?>">
                                    </div>
                                <?php endif; ?>
                            </div>                  
                        </a>
					</div>
				<?php endforeach; ?>

			</div> 
		</div>
		<?php
	}
}