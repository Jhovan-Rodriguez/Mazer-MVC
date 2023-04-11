<?php
    require_once("model/index.php");
    require_once("config.php");
    class modeloController{
        private $model;
        //Constructor del modelo
        public function __construct(){
            $this->model = new Model();
        }
        //Funcion a la vista login
        static function view_login(){
            require_once("views/login.php");
        }

        static function viewAddTienda(){
            require_once("views/addTienda.php");
        }

        static function viewEditTienda(){
            require_once("views/editarTienda.php");
        }

        //Función para el logueo de usuarios e identificación de variables de sesión
        static function login(){
            $model = new Model();
            
            session_start();
            
            if(isset($_POST['btnlogin'])){
                $nombre = $_POST['nombre'];
                $password = md5($_POST['password']);
                $data = "user_name='".$nombre."' AND user_password='".$password."'";
                $u=$model->login("users",$data);
                if($u){
                    foreach($u as $value){
                        $_SESSION['nombre'] = $value[0]['user_name'];
                        $_SESSION['login_id'] = $value[0]['id'];
                        $info_tienda = $model->encontrar_tienda($value[0]['id_tienda']);
                    }
                    foreach($info_tienda as $data=>$datos){
                        $_SESSION['nombre_tienda']= $datos[0]['nombre'];

                    }
                }
                header("location:".urlsite);
            }else{
                echo "Sin sesion";
            }
            
        }
        //Función para el log out del usuario
        static function logout(){
            session_start();
            unset($_SESSION['nombre']);
            unset($_SESSION['login_id']);
            session_destroy();
            header("location:".urlsite);
        }
        //Función para la vista tiendas y el muestreo de datos
        static function tiendas(){
            $tiendas   = new Model();
            $dato       = $tiendas->mostrar_tiendas();
            require_once("views/tiendas.php");
        }

    }
