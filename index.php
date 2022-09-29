<?php

include_once "autoload.php";
 session_start();
$session = new Session;
$home = new Home;
include_once "views/header.php";

if(empty($_SESSION['user'])){
    if(!empty($_GET['cont']) && $_GET['cont'] == "register"){
    $session->register();
    }else{
    $session->login();
    }
}else{
if(!empty($_GET['cont'])){
switch ($_GET['cont']) {
    case 'register':
        $session->register();
        break;
    case 'logout':
        $session->logout();
        break;
    default:
        
        $home->getHome();
        break;
}
}else{
    $home->getHome();
}
}