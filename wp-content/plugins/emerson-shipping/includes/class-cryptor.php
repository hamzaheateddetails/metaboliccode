<?php

if ( ! class_exists( 'Cryptor' ) ) :
    class Cryptor{
        private $key;
        private $salt;
 
        public function __construct($key_length,$salt_length){
            $this->salt=substr(AUTH_KEY,0,$salt_length);
            $this->key=substr(SECURE_AUTH_KEY,0,$key_length);
        }

        /**
         * cipher string with aes, using wp-config values
         * 
         * @param  string $value      text to cipher
         * 
         * @return string $response  ciphered text
         * 
         */
        public function encrypt( $value ) {
            if ( ! extension_loaded( 'openssl' ) ) {
                return $value;
            }
        
            $method = 'aes-256-ctr';
            $ivlen  = openssl_cipher_iv_length( $method );
            $iv     = openssl_random_pseudo_bytes( $ivlen );
        
            $raw_value = openssl_encrypt( $value .$this->salt, $method, $this->key, 0, $iv );
            if ( ! $raw_value ) {
                return false;
            }
        
            return base64_encode( $iv . $raw_value );
        }
    
    
        /**
         * decipher string with aes, using wp-config values
         * 
         * @param  string $value      ciphered text
         * 
         * @return string $response   plain text
         * 
         */
        public function decrypt( $raw_value ) {
            if ( ! extension_loaded( 'openssl' ) ) {
                return $raw_value;
            }
        
            $raw_value = base64_decode( $raw_value, true );
        
            $method = 'aes-256-ctr';
            $ivlen  = openssl_cipher_iv_length( $method );
            $iv     = substr( $raw_value, 0, $ivlen );
        
            $raw_value = substr( $raw_value, $ivlen );
        
            $value = openssl_decrypt( $raw_value, $method, $this->key, 0, $iv );
            if ( ! $value || substr( $value, - strlen($this->salt ) ) !==$this->salt ) {
                return false;
            }
        
            return substr( $value, 0, - strlen($this->salt ) );
        }
    }
endif;


   