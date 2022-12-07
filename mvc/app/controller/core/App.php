<?php

class App
{
    private function splitUrl()
    {
        $URL = $_GET['url'] ?? 'home';
        $URL = explode("/", $URL); 
        return $URL;
    }

    public function loadController()
    {
        $URL = $this->splitUrl();

        $filename = "../app/controller/".ucfirst($URL[0]).".php";
        if(file_exists($filename))
        {
            require $filename;
        }else{
            $filename = "../app/controller/_404.php";
            require $filename;
        }
    }
}
