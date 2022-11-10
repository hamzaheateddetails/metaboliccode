<?php

// If this file is called directly, abort.
if (!defined('WPINC')) {
	die;
}

if (!class_exists('Emerson_REST')) :

    class Emerson_REST
    {
         
        public function __construct()
        {
         
            add_action( 'rest_api_init', function () {
                register_rest_route( 'emerson-shipping', '/v1/check-connection/',
                    array(
                        'methods' => 'POST', 
                        'permission_callback'=>'__return_true',
                        'callback' => array($this, 'check_api_connection')
                    )
                );

                register_rest_route( 'emerson-shipping', '/v1/generate-url',
                    array(                      
                        //the endpoint is "our-site/wp-json/emerson-shipping/v1/generate-url"
                        'methods'  => 'POST',
                        'callback' => array( $this, 'generate_url'),      //what we do at the endpoint
                        'permission_callback' => function() {
                            return true;                                               //check authentication
                        }
                    )
                );

            });          
        }

        function generate_url(WP_REST_Request $request){
            $data = $request->get_params();
            $obj =new Emerson_Url(home_url('/').'?add-to-cart=',$data);
            return $obj->get_url();
        }


        function check_api_connection(){

            // $do_check = check_ajax_referer('emerson_config_nonce',$_POST['_ajax_nonce'],false);
            // return $do_check;
            // $do_check = wp_verify_nonce($_POST['_ajax_nonce'],EMERSON_CONFIG_NAME);
            // if (!$do_check){
            // 	return [];
            // }
            $emerson_api        = new Emerson_API(EMERSON_CONFIG_NAME);
            $is_alive = $emerson_api->IsAlive();
            $arr=[];
        
            if ($is_alive!==true){
                array_push($arr,'Cannot reach Emerson\'s API');
            }else{
                $arr=$emerson_api->CheckCredentials();
            }
            $message="Connection tested with stored  settings. \nResult:\n";
            if (count($arr)!=0){
                foreach($arr as $item){
                    $message.=$item." \n";
                }
            }else{
                $message.='Connection success';
            }
        
            return $message;
        }
        
        
    }
    $obj = new Emerson_REST();
endif;


