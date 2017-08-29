<?php

$key = $_SERVER["QUERY_STRING"];

if($key==""){

    header("Location:form.php");

    exit;
}

$reg = '/^[A-Za-z0-9]{5,5}$/';

if(preg_match($reg,$key)){

    require_once 'classes/shortUrl.class.php';
                   
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