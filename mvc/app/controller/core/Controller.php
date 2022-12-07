<?php

class Controller
{
    public function view($name)
    {
       $filename = "../app/views/".$name."view.php"; 
       if(file_exists($filename))
       {
        require $filename;
       }else{
        $filename = "../app/views/_404.view.php";
        require $filename;
       }
    }
}