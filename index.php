<?php
    session_start();
    // Insertando los archivos necesarios
    require_once("config.php");
    require_once("controller/index.php");
    // Insertando el header para todas las paginas
    require_once("layouts/header.php");
    // Verifica si existe una sesion
    if(isset($_SESSION['nombre'])){
        // Verifica si se paso un parametro m por medio de post
        if(isset($_POST['m'])){
            $metodo =   $_POST['m'];
            // Verifica si el valor del parametro m es una funcion dentro de modelController
            if(method_exists("modeloController",$metodo)){
                // Ejecuta la funcion pasada por m
                modeloController::{$metodo}();
                // Si no existe la funcion carga la vista por defecto
            }else{
                require_once("views/index.php");    
            }
        // 
        }else{
            // Condicion donde si la tienda es root, cambie de dashboard a las tiendas 
            if($_SESSION['nombre_tienda']=='root'){
                modeloController::tiendas();
            }else{
            // Si no es root, se va al dashboard de prederminado de las tiendas
                require_once("views/index.php");
            }
        }
        ?>
        
    <?php
    }else{
        // Si no existe una sesion se comprueba que exista un parametro m por post
        if(isset($_POST['m'])){
            $metodo =   $_POST['m'];
            // Se comprueba que exista el metodo m
            if(method_exists("modeloController",$metodo)){
                // Se ejecuta el metodo
                modeloController::{$metodo}();
            }
        }else{
            // Si no existe un metodo se manda a la ventana de login
            modeloController::view_login();
        }
    }
    require_once("layouts/bottom.php");
?>
