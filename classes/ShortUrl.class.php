<?php
class ShortUrl
{                  
    public $packer;
    public $packerS;
    public $short_url;
    public $user_url;

     function __construct() {

         $loader = require('./vendor/autoload.php');

         $loader->add('Packer\\', __DIR__);

         $this->packer = new Packer\Packer('data/userLinks.pack');

         $this->packerS = new Packer\Packer('data/shortLinks.pack');

    }

    public function storeUrl($user_url)
    {

        $this->short_url = $this->create_url();

        $this->packer->write($this->short_url, $user_url);

        $this->packerS->write($user_url, $this->short_url);

        return $this->short_url;
        
    }
                           
    public function getShortUrl($user_url)
    {

            $this->short_url = $this->packerS->read($user_url);
             
            return $this->short_url;

    }

    public function shortUrlExist($user_url)
    {
        
        if ($this->packerS->exist($user_url)) {
        
            return true;

        } else {
         
            return false;

        }
    }

    public function getUserUrl($short_url)
    {

            $this->user_url = $this->packer->read($short_url);
             
            return $this->user_url;

    }

    private function create_url() 
    { 

        $chars = "123456789abcdfghjkmnpqrstvwxyzABCDFGHJKLMNPQRSTVWXYZ";

        $arr = str_split($chars);
    
        $url = ""; 

        for ($i = 0; $i < 5; $i++) { 

            $random = rand(0, count($arr) - 1); 

            $url .= $arr[$random]; 

        }

        if ($this->packer->exist($url)) {

            return $this->create_url();

        }

        return $url; 
    } 

}
?>