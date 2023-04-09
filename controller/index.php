<?php
    require_once("model/index.php");
    require_once("config.php");
    class modeloController{
        private $model;

        public function __construct(){
            $this->model = new Model();
        }

        static function view_login(){
            require_once("views/login.php");
        }

        static function login(){
            $model = new Model();
            
            session_start();
            
            if(isset($_POST['btnlogin'])){
                $nombre = $_POST['nombre'];
                $password = $_POST['password'];
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

        static function logout(){
            session_start();
            unset($_SESSION['nombre']);
            unset($_SESSION['login_id']);
            session_destroy();
            header("location:".urlsite);
        }

        static function tiendas(){
            $tiendas   = new Model();
            $dato       = $tiendas->mostrar_tiendas();
            require_once("views/tiendas.php");
        }

    }