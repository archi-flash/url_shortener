<?php
  ini_set('display_errors', true);error_reporting(E_ALL ^ E_NOTICE);

$user_url = filter_var($_GET['url'], FILTER_SANITIZE_STRING);

$host = "http".(!empty($_SERVER['HTTPS'])?"s":"")."://".$_SERVER['SERVER_NAME'].dirname($_SERVER['REQUEST_URI'])."/";


if (!filter_var($user_url, FILTER_VALIDATE_URL)){

    echo "this is not a valid URL";

    exit;

}

require_once 'classes/shortUrl.class.php';

$shortUrl = new ShortUrl();


if($shortUrl->shortUrlExist($user_url)){

     echo json_encode(['status'=>1,'url'=>$host.($shortUrl->getShortUrl($user_url))]);

     exit;
}

$short_url = $shortUrl->storeUrl($user_url);

echo json_encode(['status'=>1,'url'=>$host.$short_url]);

