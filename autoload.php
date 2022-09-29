<?php


spl_autoload_register(function ($class){
 $file = "models/" . $class . ".php";
    if(file_exists($file)){
        include $file;
    }else{
        $file = "controllers/" . $class . ".php";
        if(file_exists($file)){
            include $file;
        }
    }
});