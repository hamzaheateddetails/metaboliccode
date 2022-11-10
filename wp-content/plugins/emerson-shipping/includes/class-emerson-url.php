<?php

// If this file is called directly, abort.
if (!defined('WPINC')) {
	die;
}



if (!class_exists('Emerson_URL')) :

    class Emerson_URL
    {

        private $base_url;
        private $params;
        private $data;

        public function __construct( $base_url,$params){
            $this->base_url = $base_url;
            $this->data = array();
            $this->params = isset($params) && isset($params['Order']) && isset($params['Order']['Products'])? $params['Order']['Products']: [];
        }

        function add_item($product_id,$quantity){
            if (is_null($this->data[$product_id])){
                $this->data[$product_id] = 0;
            }
            $this->data[$product_id] += $quantity;
        }

        public function get_url(){
            foreach($this->params as $product_item){
               $this->process_product_item($product_item);
            }

            $result ='';
            foreach($this->data as $id=>$quantity){
                $result .= $id.'x'.$quantity.',';
            }

            if (substr($result,-1)==','){
                $result=substr($result,0,-1);
            }
            
            return $this->base_url.$result;
        }

        function get_product_by_sku($sku) {
     
            if (is_null($sku)|| $sku==''){
                return false;
            }
            $product_id = wc_get_product_id_by_sku( $sku);
            if ( $product_id ){
               return wc_get_product( $product_id );
            }
           
            return false;
        }

        private function process_product_item($product_item){
            
            $product_item=$this->get_product_by_sku($product_item['Identifier']);
            
            if ($product_item){
                if ($product_item->get_type() == 'grouped' || $product_item->get_type() == 'variable'){
                    $first_child = $product_item->get_children()[0];
                    $product_item = null;
                    if (isset($first_child)){
                        $first_child = wc_get_product( $first_child );
                        if ($first_child){
                            $product_item = $first_child;
                        }
                    }
                }

                if ($product_item){
                    $quantity = get_post_meta($product_item->get_ID(), 'emerson_quantity', true);
                    $quantity = $quantity!=''?$quantity:1;
                    $this->add_item($product_item->get_ID(),$quantity);
                }
            }
        }
    }

endif;