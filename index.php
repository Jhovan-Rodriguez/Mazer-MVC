<?php
    session_start();
    require_once("config.php");
    require_once("controller/index.php");
    require_once("layouts/header.php");
    if(isset($_SESSION['nombre'])){
        if(isset($_POST['m'])){
            $metodo =   $_POST['m'];
            if(method_exists("modeloController",$metodo)){
                modeloController::{$metodo}();
            }else{
                require_once("views/index.php");    
            }
        }else{
            #Condicion donde si la tienda es root, cambie de dashboard a las tiendas 
            if($_SESSION['nombre_tienda']=='root'){
                modeloController::tiendas();
            }else{
            #Si no es root, se va al dashboard de prederminado de las tiendas
                require_once("views/index.php");
            }
        }
        ?>
        
    <?php
    }else{
        
        if(isset($_POST['m'])){
            $metodo =   $_POST['m'];
            if(method_exists("modeloController",$metodo)){
                modeloController::{$metodo}();
            }
        }else{
            modeloController::view_login();
        }
    }
    require_once("layouts/bottom.php");
?>