<?php
    session_start();
    require_once("config.php");
    require_once("controller/index.php");
    require_once("layouts/header.php");
    if(isset($_SESSION['nombre'])):
        if(isset($_POST['m'])):
            $metodo =   $_POST['m'];
            if(method_exists("modeloController",$metodo)):  
                modeloController::{$metodo}();
            else:
                require_once("views/index.php");    
            endif;
        else:
            require_once("views/index.php");
        endif;
        ?>
        
    <?php
    else:
        
        if(isset($_POST['m'])):
            $metodo =   $_POST['m'];
            if(method_exists("modeloController",$metodo)):  
                modeloController::{$metodo}();
            endif;
        else:
            modeloController::view_login();
        endif;
    endif;
    require_once("layouts/bottom.php");
?>