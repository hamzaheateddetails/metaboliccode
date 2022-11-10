<?php

/**
 * TODO: avoid direct call
 */

function emerson_shipping_method()
{
    if (!class_exists('Emerson_Shipping_Method')) {
        class Emerson_Shipping_Method extends WC_Shipping_Method
        {

            /**
             * Constructor for your shipping class
             *
             * @access public
             * @return void
             */
            public function __construct($instance_id = 0)
            {
                $this->id                 = 'emerson';
                $this->instance_id        = absint( $instance_id );  //must have instance_id for allow multiple times, and configuration edit button
                $this->method_title       = __('Emerson Integration', 'emerson');
                $this->method_description = __('Custom Shipping Method for Emerson', 'emerson');
                $this->debug_mode  = 'yes' === get_option( 'woocommerce_shipping_debug_mode', 'no' );

                $this->supports = array(
                    'shipping-zones',	 // for the `Add shipping method` form(in shipping zone) 
                    'instance-settings', // for the edit button under the table item
                    'instance-settings-modal', // for show the settings in a modal, if not supplied setting will appear in a full page
                );

                $this->init();

                $this->cryptor            = new Cryptor(10, 6);
                $this->emerson_api        = new Emerson_API(EMERSON_CONFIG_NAME);
                
                $this->title =  __('Emerson Integration', 'emerson');
            }

            /**
             * Init your settings
             *
             * @access public
             * @return void
             */
            function init()
            {
                // Load the settings API
                $this->init_form_fields();
                $this->init_settings();

                $this->tax_status   = $this->get_option( 'tax_status' );
                // Save settings in admin if you have any defined
                add_action('woocommerce_update_options_shipping_' . $this->id, array($this, 'process_admin_options'));
            }

            /**
             * Define settings field for this shipping
             * @return void 
             */
            function init_form_fields()
            {
                $this->form_fields = array(
                    'tax_status' => array(
                        'title'   => __( 'Tax status', 'woocommerce' ),
                        'type'    => 'select',
                        'class'   => 'wc-enhanced-select',
                        'default' => 'taxable',
                        'options' => array(
                            'taxable' => __( 'Taxable', 'woocommerce' ),
                            'none'    => _x( 'None', 'Tax status', 'woocommerce' ),
                        ),
                    ),
                );
            }



            /**
             * Get setting form fields for instances of this shipping method within zones.
             *
             * @return array
             */
            public function get_instance_form_fields() {
                return $this->form_fields;
            }

            /**
             * This function is used to calculate the shipping cost. Within this function we can check for weights, dimensions and other parameters.
             *
             * @access public
             * @param mixed $packages
             * @return void
             */
            public function calculate_shipping($packages = array())
            {
                                    
                $data = array(
                    'items'=>array()
                );

                foreach($packages['contents'] as $key=>$cart_item){
                    $product=wc_get_product($cart_item['product_id']);
                    array_push($data['items'], array(
                        'product_id' => $cart_item['product_id'],
                        'SKU' => $product->get_sku(),
                        'quantity' => $cart_item['quantity'],
                        'name' => $product->get_title()
                    ));
                }

                
                $data['address'] = array(
                    'CountryName' => WC()->countries->countries[$packages['destination']['country']],
                    'RegionName' => WC()->countries->get_states($packages['destination']['country'] )[$packages['destination']['state']],
                    'PostalCode' => $packages['destination']['postcode'],
                    'CountryCode' => $packages['destination']['country'],
                    'City' => $packages['destination']['city'],
                    'RegionCode' => $packages['destination']['state'],
                    'Line1' => isset($packages['destination']['address'])&&$packages['destination']['address']!=''?$packages['destination']['address']:' ',
                    'Line2' => isset($packages['destination']['address_2'])&&$packages['destination']['address_2']!=''?$packages['destination']['address_2']:' ',
                    'FullName' => WC()->customer->get_shipping_first_name().' '.WC()->customer->get_shipping_last_name(),
                    'PhoneNumber' => method_exists(WC()->customer,'get_shipping_phone')? WC()->customer->get_shipping_phone(): WC()->customer->get_billing_phone()
                );
                

                // Emerson API 
                $get_ship_via_costs = $this->emerson_api->GetShipViaCosts($data);

                if (isset($get_ship_via_costs->error)) {

                    if ($this->debug_mode){
                        foreach($get_ship_via_costs->messages as $item){
                            wc_add_wp_error_notices(new WP_Error(1,$item));
                        }
                    }
                    return;
                }

                foreach ($get_ship_via_costs->ShippingMethods as $array_name_cost) {
                    $array_name_cost = explode(" - ", $array_name_cost);
            
                    if ($array_name_cost[0] === 'Standard'){
                        /**
                         * Setting Standard to static value (but settings is prepared for this field)
                         */
                        $array_name_cost[1] = 8.75;
                    }

                    $rate = array(
                        'id' => $array_name_cost[0],
                        'label' => $array_name_cost[0],
                        'package' => $packages,
                        'cost' => count($array_name_cost) == 1 ? '0' : $array_name_cost[1],
                        'meta_data'=> array(
                            'emerson_shipping'=> $data['items']
                        )
                    );
                    $this->add_rate($rate);
                }
            }

        }
    }
}

