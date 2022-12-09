<?php

class HomeController{
    public function index($page){
        include('../app/views/'.$page.'.php');
    }
}
?>