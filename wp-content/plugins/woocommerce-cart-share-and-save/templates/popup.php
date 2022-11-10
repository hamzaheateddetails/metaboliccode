<?php if ( 'yes' === get_option( 'wcss_popup_overlay_status' ) ) : ?>
<div class="wcss-popup-overlay" data-wcss-popup-close></div>
<?php endif; ?>
<div class="wcss-popup wcss-popup--bg-color <?php echo ( get_option( 'wcss_rtl_status' ) === 'yes' ) ? 'wcss-popup--rtl' : '' ?>">

    <div class="wcss-popup__header">
        <div class="wcss-popup__header-text wcss-popup--text-color">
            <?php echo esc_html( get_option( 'wcss_share_cart_title' ) ); ?>
        </div>
        <div class="wcss-popup__header-close" data-wcss-popup-close>
            <i class="wcss-icon-times"></i>
        </div>
    </div><!-- .wcss-popup__header -->

    <div class="wcss-popup__body">

        <div class="wcss-popup-ajax">
    
        <div class="wcss-spinner">
            <div class="wcss-dot1"></div>
            <div class="wcss-dot2"></div>
        </div>

        </div><!-- .wcss-popup-ajax -->
        
    </div><!-- .wcss-popup__body -->

    <div class="wcss-popup__footer">
        
    </div><!-- .wcss-popup__footer -->

</div><!-- .wcss-popup -->