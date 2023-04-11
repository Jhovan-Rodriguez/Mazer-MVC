<?php
require_once("model/index.php");
require_once("config.php");
class modeloController
{
    private $model;
    //Constructor del modelo
    public function __construct()
    {
        $this->model = new Model();
    }
    //Funcion a la vista login
    static function view_login()
    {
        require_once("views/login.php");
    }

    static function viewAddTienda()
    {
        require_once("views/addTienda.php");
    }

    static function viewEditTienda()
    {
        require_once("views/editarTienda.php");
    }

    //Función para el logueo de usuarios e identificación de variables de sesión
    static function login()
    {
        $model = new Model();

        session_start();

        if (isset($_POST['btnlogin'])) {
            $nombre = $_POST['nombre'];
            $password = md5($_POST['password']);
            $data = "user_name='" . $nombre . "' AND user_password='" . $password . "'";
            $u = $model->login("users", $data);
            if ($u) {
                foreach ($u as $value) {
                    $_SESSION['nombre'] = $value[0]['user_name'];
                    $_SESSION['login_id'] = $value[0]['id'];
                    $info_tienda = $model->encontrar_tienda($value[0]['id_tienda']);
                }
                foreach ($info_tienda as $data => $datos) {
                    $_SESSION['nombre_tienda'] = $datos[0]['nombre'];

                }
            }
            header("location:" . urlsite);
        } else {
            echo "Sin sesion";
        }

    }
    //Función para el log out del usuario
    static function logout()
    {
        session_start();
        unset($_SESSION['nombre']);
        unset($_SESSION['login_id']);
        session_destroy();
        header("location:" . urlsite);
    }
    //Función para la vista tiendas y el muestreo de datos
    static function tiendas()
    {
        $tiendas = new Model();
        $dato = $tiendas->mostrar_tiendas();
        require_once("views/tiendas.php");
    }

    //Función para añadir tienda a la base de datos
    static function addTienda()
    {
        session_start();
        $nombre = $_POST["nombre"];
        $activa = $_POST["radio-stacked"];
        // Realiza la lógica de guardar la tienda en la base de datos
        $model = new Model();
        $resultado = $model->addTienda($nombre, $activa);
        //Se redirecciona a la vista de tienda
        require_once("views/tiendas.php");
        //Colocación de alertas
        if ($resultado == 'success') {
            echo "<script>Swal.fire('Registro exitoso!', 'La tienda se ha registrado con exito', 'success')</script>";
        } else {
            echo "<script>Swal.fire('Registro fallido!', 'La tienda se no ha registrado', 'error')</script>";

        }

    }

    static function EditTienda()
    {
        session_start();
        //Se obtienen los valores de la actualización
        $nombre = $_POST['nombre'];
        $id = $_POST['id'];
        $activa = $_POST["radio-stacked"];
        //Se crea un modelo
        $model = new Model();
        //Se llama a la funcion del modelo para editar tienda
        $resultado = $model->EditTienda($id, $nombre, $activa);
        require_once("views/tiendas.php");
        //Colocación de alertas
        if ($resultado == 'success') {
            echo "<script>Swal.fire('Actualización exitosa!', 'La tienda se ha actualizado con exito', 'success')</script>";
        } else {
            echo "<script>Swal.fire('Actualización fallida!', 'La tienda se no ha actualizado', 'error')</script>";

        }
    }

    static function InTienda()
    {
        session_start();
        $id_tienda = $_POST['id'];
        $model = new Model();
        $resultado = $model->consultaTienda($id_tienda);
        foreach ($resultado as $datos => $value) {
            $nombre_tienda = $value['nombre'];
        }
        $_SESSION['nombre_tienda'] = $nombre_tienda;
        require_once("views/index.php");

    }

}