<?php

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

if (!class_exists('Emerson_Order')) :

    class Emerson_Order
    {


        public function __construct()
        {

            // Call a function after the user have pressed the "Place order"
            add_action('woocommerce_checkout_order_processed', array($this, 'place_order'), 20);

            add_action('woocommerce_order_actions', array($this, 'add_actions_option'));
            add_action('woocommerce_order_action_wc_retry_order_action', array($this, 'place_order'));
            add_action('woocommerce_order_action_wc_get_order_tracking_info_action', array($this, 'get_order_tracking_info'));
        }


        /**
         * Add a custom action to order actions select box on edit order page
         * Only added for marked for retry orders
         *
         * @param array $actions order actions array to display
         * @return array - updated actions
         */
        function add_actions_option($actions)
        {
            global $theorder;
            $emerson_fullfilment_state = get_post_meta($theorder->get_id(), 'emerson_fullfilment_state', true);

            if ($emerson_fullfilment_state !== 'completed') {

                $actions['wc_get_order_tracking_info_action'] = __('Get tracking info', 'emerson');

                $actions['wc_retry_order_action'] = __('Resubmit order', 'emerson');
            }


            return $actions;
        }


        /**
         * Create an order in emerson
         * 
         * @param integer|WC_Order $order
         * 
         */
        function place_order($order)
        {

            if (!($order instanceof WC_Order)) {
                $order = new WC_Order($order);
            }

            if (!$order) {
                return;
            }

            update_post_meta($order->get_id(), 'emerson_fullfilment_state', 'new');

            $Emerson_api = new Emerson_API(EMERSON_CONFIG_NAME);

            // Preparing data for external request

            $data = array(
                'items' => array()
            );

            foreach ($order->get_items('shipping') as $item_id => $item) {
                $data['items'] = $item->get_meta('emerson_shipping');
                if ($data['items'] != '') {
                    break;
                }
            }

            if ($data['items'] == '' || count($data['items']) == 0) {
                return;
            }

            $data['ShippingMethod'] = $order->get_shipping_method();
            $data['PaymentIdentifier'] = 'Terms';
            $data['OrderComments'] = [$order->get_customer_note()];
            $data['SuppressWarnings'] = true; //yes
            $data['CustomerOrderNumber'] = "EM-" . $order->get_id();


            $states  = WC()->countries->get_states($order->get_shipping_country());


            $data['address'] = array(
                'CountryName' => WC()->countries->countries[$order->get_shipping_country()],
                'RegionName' => $states[$order->get_shipping_state()],
                'PostalCode' => $order->get_shipping_postcode(),
                'CountryCode' => $order->get_shipping_country(),
                'City' => $order->get_shipping_city(),
                'RegionCode' => $order->get_shipping_state(),
                'Line1' => $order->get_shipping_address_1(),
                'Line2' => $order->get_shipping_address_2(),
                'FullName' => $order->get_shipping_first_name() . ' ' . $order->get_shipping_last_name(),
                'PhoneNumber' =>  method_exists($order, 'get_shipping_phone') ? $order->get_shipping_phone() : $order->get_billing_phone()
            );


            $api_request_type = 3; //1: check the order, 2: check order and address, 
            //3: check order and address, and create order(returning guid) 
            // Emerson API 
            $submit_order = $Emerson_api->SubmitOrder($data, $api_request_type);
            $order_note = '';

            if (isset($submit_order->error)) {

                $order_note .= __('Cannot submit order: ', 'emerson');
                $order_note .= $this->process_message_array('Error', $submit_order->messages);
            } else if (isset($submit_order->Success) && $submit_order->Success == true) {
                $submitted_message = count($submit_order->Warnings) == 0 ? 'Order submitted successfully. Order ID: %s' : 'Order submitted with warnings. Order ID: %s';
                $order_note .= ($br == true ? '<br/>' : '') . sprintf(__($submitted_message, 'emerson'), $submit_order->OrderGuid);

                $order_note .= $this->process_message_array('Warning', $submit_order->Warnings);

                update_post_meta($order->get_id(), 'emerson_fullfilment_state', 'created');

                date_default_timezone_set('UTC');
                $actual_date = new DateTime();
                update_post_meta($order->get_id(), 'emerson_created_on', $actual_date);

                update_post_meta($order->get_id(), '_emerson_Guid', $submit_order->OrderGuid);
                update_post_meta($order->get_id(), '_wc_order_marked_for_emerson_retry', 'no');

                $br = true;
            } else {
                $order_note .= ($br == true ? '<br/>' : '') . __('Cannot submit order.', 'emerson');
                $br = true;

                $order_note .= $this->process_message_array('Error', $submit_order->Errors);
                $order_note .= $this->process_message_array('Warning', $submit_order->Warnings);

                // mark the order for retry
                update_post_meta($order->get_id(), '_wc_order_marked_for_emerson_retry', 'yes');
            }

            $order->add_order_note($order_note);
        }

        private function process_message_array($type, $arr)
        {
            $note = '';
            if (isset($arr) && count($arr) != 0) {
                $note .= '<br/>';
                foreach ($arr as $item) {
                    $note .= sprintf(__($type . ': %s', 'emerson'), $item) . '<br/>';
                };
            }

            return $note;
        }


        function get_order_number($order)
        {
            if (!($order instanceof WC_Order)) {
                $order = new WC_Order($order);
            }

            if (!$order) {
                return;
            }

            $order_number = get_post_meta($order->get_id(), '_emerson_OrderNumber', true);

            if ($order_number) {
                return $order_number;
            }

            $Emerson_api = new Emerson_API(EMERSON_CONFIG_NAME);

            $result = $Emerson_api->GetOrderNumber(get_post_meta($order->get_id(), '_emerson_Guid', true));

            $order_number = false;
            if ($result->Success === true) {
                update_post_meta($order->get_id(), 'emerson_fullfilment_state', 'processed');
                update_post_meta($order->get_id(), '_emerson_OrderNumber', $result->OrderNumber);
                $order_number =  $result->OrderNumber;
                $order->add_order_note(sprintf(__('Order validated successfully. Order No. %s', 'emerson'), $result->OrderNumber));
            } else {
                /**
                 * Si da error 604 entonces...
                 * TODO: check Errors for check 604 item
                 */
                // update_post_meta( $order->get_id(), 'emerson_fullfilment_state', 'failed' ); 

                $tracking_note =  __('Cannot validate order:', 'emerson');
                $tracking_note .= $this->process_message_array('Error', $result->Errors);
                $tracking_note .= $this->process_message_array('Error', $result->messages);

                $order->add_order_note($tracking_note);
            }

            return $order_number;
        }

        private function add_tracking_info($actions, $order_id, $tracking_number, $service_slug)
        {

            if ($service_slug == '' || $actions == null) {
                return;
            }
            $actions->add_tracking_item($order_id, array(
                'tracking_number' => $tracking_number,
                'slug' => $service_slug
            ));
        }

        function get_order_tracking_info($order)
        {
            if (!($order instanceof WC_Order)) {
                $order = new WC_Order($order);
            }

            if (!$order) {
                return;
            }

            if (
                get_post_meta($order->get_id(), 'emerson_fullfilment_state', true) !== 'processed'
                && $this->get_order_number($order) === false
            ) {
                return;
            }

            /**
             * 'ups' for United States
             */
            $service_slug = $order->get_shipping_country() === 'US' ? 'ups' : '';
            $Emerson_api = new Emerson_API(EMERSON_CONFIG_NAME);

            $actions = null;
            if (class_exists('AfterShip_Actions')) {
                /**
                 * Checking for `AfterShip Tracking` class
                 */
                $actions = AfterShip_Actions::get_instance();
            }
            $tracking_order_note = __('Tracking numbers:', 'emerson');
            $has_tracking = false;

            $result = $Emerson_api->GetOrderTrackingInformation(get_post_meta($order->get_id(), '_emerson_OrderNumber', true));

            if ($result->Success === true) {
                foreach ($result->Shipments as $shipment) {
                    $service = $shipment->Service; //Contains the ship via method through which the shipment is shipped.
                    foreach ($shipment->Packages as $package) {
                        $has_tracking = true;
                        $tracking_order_note .= '<br/>' . $package->TrackingNumber;
                        $this->add_tracking_info($actions, $order->get_id(), $package->TrackingNumber, $service_slug);
                    }
                }

                if ($has_tracking) {
                    update_post_meta($order->get_id(), 'emerson_fullfilment_state', 'completed');
                    $order->update_status('completed', '', true);
                    if (is_null($actions)) {
                        /**
                         * fallback
                         */
                        $order->add_order_note($tracking_order_note);
                    }
                } else {
                    $order->add_order_note(__('Tracking info obtained but shipping list was empty.', 'emerson'));
                }
            } else {
                $tracking_note =  __('Cannot get tracking info: ', 'emerson');

                $tracking_note .= $this->process_message_array('Error', $result->Errors);
                $tracking_note .= $this->process_message_array('Error', $result->messages);

                $order->add_order_note($tracking_note);
            }
        }
    }


    $obj = new Emerson_Order();

endif;
