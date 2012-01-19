<?php
Class CryptionHandler {
    private $key = "ASDASDa456oda5asdasdHJG6";
    private $td;
    private $iv ;
    
    public function __construct() {
    }
    
    public function Encrypt($a_input) {
             
        $this->td = mcrypt_module_open('tripledes', '', 'ecb', '');
        $this->iv = mcrypt_create_iv (mcrypt_enc_get_iv_size($this->td), MCRYPT_RAND);
        mcrypt_generic_init($this->td, $this->key, $this->iv);
        $encrypted_data = mcrypt_generic($this->td, $a_input);
        mcrypt_generic_deinit($this->td);
        mcrypt_module_close($this->td);
        return $encrypted_data;
    }
    
    public function crypto($str) {
        return hash_hmac('sha256', $str, $this->key);
    }
    
    function decryptCookie($value){
       if(!$value){return false;}
       $key = 'YH7639SLJAS56ASD';
       $crypttext = base64_decode($value); //decode cookie
       $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
       $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
       $decrypttext = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $crypttext, MCRYPT_MODE_ECB, $iv);
       return trim($decrypttext);
    }
    
    public function test() {
        
         $pass = "Passwoord";
         $encryptPass = $this->Encrypt($pass);
         if($pass == $encryptPass) {
            echo "EncryptionHandler::Encrypt: L�senordet krypteras inte";
            return false;
         }
         $decryptPass = $this->Decrypt($encryptPass);
         
         if(!strcmp($pass,$decryptPass)) {
            echo "EncryptionHandler::Decrypt: L�senrdet decrypteras inte korrekt";
            return false;
         }
         
         $cookiePass = "Password";
         $encyptCookiePass = $this->encryptCookie($cookiePass);
         $decryptedCookiepass = $this->decryptCookie($encyptCookiePass);
         
         if($encyptCookiePass == "Password") {
            echo "EncryptionHandler::encryptCookie: kryptering fungerar inte";
            return false;
         }
         
         if($decryptedCookiepass != "Password") {
            echo "EncryptionHandler::decryptCookie: dekryptering fungerar inte";
            return false;
         }
         
         return true;
    }
}