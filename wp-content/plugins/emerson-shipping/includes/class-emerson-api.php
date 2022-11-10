<?php

if (!class_exists('Emerson_API')) :
    class Emerson_API
    {
        private $emerson_url;
        private $user; 
        private  $password;
        private  $token; 
        private  $save_logs; 
        private  $logger; 
        public function __construct($instance_id)
        {
       

            $options = unserialize(get_option('emerson_config'));
  

            $this->user = isset($options['username']) ? $options['username'] : '';
            $cryptor = new Cryptor(10, 6);
            $this->password = isset($options['password']) ? $options['password'] : '';
            $this->password = $cryptor->decrypt($options['password']);
            $this->token = isset($options['apiKey']) ? $options['apiKey'] : '';
            $this->emerson_url = isset($options['apiUrl']) ? $options['apiUrl'] : '';
            $this->save_logs = isset($options['saveLogsEmerson']) ? $options['saveLogsEmerson'] : 'no';

            $this->logger = wc_get_logger();

        }

        /**
         * Get the ship names with their cost on emerson api
         * it will be used as proposal, and the user will choose which one he wants
         * 
         * @param object $data
         * @param array  $data.items
         * @param string $data.items[].SKU           unique identifier
         * @param int    $data.items[].quantity      product quantity
         * @param string $data.items[].name
         * @param object $data.address
         * @param string $data.address.Line1
         * @param string $data.address.CountryName
         * @param string $data.address.RegionName
         * @param string $data.address.PostalCode
         * @param string $data.address.FullName       person full name
         * @param string $data.address.PhoneNumber    person phone number
         * @param string $data.address.CountryCode    person phone number
         * @param string $data.address.City           city name
         * @param string $data.address.RegionCode     Ex: CU 
         * 
         * 
         * @return object         $response            
         * @return array[string]  $response.Errors            error arr strings
         * @return array[string]  $response.ShippingMethods   arr of shipping methods
         * @return array[string]  $response.Warnings          warnings
         * @return bool           $response.Success           does emerson api accepted this request?
         *
         */

        public function GetShipViaCosts($data)
        {
            $is_alive = $this->IsAlive();
            if ($is_alive !== true) {
                return $is_alive;
            }

            $line_items = $this->get_items($data);

            $shipping_address = $data['address'];

            $request_body = array(
                'userName' => $this->user,
                'password' => $this->password,
                'apiKey' => $this->token,
                'apiRequestType' => 2,
                'order' => array(
                    'LineItems' => $line_items,
                    "ShipToAddressKey" => null,
                    'ShipToAddress' => $shipping_address

                )
            );

            $response = $this->exec_curl('/OrderService.svc/json/GetShipViaCosts', $request_body);
            if (isset($response->Errors) && count($response->Errors)!=0){
                return (object)array('error'=>true, 'messages'=>$response->Errors);
            }
            return $response;
        }

        /**
         * Check api key, and credentials
         */
        public function CheckCredentials()
        {
            $request_body = array(
                'userName' => $this->user,
                'password' => $this->password,
                'apiKey' => $this->token,
            );

            $error_list=[];
            $response = $this->exec_curl('/OrderService.svc/json/GetShipViaCosts', $request_body);
            if (isset($response->Errors)){
                foreach($response->Errors as $error){
                    $start=substr($error, 0, 4);
                    if ($start==='603:'){
                        $error_list[]=__('Invalid username or password','emerson');
                    }else if ($start==='601:'){
                        $error_list[]=__('Invalid API key','emerson');
                    }
                }
            }
            return $error_list;
        }


        /**
         * Place one order in emerson api, and receive full response with 
         *  the `OrderGuid` 
         * 
         * @param object $data
         * 
         * @param array  $data.items
         * @param string $data.items[].SKU           unique identifier
         * @param int    $data.items[].quantity      product quantity
         * @param string $data.items[].name
         * 
         * @param object $data.address
         * @param string $data.address.Line1
         * @param string $data.address.CountryName
         * @param string $data.address.RegionName
         * @param string $data.address.PostalCode
         * @param string $data.address.FullName       person full name
         * @param string $data.address.PhoneNumber    person phone number
         * @param string $data.address.CountryCode    person phone number
         * @param string $data.address.City           city name
         * @param string $data.address.RegionCode     Ex: 'CU'
         * 
         * @param string $data.ShippingMethod         Shipping method item returned in GetShipViaCosts.ShippingMethods
         * @param string $data.PaymentIdentifier      only 'Terms'
         * @param array[string] $data.OrderComments   if the client write specific messages for his delivery
         * @param bool   $data.SuppressWarnings       do you want to create the order even if some warning exists? 
         *                                            Ex: "12:Item FISH4 has limited stock available."
         * 
         * @param string $data.CustomerOrderNumber    the customer cart number as string
         * 
         * @param integer $api_request_type               1: check the order, 2: check order and address, 3: check order and address, and create order(returning guid) 
         * 
         * 
         * @return object         $response            
         * @return array[string]  $response.Errors            error arr strings
         * @return string         $response.OrderGuid         unique order identificator in emerson
         * @return string         $response.ShipToAddressKey  
         * @return string         $response.SubTotal          
         * @return array[string]  $response.Warnings          warnings
         * @return bool           $response.Success           does emerson api accepted this request?
         * @return object         $response.Order             full order 
         *
         */

        public function SubmitOrder($data, $api_request_type)
        {
            $is_alive = $this->IsAlive();
            if ($is_alive !== true) {
                return $is_alive;
            }

            $line_items = $this->get_items($data);
            
            $shipping_address = $data['address'];

            $request_body = array(
                'userName' => $this->user,
                'password' => $this->password,
                'apiKey' => $this->token,
                'apiRequestType' => $api_request_type,
                'order' => array(
                    'LineItems' => $line_items,
                    "ShipToAddressKey" => null,
                    'ShipToAddress' => $shipping_address,

                    'ShippingMethod' => $data['ShippingMethod'],
                    'PaymentIdentifier' => $data['PaymentIdentifier'],
                    'OrderComments' => $data['OrderComments'],
                    'SuppressWarnings' => $data['SuppressWarnings'],
                    'CustomerOrderNumber' => $data['CustomerOrderNumber'],
                )
            );

            $response = $this->exec_curl('/OrderService.svc/json/SubmitOrder', $request_body);
            return $response;
        }

        private function get_items($data)
        {
            $line_items = [];

            foreach ($data['items'] as $item) {
                array_push($line_items, array(
                    'ItemId' => $item['SKU'],
                    'Quantity' => $item['quantity'],
                    'DisplayName' => $item['name']
                ));
            }
            return $line_items;
        }

        /**
         * Get the order number, with that value we can grab the track informacion
         * 
         * @param string @order_guid   OrderGuid unique order identificator in emerson
         * 
         * @return object        response
         * @return array[string] response.Errors 
         * @return string        OrderNumber          the string we were looking for
         * @return boolean       Success
         */
        function GetOrderNumber($order_guid)
        {
            $is_alive = $this->IsAlive();
            if ($is_alive !== true) {
                return $is_alive;
            }
            $response = $this->exec_curl(
                '/OrderService.svc/json/GetOrderNumber'
                    . '?userName=' . $this->user
                    . '&password=' . $this->password
                    . '&apiKey=' . $this->token
                    . '&OrderGuid=' . $order_guid,
                false
            );
            return $response;
        }

        /**
         * Get the tracking information with the order number
         * 
         * @param string @order_number   orderNumber 
         * 
         * @return object        response
         * @return array[string] response.Errors 
         * @return array         Shipments          
         * @return boolean       Success
         */
        function GetOrderTrackingInformation($order_number)
        {
            $is_alive = $this->IsAlive();
            if ($is_alive !== true) {
                return $is_alive;
            }

            $response = $this->exec_curl(
                '/OrderService.svc/json/GetOrderTrackingInformation'
                    . '?userName=' . $this->user
                    . '&password=' . $this->password
                    . '&apiKey=' . $this->token
                    . '&orderNumber=' . $order_number,
                false
            );
            return $response;
        }

        /**
         * this function check if emerson api is available right now
         * @return boolean   IsAlive
         */
        function IsAlive()
        {
            $response = $this->exec_curl(
                '/OrderService.svc/json/IsAlive'
                    . '?userName=' . $this->user
                    . '&password=' . $this->password
                    . '&apiKey=' . $this->token,
                false
            );
   
            return $response === true? true: (object)array('error' => true, 'messages' => array( __('Emerson API is down','emerson') ));
           
        }


        /**
         * Logs for testing in stage
         */
        function dev_log($type, $key, $value)
        {
            $this->logger->log($type,  $key.' => '. print_r($value,true) , array( 'source' => 'emerson-shipping' ) );   
        }

        function save_log($type, $final_url, $request_body, $status_code, $response){

            if ($this->save_logs !== 'yes'){
                return;
            }
            
            $final_url=explode('?',$final_url);
            $this->dev_log($type, 'Url',$final_url[0]);
            unset($request_body['password']);
            unset($request_body['userName']);
            unset($request_body['apiKey']);
            $this->dev_log($type, 'Request', $request_body);
            $this->dev_log($type, 'Status_Code', $status_code);
            $this->dev_log($type, 'Response', $response);
        }


        /**
         * Execute an external request with curl with method post and content type
         * application-json
         * 
         * @param string $method string    method endpoint
         * @param object $request_body     full request body for the post request
         * 
         * @return object response         full emerson response as object 
         */

        function exec_curl($method, $request_body)
        {
            if (!isset($this->emerson_url) || $this->emerson_url == '') {
                return (object)array(
                    'error' => true,
                    'messages' => array( __('Missing config for Emerson Integration','emerson') )
                );
            }

            $final_url = $this->emerson_url . $method;
            
            $data = $request_body ? array(
                'headers'     => array('Content-Type' => 'application/json; charset=utf-8'),
                'body'        => json_encode($request_body),
                'method'      => 'POST',
                'data_format' => 'body',
            ) : array('method' => 'GET');

            $data['timeout']= 20; //setting wait time to 20 seconds
            
            $response = wp_remote_post($final_url, $data);
            $status_code = wp_remote_retrieve_response_code($response);
            


            if (isset($response->errors)) {
                $this->save_log('warning',$final_url,$request_body,$status_code,$response->errors);
                return (object)array(
                    'error' => true,
                    'messages'=>$response->errors
                );
            }
            
            $body = wp_remote_retrieve_body($response);
            $this->save_log('info',$final_url,$request_body,$status_code, $body);

            if ($status_code < 199 || $status_code > 299) {
                return (object)array(
                    'error' => true,
                    'messages' => array( 
                        sprintf(__('Error: Emerson status code `%s`','emerson'),$status_code), 
                        __('Response:','emerson').serialize($body)
                    )
                );
            }
            return json_decode($body);
        }
    }
endif;
