<?php

if ( !class_exists('htqrcode_default_widgets') ) {
    class htqrcode_default_widgets extends WP_Widget{

        function __construct(){
            $widget_options = array(
                'description'                   => esc_html__('HT QR Code', 'ht-qrcode'), 
                'customize_selective_refresh'   => true,
            );

            parent:: __construct(
                'htqrcode_default_widgets', 
                esc_html__( 'HT QR Code', 'ht-qrcode') );
        }
        /**
         * Front-end display of widget.
         *
         * @see WP_Widget::widget()
         *
         * @param array $args     Widget arguments.
         * @param array $instance Saved values from database.
         */
        public function widget($args, $instance){ 
            $title                  = isset( $instance['title'] ) ? $instance['title'] : ''; 
            $sub_title              = isset( $instance['sub_title'] ) ? $instance['sub_title'] : ''; 
            $alignment              = isset( $instance['alignment'] ) ? $instance['alignment'] : '';
            $qrcode                 = isset( $instance['qrcode'] ) ? $instance['qrcode'] : '';
            $size                   = isset( $instance['size'] ) ? $instance['size'] : '';
            $dot_scale              = isset( $instance['dot_scale'] ) ? $instance['dot_scale'] : '';
            $qr_level               = isset( $instance['qr_level'] ) ? $instance['qr_level'] : '';
            $logo                   = isset( $instance['logo'] ) ? $instance['logo'] : '';
            $logo_size              = isset( $instance['logo_size'] ) ? $instance['logo_size'] : '';
            $logo_bg_color          = isset( $instance['logo_bg_color'] ) ? $instance['logo_bg_color'] : '';
            $logo_bg_transparent    = isset( $instance['logo_bg_transparent'] ) ? $instance['logo_bg_transparent'] : '';
            $qr_bg_image            = isset( $instance['qr_bg_image'] ) ? $instance['qr_bg_image'] : '';
            $qr_bg_opacity          = isset( $instance['qr_bg_opacity'] ) ? $instance['qr_bg_opacity'] : '';
            $qr_bg_autocolor        = isset( $instance['qr_bg_autocolor'] ) ? $instance['qr_bg_autocolor'] : '';
            $colordark              = isset( $instance['colordark'] ) ? $instance['colordark'] : '';
            $colorlight             = isset( $instance['colorlight'] ) ? $instance['colorlight'] : '';
            $po                     = isset( $instance['po'] ) ? $instance['po'] : '';
            $pi                     = isset( $instance['pi'] ) ? $instance['pi'] : '';
            $po_tl                  = isset( $instance['po_tl'] ) ? $instance['po_tl'] : '';
            $pi_tl                  = isset( $instance['pi_tl'] ) ? $instance['pi_tl'] : '';
            $po_tr                  = isset( $instance['po_tr'] ) ? $instance['po_tr'] : '';
            $pi_tr                  = isset( $instance['pi_tr'] ) ? $instance['pi_tr'] : '';
            $po_bl                  = isset( $instance['po_bl'] ) ? $instance['po_bl'] : '';
            $pi_bl                  = isset( $instance['pi_bl'] ) ? $instance['pi_bl'] : '';
            $ai                     = isset( $instance['ai'] ) ? $instance['ai'] : '';
            $ao                     = isset( $instance['ao'] ) ? $instance['ao'] : '';
            $timing                 = isset( $instance['timing'] ) ? $instance['timing'] : '';
            $timing_h               = isset( $instance['timing_h'] ) ? $instance['timing_h'] : '';
            $timing_v               = isset( $instance['timing_v'] ) ? $instance['timing_v'] : '';
            $print                  = isset( $instance['print'] ) ? $instance['print'] : '';
            $print_btn_txt          = isset( $instance['print_btn_txt'] ) ? $instance['print_btn_txt'] : '';
            $download               = isset( $instance['download'] ) ? $instance['download'] : '';
            $download_btn_txt       = isset( $instance['download_btn_txt'] ) ? $instance['download_btn_txt'] : '';

            // Render Html
            echo $args['before_widget'];
                if ( !empty( $title ) ) { echo $args['before_title'] . esc_html( $title ) . $args['after_title']; }
                if ( !empty( $sub_title ) ) { echo '<p>'; echo esc_html( $sub_title ); echo '</p>'; }
                    if( empty( $qrcode )) { $qrcode = get_permalink(); }
                    if( empty( $size)) { $size = 300; }
                    if( empty( $dot_scale ) ) { $dot_scale = 1; }
                    if( empty( $logo_size ) ) { $logo_size = 0; }
                    if( empty( $colordark ) ) { $colordark = "#000000"; }
                    if( empty( $colorlight ) ) { $colorlight = "#ffffff"; }
                    if( empty( $qr_bg_opacity ) ) { $qr_bg_opacity = 0; }
                    if( empty( $qr_level ) ) { $qr_level = "L"; }
                    if( empty( $logo_bg_transparent ) ) { $logo_bg_transparent = "false"; }
                    if( empty( $qr_bg_autocolor ) ) { $qr_bg_autocolor = "true"; }
                    ?>

                    <div class="htinsta-widgets">
                        <?php echo do_shortcode( sprintf( '[htqrcode alignment ="%s" size = "%s" dot_scale = "%s" qr_level = "%s" logo = "%s" logo_size = "%s" logo_bg_color = "%s" logo_bg_transparent = "%s" qr_bg_image ="%s" qr_bg_opacity = "%s" qr_bg_autocolor = "%s" colordark = "%s" colorlight = "%s" po = "%s" pi = "%s" po_tl = "%s" pi_tl = "%s" po_tr = "%s" pi_tr = "%s" po_bl = "%s" pi_bl = "%s" ao = "%s" ai = "%s" timing = "%s" timing_h = "%s" timing_v = "%s" print = "%s" print_btn_txt = "%s" download = "%s" download_btn_txt = "%s"]%s[/htqrcode]', $alignment, $size, $dot_scale, $qr_level, $logo, $logo_size, $logo_bg_color, $logo_bg_transparent, $qr_bg_image, $qr_bg_opacity, $qr_bg_autocolor, $colordark, $colorlight, $po, $pi, $po_tl, $pi_tl, $po_tr,  $pi_tr, $po_bl, $pi_bl, $ao, $ai, $timing, $timing_h, $timing_v, $print, $print_btn_txt, $download, $download_btn_txt, $qrcode) ); ?>
                    </div>
            <?php echo $args['after_widget']; 
        }

        /**
         * Sanitize widget form values as they are saved.
         *
         * @see WP_Widget::update()
         *
         * @param array $new_instance Values just sent to be saved.
         * @param array $old_instance Previously saved values from database.
         *
         * @return array Updated safe values to be saved.
         */

        public function update( $new_instance, $old_instance ) {
            $instance = $old_instance;  
            $instance['title']                  =  strip_tags($new_instance['title']);
            $instance['sub_title']              =  strip_tags($new_instance['sub_title']);
            $instance['alignment']              =  strip_tags($new_instance['alignment']);
            $instance['qrcode']                 =  strip_tags($new_instance['qrcode']);
            $instance['size']                   =  strip_tags($new_instance['size']);
            $instance['dot_scale']              =  strip_tags($new_instance['dot_scale']);
            $instance['qr_level']               =  strip_tags($new_instance['qr_level']);
            $instance['logo']                   =  strip_tags($new_instance['logo']);
            $instance['logo_size']              =  strip_tags($new_instance['logo_size']);
            $instance['logo_bg_color']          =  strip_tags($new_instance['logo_bg_color']);
            $instance['logo_bg_transparent']    =  strip_tags($new_instance['logo_bg_transparent']);
            $instance['qr_bg_image']            =  strip_tags($new_instance['qr_bg_image']);
            $instance['qr_bg_opacity']          =  strip_tags($new_instance['qr_bg_opacity']);
            $instance['qr_bg_autocolor']        =  strip_tags($new_instance['qr_bg_autocolor']);
            $instance['colordark']              =  strip_tags($new_instance['colordark']);
            $instance['colorlight']             =  strip_tags($new_instance['colorlight']);
            $instance['po']                     =  strip_tags($new_instance['po']);
            $instance['pi']                     =  strip_tags($new_instance['pi']);
            $instance['po_tl']                  =  strip_tags($new_instance['po_tl']);
            $instance['pi_tl']                  =  strip_tags($new_instance['pi_tl']);
            $instance['po_tr']                  =  strip_tags($new_instance['po_tr']);
            $instance['pi_tr']                  =  strip_tags($new_instance['pi_tr']);
            $instance['po_bl']                  =  strip_tags($new_instance['po_bl']);
            $instance['pi_bl']                  =  strip_tags($new_instance['pi_bl']);
            $instance['ai']                     =  strip_tags($new_instance['ai']); 
            $instance['ao']                     =  strip_tags($new_instance['ao']);
            $instance['timing']                 =  strip_tags($new_instance['timing']);
            $instance['timing_h']               =  strip_tags($new_instance['timing_h']);
            $instance['timing_v']               =  strip_tags($new_instance['timing_v']); 
            $instance['print']                  =  strip_tags($new_instance['print']);
            $instance['print_btn_txt']          =  strip_tags($new_instance['print_btn_txt']);  
            $instance['download']               =  strip_tags($new_instance['download']);
            $instance['download_btn_txt']       =  strip_tags($new_instance['download_btn_txt']);  
            return $instance;
        }

        /**
         * Back-end widget form.
         *
         * @see WP_Widget::form()
         *
         * @param array $instance Previously saved values from database.
         */

        public function form( $instance ){ 

            $array_default = array(
  
                'title'                 => 'HT QR Code',
                'sub_title'             => '',
                'alignment'             => 'left',
                'qrcode'                => '',
                'size'                  => 300,
                'dot_scale'             => 1,
                'qr_level'              => 'L',
                'logo'                  => '',
                'logo_size'             => 50,
                'logo_bg_color'         => '#ffffff',
                'logo_bg_transparent'   => 'false',
                'qr_bg_image'           => '',
                'qr_bg_opacity'         => 0.5,
                'qr_bg_autocolor'       => 'true',
                'colordark'             => '#000000',
                'colorlight'            => '#ffffff',
                'po'                    => '#000000',
                'pi'                    => '#000000',
                'po_tl'                 => '#000000',
                'pi_tl'                 => '#000000',
                'po_tr'                 => '#000000',
                'pi_tr'                 => '#000000',
                'po_bl'                 => '#000000',
                'pi_bl'                 => '#000000',
                'ai'                    => '#000000',
                'ao'                    => '#000000',
                'timing'                => '#000000',
                'timing_h'              => '#000000',
                'timing_v'              => '#000000',
                'print'                 => 'true',
                'print_btn_txt'         => '',
                'download'              => 'true',
                'download_btn_txt'      => '',
            );
            $instance = wp_parse_args( (array) $instance, $array_default );
            ?>

            <p>
                <label for="<?php echo $this->get_field_id('title'); ?>"><?php echo esc_attr__('Enter Your Title:', 'ht-qrcode'); ?> </label>
                <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" placeholder="<?php echo esc_attr_x( 'Please enter your title here.', 'placeholder', 'ht-qrcode' ); ?>" />
            </p>
            
            <p>
                <label for="<?php echo $this->get_field_id('sub_title'); ?>"><?php echo esc_attr__('Sub Title:', 'ht-qrcode'); ?> </label>
                <textarea class="widefat" rows="2" cols="50" id="<?php echo $this->get_field_id('sub_title'); ?>" name="<?php echo $this->get_field_name('sub_title'); ?>" placeholder="<?php echo esc_attr_x( 'Please enter your sub title here.', 'placeholder', 'ht-qrcode' ); ?>"><?php echo esc_attr($instance['sub_title']); ?></textarea>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id('alignment'); ?>"><?php echo esc_attr__('QR Code Positions:', 'ht-qrcode'); ?> </label>
                <select class="widefat" id="<?php echo $this->get_field_id('alignment'); ?>" name="<?php echo $this->get_field_name('alignment'); ?>" value="<?php echo esc_attr($instance['alignment']); ?>" >
                  <option <?php selected( $instance['alignment'], 'left' ); ?> value="left"><?php echo esc_attr__('Left', 'ht-qrcode'); ?></option>
                  <option <?php selected( $instance['alignment'], 'center' ); ?> value="center" ><?php echo esc_attr__('Center', 'ht-qrcode'); ?></option>
                  <option <?php selected( $instance['alignment'], 'right' ); ?> value="right"><?php echo esc_attr__('Right', 'ht-qrcode'); ?></option>
                </select>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id('qrcode'); ?>"><?php echo esc_attr__('Please QR Code Text Here:', 'ht-qrcode'); ?> </label>
                <textarea class="widefat" rows="4" cols="50" id="<?php echo $this->get_field_id('qrcode'); ?>" name="<?php echo $this->get_field_name('qrcode'); ?>" placeholder="<?php echo esc_attr_x( 'If you do not enter any text or URL here, Then the default page URL QR code will be shown on this page.', 'placeholder', 'ht-qrcode' ); ?>"><?php echo esc_attr($instance['qrcode']); ?></textarea>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id('size'); ?>"><?php echo esc_attr__('QR Code Size:', 'ht-qrcode'); ?> </label>
                <input class="widefat" min="40" step="10" max="600" id="<?php echo $this->get_field_id('size'); ?>" name="<?php echo $this->get_field_name('size'); ?>" type="number" value="<?php echo esc_attr($instance['size']); ?>" placeholder="<?php echo esc_attr_x( 'Example: 200', 'placeholder', 'ht-qrcode' ); ?>"/>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id('dot_scale'); ?>"><?php echo esc_attr__('QR Code Dot Scale ( 0.1 to 1 ):', 'ht-qrcode'); ?> </label>
                <input class="widefat" min="0.1" step="0.1" max="1" id="<?php echo $this->get_field_id('dot_scale'); ?>" name="<?php echo $this->get_field_name('dot_scale'); ?>" type="number" value="<?php echo esc_attr($instance['dot_scale']); ?>" placeholder="<?php echo esc_attr_x( 'Example: 0.1 to 1', 'placeholder', 'ht-qrcode' ); ?>"/>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id('qr_level'); ?>"><?php echo esc_attr__('QR EC Level:', 'ht-qrcode'); ?> </label>
                <select class="widefat" id="<?php echo $this->get_field_id('qr_level'); ?>" name="<?php echo $this->get_field_name('qr_level'); ?>" value="<?php echo esc_attr($instance['qr_level']); ?>" >
                  <option <?php selected( $instance['qr_level'], 'L' ); ?> value="L"><?php echo esc_attr__('Low', 'ht-qrcode'); ?></option>
                  <option <?php selected( $instance['qr_level'], 'M' ); ?> value="M" ><?php echo esc_attr__('Medium', 'ht-qrcode'); ?></option>
                  <option <?php selected( $instance['qr_level'], 'Q' ); ?> value="Q"><?php echo esc_attr__('Quartile', 'ht-qrcode'); ?></option>
                  <option <?php selected( $instance['qr_level'], 'H' ); ?> value="H"><?php echo esc_attr__('High', 'ht-qrcode'); ?></option>
                </select>
            </p>
           
            <p>
                <label for="<?php echo $this->get_field_id('logo'); ?>"><?php echo esc_attr__('Choose QR Code Logo:', 'ht-qrcode'); ?> </label>
                <input class="widefat htqrcode-logo-url" id="<?php echo $this->get_field_id('logo'); ?>" name="<?php echo $this->get_field_name('logo'); ?>" type="text" value="<?php echo esc_attr($instance['logo']); ?>" placeholder="<?php echo esc_attr_x( 'Choose your logo', 'placeholder', 'ht-qrcode' ); ?>"/>
                    <input type="button" class="button htqrcode-browse widefat" value="Choose Logo">
            </p>

            <p>
                <label for="<?php echo $this->get_field_id('logo_size'); ?>"><?php echo esc_attr__('logo size:', 'ht-qrcode'); ?> </label>
                <input class="widefat" min="10" step="1" max="100"  id="<?php echo $this->get_field_id('logo_size'); ?>" name="<?php echo $this->get_field_name('logo_size'); ?>" type="number" value="<?php echo esc_attr($instance['logo_size']); ?>" placeholder="<?php echo esc_attr_x( 'Example: 50', 'placeholder', 'ht-qrcode' ); ?>"/>
            </p>
            
            <p>
                <label for="<?php echo $this->get_field_id('logo_bg_transparent'); ?>"><?php echo esc_attr__('Background Transparent', 'ht-qrcode'); ?> </label>
                <select class="widefat" id="<?php echo $this->get_field_id('logo_bg_transparent'); ?>" name="<?php echo $this->get_field_name('logo_bg_transparent'); ?>" value="<?php echo esc_attr($instance['logo_bg_transparent']); ?>" >
                  <option  <?php selected( $instance['logo_bg_transparent'], 'true' ); ?> value="true"><?php echo esc_attr__('True', 'ht-qrcode'); ?></option>
                  <option  <?php selected( $instance['logo_bg_transparent'], 'false' ); ?> value="false"><?php echo esc_attr__('False', 'ht-qrcode'); ?></option>
                </select>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id('logo_bg_color'); ?>"><?php echo esc_attr__('Logo Background Color:', 'ht-qrcode'); ?> </label>
                <input class="htqrcode_color_style" id="<?php echo $this->get_field_id('logo_bg_color'); ?>" name="<?php echo $this->get_field_name('logo_bg_color'); ?>" type="color" value="<?php echo esc_attr($instance['logo_bg_color']); ?>"/>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id('qr_bg_image'); ?>"><?php echo esc_attr__('Choose QR Code Background Image:', 'ht-qrcode'); ?> </label>
                <input class="widefat htqrcode-logo-url" id="<?php echo $this->get_field_id('qr_bg_image'); ?>" name="<?php echo $this->get_field_name('qr_bg_image'); ?>" type="text" value="<?php echo esc_attr($instance['qr_bg_image']); ?>" placeholder="<?php echo esc_attr_x( 'Choose Your Background Image.', 'placeholder', 'ht-qrcode' ); ?>"/>
                    <input type="button" class="button htqrcode-browse widefat" value="Choose Image"/>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id('qr_bg_opacity'); ?>"><?php echo esc_attr__('Background Image Opacity:', 'ht-qrcode'); ?> </label>
                <input class="widefat" min="0.1" step="0.1" max="1" id="<?php echo $this->get_field_id('qr_bg_opacity'); ?>" name="<?php echo $this->get_field_name('qr_bg_opacity'); ?>" type="number" value="<?php echo esc_attr($instance['qr_bg_opacity']); ?>" placeholder="<?php echo esc_attr_x( 'Example: 0.1 to 1', 'placeholder', 'ht-qrcode' ); ?>"/>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id('qr_bg_autocolor'); ?>"><?php echo esc_attr__('Background Auto Color:', 'ht-qrcode'); ?> </label>
                <select class="widefat" id="<?php echo $this->get_field_id('qr_bg_autocolor'); ?>" name="<?php echo $this->get_field_name('qr_bg_autocolor'); ?>" value="<?php echo esc_attr($instance['qr_bg_autocolor']); ?>" >
                  <option  <?php selected( $instance['qr_bg_autocolor'], 'true' ); ?> value="true"><?php echo esc_attr__('True', 'ht-qrcode'); ?></option>
                  <option <?php selected( $instance['qr_bg_autocolor'], 'false' ); ?> value="false"><?php echo esc_attr__('False', 'ht-qrcode'); ?></option>
                </select>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id('colordark'); ?>"><?php echo esc_attr__('QR Dot Color:', 'ht-qrcode'); ?> </label>
                <input class="htqrcode_color_style" id="<?php echo $this->get_field_id('colordark'); ?>" name="<?php echo $this->get_field_name('colordark'); ?>" type="color" value="<?php echo esc_attr($instance['colordark']); ?>"/>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id('colorlight'); ?>"><?php echo esc_attr__('Background Color:', 'ht-qrcode'); ?> </label>
                <input class="htqrcode_color_style" id="<?php echo $this->get_field_id('colorlight'); ?>" name="<?php echo $this->get_field_name('colorlight'); ?>" type="color" value="<?php echo esc_attr($instance['colorlight']); ?>" placeholder="<?php echo esc_attr_x( 'Example: #ffffff', 'placeholder', 'ht-qrcode' ); ?>"/>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id('po_tl'); ?>"><?php echo esc_attr__('Pattern Outer Top Left Color:', 'ht-qrcode'); ?> </label>
                <input class="htqrcode_color_style" id="<?php echo $this->get_field_id('po_tl'); ?>" name="<?php echo $this->get_field_name('po_tl'); ?>" type="color" value="<?php echo esc_attr($instance['po_tl']); ?>" placeholder="<?php echo esc_attr_x( 'Example: #ffffff', 'placeholder', 'ht-qrcode' ); ?>"/>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id('pi_tl'); ?>"><?php echo esc_attr__('Pattern Inner Top Left Color:', 'ht-qrcode'); ?> </label>
                <input class="htqrcode_color_style" id="<?php echo $this->get_field_id('pi_tl'); ?>" name="<?php echo $this->get_field_name('pi_tl'); ?>" type="color" value="<?php echo esc_attr($instance['pi_tl']); ?>" placeholder="<?php echo esc_attr_x( 'Example: #ffffff', 'placeholder', 'ht-qrcode' ); ?>"/>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id('po_tr'); ?>"><?php echo esc_attr__('Pattern Outer Top Right Color:', 'ht-qrcode'); ?> </label>
                <input class="htqrcode_color_style" id="<?php echo $this->get_field_id('po_tr'); ?>" name="<?php echo $this->get_field_name('po_tr'); ?>" type="color" value="<?php echo esc_attr($instance['po_tr']); ?>" placeholder="<?php echo esc_attr_x( 'Example: #ffffff', 'placeholder', 'ht-qrcode' ); ?>"/>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id('pi_tr'); ?>"><?php echo esc_attr__('Pattern Inner Top Right Color:', 'ht-qrcode'); ?> </label>
                <input class="htqrcode_color_style" id="<?php echo $this->get_field_id('pi_tr'); ?>" name="<?php echo $this->get_field_name('pi_tr'); ?>" type="color" value="<?php echo esc_attr($instance['pi_tr']); ?>" placeholder="<?php echo esc_attr_x( 'Example: #ffffff', 'placeholder', 'ht-qrcode' ); ?>"/>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id('po_bl'); ?>"><?php echo esc_attr__('Pattern Outer Bottom Color:', 'ht-qrcode'); ?> </label>
                <input class="htqrcode_color_style" id="<?php echo $this->get_field_id('po_bl'); ?>" name="<?php echo $this->get_field_name('po_bl'); ?>" type="color" value="<?php echo esc_attr($instance['po_bl']); ?>" placeholder="<?php echo esc_attr_x( 'Example: #ffffff', 'placeholder', 'ht-qrcode' ); ?>"/>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id('pi_bl'); ?>"><?php echo esc_attr__('Pattern Inner Bottom Color:', 'ht-qrcode'); ?> </label>
                <input class="htqrcode_color_style" id="<?php echo $this->get_field_id('pi_bl'); ?>" name="<?php echo $this->get_field_name('pi_bl'); ?>" type="color" value="<?php echo esc_attr($instance['pi_bl']); ?>" placeholder="<?php echo esc_attr_x( 'Example: #ffffff', 'placeholder', 'ht-qrcode' ); ?>"/>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id('ai'); ?>"><?php echo esc_attr__('Aligment Outer Color:', 'ht-qrcode'); ?> </label>
                <input class="htqrcode_color_style" id="<?php echo $this->get_field_id('ai'); ?>" name="<?php echo $this->get_field_name('ai'); ?>" type="color" value="<?php echo esc_attr($instance['ai']); ?>" placeholder="<?php echo esc_attr_x( 'Example: #ffffff', 'placeholder', 'ht-qrcode' ); ?>"/>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id('ao'); ?>"><?php echo esc_attr__('Aligment Inner Color:', 'ht-qrcode'); ?> </label>
                <input class="htqrcode_color_style" id="<?php echo $this->get_field_id('ao'); ?>" name="<?php echo $this->get_field_name('ao'); ?>" type="color" value="<?php echo esc_attr($instance['ao']); ?>" placeholder="<?php echo esc_attr_x( 'Example: #ffffff', 'placeholder', 'ht-qrcode' ); ?>"/>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id('timing_h'); ?>"><?php echo esc_attr__('Timing Horizontal Color:', 'ht-qrcode'); ?> </label>
                <input class="htqrcode_color_style" id="<?php echo $this->get_field_id('timing_h'); ?>" name="<?php echo $this->get_field_name('timing_h'); ?>" type="color" value="<?php echo esc_attr($instance['timing_h']); ?>" placeholder="<?php echo esc_attr_x( 'Example: #ffffff', 'placeholder', 'ht-qrcode' ); ?>"/>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id('timing_v'); ?>"><?php echo esc_attr__('Timing Vertical Color:', 'ht-qrcode'); ?> </label>
                <input class="htqrcode_color_style" id="<?php echo $this->get_field_id('timing_v'); ?>" name="<?php echo $this->get_field_name('timing_v'); ?>" type="color" value="<?php echo esc_attr($instance['timing_v']); ?>" placeholder="<?php echo esc_attr_x( 'Example: #ffffff', 'placeholder', 'ht-qrcode' ); ?>"/>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id('print'); ?>"><?php echo esc_attr__('Print QR Code Button:', 'ht-qrcode'); ?> </label>
                <select class="widefat" id="<?php echo $this->get_field_id('print'); ?>" name="<?php echo $this->get_field_name('print'); ?>" value="<?php echo esc_attr($instance['print']); ?>" >
                  <option  <?php selected( $instance['print'], 'true' ); ?> value="true"><?php echo esc_attr__('Enable', 'ht-qrcode'); ?></option>
                  <option <?php selected( $instance['print'], 'false' ); ?> value="false"><?php echo esc_attr__('Disable', 'ht-qrcode'); ?></option>
                </select>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id('print_btn_txt'); ?>"><?php echo esc_attr__('Print Button Text:', 'ht-qrcode'); ?> </label>
                <input class="widefat" id="<?php echo $this->get_field_id('print_btn_txt'); ?>" name="<?php echo $this->get_field_name('print_btn_txt'); ?>" type="text" value="<?php echo esc_attr($instance['print_btn_txt']); ?>" placeholder="<?php echo esc_attr_x( 'Print Button Text Here.', 'placeholder', 'ht-qrcode' ); ?>"/>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id('download'); ?>"><?php echo esc_attr__('Download QR Code Button:', 'ht-qrcode'); ?> </label>
                <select class="widefat" id="<?php echo $this->get_field_id('download'); ?>" name="<?php echo $this->get_field_name('download'); ?>" value="<?php echo esc_attr($instance['download']); ?>" >
                  <option  <?php selected( $instance['download'], 'true' ); ?> value="true"><?php echo esc_attr__('Enable', 'ht-qrcode'); ?></option>
                  <option <?php selected( $instance['download'], 'false' ); ?> value="false"><?php echo esc_attr__('Disable', 'ht-qrcode'); ?></option>
                </select>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id('download_btn_txt'); ?>"><?php echo esc_attr__('Download Button Text:', 'ht-qrcode'); ?> </label>
                <input class="widefat" id="<?php echo $this->get_field_id('download_btn_txt'); ?>" name="<?php echo $this->get_field_name('download_btn_txt'); ?>" type="text" value="<?php echo esc_attr($instance['download_btn_txt']); ?>" placeholder="<?php echo esc_attr_x( 'Download Button Text Here.', 'placeholder', 'ht-qrcode' ); ?>"/>
            </p>
        <?php }
    } // end extends class
} // end exists class

// Register Author information widget.
function htqrcode_default_widgets() {
    register_widget( 'htqrcode_default_widgets' );
}
add_action( 'widgets_init', 'htqrcode_default_widgets' );