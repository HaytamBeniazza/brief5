<?php
require_once 'autoload.php';
require_once '../app/controllers/HomeController.php';


$home = new HomeController();

$pages = ['home', 'create', 'update', 'delete', 'about', 'contact', 'gallery', 'admin'];

if(isset($_GET['page'])){
    if(in_array($_GET['page'], $pages)){
        $page = $_GET['page'];
        $home->index($page);
    }else{
        include('../app/views/includes/404.php');
    }
}else{
    $home->index('home');
}

?>