<?php

spl_autoload_register(function ($class_name) {
    include 'classes/'.$class_name . '.class.php';
});

if ($_GET['url']) {

    $user_url = filter_var($_GET['url'], FILTER_SANITIZE_STRING);

    $host = "http".(!empty($_SERVER['HTTPS'])?"s":"")."://".$_SERVER['SERVER_NAME'].dirname($_SERVER['REQUEST_URI'])."/";


    if (!filter_var($user_url, FILTER_VALIDATE_URL)) {

        echo "this is not a valid URL";

        exit;

    }

    $shortUrl = new ShortUrl();


    if( $shortUrl->shortUrlExist($user_url)) {

         echo json_encode(['status'=>1,'url'=>$host.($shortUrl->getShortUrl($user_url))]);

         exit;
    }

    $short_url = $shortUrl->storeUrl($user_url);

    echo json_encode(['status'=>1, 'url'=>$host.$short_url]);

    exit;

}

$key = $_SERVER["QUERY_STRING"];

if($key=="") {

    include("templates/form.html");

    exit;
}

$reg = '/^[A-Za-z0-9]{5,5}$/';

if (preg_match($reg,$key)) {

                   
    $shortUrl = new ShortUrl();

    $user_url = $shortUrl->getUserUrl($key);

    if (is_null($user_url)) {

        echo "URL does not exist.";

    } else {
        
        header("Location: $user_url");

    }

} else {

    echo "URL does not exist.";

}
?>