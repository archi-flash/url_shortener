<?php
class ShortUrl
{                  
    public static $packer;
    public static $packerS;
    public static $short_url;
    public static $user_url;

   function __construct() {

       $loader = require('./vendor/autoload.php');

       $loader->add('Packer\\', __DIR__);

       self::$packer = new Packer\Packer('data/userLinks.pack');

       self::$packerS = new Packer\Packer('data/shortLinks.pack');

   }

    public function storeUrl($user_url){

        self::$short_url = self::create_url();

        self::$packer->write(self::$short_url, $user_url);

        self::$packerS->write($user_url, self::$short_url);

        return self::$short_url;
        
    }
                           
    public function getShortUrl($user_url){

            self::$short_url = self::$packerS->read($user_url);
             
            return self::$short_url;

    }

    public function shortUrlExist($user_url){
        
        if(self::$packerS->exist($user_url)){
        
            return true;

        }else{
         
            return false;

        }
    }

    public function getUserUrl($short_url){

            self::$user_url = self::$packer->read($short_url);
             
            return self::$user_url;

    }

    private function create_url() { 

        $chars = "123456789abcdfghjkmnpqrstvwxyzABCDFGHJKLMNPQRSTVWXYZ";

        $arr = str_split($chars);
    
        $url = ""; 

        for($i = 0; $i < 5; $i++){ 

            $random = rand(0, count($arr) - 1); 

            $url .= $arr[$random]; 

        }

        if(self::$packer->exist($url)){

            return self::create_url();

        }

        return $url; 
    } 

}
?>