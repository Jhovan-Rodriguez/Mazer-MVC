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
        // Muestra el form para añadir una tienda
        static function viewAddTienda(){
            require_once("views/addTienda.php");
        }
        // Muestra el form para modificr una tienda
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
                        $_SESSION['id_tienda']= $value[0]['id_tienda'];
                        $info_tienda = $model->encontrar_tienda($value[0]['id_tienda']);
                        
                    }
                    foreach($info_tienda as $data=>$datos){
                        $_SESSION['nombre_tienda']= $datos[0]['nombre'];
                    }
                }
            
            header("location:".urlsite);
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

    static function InTienda(){
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

    // Muestra la vista de la tabla de categorias
    static function categoria(){
        $tiendas   = new Model();
        $dato       = $tiendas->mostrar('categorias','1');
        require_once("views/categorias.php");
    }
    // Muestra el form para añadir una categoria
    static function viewAddCategoria(){
        require_once("views/addCategoria.php");
    }

    // Muestra el form para añadir una categoria
    static function viewEditCategoria(){
        $id = $_POST['id'];
        $condition = 'id='.$id;
        $categori   = new Model();
        $dato       = $categori->mostrar('categorias',$condition);
        $data_categoria = $dato[0][0];
        require_once("views/editarCategoria.php");
    }

    // Actualizar la categoria
    static function updateCategoria(){
        $id = $_POST['id'];
        $nombre = $_POST['name'];
        $descripcion = $_POST['descripcion'];
        $data = "nombre='".$nombre."',descripcion='".$descripcion."'";
        $condition = 'id='.$id;
        $categori   = new Model();
        $dato       = $categori->actualizar('categorias',$data,$condition);
        modeloController::categoria();
        
    }
        
    // Eliminar la categoria
    static function delCategoria(){
        $id = $_POST['id'];
        $condition = 'id='.$id;
        $categori   = new Model();
        $dato       = $categori->eliminar('categorias',$condition);
        modeloController::categoria();
        
    }

    // Añadir nueva categoria
    static function addCategoria(){
        $nombre = $_POST['name'];
        $descripcion = $_POST['descripcion'];
        $fecha_actual = date('Y-m-d H:i:s');
        $id_tienda = $_SESSION['id_tienda'];
        $data = "'".$nombre."','".$descripcion."','".$fecha_actual."','".$id_tienda."'";
        $categoria   = new Model();
        $dato       = $categoria->insertar('categorias',$data);
        modeloController::categoria();
        
    }

}