<?php
namespace Elementor;

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Htqrcode_Elementor_Widget_QRCode extends Widget_Base {

    public function get_name() {
        return 'htqrcode-addons';
    }
    
    public function get_title() {
        return esc_html__( 'HT QR Code', 'ht-qrcode' );
    }

    public function get_icon() {
        return 'fas fa-qrcode';
    }

    public function get_categories() {
        return [ 'general' ];
    }
    protected function _register_controls() {
       

        $this->start_controls_section(
                'ht_qr_alignment',
                [
                    'label' => esc_html__( 'HT QR Code', 'ht-qrcode' ),
                    'tab' => Controls_Manager::TAB_CONTENT,
                ]
            );

            $this->add_control(
            'ht_qr_align',
                [
                    'label' => esc_html__( 'Alignment', 'ht-qrcode' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => esc_html__( 'Left', 'ht-qrcode' ),
                            'icon' => 'fa fa-align-left',
                        ],
                        'center' => [
                            'title' => esc_html__( 'Center', 'ht-qrcode' ),
                            'icon' => 'fa fa-align-center',
                        ],
                        'right' => [
                            'title' => esc_html__( 'Right', 'ht-qrcode' ),
                            'icon' => 'fa fa-align-right',
                        ],
                    ],
                    'default' => 'center',
                    'toggle' => true,
                ]
            );

            $this->add_control(
            'ht_qr_style_title',
                [
                    'label' => esc_html__( 'HT QR Code Style:', 'ht-qrcode' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_control(
            'ht_qr_hr_style_2',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_control(
                'ht_qr_style',
                [
                    'label' => esc_html__( 'QR Code Style:', 'ht-qrcode' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => '0',
                    'options' => [
                        '0' => esc_html__( '0. Custom', 'ht-qrcode' ),
                        '1' => esc_html__( '1. Normal', 'ht-qrcode' ),
                        '2' => esc_html__( '2. Color', 'ht-qrcode' ),
                        '3' => esc_html__( '3. Dot Scale', 'ht-qrcode' ),
                        '4' => esc_html__( '4. Position Color + Alignment Color', 'ht-qrcode' ),
                        '5' => esc_html__( '5. Position Color + Dot Scale', 'ht-qrcode' ),
                        '6' => esc_html__( '6. Timing + Dot Scale', 'ht-qrcode' ),
                        '7' => esc_html__( '7. Background Image', 'ht-qrcode' ),
                        '8' => esc_html__( '8. Auto Color + Background Image + Dot Scale', 'ht-qrcode' ),
                        '9' => esc_html__( '9. AutoColor + background Image Alpha', 'ht-qrcode' ),
                        '10' => esc_html__( '10. Logo + quietZone Color', 'ht-qrcode' ),
                        '11' => esc_html__( '11. Logo + Dot Scale', 'ht-qrcode' ),
                        '12' => esc_html__( '12. Logo + Colorful Style 1', 'ht-qrcode' ),
                        '13' => esc_html__( '13. Logo + Colorful Style 2', 'ht-qrcode' ),
                        '14' => esc_html__( '14. QuietZone + Logo + Background', 'ht-qrcode' ),
                    ],
                ]
            );
            
            $this->add_control(
            'ht_qr_text_options_title',
                [
                    'label' => esc_html__( 'QR Code Text:', 'ht-qrcode' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_control(
            'ht_qr_text_options_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_control(
                'ht_qr_code_text_style',
                [
                    'label' => esc_html__( 'Choose QR Code Category:', 'ht-qrcode' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'text',
                    'options' => [
                        'text' => esc_html__( 'Text', 'ht-qrcode' ),
                        'url' => esc_html__( 'URL', 'ht-qrcode' ),
                        'current-page-url' => esc_html__( 'Current Page URL', 'ht-qrcode' ),
                        'sms' => esc_html__( 'Send SMS', 'ht-qrcode' ),
                        'ph_number' => esc_html__( 'Mobile Number', 'ht-qrcode' ),
                        'email' => esc_html__( 'Email Address', 'ht-qrcode' ),
                        'skype' => esc_html__( 'Skype Call', 'ht-qrcode' ),
                        'maps' => esc_html__( 'Google Maps Location', 'ht-qrcode' ),
                        'g_talk' => esc_html__( 'Google Talk Client', 'ht-qrcode' ),
                        'wifi' => esc_html__( 'WiFi Access', 'ht-qrcode' ),
                        'contact_info' => esc_html__( 'Contact Information', 'ht-qrcode' ),
                    ],
                ]
            );


            $this->add_control(
                'ht_custom_qrcode_text_1',
                [
                    'label' => esc_html__( 'Text Here:', 'ht-qrcode' ),
                    'type' => Controls_Manager::TEXTAREA,
                    'rows' => 3,
                    'placeholder' => esc_html__( 'Type your URL or Text here.', 'ht-qrcode' ),
                    'condition' =>[
                        'ht_qr_code_text_style' => 'text',
                    ],
                ]
            );

            $this->add_control(
                'ht_qrcode_contact_name',
                [
                    'label' => esc_html__( 'Name:', 'ht-qrcode' ),
                    'type' => Controls_Manager::TEXT,
                    'condition' =>[
                        'ht_qr_code_text_style' => 'contact_info',
                    ],
                ]
            );

            $this->add_control(
                'ht_qrcode_contact_company',
                [
                    'label' => esc_html__( 'Company:', 'ht-qrcode' ),
                    'type' => Controls_Manager::TEXT,
                    'condition' =>[
                        'ht_qr_code_text_style' => 'contact_info',
                    ],
                ]
            );

            $this->add_control(
                'ht_qrcode_contact_title',
                [
                    'label' => esc_html__( 'Title:', 'ht-qrcode' ),
                    'type' => Controls_Manager::TEXT,
                    'condition' =>[
                        'ht_qr_code_text_style' => 'contact_info',
                    ],
                ]
            );

            $this->add_control(
                'ht_custom_qrcode_url',
                [
                    'label' => esc_html__( 'Custom URL:', 'ht-qrcode' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => 'https://',
                    'condition' =>[
                        'ht_qr_code_text_style' => 'url',
                    ],
                ]
            );

            $this->add_control(
                'ht_qrcode_mobile',
                [
                    'label' => esc_html__( 'Mobile Number:', 'ht-qrcode' ),
                    'type' => Controls_Manager::TEXT,
                    'condition' =>[
                        'ht_qr_code_text_style' => ['sms','ph_number','contact_info'],
                    ],
                ]
            );

            $this->add_control(
                'ht_qrcode_Phone',
                [
                    'label' => esc_html__( 'Phone Number:', 'ht-qrcode' ),
                    'type' => Controls_Manager::TEXT,
                    'condition' =>[
                        'ht_qr_code_text_style' => ['contact_info'],
                    ],
                ]
            );

            $this->add_control(
                'ht_qrcode_sms_massage',
                [
                    'label' => esc_html__( 'Message:', 'ht-qrcode' ),
                    'type' => Controls_Manager::TEXTAREA,
                    'rows' => 3,
                    'condition' =>[
                        'ht_qr_code_text_style' => 'sms',
                    ],
                ]
            );

            $this->add_control(
                'ht_qrcode_email',
                [
                    'label' => esc_html__( 'Email:', 'ht-qrcode' ),
                    'type' => Controls_Manager::TEXT,
                    'condition' =>[
                        'ht_qr_code_text_style' => ['email','g_talk','contact_info'],
                    ],
                ]
            );

            $this->add_control(
                'ht_qrcode_skype',
                [
                    'label' => esc_html__( 'Skype:', 'ht-qrcode' ),
                    'type' => Controls_Manager::TEXT,
                    'condition' =>[
                        'ht_qr_code_text_style' => 'skype',
                    ],
                ]
            );

            $this->add_control(
                'ht_qrcode_maps_latitude',
                [
                    'label' => esc_html__( 'Latitude:', 'ht-qrcode' ),
                    'type' => Controls_Manager::TEXT,
                    'condition' =>[
                        'ht_qr_code_text_style' => 'maps',
                    ],
                ]
            );

            $this->add_control(
                'ht_qrcode_maps_longitude',
                [
                    'label' => esc_html__( 'Longitude:', 'ht-qrcode' ),
                    'type' => Controls_Manager::TEXT,
                    'condition' =>[
                        'ht_qr_code_text_style' => 'maps',
                    ],
                ]
            );

            $this->add_control(
                'ht_qrcode_maps_query',
                [
                    'label' => esc_html__( 'Query:', 'ht-qrcode' ),
                    'type' => Controls_Manager::TEXT,
                    'condition' =>[
                        'ht_qr_code_text_style' => 'maps',
                    ],
                ]
            );

            $this->add_control(
                'ht_qrcode_wifi_ssid',
                [
                    'label' => esc_html__( 'SSID:', 'ht-qrcode' ),
                    'type' => Controls_Manager::TEXT,
                    'condition' =>[
                        'ht_qr_code_text_style' => 'wifi',
                    ],
                ]
            );

            $this->add_control(
                'ht_qrcode_wifi_password',
                [
                    'label' => esc_html__( 'Password:', 'ht-qrcode' ),
                    'type' => Controls_Manager::TEXT,
                    'condition' =>[
                        'ht_qr_code_text_style' => 'wifi',
                    ],
                ]
            );

            $this->add_control(
                'ht_qrcode_wifi_type',
                [
                    'label' => esc_html__( 'Network Type:', 'ht-qrcode' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'WEP',
                    'options' => [
                        'WEP' => esc_html__( 'WEP', 'ht-qrcode' ),
                        'WPA' => esc_html__( 'WPA/WPA2', 'ht-qrcode' ),
                    ],
                    'condition' =>[
                        'ht_qr_code_text_style' => 'wifi',
                    ],
                ]
            );

            $this->add_control(
                'ht_qrcode_contact_address',
                [
                    'label' => esc_html__( 'Address:', 'ht-qrcode' ),
                    'type' => Controls_Manager::TEXTAREA,
                    'rows' => 2,
                    'condition' =>[
                        'ht_qr_code_text_style' => 'contact_info',
                    ],
                ]
            );

            $this->add_control(
                'ht_qrcode_contact_website',
                [
                    'label' => esc_html__( 'Website:', 'ht-qrcode' ),
                    'type' => Controls_Manager::TEXT,
                    'condition' =>[
                        'ht_qr_code_text_style' => 'contact_info',
                    ],
                ]
            );

            $this->add_control(
                'ht_qrcode_contact_note',
                [
                    'label' => esc_html__( 'Node:', 'ht-qrcode' ),
                    'type' => Controls_Manager::TEXTAREA,
                    'rows' => 2,
                    'placeholder' => esc_html__( 'Note..', 'ht-qrcode' ),
                    'condition' =>[
                        'ht_qr_code_text_style' => 'contact_info',
                    ],
                ]
            );

            $this->add_control(
                'ht_qrcode_contact_encoding',
                [
                    'label' => esc_html__( 'Encoding:', 'ht-qrcode' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'VCARD',
                    'options' => [
                        'VCARD' => esc_html__( 'vCard', 'ht-qrcode' ),
                        'MECARD' => esc_html__( 'MECARD', 'ht-qrcode' ),
                    ],
                    'condition' =>[
                        'ht_qr_code_text_style' => 'contact_info',
                    ],
                ]
            );

            $this->add_control(
            'ht_qr_general_options_title',
                [
                    'label' => esc_html__( 'General Options:', 'ht-qrcode' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_control(
            'ht_qr_general_options_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_control(
            'ht_qr_size',
                [
                    'label' => esc_html__( 'QR Code Size:', 'ht-qrcode' ),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 50,
                    'max' => 600,
                    'step' => 50,
                    'default' => 300,
                    'placeholder' => esc_html__( 'Example: 300 ', 'ht-qrcode' ),
                ]
            );

            $this->add_control(
            'ht_qr_dot_scale',
                [
                    'label' => esc_html__( 'QR Code Dot Scale:', 'ht-qrcode' ),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 0.1,
                    'max' => 1,
                    'step' => 0.1,
                    'condition' =>[
                        'ht_qr_style' => ['0','3','4','5','6','7','8'],
                    ],
                ]
            );

            $this->add_control(
            'ht_qr_zone',
                [
                    'label' => esc_html__( 'QR Quiet Zone:', 'ht-qrcode' ),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 0,
                    'max' => 40,
                    'step' => 1,
                    'default' => 0,
                    'condition' =>[
                        'ht_qr_style' => '0',
                    ],
                ]
            );

            $this->add_control(
            'ht_qr_zone_color',
                [
                    'label' => esc_html__( 'QR Quiet Zone Color:', 'ht-qrcode' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => "#FFFFFF",
                    'condition' =>[
                        'ht_qr_style' => '0',
                    ],
                ]
            );
            

            $this->add_control(
                'ht_qr_ec_level',
                [
                    'label' => esc_html__( 'QR EC Level', 'ht-qrcode' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'L',
                    'options' => [
                        'L'  => esc_html__( 'Low', 'ht-qrcode' ),
                        'M' => esc_html__( 'Medium ', 'ht-qrcode' ),
                        'Q' => esc_html__( 'Quartile', 'ht-qrcode' ),
                        'H' => esc_html__( 'High', 'ht-qrcode' ),
                    ],
                ]
            );

            $this->add_control(
            'ht_qr_more_options_logo',
                [
                    'label' => esc_html__( 'QR Code Image', 'ht-qrcode' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                    'condition' =>[
                        'ht_qr_style' => ['0','7','8','9','10','11','12','13','14']
                    ],
                ]
            );

            $this->add_control(
            'ht_qr_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_control(
            'ht_qr_logo',
                [
                    'label' => esc_html__( 'Choose Logo', 'ht-qrcode' ),
                    'type' => Controls_Manager::MEDIA,
                    'default' => [
                    'url' => HTQRCODE_PL_URL."assets/img/logo.png",
                    ],
                    'condition' =>[
                        'ht_qr_style' => ['0','8','9','10','11','12','13','14']
                    ],
                ]
            );

            $this->add_control(
            'ht_qr_logo_size',
                [
                    'label' => esc_html__( 'Logo size: (Max Size 100px)', 'ht-qrcode' ),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 1,
                    'max' => 100,
                    'step' => 1,
                    'default' => 50,
                    'condition' =>[
                        'ht_qr_style' => ['0','8','9','10','11','12','13','14']
                    ],
                ]
            );

            $this->add_control(
                'ht_qr_logo_bg_transparent',
                [
                    'label' => esc_html__( 'Background Transparent', 'ht-qrcode' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'true',
                    'options' => [
                        'true'  => esc_html__( 'True', 'ht-qrcode' ),
                        'false' => esc_html__( 'False ', 'ht-qrcode' ),
                    ],
                    'condition' =>[
                        'ht_qr_style' => ['0','8','9','10','11','12','13','14']
                    ],
                    
                ]
            );

            $this->add_control(
            'ht_qr_logo_bg_color',
                [
                    'label' => esc_html__( 'Logo Background Color', 'ht-qrcode' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => "#ffffff",
                    'condition' =>[
                        'ht_qr_logo_bg_transparent' => 'false',
                        'ht_qr_style' => ['0','8','9','10','11','12','13','14']
                    ],
                ]
            );

            $this->add_control(
            'ht_qr_bg_image',
                [
                    'label' => esc_html__( 'Choose Background Image:', 'ht-qrcode' ),
                    'type' => Controls_Manager::MEDIA,
                    'default' => [
                        'url' => HTQRCODE_PL_URL."assets/img/background_logo.png",
                    ],
                    'condition' =>[
                        'ht_qr_style' => ['0','7','8','9','10','14']
                    ],
                ]
            );
            
             $this->add_control(
            'ht_qr_bg_opacity',
                [
                    'label' => esc_html__( 'Background Image Opacity:', 'ht-qrcode' ),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 0.1,
                    'max' => 1,
                    'step' => 0.1,
                    'placeholder' => esc_html__( '1', 'ht-qrcode' ),
                    'condition' =>[
                        'ht_qr_style' => ['0','7','8','9','10','14']
                    ],
                ]
            );

            $this->add_control(
                'ht_qr_bg_autocolor',
                [
                    'label' => esc_html__( 'Background Auto Color:', 'ht-qrcode' ),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'true'  => esc_html__( 'True', 'ht-qrcode' ),
                        'false' => esc_html__( 'False ', 'ht-qrcode' ),
                    ],
                    'condition' =>[
                        'ht_qr_style' => ['0','7','8','10']
                    ],

                ]
            );

            /*
            * QR code Style
            */
            $this->add_control(
            'more_options_style',
                [
                    'label' => esc_html__( 'QR Code Style', 'ht-qrcode' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                    'condition' =>[
                        'ht_qr_style' => ['0','3','4','7'],
                    ],
                ]
            );

            $this->add_control(
            'ht_qr_hr_style',
                [
                    'type' => Controls_Manager::DIVIDER,
                    'condition' =>[
                        'ht_qr_style' => ['0','3','4','7'],
                    ],
                ]
            );

            $this->add_control(
            'ht_qr_colordark_dot',
                [
                    'label' => esc_html__( 'QR Dot Color:', 'ht-qrcode' ),
                    'type' => Controls_Manager::COLOR,                    
                    'condition' =>[
                        'ht_qr_style' => ['0','2','3','4','5','6','7','8'],
                    ],
                ]
            );

            $this->add_control(
            'ht_qr_colorlight_bg',
                [
                    'label' => esc_html__( 'Background Color:', 'ht-qrcode' ),
                    'type' => Controls_Manager::COLOR,
                    'condition' =>[
                        'ht_qr_style' => ['0','2']
                    ],

                ]
            );

            /*
            * Pasotion Pattern Global Color:
            */
             $this->add_control(
            'ht_pattern_global_style',
                [
                    'label' => esc_html__( 'Pasotion Pattern Global Style', 'ht-qrcode' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                    'condition' =>[
                        'ht_qr_style' => ['0','4','5'],
                    ],
                ]
            );

            $this->add_control(
            'ht_qr_hr_pattern_global_style',
                [
                    'type' => Controls_Manager::DIVIDER,
                    'condition' =>[
                        'ht_qr_style' => ['0','4','5'],
                    ],
                ]
            );

            $this->add_control(
            'ht_qr_po',
                [
                    'label' => esc_html__( 'Pattern Outer Global Color:', 'ht-qrcode' ),
                    'type' => Controls_Manager::COLOR,
                    'condition' =>[
                        'ht_qr_style' => ['0','4','5','8'],
                    ],
                ]
            );

            $this->add_control(
            'ht_qr_pi',
                [
                    'label' => esc_html__( 'Pattern Inner Global Color:', 'ht-qrcode' ),
                    'type' => Controls_Manager::COLOR,
                    'condition' =>[
                        'ht_qr_style' => ['0','4','5','8'],
                    ],
                ]
            );

            /*
            * Pasotion Pattern Individual Color:
            */
             $this->add_control(
            'ht_pattern_individual_style',
                [
                    'label' => esc_html__( 'Pasotion Pattern Individual Style', 'ht-qrcode' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                    'condition' =>[
                        'ht_qr_style' => ['0','5'],
                    ],
                ]
            );

            $this->add_control(
            'ht_qr_hr_pattern_individual_style',
                [
                    'type' => Controls_Manager::DIVIDER,
                    'condition' =>[
                        'ht_qr_style' => ['0','5'],
                    ],
                ]
            );

            $this->add_control(
            'ht_qr_po_tl',
                [
                    'label' => esc_html__( 'Pattern Outer Top Left Color:', 'ht-qrcode' ),
                    'type' => Controls_Manager::COLOR,
                    'condition' =>[
                        'ht_qr_style' => ['0','5'],
                    ],
                ]
            );

            $this->add_control(
            'ht_qr_pi_tl',
                [
                    'label' => esc_html__( 'Pattern Inner Top Left Color:', 'ht-qrcode' ),
                    'type' => Controls_Manager::COLOR,
                    'condition' =>[
                        'ht_qr_style' => ['0','5'],
                    ],
                ]
            );

            $this->add_control(
            'ht_qr_po_tr',
                [
                    'label' => esc_html__( 'Pattern Outer Top Right Color:', 'ht-qrcode' ),
                    'type' => Controls_Manager::COLOR,
                    'condition' =>[
                        'ht_qr_style' => '0',
                    ],
                ]
            );

            $this->add_control(
            'ht_qr_pi_tr',
                [
                    'label' => esc_html__( 'Pattern Inner Top Right Color:', 'ht-qrcode' ),
                    'type' => Controls_Manager::COLOR,
                    'condition' =>[
                        'ht_qr_style' => '0',
                    ],
                ]
            );

            $this->add_control(
            'ht_qr_po_bl',
                [
                    'label' => esc_html__( 'Pattern Outer Bottom Color:', 'ht-qrcode' ),
                    'type' => Controls_Manager::COLOR,
                    'condition' =>[
                        'ht_qr_style' => '0',
                    ],
                ]
            );

            $this->add_control(
            'ht_qr_pi_bl',
                [
                    'label' => esc_html__( 'Pattern Inner Bottom Color:', 'ht-qrcode' ),
                    'type' => Controls_Manager::COLOR,
                    'condition' =>[
                        'ht_qr_style' => '0',
                    ],
                ]
            );

            /*
            *  Aligment color
            */
            $this->add_control(
            'ht_qr_hr_aligment_style',
                [
                    'type' => Controls_Manager::DIVIDER,
                    'condition' =>[
                        'ht_qr_style' => '0',
                    ],
                ]
            );

            $this->add_control(
            'ht_qr_ao',
                [
                    'label' => esc_html__( 'Aligment Outer Color:', 'ht-qrcode' ),
                    'type' => Controls_Manager::COLOR,
                    'condition' =>[
                        'ht_qr_style' => ['0','4'],
                    ],
                ]
            );

            $this->add_control(
            'ht_qr_ai',
                [
                    'label' => esc_html__( 'Aligment Inner Color:', 'ht-qrcode' ),
                    'type' => Controls_Manager::COLOR,
                    'condition' =>[
                        'ht_qr_style' => ['0','4'],
                    ],
                ]
            );

            /*
            *  Timing Pattern Color
            */
             $this->add_control(
            'ht_timing_pattern_style',
                [
                    'label' => esc_html__( 'Timing Pattern Style (Global & Individual)', 'ht-qrcode' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                    'condition' =>[
                        'ht_qr_style' => ['0','6'],
                    ],
                ]
            );

            $this->add_control(
            'ht_qr_hr_timing_style_1',
                [
                    'type' => Controls_Manager::DIVIDER,
                    'condition' =>[
                        'ht_qr_style' => ['0','6'],
                    ],
                ]
            );

            $this->add_control(
            'ht_qr_timing',
                [
                    'label' => esc_html__( 'Timing Global Color:', 'ht-qrcode' ),
                    'type' => Controls_Manager::COLOR,
                    'condition' =>[
                        'ht_qr_style' => '0',
                    ],
                ]
            );

            $this->add_control(
            'ht_qr_timing_h',
                [
                    'label' => esc_html__( 'Timing Horizontal Color:', 'ht-qrcode' ),
                    'type' => Controls_Manager::COLOR,
                    'condition' =>[
                        'ht_qr_style' => ['0','6'],
                    ],
                ]
            );

            $this->add_control(
            'ht_qr_timing_v',
                [
                    'label' => esc_html__( 'Timing Vertical Color:', 'ht-qrcode' ),
                    'type' => Controls_Manager::COLOR,
                    'condition' =>[
                        'ht_qr_style' => ['0','6'],
                    ],
                ]
            );

        $this->end_controls_section();

        $this->start_controls_section(
        'ht_qrcode_print',
            [
                'label' => esc_html__( 'Print Button Option', 'ht-qrcode' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

            $this->add_control(
                'ht_qr_print_button',
                [
                    'label' => esc_html__( 'Print Button:', 'ht-qrcode' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'true',
                    'options' => [
                        'true'  => esc_html__( 'Enable', 'ht-qrcode' ),
                        'false' => esc_html__( 'Disable ', 'ht-qrcode' ),
                    ],
                ]
            );

            $this->add_control(
                'ht_qrcode_print_button_txt',
                [
                    'label' => esc_html__( 'Print Button Text:', 'ht-qrcode' ),
                    'type' => Controls_Manager::TEXT,
                    'placeholder' => esc_html__( 'Button Text Here.', 'ht-qrcode' ),
                    'condition' =>[
                        'ht_qr_print_button' => 'true',
                    ],
                ]
            );

            $this->start_controls_tabs(
                'print_tabs',
                [
                    'condition' =>[
                        'ht_qr_print_button' => 'true',
                    ],
                ]
                
            );

                $this->start_controls_tab(
                    'print_normal_tab',
                    [
                        'label' => esc_html__( 'Normal', 'ht-qrcode' ),
                    ]
                );

                    $this->add_control(
                        'ht_qr_print_button_bg_color',
                        [
                            'label'     => esc_html__( 'Button background color', 'ht-qrcode' ),
                            'type'      => Controls_Manager::COLOR,
                            'scheme'    => [
                                'type'  => Scheme_Color::get_type(),
                                'value' => Scheme_Color::COLOR_1,
                            ],
                            'default' => esc_html__( '#28a745', 'ht-qrcode' ),
                            'selectors' 	=> [
                                '{{WRAPPER}} a.htqr-btn.htqr-btn-print' => 'background-color: {{VALUE}}',
                            ],
                            'condition' =>[
                                'ht_qr_print_button' => 'true',
                            ],
                        ]
                    );

                    $this->add_control(
                        'ht_qr_print_button_txt_color',
                        [
                            'label'     => esc_html__( 'Button Text color', 'ht-qrcode' ),
                            'type'      => Controls_Manager::COLOR,
                            'scheme'    => [
                                'type'  => Scheme_Color::get_type(),
                                'value' => Scheme_Color::COLOR_1,
                            ],
                            'default' => esc_html__( '#ffffff', 'ht-qrcode' ),
                            'selectors' 	=> [
                                '{{WRAPPER}} a.htqr-btn.htqr-btn-print' => 'color: {{VALUE}} !important',
                            ],
                            'condition' =>[
                                'ht_qr_print_button' => 'true',
                            ],
                        ]
                    );

                    $this->add_control(
                        'ht_qr_print_button_boder_color',
                        [
                            'label'     => esc_html__( 'Button border color', 'ht-qrcode' ),
                            'type'      => Controls_Manager::COLOR,
                            'scheme'    => [
                                'type'  => Scheme_Color::get_type(),
                                'value' => Scheme_Color::COLOR_1,
                            ],
                            'default' => esc_html__( '#28a745', 'ht-qrcode' ),
                            'selectors' => [
                                '{{WRAPPER}} a.htqr-btn.htqr-btn-print' => 'border-color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Typography::get_type(),
                        [
                            'name'      => 'ht_qrcode_print_btn_typography',
                            'scheme'    => Scheme_Typography::TYPOGRAPHY_1,
                            'selector'  => '{{WRAPPER}} a.htqr-btn.htqr-btn-print',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name'      => 'ht_qr_print_button_border',
                            'label'     => esc_html__( 'Button Border', 'ht-qrcode' ),
                            'selector'  => '{{WRAPPER}} a.htqr-btn.htqr-btn-print, a.htqr-btn.htqr-btn-print::before',
                        ]
                    );
                    
                    $this->add_responsive_control(
                        'ht_qr_print_button_border_radius',
                        [
                            'label'     => esc_html__( 'Border Radius', 'ht-qrcode' ),
                            'type'      => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} a.htqr-btn.htqr-btn-print, a.htqr-btn.htqr-btn-print::before' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'ht_qr_print_button_buttonpadding',
                        [
                            'label'     => esc_html__( 'Padding', 'ht-qrcode' ),
                            'type'      => Controls_Manager::DIMENSIONS,
                            'size_units'=> [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} a.htqr-btn.htqr-btn-print' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'ht_qr_print_button_buttonmargin',
                        [
                            'label'         => esc_html__( 'Margin', 'ht-qrcode' ),
                            'type'          => Controls_Manager::DIMENSIONS,
                            'size_units'    => [ 'px', '%', 'em' ],
                            'selectors'     => [
                                '{{WRAPPER}} a.htqr-btn.htqr-btn-print' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                $this->end_controls_tab();

                // Hover tab for button
                $this->start_controls_tab(
                    'ht_qr_print_button_style_hover_tab',
                    [
                        'label' => esc_html__( 'Hover', 'ht-qrcode' ),
                    ]
                );

                    $this->add_control(
                        'ht_qr_print_button_hover_color',
                        [
                            'label'     => esc_html__( 'Button background color', 'ht-qrcode' ),
                            'type'      => Controls_Manager::COLOR,
                            'default' => esc_html__( '#218838', 'ht-qrcode' ),
                            'scheme'    => [
                                'type'  => Scheme_Color::get_type(),
                                'value' => Scheme_Color::COLOR_1,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} a.htqr-btn.htqr-btn-print:hover' => 'background-color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'ht_qr_print_button_bordercolor',
                        [
                            'label'     => esc_html__( 'Button border color', 'ht-qrcode' ),
                            'type'      => Controls_Manager::COLOR,
                            'default' => esc_html__( '#218838', 'ht-qrcode' ),
                            'scheme'    => [
                                'type'  => Scheme_Color::get_type(),
                                'value' => Scheme_Color::COLOR_1,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} a.htqr-btn.htqr-btn-print:hover, a.htqr-btn.htqr-btn-print:hover::before' => 'border-color: {{VALUE}};',
                            ],
                        ]
                    );

                $this->end_controls_tab();// End tab hover

            $this->end_controls_tabs();// tabs end

        $this->end_controls_section();

        $this->start_controls_section(
        'ht_qrcode_download',
            [
                'label' => esc_html__( 'Download Button Option', 'ht-qrcode' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

            $this->add_control(
                'ht_qrcode_download_button',
                [
                    'label' => esc_html__( 'Download Button:', 'ht-qrcode' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'true',
                    'options' => [
                        'true'  => esc_html__( 'Enable', 'ht-qrcode' ),
                        'false' => esc_html__( 'Disable ', 'ht-qrcode' ),
                    ],
                ]
            );

            $this->add_control(
                'ht_qrcode_download_button_txt',
                [
                    'label' => esc_html__( 'Download Button Text:', 'ht-qrcode' ),
                    'type' => Controls_Manager::TEXT,
                    'placeholder' => esc_html__( 'Button Text Here.', 'ht-qrcode' ),
                    'condition' =>[
                        'ht_qrcode_download_button' => 'true',
                    ],
                ]
            );


            $this->start_controls_tabs(
                'download_tabs',
                [
                    'condition' =>[
                        'ht_qrcode_download_button' => 'true',
                    ],
                ]
                
            );

                $this->start_controls_tab(
                    'download_normal_tab',
                    [
                        'label' => esc_html__( 'Normal', 'ht-qrcode' ),
                    ]
                );

                    $this->add_control(
                        'ht_qrcode_download_button_bg_color',
                        [
                            'label'     => esc_html__( 'Button background color', 'ht-qrcode' ),
                            'type'      => Controls_Manager::COLOR,
                            'scheme'    => [
                                'type'  => Scheme_Color::get_type(),
                                'value' => Scheme_Color::COLOR_1,
                            ],
                            'default' => esc_html__( '#286090', 'ht-qrcode' ),
                            'selectors' 	=> [
                                '{{WRAPPER}} a.qrcode-download.htqr-btn.htqr-btn-download' => 'background-color: {{VALUE}}',
                            ],
                            'condition' =>[
                                'ht_qrcode_download_button' => 'true',
                            ],
                        ]
                    );

                    $this->add_control(
                        'ht_qrcode_download_button_txt_color',
                        [
                            'label'     => esc_html__( 'Button Text color', 'ht-qrcode' ),
                            'type'      => Controls_Manager::COLOR,
                            'scheme'    => [
                                'type'  => Scheme_Color::get_type(),
                                'value' => Scheme_Color::COLOR_1,
                            ],
                            'default' => esc_html__( '#ffffff', 'ht-qrcode' ),
                            'selectors' 	=> [
                                '{{WRAPPER}} a.qrcode-download.htqr-btn.htqr-btn-download' => 'color: {{VALUE}} !important',
                            ],
                            'condition' =>[
                                'ht_qrcode_download_button' => 'true',
                            ],
                        ]
                    );

                    $this->add_control(
                        'ht_qrcode_download_button_boder_color',
                        [
                            'label'     => esc_html__( 'Button border color', 'ht-qrcode' ),
                            'type'      => Controls_Manager::COLOR,
                            'scheme'    => [
                                'type'  => Scheme_Color::get_type(),
                                'value' => Scheme_Color::COLOR_1,
                            ],
                            'default' => esc_html__( '#2e6da4', 'ht-qrcode' ),
                            'selectors' => [
                                '{{WRAPPER}} a.qrcode-download.htqr-btn.htqr-btn-download' => 'border-color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Typography::get_type(),
                        [
                            'name'      => 'ht_qrcode_btn_typography',
                            'scheme'    => Scheme_Typography::TYPOGRAPHY_1,
                            'selector'  => '{{WRAPPER}} a.qrcode-download.htqr-btn.htqr-btn-download',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name'      => 'ht_qrcode_download_button_border',
                            'label'     => esc_html__( 'Button Border', 'ht-qrcode' ),
                            'selector'  => '{{WRAPPER}} a.qrcode-download.htqr-btn.htqr-btn-download, a.qrcode-download.htqr-btn.htqr-btn-download::before',
                        ]
                    );
                    
                    $this->add_responsive_control(
                        'ht_qrcode_download_button_border_radius',
                        [
                            'label'     => esc_html__( 'Border Radius', 'ht-qrcode' ),
                            'type'      => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} a.qrcode-download.htqr-btn.htqr-btn-download, a.qrcode-download.htqr-btn.htqr-btn-download::before' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'ht_qrcode_download_button_buttonpadding',
                        [
                            'label'     => esc_html__( 'Padding', 'ht-qrcode' ),
                            'type'      => Controls_Manager::DIMENSIONS,
                            'size_units'=> [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} a.qrcode-download.htqr-btn.htqr-btn-download' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'ht_qrcode_download_button_buttonmargin',
                        [
                            'label'         => esc_html__( 'Margin', 'ht-qrcode' ),
                            'type'          => Controls_Manager::DIMENSIONS,
                            'size_units'    => [ 'px', '%', 'em' ],
                            'selectors'     => [
                                '{{WRAPPER}} a.qrcode-download.htqr-btn.htqr-btn-download' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                $this->end_controls_tab();

                // Hover tab for button
                $this->start_controls_tab(
                    'ht_qrcode_download_button_style_hover_tab',
                    [
                        'label' => esc_html__( 'Hover', 'ht-qrcode' ),
                    ]
                );

                    $this->add_control(
                        'ht_qrcode_download_button_hover_color',
                        [
                            'label'     => esc_html__( 'Button background color', 'ht-qrcode' ),
                            'type'      => Controls_Manager::COLOR,
                            'default' => esc_html__( '#337ab7', 'ht-qrcode' ),
                            'scheme'    => [
                                'type'  => Scheme_Color::get_type(),
                                'value' => Scheme_Color::COLOR_1,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} a.qrcode-download.htqr-btn.htqr-btn-download:hover' => 'background-color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'ht_qrcode_download_button_bordercolor',
                        [
                            'label'     => esc_html__( 'Button border color', 'ht-qrcode' ),
                            'type'      => Controls_Manager::COLOR,
                            'default' => esc_html__( '#204d74', 'ht-qrcode' ),
                            'scheme'    => [
                                'type'  => Scheme_Color::get_type(),
                                'value' => Scheme_Color::COLOR_1,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} a.qrcode-download.htqr-btn.htqr-btn-download:hover, a.qrcode-download.htqr-btn.htqr-btn-download:hover::before' => 'border-color: {{VALUE}};',
                            ],
                        ]
                    );

                $this->end_controls_tab();// End tab hover

            $this->end_controls_tabs();// tabs end

        $this->end_controls_section();
    }

    protected function render( $instance = [] ) {
        $settings = $this->get_settings_for_display();
  
        switch ($settings['ht_qr_code_text_style']) {
            case "text":
                $settings['ht_custom_qrcode_text'] = $settings['ht_custom_qrcode_text_1'];
                break;
            case "url":
                $settings['ht_custom_qrcode_text'] = $settings['ht_custom_qrcode_url'];
                break;
            case "current-page-url":
                $settings['ht_custom_qrcode_text'] = $settings['ht_custom_qrcode_text'] = get_permalink();
                break;
            case "sms":
                $settings['ht_custom_qrcode_text'] = "smsto:".$settings['ht_qrcode_mobile'].":".$settings['ht_qrcode_sms_massage'];
                break;
            case "ph_number":
                $settings['ht_custom_qrcode_text'] = "tel:".$settings['ht_qrcode_mobile'];
                break;
            case "email":
                $settings['ht_custom_qrcode_text'] = "mailto:".$settings['ht_qrcode_email'];
                break;
            case "skype":
                $settings['ht_custom_qrcode_text'] = "skype:".$settings['ht_qrcode_skype'];
                break;
            case "maps":
                $settings['ht_custom_qrcode_text'] = "geo:".$settings['ht_qrcode_maps_latitude'].",".$settings['ht_qrcode_maps_longitude']."?q=".$settings['ht_qrcode_maps_query'];
                break;
            case "g_talk":
                $settings['ht_custom_qrcode_text'] = "gtalk:query?<".$settings['ht_qrcode_email'].">";
                break;
            case "wifi":
                $settings['ht_custom_qrcode_text'] = "WIFI:S:".$settings['ht_qrcode_wifi_ssid'].";T:".$settings['ht_qrcode_wifi_type'].";P:".$settings['ht_qrcode_wifi_password'].";;";
                break;
            case "contact_info":
                 if($settings['ht_qrcode_contact_encoding'] == 'VCARD'){
                     $settings['ht_custom_qrcode_text'] = "BEGIN:VCARD\nVERSION:3.0\nN:".$settings['ht_qrcode_contact_name']."\nORG:".$settings['ht_qrcode_contact_company']."\nTITLE:".$settings['ht_qrcode_contact_title']."\nTEL:".$settings['ht_qrcode_mobile']."\nTEL:".$settings['ht_qrcode_Phone']."\nURL:".$settings['ht_qrcode_contact_website']."\nEMAIL:".$settings['ht_qrcode_email']."\nADR:".$settings['ht_qrcode_contact_address']."\nNOTE:".$settings['ht_qrcode_contact_note']."\nEND:VCARD";
                 }else{
                    $settings['ht_custom_qrcode_text'] = "MECARD:N:".$settings['ht_qrcode_contact_name'].";ORG:".$settings['ht_qrcode_contact_company'].";TEL:".$settings['ht_qrcode_mobile'].";TEL:".$settings['ht_qrcode_Phone'].";URL:".$settings['ht_qrcode_contact_website'].";EMAIL:".$settings['ht_qrcode_email'].";ADR:".$settings['ht_qrcode_contact_address'].";NOTE:".$settings['ht_qrcode_contact_title'].";;";
                 }
                break;
            
        }

        if( empty( $settings['ht_custom_qrcode_text'] ) ) { $settings['ht_custom_qrcode_text'] = get_permalink(); }
        if( empty( $settings['ht_qr_size'] )) { $settings['ht_qr_size'] = 300; }
        if( empty( $settings['ht_qr_logo_size'] ) ) { $settings['ht_qr_logo_size'] = 0; }
        if( empty( $settings['ht_qr_logo_bg_transparent'] ) ) { $settings['ht_qr_logo_bg_transparent'] = "true"; }
        if( empty( $settings['ht_qr_bg_autocolor'] ) ) { $settings['ht_qr_bg_autocolor'] = "false"; }
        if( empty( $settings['ht_qr_colordark_dot'])){ $settings['ht_qr_colordark_dot'] = ""; }
        if( empty( $settings['ht_qr_colorlight_bg'])){ $settings['ht_qr_colorlight_bg'] = ""; }
        if( empty( $settings['ht_qr_dot_scale'])){ $settings['ht_qr_dot_scale'] = 0; }
        if( empty( $settings['ht_qr_bg_opacity'])){ $settings['ht_qr_bg_opacity'] = 0; }
        if( empty( $settings['ht_qr_po'])){ $settings['ht_qr_po'] = ""; }
        if( empty( $settings['ht_qr_pi'])){ $settings['ht_qr_pi'] = ""; }
        if( empty( $settings['ht_qr_po_tl'])){ $settings['ht_qr_po_tl'] = ""; }
        if( empty( $settings['ht_qr_pi_tl'])){ $settings['ht_qr_pi_tl'] = ""; }
        if( empty( $settings['ht_qr_po_tr'])){ $settings['ht_qr_po_tr'] = ""; }
        if( empty( $settings['ht_qr_pi_tr'])){ $settings['ht_qr_pi_tr'] = ""; }
        if( empty( $settings['ht_qr_po_bl'])){ $settings['ht_qr_po_bl'] = ""; }
        if( empty( $settings['ht_qr_pi_bl'])){ $settings['ht_qr_pi_bl'] = ""; }
        if( empty( $settings['ht_qr_ao'])){ $settings['ht_qr_ao'] = ""; }
        if( empty( $settings['ht_qr_ai'])){ $settings['ht_qr_ai'] = ""; }
        if( empty( $settings['ht_qr_timing'])){ $settings['ht_qr_timing'] = ""; }
        if( empty( $settings['ht_qr_timing_h'])){ $settings['ht_qr_timing_h'] = ""; }
        if( empty( $settings['ht_qr_timing_v'])){ $settings['ht_qr_timing_v'] = ""; }
        if( empty( $settings['ht_qr_zone'])){ $settings['ht_qr_zone'] = 0; }
        if( empty( $settings['ht_qr_zone_color'])){ $settings['ht_qr_zone_color'] = "ffffff"; }  



        switch ($settings['ht_qr_style']) {
            case "0":
                if( empty( $settings['ht_qr_dot_scale'] ) ) { $settings['ht_qr_dot_scale'] = 1; }
                if( empty( $settings['ht_qr_colordark_dot'] ) ) { $settings['ht_qr_colordark_dot'] = "#000000"; }
                if( empty( $settings['ht_qr_colorlight_bg'] ) ) { $settings['ht_qr_colorlight_bg'] = "#ffffff"; }
                if( empty( $settings['ht_qr_bg_opacity'] ) ) { $settings['ht_qr_bg_opacity'] = 1; }
                if( empty($settings['ht_qr_zone'])){$settings['ht_qr_zone'] = 0;}
                break;

            case "1":
                $settings['ht_qr_dot_scale'] = 1;
                $settings['ht_qr_logo']['url']= "";
                $settings['ht_qr_bg_image']['url'] = "";
                $settings['ht_qr_colordark_dot'] = "#000000";
                $settings['ht_qr_colorlight_bg'] ="#ffffff";
                if( empty( $settings['ht_qr_bg_opacity'] ) ) { $settings['ht_qr_bg_opacity'] = 0; }
                break;

            case "2":
                $settings['ht_qr_dot_scale'] = 1;
                if( empty( $settings['ht_qr_colordark_dot'] ) ){ $settings['ht_qr_colordark_dot'] = "#473C8B"; }
                if( empty( $settings['ht_qr_colorlight_bg'] ) ) { $settings['ht_qr_colorlight_bg'] = "#FFFACD"; }
                $settings['ht_qr_logo']['url'] = "";
                $settings['ht_qr_bg_image']['url'] = "";
                if( empty( $settings['ht_qr_bg_opacity'] ) ) { $settings['ht_qr_bg_opacity'] = 0; }
                break;

            case "3":
                if(empty($settings['ht_qr_dot_scale'])) { $settings['ht_qr_dot_scale'] = 0.4; }
                if(empty($settings['ht_qr_colordark_dot'])) { $settings['ht_qr_colordark_dot'] = "#000000"; }
                if(empty($settings['ht_qr_colorlight_bg'])) { $settings['ht_qr_colorlight_bg'] ="#ffffff"; }
                $settings['ht_qr_logo']['url'] = "";
                $settings['ht_qr_bg_image']['url'] = "";
                if( empty( $settings['ht_qr_bg_opacity'] ) ) { $settings['ht_qr_bg_opacity'] = 0; }
                break;

            case "4":
                if(empty($settings['ht_qr_dot_scale'])) { $settings['ht_qr_dot_scale'] = 1; }
                if(empty( $settings['ht_qr_colordark_dot'])) { $settings['ht_qr_colordark_dot'] = "#000000"; } 
                $settings['ht_qr_colorlight_bg'] ="#ffffff";
                $settings['ht_qr_logo']['url'] = "";
                $settings['ht_qr_bg_image']['url'] = "";
                if( empty( $settings['ht_qr_bg_opacity'] ) ) { $settings['ht_qr_bg_opacity'] = 0; }
                if( empty($settings['ht_qr_po'])) { $settings['ht_qr_po'] ="#269926"; }
                if( empty($settings['ht_qr_pi'])) { $settings['ht_qr_pi'] ="#BF3030"; }
                if( empty($settings['ht_qr_ao'])) { $settings['ht_qr_ao'] = "#B03060"; }
                if( empty($settings['ht_qr_ai'])) { $settings['ht_qr_ai'] = "#009ACD"; }
                break;

            case "5":
                if( empty($settings['ht_qr_dot_scale'])) { $settings['ht_qr_dot_scale'] = 0.4; }
                if( empty( $settings['ht_qr_colordark_dot'])) { $settings['ht_qr_colordark_dot'] = "#000000"; } 
                $settings['ht_qr_colorlight_bg'] = "#ffffff";
                $settings['ht_qr_logo']['url'] = "";
                $settings['ht_qr_bg_image']['url'] = "";
                if( empty( $settings['ht_qr_bg_opacity'] ) ) { $settings['ht_qr_bg_opacity'] = 0; }
                if( empty( $settings['ht_qr_pi'] )) { $settings['ht_qr_pi'] = "#f55066"; }
                if( empty( $settings['ht_qr_po_tl'] )) { $settings['ht_qr_po_tl'] = "#aa5b71"; }
                if( empty( $settings['ht_qr_pi_tl'] )) { $settings['ht_qr_pi_tl'] = "#b7d28d"; }

                break;

            case "6":
                if( empty($settings['ht_qr_dot_scale'])) { $settings['ht_qr_dot_scale'] = 0.4; }
                if( empty($settings['ht_qr_colordark_dot'])) { $settings['ht_qr_colordark_dot'] = "#000000"; }
                $settings['ht_qr_colorlight_bg'] = "#ffffff";
                $settings['ht_qr_logo']['url'] = "";
                $settings['ht_qr_bg_image']['url'] = "";
                if( empty( $settings['ht_qr_bg_opacity'] ) ) { $settings['ht_qr_bg_opacity'] = 0; }
                if( empty($settings['ht_qr_timing_h'])) { $settings['ht_qr_timing_h'] = "#e1622f"; }
                if( empty($settings['ht_qr_timing_v'])) { $settings['ht_qr_timing_v'] = "#00C12B"; }
                $settings['ht_qr_zone'] = 0;
                break;

            case "7":
                if( empty($settings['ht_qr_dot_scale'])) { $settings['ht_qr_dot_scale'] = 1; }
                if( empty($settings['ht_qr_bg_opacity'])) { $settings['ht_qr_bg_opacity'] = 1; }
                $settings['ht_qr_logo']['url'] = "";
                if(empty($settings['ht_qr_bg_autocolor'])){$settings['ht_qr_bg_autocolor'] = "false";}
                if( empty($settings['ht_qr_colordark_dot'])) { $settings['ht_qr_colordark_dot'] = "#000000"; }
                $settings['ht_qr_colorlight_bg'] = "#ffffff";
                break;

            case "8":
                if( empty($settings['ht_qr_dot_scale'])) {$settings['ht_qr_dot_scale'] = 0.5;}
                if( empty($settings['ht_qr_bg_opacity'])) {$settings['ht_qr_bg_opacity'] = 1;}
                if( empty($settings['ht_qr_bg_autocolor'])) {$settings['ht_qr_bg_autocolor'] = "true";}
                if( empty($settings['ht_qr_colordark_dot'])) { $settings['ht_qr_colordark_dot'] = "#000000"; }
                if( empty($settings['ht_qr_colorlight_bg'])) { $settings['ht_qr_colorlight_bg'] = "#ffffff"; }
                if( empty($settings['ht_qr_pi'])) { $settings['ht_qr_pi'] = "#f55066"; }
                break;

            case "9":
                $settings['ht_qr_dot_scale'] = 0.5;
                $settings['ht_qr_bg_opacity'] = 0.3;
                $settings['ht_qr_bg_autocolor'] = "true";
                $settings['ht_qr_colordark_dot'] = "#000000";
                $settings['ht_qr_colorlight_bg'] = "#ffffff";
                $settings['ht_qr_pi'] = "#f55066";
                break;

             case "10":
                $settings['ht_qr_dot_scale'] = 1;
                $settings['ht_qr_logo_bg_color'] = "ffffff";
                $settings['ht_qr_logo_bg_transparent'] = "false";
                $settings['ht_qr_bg_opacity'] = 1;
                $settings['ht_qr_colordark_dot'] = "#000000";
                $settings['ht_qr_colorlight_bg'] = "#ffffff";
                $settings['ht_qr_zone'] = 10;
                $settings['ht_qr_zone_color'] = "#00CED1";
                break;

            case "11":
                 $settings['ht_qr_colordark_dot'] = "#000000";
                $settings['ht_qr_colorlight_bg'] = "#ffffff";
                $settings['ht_qr_dot_scale'] = 0.5;
                $settings['ht_qr_bg_image']['url'] = "";
                $settings['ht_qr_bg_opacity'] = 1;
                $settings['ht_qr_bg_autocolor'] = "false";
                $settings['ht_qr_timing_v'] ="#00B2EE";
                break;

            case "12":
                 $settings['ht_qr_colordark_dot'] = "#27408B";
                $settings['ht_qr_colorlight_bg'] = "#FFF8DC";
                $settings['ht_qr_dot_scale'] = 0.5;
                $settings['ht_qr_bg_image']['url'] = "";
                $settings['ht_qr_bg_opacity'] = 1;
                $settings['ht_qr_bg_autocolor'] = "false";
                $settings['ht_qr_po'] = "#e1622f";
                $settings['ht_qr_pi'] = "#aa5b71";
                $settings['ht_qr_pi_tl'] = "#b7d28d";
                $settings['ht_qr_po_tr'] = "#aa5b71";
                $settings['ht_qr_pi_tr'] = "#c17e61";
                $settings['ht_qr_timing_h'] ="#ff6600";
                $settings['ht_qr_timing_v'] ="#cc0033";
                break;

             case "13":
                 $settings['ht_qr_colordark_dot'] = "#000000";
                $settings['ht_qr_colorlight_bg'] = "#FFFACD";
                $settings['ht_qr_dot_scale'] = 0.5;
                $settings['ht_qr_bg_image']['url'] = "";
                $settings['ht_qr_bg_opacity'] = 1;
                $settings['ht_qr_bg_autocolor'] = "false";
                $settings['ht_qr_po'] = "#e1622f";
                $settings['ht_qr_pi'] = "#aa5b71";
                $settings['ht_qr_po_tl'] = "#aa5b71";
                $settings['ht_qr_pi_tl'] = "#b7d28d";
                $settings['ht_qr_pi_tr'] = "#c17e61";
                $settings['ht_qr_ao'] = "#27408B";
                $settings['ht_qr_ai'] = "#7D26CD";
                $settings['ht_qr_timing_h'] ="#ff6600";
                $settings['ht_qr_timing_v'] ="#cc0033";
                break;

            case "14":
                $settings['ht_qr_colordark_dot'] = "#000000";
                $settings['ht_qr_colorlight_bg'] = "#FFF8DC";
                $settings['ht_qr_dot_scale'] = 0.7;
                $settings['ht_qr_bg_opacity'] = 0.1;
                $settings['ht_qr_bg_autocolor'] = "false";
                $settings['ht_qr_po'] = "#e1622f";
                $settings['ht_qr_pi'] = "#aa5b71";
                $settings['ht_qr_po_tl'] = "#aa5b71";
                $settings['ht_qr_pi_tl'] = "#b7d28d";
                $settings['ht_qr_pi_tr'] = "#c17e61";
                $settings['ht_qr_ao'] = "#27408B";
                $settings['ht_qr_ai'] = "#7D26CD";
                $settings['ht_qr_timing_h'] ="#ff6600";
                $settings['ht_qr_timing_v'] ="#cc0033";
                $settings['ht_qr_zone'] = 30;
                $settings['ht_qr_zone_color'] = "#00CED1";
                break;  
        }

        echo do_shortcode('[htqrcode alignment = "'.esc_attr_x( $settings['ht_qr_align'],'ht-qrcode' ).'" size = "'.esc_html__( $settings['ht_qr_size'],'ht-qrcode' ).'" dot_scale = "'.esc_html__( $settings['ht_qr_dot_scale'],'ht-qrcode' ).'" qr_level = "'.esc_html__( $settings['ht_qr_ec_level'],'ht-qrcode' ).'" logo = "'.esc_html__( $settings['ht_qr_logo']['url'],'ht-qrcode' ).'" logo_size = "'.esc_html__( $settings['ht_qr_logo_size'],'ht-qrcode' ).'" logo_bg_color = "'.esc_html__( $settings['ht_qr_logo_bg_color'],'ht-qrcode' ).'" logo_bg_transparent = "'.esc_html__( $settings['ht_qr_logo_bg_transparent'],'ht-qrcode' ).'" qr_bg_image ="'.esc_html__( $settings['ht_qr_bg_image']['url'],'ht-qrcode' ).'" qr_bg_opacity = "'.esc_html__( $settings['ht_qr_bg_opacity'],'ht-qrcode' ).'" qr_bg_autocolor = "'.esc_html__( $settings['ht_qr_bg_autocolor'],'ht-qrcode' ).'" colordark = "'.esc_html__( $settings['ht_qr_colordark_dot'],'ht-qrcode' ).'" colorlight = "'.esc_html__( $settings['ht_qr_colorlight_bg'],'ht-qrcode' ).'" po = "'.esc_html__( $settings['ht_qr_po'],'ht-qrcode' ).'" pi = "'.esc_html__( $settings['ht_qr_pi'],'ht-qrcode' ).'" po_tl = "'.esc_html__( $settings['ht_qr_po_tl'],'ht-qrcode' ).'" pi_tl = "'.esc_html__( $settings['ht_qr_pi_tl'],'ht-qrcode' ).'" po_tr = "'.esc_html__( $settings['ht_qr_po_tr'],'ht-qrcode' ).'" pi_tr = "'.esc_html__( $settings['ht_qr_pi_tr'],'ht-qrcode' ).'" po_bl = "'.esc_html__( $settings['ht_qr_po_bl'],'ht-qrcode' ).'" pi_bl = "'.esc_html__( $settings['ht_qr_pi_bl'],'ht-qrcode' ).'" ao = "'.esc_html__( $settings['ht_qr_ao'],'ht-qrcode' ).'" ai = "'.esc_html__( $settings['ht_qr_ai'],'ht-qrcode' ).'" timing = "'.esc_html__( $settings['ht_qr_timing'],'ht-qrcode' ).'" timing_h = "'.esc_html__( $settings['ht_qr_timing_h'],'ht-qrcode' ).'" timing_v = "'.esc_html__( $settings['ht_qr_timing_v'],'ht-qrcode' ).'" quietzone="'.esc_html__( $settings['ht_qr_zone'],'ht-qrcode' ).'" quietzonecolor = "'.esc_html__( $settings['ht_qr_zone_color'],'ht-qrcode' ).'" print = "'.esc_html__( $settings['ht_qr_print_button'],'ht-qrcode' ).'" print_btn_txt = "'.esc_html__( $settings['ht_qrcode_print_button_txt'],'ht-qrcode' ).'" download = "'.esc_html__( $settings['ht_qrcode_download_button'],'ht-qrcode' ).'" download_btn_txt = "'.esc_html__( $settings['ht_qrcode_download_button_txt'],'ht-qrcode' ).'"]'.esc_html__( $settings['ht_custom_qrcode_text'],'ht-qrcode' ).'[/htqrcode]' ); ?>

<?php
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new Htqrcode_Elementor_Widget_QRCode() );