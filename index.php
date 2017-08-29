<?php
spl_autoload_register(function ($class_name) {
    include 'classes/'.$class_name . '.class.php';
});


$key = $_SERVER["QUERY_STRING"];

if($key==""){

    include("templates/form.html");

    exit;
}

$reg = '/^[A-Za-z0-9]{5,5}$/';

if(preg_match($reg,$key)){

                   
    $shortUrl = new ShortUrl();

    $user_url = $shortUrl->getUserUrl($key);

    if(is_null($user_url)){

        echo "URL does not exist.";

    }else{
        
        header("Location: $user_url");

    }

}else{

    echo "URL does not exist.";

}
?>