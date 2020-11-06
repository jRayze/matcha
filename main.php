<?php
    if(!function_exists('classAutoLoader')){
        function classAutoLoader($class){
            $class=strtolower($class);
            $classFile=$_SERVER['DOCUMENT_ROOT'].'/include/class/'.$class.'.class.php';
            if(is_file($classFile)&&!class_exists($class)) include $classFile;
        }
    }
    spl_autoload_register('classAutoLoader');
    include ('start.php');
    include ('login.php');
    include ('end.php');
?>