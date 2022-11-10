
<?php
    $wcss_email_cart_form_fields = apply_filters( 'wcss_email_cart_form_fields', array(
        'email_to' => array(
            'title'         =>  get_option( 'wcss_share_cart_email_to_label' ),
            'type'          => 'text',
            'required'      => true,
            'name'          => 'email_to',
            'attributes'    => array(
                'placeholder'   => 'email@domian.com',
                'autofocus'     => 'autofocus',
            ), 
        ),
        'email_subject' => array(
            'title'         =>  get_option( 'wcss_share_cart_email_subject_label' ),
            'type'          => 'text',
            'required'      => true,
            'name'          => 'email_subject',
            'attributes'    => array(
                'autocomplete'   => 'autocomplete_off_hack',
            ), 
        ),
        'email_message' => array(
            'title'         =>  get_option( 'wcss_share_cart_email_message_label' ),
            'type'          => 'textarea',
            'required'      => false,
            'name'          => 'email_message',
        ), )
    );
?>


<div class="wcss-email-cart">
    <form id="wcss-email-cart-form" action="#" method="post" novalidate>
        <input type="hidden" name="cart_key" value="<?php echo esc_html( $uid ); ?>">
        <?php
            foreach ( $wcss_email_cart_form_fields as $field_key => $field ) {
                if ( ! isset( $field['type'] ) ) {
                    continue;
                }

                $title      = isset( $field['title'] ) ? $field['title'] : '';
                $desc       = isset( $field['desc'] ) ? $field['desc'] : '';
                $required   = ( isset( $field['required'] ) && $field['required'] === true ) ? true : false;
                $name       = isset( $field['name'] ) ? $field['name'] : '';
                $value      = isset( $field['value'] ) ? $field['value'] : '';
                $class      = isset( $field['class'] ) ? $field['class'] : '';

                // Custom attribute handling.
                $attributes = array();
                
                if ( ! empty( $field['attributes'] ) && is_array( $field['attributes'] ) ) {
                    foreach ( $field['attributes'] as $attribute => $attribute_value ) {
                        $attributes[] = esc_attr( $attribute ) . '="' . esc_attr( $attribute_value ) . '"';
                    }
                    $field['attributes'] = $attributes;
                }

                // Display fields
                if ( $field['type'] === 'email' ) {
                    ?>  
                    <div>
                        <label class="wcss-popup--text-color"><?php echo esc_html( $title ); ?> <?php echo ( $required === true ) ? '<span>*<span>' : '' ?></label>
                        <p>
                            <input 
                                type="email" 
                                class="wcss-email-cart-form-field <?php echo esc_attr( $class ) ?>"
                                name="<?php echo esc_attr( $name ); ?>" 
                                value="<?php echo esc_attr( $value ); ?>"
                                <?php echo implode( ' ', $attributes ); // WPCS: XSS ok. ?>
                                <?php echo ( $required === true ) ? 'required' : ''; ?> >
                        </p>
                        <?php echo ( $desc ) ? '<p class="wcss-email-cart-form-field-desc">' . esc_html( $desc ) . '</p>' : ''; ?>
                    </div>
                    <?php
                }
                if ( $field['type'] === 'text' ) {
                    ?>  
                    <div>
                        <label class="wcss-popup--text-color"><?php echo esc_html( $title ); ?> <?php echo ( $required === true ) ? '<span>*<span>' : '' ?></label>
                        <p>
                            <input 
                                type="text"
                                class="wcss-email-cart-form-field <?php echo esc_attr( $class ) ?>"
                                name="<?php echo esc_attr( $name ); ?>" 
                                value="<?php echo esc_attr( $value ); ?>" 
                                <?php echo implode( ' ', $attributes ); // WPCS: XSS ok. ?>
                                <?php echo ( $required === true ) ? 'required' : ''; ?> >
                        </p>
                        <?php echo ( $desc ) ? '<p class="wcss-email-cart-form-field-desc">' . esc_html( $desc ) . '</p>' : ''; ?>
                    </div>
                    <?php
                }
                if ( $field['type'] === 'textarea' ) {
                    ?>  
                    <div>
                        <label class="wcss-popup--text-color"><?php echo esc_html( $title ); ?> <?php echo ( $required === true ) ? '<span>*<span>' : '' ?></label>
                        <p>
                            <textarea 
                                class="wcss-email-cart-form-field <?php echo esc_attr( $class ) ?>"
                                name="<?php echo esc_attr( $name ); ?>" 
                                <?php echo implode( ' ', $attributes ); // WPCS: XSS ok. ?>
                                <?php echo ( $required === true ) ? 'required' : ''; ?> ><?php echo wp_kses_post( $value ); ?></textarea>
                        </p>
                        <?php echo ( $desc ) ? '<p class="wcss-email-cart-form-field-desc">' . esc_html( $desc ) . '</p>' : ''; ?>
                    </div>
                    <?php
                }

            }

        ?>

        <div>
            <input type="submit" value="<?php echo esc_attr( get_option( 'wcss_share_cart_email_button_text' ) ); ?>" class="wcss-btn">
        </div>
    </form>
</div>