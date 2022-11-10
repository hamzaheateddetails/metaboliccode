<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class HTImg_marker_Elementor_Widget extends Widget_Base {

    public function get_name() {
        return 'htimg-marker-addons';
    }
    
    public function get_title() {
        return esc_html__( 'HT Image Marker', 'htimg-marker' );
    }

    public function get_icon() {
        return 'htimg-marker-icon eicon-post';
    }
    public function get_categories() {
        return [ 'general' ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'ht_image_marker_image_section',
            [
                'label' => esc_html__( 'Image', 'htimg-marker' ),
            ]
        );
            
            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'marker_bg_background',
                    'label' => esc_html__( 'Background', 'htimg-marker' ),
                    'types' => [ 'classic', 'gradient'],
                    'selector' => '{{WRAPPER}} .htimgmkr-marker-wrapper',
                ]
            );

            $this->add_control(
                'marker_bg_opacity_color',
                [
                    'label' => esc_html__( 'Opacity Color', 'htimg-marker' ),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .htimgmkr-marker-wrapper:before' => 'background-color: {{VALUE}}',
                    ],
                    'condition'=>[
                        'marker_bg_background_image[id]!'=>'',
                    ]
                ]
            );

        $this->end_controls_section(); // Marker Image Content section

        // Marker Content section
        $this->start_controls_section(
            'ht_image_marker_content_section',
            [
                'label' => esc_html__( 'Marker', 'htimg-marker' ),
            ]
        );
            $this->add_control(
                'marker_style',
                [
                    'label'   => esc_html__( 'Style', 'htimg-marker' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => '1',
                    'options' => [
                        '1'   => esc_html__( 'Style One', 'htimg-marker' ),
                        '2'   => esc_html__( 'Style Two', 'htimg-marker' ),
                        '3'   => esc_html__( 'Style Three', 'htimg-marker' ),
                        '4'   => esc_html__( 'Style Four', 'htimg-marker' ),
                        '5'   => esc_html__( 'Style Five', 'htimg-marker' ),
                    ],
                ]
            );

            $repeater = new Repeater();

            $repeater->add_control(
                'marker_title',
                [
                    'label'   => esc_html__( 'Marker Title', 'htimg-marker' ),
                    'type'    => Controls_Manager::TEXT,
                    'default' => esc_html__( 'Marker #1', 'htimg-marker' ),
                ]
            );

            $repeater->add_control(
                'marker_content',
                [
                    'label'   => esc_html__( 'Marker Content', 'htimg-marker' ),
                    'type'    => Controls_Manager::TEXTAREA,
                    'default' => esc_html__( 'Lorem ipsum pisaci volupt atem accusa saes ntisdumtiu loperm asaerks.', 'htimg-marker' ),
                ]
            );

            $repeater->add_control(
                'marker_x_position',
                [
                    'label' => esc_html__( 'X Postion', 'htimg-marker' ),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 66,
                        'unit' => '%',
                    ],
                    'range' => [
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .htimgmkr-marker-wrapper .htimgmkr_image_pointer{{CURRENT_ITEM}}' => 'left: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $repeater->add_control(
                'marker_y_position',
                [
                    'label' => esc_html__( 'Y Postion', 'htimg-marker' ),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 15,
                        'unit' => '%',
                    ],
                    'range' => [
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .htimgmkr-marker-wrapper .htimgmkr_image_pointer{{CURRENT_ITEM}}' => 'top: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'ht_image_marker_list',
                [
                    'type'    => Controls_Manager::REPEATER,
                    'fields'  => array_values( $repeater->get_controls() ),
                    'default' => [
                        [
                            'marker_title' => esc_html__( 'Marker #1', 'htimg-marker' ),
                            'marker_content' => esc_html__( 'Lorem ipsum pisaci volupt atem accusa saes ntisdumtiu loperm asaerks.','htimg-marker' ),
                            'marker_x_position' => [
                                'size' => 66,
                                'unit' => '%',
                            ],
                            'marker_y_position' => [
                                'size' => 15,
                                'unit' => '%',
                            ]
                        ]
                    ],
                    'title_field' => '{{{ marker_title }}}',
                ]
            );

        $this->end_controls_section();

        // Style Marker tab section
        $this->start_controls_section(
            'ht_image_marker_style_section',
            [
                'label' => esc_html__( 'Marker', 'htimg-marker' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_control(
                'ht_image_marker_color',
                [
                    'label'     => esc_html__( 'Color', 'htimg-marker' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htimgmkr-marker-wrapper .htimgmkr_image_pointer::before' => 'color: {{VALUE}};',
                    ],
                    'default'=>'#ed552d',
                    'separator' => 'before',
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'ht_image_marker_background',
                    'label' => esc_html__( 'Background', 'htimg-marker' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .htimgmkr-marker-wrapper .htimgmkr_image_pointer',
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'ht_image_marker_border',
                    'label' => esc_html__( 'Border', 'htimg-marker' ),
                    'selector' => '{{WRAPPER}} .htimgmkr-marker-wrapper .htimgmkr_image_pointer',
                ]
            );

            $this->add_responsive_control(
                'ht_image_marker_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'htimg-marker' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .htimgmkr-marker-wrapper .htimgmkr_image_pointer' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );

            $this->add_responsive_control(
                'ht_image_marker_padding',
                [
                    'label' => esc_html__( 'Padding', 'htimg-marker' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htimgmkr-marker-wrapper .htimgmkr_image_pointer' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section(); // End Marker style tab

        // Style Marker tab section
        $this->start_controls_section(
            'ht_image_marker_content_style_section',
            [
                'label' => esc_html__( 'Content', 'htimg-marker' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'ht_image_marker_content_area_background',
                    'label' => esc_html__( 'Background', 'htimg-marker' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .htimgmkr-marker-wrapper .htimgmkr_image_pointer .htimgmkr_pointer_box',
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'ht_image_marker_content_area_border',
                    'label' => esc_html__( 'Border', 'htimg-marker' ),
                    'selector' => '{{WRAPPER}} .htimgmkr-marker-wrapper .htimgmkr_image_pointer .htimgmkr_pointer_box',
                ]
            );

            $this->add_responsive_control(
                'ht_image_marker_content_area_border_radius',
                [
                    'label' => esc_html__( 'Content area border radius', 'htimg-marker' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .htimgmkr-marker-wrapper .htimgmkr_image_pointer .htimgmkr_pointer_box' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );

            $this->add_responsive_control(
                'ht_image_marker_content_area_padding',
                [
                    'label' => esc_html__( 'Content area padding', 'htimg-marker' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htimgmkr-marker-wrapper .htimgmkr_image_pointer .htimgmkr_pointer_box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->start_controls_tabs('ht_image_marker_content_style_tabs');
                
                // Style Title Tab start
                $this->start_controls_tab(
                    'style_title_tab',
                    [
                        'label' => esc_html__( 'Title', 'htimg-marker' ),
                    ]
                );
                    $this->add_control(
                        'ht_image_marker_title_color',
                        [
                            'label'     => esc_html__( 'Color', 'htimg-marker' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htimgmkr-marker-wrapper .htimgmkr_image_pointer .htimgmkr_pointer_box h4' => 'color: {{VALUE}};',
                            ],
                            'default'=>'#18012c',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Typography::get_type(),
                        [
                            'name' => 'ht_image_marker_title_typography',
                            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                            'selector' => '{{WRAPPER}} .htimgmkr-marker-wrapper .htimgmkr_image_pointer .htimgmkr_pointer_box h4',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'ht_image_marker_title_border',
                            'label' => esc_html__( 'Border', 'htimg-marker' ),
                            'selector' => '{{WRAPPER}} .htimgmkr-marker-wrapper .htimgmkr_image_pointer .htimgmkr_pointer_box h4',
                        ]
                    );

                    $this->add_responsive_control(
                        'ht_image_marker_title_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'htimg-marker' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .htimgmkr-marker-wrapper .htimgmkr_image_pointer .htimgmkr_pointer_box h4' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'ht_image_marker_title_margin',
                        [
                            'label' => esc_html__( 'Margin', 'htimg-marker' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .htimgmkr-marker-wrapper .htimgmkr_image_pointer .htimgmkr_pointer_box h4' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                $this->end_controls_tab(); // Style Title Tab end
                
                // Style Description Tab start
                $this->start_controls_tab(
                    'style_description_tab',
                    [
                        'label' => esc_html__( 'Description', 'htimg-marker' ),
                    ]
                );
                    
                    $this->add_control(
                        'ht_image_marker_description_color',
                        [
                            'label'     => esc_html__( 'Color', 'htimg-marker' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htimgmkr-marker-wrapper .htimgmkr_image_pointer .htimgmkr_pointer_box p' => 'color: {{VALUE}};',
                            ],
                            'default'=>'#18012c',
                            'separator' => 'before',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Typography::get_type(),
                        [
                            'name' => 'ht_image_marker_description_typography',
                            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                            'selector' => '{{WRAPPER}} .htimgmkr-marker-wrapper .htimgmkr_image_pointer .htimgmkr_pointer_box p',
                        ]
                    );

                    $this->add_responsive_control(
                        'ht_image_marker_description_margin',
                        [
                            'label' => esc_html__( 'Margin', 'htimg-marker' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .htimgmkr-marker-wrapper .htimgmkr_image_pointer .htimgmkr_pointer_box p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                $this->end_controls_tab(); // Style Description Tab end

            $this->end_controls_tabs();

        $this->end_controls_section(); // End Content style tab

    }

    protected function render( $instance = [] ) {

        $settings   = $this->get_settings_for_display();

        $this->add_render_attribute( 'htimgmkr_image_marker_attr', 'class', 'htimgmkr-marker-wrapper' );
        $this->add_render_attribute( 'htimgmkr_image_marker_attr', 'class', 'htimgmkr-marker-style-'.$settings['marker_style'] );
       
        ?>
            <div <?php echo $this->get_render_attribute_string('htimgmkr_image_marker_attr'); ?> >

                <?php
                    foreach ( $settings['ht_image_marker_list'] as $item ):
                    ?>
                        <div class="htimgmkr_image_pointer elementor-repeater-item-<?php echo esc_attr( $item['_id'] );?>">
                            <div class="htimgmkr_pointer_box">
                                <?php
                                    if( !empty( $item['marker_title'] ) ){
                                        echo '<h4>'.esc_html__( $item['marker_title'], 'htimg-marker' ).'</h4>';
                                    }
                                    if( !empty( $item['marker_content'] ) ){
                                        echo '<p>'.esc_html__( $item['marker_content'], 'htimg-marker' ).'</p>';
                                    }
                                ?>
                            </div>
                        </div>
                    <?php
                    endforeach;
                ?>   
            </div>
        <?php
    }
}

