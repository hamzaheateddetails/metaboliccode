<?php
/*
*   ShortCode 
*/
function htqr_shortcode( $attributes, $content ){
    $ht_id = uniqid();
    extract( shortcode_atts( array(
        'title'                 => 'QR Code Titel',
        'html_tag'              => 'h3',
        'sub_titel'             => '',
        'alignment'             => 'left',
        'qrcode'                => '',
        'size'                  => 300,
        'dot_scale'             => 1,
        'qr_level'              => 'L',
        'logo'                  => '',
        'logo_size'             => 80,
        'logo_bg_color'         => '',
        'logo_bg_transparent'   => 'true',
        'qr_bg_image'			=> '',
        'qr_bg_opacity'			=> 0.5,
        'qr_bg_autocolor'		=> 'false',
        'colordark'             => '#000000',
        'colorlight'            => '#ffffff',
        'po'                    => '',
        'pi'                    => '',
        'po_tl'                 => '',
        'pi_tl'                 => '',
        'po_tr'                 => '',
        'pi_tr'                 => '',
        'po_bl'                 => '',
        'pi_bl'                 => '',
        'ai'                    => '',
        'ao'                    => '',
        'timing'                => '',
        'timing_h'              => '',
        'timing_v'              => '',
        'quietzone'             => 0,
        'quietzonecolor'        => '',
        'print'                 => 'true',
        'print_btn_txt'         => 'Print QR Code',
        'download'              => 'true',
        'download_btn_txt'      => 'Download',
        
    ), $attributes ) );

        
    // if $content and $qrcode variable is empty, then entered default page URL show
    if(empty($content) && empty($qrcode)){
        $content = get_permalink();
    }else if(!empty($content)){ 
        $content  = do_shortcode($content);
    }else if(!empty($qrcode)){
        $content  = $qrcode;
    }

    // if $print_btn_txt variable is empty, then print "Print QR Code" text
    if(empty($print_btn_txt)){ $print_btn_txt = 'Print QR Code';}
    // if $download_btn_txt variable is empty, then print "Download" text
    if(empty($download_btn_txt)){ $download_btn_txt = 'Download';}

    $data = array();
    ob_start();
    ?>
        <div class="ht_qrcode" style="text-align: <?php echo esc_html__( $alignment, 'ht-qrcode' ); ?>">
            <div id="print-<?php echo esc_html__( $ht_id, 'ht-qrcode' ); ?>" class="ht_qrcode-<?php echo esc_html__( $ht_id, 'ht-qrcode' ); ?>"></div>

            <?php if( esc_attr( $print == 'true' )){ ?>
                <a class="htqr-btn htqr-btn-print" href="javascript:printDiv('print-<?php echo esc_html__( $ht_id, 'ht-qrcode' ); ?>')"><?php echo esc_html__( $print_btn_txt, 'ht-qrcode' ) ?></a>
            <?php } ?>
            <?php if(esc_attr(  $download == 'true' )){ ?>
                <a href="#" class="qrcode-download htqr-btn htqr-btn-download" data-target=".ht_qrcode-<?php echo esc_html__( $ht_id, 'ht-qrcode' ); ?> "><?php echo esc_html__( $download_btn_txt, 'ht-qrcode' ) ?></a>
            <?php } ?>
        </div>

        <script type="text/javascript">
            jQuery(document).ready(function($) {
                'use strict';

                new QRCode(document.querySelector(".ht_qrcode-<?php echo esc_js( $ht_id ); ?>"),{
                    text: "<?php echo esc_js( $content ); ?>",
                    width: <?php echo esc_js( $size ); ?>,
                    height: <?php echo esc_js( $size ); ?>,
                    dotScale: <?php echo esc_js( $dot_scale ); ?>,
                    correctLevel: QRCode.CorrectLevel.<?php echo esc_js( $qr_level ); ?>,
                    logo: "<?php echo esc_js( $logo ); ?>",
                    logoWidth: <?php echo esc_js( $logo_size ); ?>, 
                    logoHeight: <?php echo esc_js( $logo_size ); ?>, 
                    logoBackgroundColor: "<?php echo esc_js( $logo_bg_color ); ?>",
                    logoBackgroundTransparent: <?php echo esc_js( $logo_bg_transparent ); ?>,
                    backgroundImage: "<?php echo esc_js( $qr_bg_image ); ?>",
                    backgroundImageAlpha: <?php echo esc_js( $qr_bg_opacity ); ?>,
                    autoColor: <?php echo esc_js( $qr_bg_autocolor ); ?>, 
                    colorDark: "<?php echo esc_js( $colordark ); ?>",
                    colorLight: "<?php echo esc_js( $colorlight ); ?>",
                    PO: "<?php echo esc_js( $po ); ?>",
                    PI: "<?php echo esc_js( $pi ); ?>",
                    PO_TL:"<?php echo esc_js( $po_tl ); ?>",
                    PI_TL: "<?php echo esc_js( $pi_tl ); ?>",
                    PO_TR: "<?php echo esc_js( $po_tr ); ?>",
                    PI_TR: "<?php echo esc_js( $pi_tr ); ?>",
                    PO_BL:"<?php echo esc_js( $po_bl ); ?>",
                    PI_BL: "<?php echo esc_js( $pi_bl ); ?>",
                    AI: "<?php echo esc_js( $ai ); ?>",
                    AO: "<?php echo esc_js( $ao ); ?>",
                    timing: "<?php echo esc_js( $timing ); ?>",
                    timing_H: "<?php echo esc_js( $timing_h ); ?>",
                    timing_V: "<?php echo esc_js( $timing_v ); ?>",
                    quietZone: <?php echo esc_js( $quietzone ); ?>,
                    quietZoneColor: "<?php echo esc_js( $quietzonecolor ); ?>",  
                }
            );
            });
        </script>
    <?php

    return ob_get_clean();
}
add_shortcode( 'htqrcode', 'htqr_shortcode');   

//QR Code Print option Button
function qr_code_print() {
    echo '<iframe name="qrcode_print_frame" width="0" height="0" frameborder="0" src="about:blank"></iframe>';
}
add_action( 'wp_footer', 'qr_code_print' );
