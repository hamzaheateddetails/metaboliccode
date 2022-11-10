<?php

class Orders_Review_Cron
{
    private $periodicity_scheduled;
    private $periodicity_recurrence;
    private $periodicity_interval_seconds;
    private $lifetime_order;

    public function __construct()
    {
        $options = unserialize(get_option('emerson_config'));
        $this->periodicity_scheduled = isset($options['periodicity_scheduled']) ? ($options['periodicity_scheduled'] == 0 ? '1 hour' : '2 hours') : '1 hour';
        $this->lifetime_order = isset($options['lifetime_order']) ? ($options['lifetime_order'] == 0 ? '1 hour' : '2 hours') : '1 hour';

        if ($this->periodicity_scheduled == '2 hours') {
            $this->periodicity_recurrence = 'every_two_hours';
            $this->periodicity_interval_seconds = 2;
        } else {
            $this->periodicity_recurrence = 'hourly';
            $this->periodicity_interval_seconds = 1;
        }

        add_filter('cron_schedules', array($this, 'custom_cron_schedule'));

        if (!wp_next_scheduled('emerson_shipping_created_orders')) {
            wp_schedule_event(time(), $this->periodicity_recurrence, 'emerson_shipping_created_orders');
        }
        add_action('emerson_shipping_created_orders', array($this, 'process_created_orders'));
        add_action('init', array($this, 'eg_schedule_emerson_shipping_created_orders_log'));
        add_action('emerson_shipping_created_orders', array($this, 'eg_log_action_emerson_shipping_created_orders'));

        if (!wp_next_scheduled('emerson_shipping_processed_orders')) {
            wp_schedule_event(time(), $this->periodicity_recurrence, 'emerson_shipping_processed_orders');
        }
        add_action('emerson_shipping_processed_orders', array($this, 'process_processed_orders'));
        add_action('init', array($this, 'eg_schedule_emerson_shipping_processed_orders_log'));
        add_action('emerson_shipping_processed_orders', array($this, 'eg_log_action_emerson_shipping_processed_orders'));
    }

    function custom_cron_schedule($schedules)
    {
        $schedules['every_two_hours'] = array(
            'interval' => 2 * HOUR_IN_SECONDS,
            'display' => __('Every 2 hours'),
        );
        return $schedules;
    }

    // Cron job that checks the orders that are in the "created" state
    function process_created_orders()
    {
        $query = new WC_Order_Query(array(
            'status' => array('wc-processing'),
            'limit' => -1
        ));

        $orders = $query->get_orders();

        foreach ($orders as $order) {

            // emerson_fullfillment_state is created
            $emerson_fullfilment_state = get_post_meta($order->get_id(), 'emerson_fullfilment_state', true);

            if ($emerson_fullfilment_state && $emerson_fullfilment_state == 'created') {
                // getOrderNumber given the GUID, it is in the order metadata
                $Emerson_api = new Emerson_API(EMERSON_CONFIG_NAME);
                $result = $Emerson_api->GetOrderNumber(get_post_meta($order->get_id(), '_emerson_Guid', true));

                // object(stdClass)#1894 (2) { ["error"]=> bool(true) ["messages"]=> array(1) { [0]=> string(19) "Emerson API is down" } } 

                $Emerson_order = new Emerson_Order();
                $Emerson_order->get_order_number($order);

                // if the order does not exist you have to verify that the current date is greater than (the date of emerson_created_on + 2h)
                if (isset($result->Errors) && count($result->Errors) != 0 && strpos($result->Errors[0], 'No order found with order guid')) {
                    date_default_timezone_set('UTC');
                    $actual_date = new DateTime();
                    $emerson_created_on = get_post_meta($order->get_id(), 'emerson_created_on', true);

                    if ($emerson_created_on) {
                        date_add($emerson_created_on, date_interval_create_from_date_string($this->lifetime_order));
                        if ($actual_date > $emerson_created_on) {
                            update_post_meta($order->get_id(), 'emerson_fullfilment_state', 'new');
                        }
                    }
                }
            }
        }
    }

    // Cron job that checks the orders that are in the "processed" state
    function process_processed_orders()
    {
        $query = new WC_Order_Query(array(
            'status' => array('wc-processing'),
            'limit' => -1
        ));

        $orders = $query->get_orders();

        foreach ($orders as $order) {
            $emerson_fullfilment_state = get_post_meta($order->get_id(), 'emerson_fullfilment_state', true);
            if ($emerson_fullfilment_state && $emerson_fullfilment_state == 'processed') {
                $Emerson_order = new Emerson_Order();
                $Emerson_order->get_order_tracking_info($order);
            }
        }
    }

    function eg_schedule_emerson_shipping_created_orders_log()
    {
        if (false === as_next_scheduled_action('emerson_shipping_created_orders')) {
            as_schedule_recurring_action(time(), $this->periodicity_interval_seconds * HOUR_IN_SECONDS, 'emerson_shipping_created_orders');
        }
    }

    function eg_schedule_emerson_shipping_processed_orders_log()
    {
        if (false === as_next_scheduled_action('emerson_shipping_processed_orders')) {
            as_schedule_recurring_action(time(), $this->periodicity_interval_seconds * HOUR_IN_SECONDS, 'emerson_shipping_processed_orders');
        }
    }

    function eg_log_action_emerson_shipping_created_orders()
    {
        error_log('It is just after midnight on ' . date('Y-m-d'));
    }

    function eg_log_action_emerson_shipping_processed_orders()
    {
        error_log('It is just after midnight on ' . date('Y-m-d'));
    }
}
