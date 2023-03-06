<?php
date_default_timezone_set('Asia/Manila');

if(!isset($_SESSION)){
    session_start();
}
require('vendor/autoload.php');
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$url = $_ENV['URL'];
$dir = dirname(__DIR__).$url;
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";

// $dir = dirname(__DIR__)."/public_html";

?>