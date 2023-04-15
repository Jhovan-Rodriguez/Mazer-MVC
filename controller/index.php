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

        //Funcion vista para añadir productos
        static function viewAddProducto(){
            $inventario = new Model();
            //$dato=$inventario->get_productos($nombre_tienda);
            $condition="id_tienda='".$_SESSION['id_tienda']."'";
            $dato = $inventario->mostrar('categorias',$condition);
            $categoria = $dato[0];
            
            //$categoria = $inventario->get_categoria($dato);
            require_once("views/addProducto.php");
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

    static function inventario()
    {
        session_start();
        $nombre_tienda = $_SESSION['nombre_tienda'];
        $inventario = new Model();
        $dato=$inventario->get_productos($nombre_tienda);
        $categoria = $inventario->get_categoria($dato);
        require_once("views/inventario.php");
        
    }

    // FUNCIONES PARA LA SECCIÓN DE TIENDAS

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

    //Funcion para editar la tienda
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

    //Funcion para ingresar a la tienda
    static function InTienda(){
        session_start();
        $id_tienda = $_POST['id'];
        $_SESSION['id_tienda']= $_POST['id'];
        $model = new Model();
        $resultado = $model->consultaTienda($id_tienda);
        foreach ($resultado as $datos => $value) {
            $nombre_tienda = $value['nombre'];
        }
        $_SESSION['nombre_tienda'] = $nombre_tienda;
        require_once("views/index.php");
    }

    // FUNCIONES PARA LA SECCIÓN DE CATEGORIAS

    // Muestra la vista de la tabla de categorias
    static function categoria(){
        $tiendas   = new Model();
        $condition = "id_tienda='".$_SESSION['id_tienda']."'";
        $dato       = $tiendas->mostrar('categorias',$condition);
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
        if($dato){
            echo "<script> window.addEventListener('load', function() { Swal.fire('Operasion exitosa!', 'La informacion se actualizo', 'success')}); </script>";
        }else{
            echo "<script> window.addEventListener('load', function() { Swal.fire('Error!', 'No se pudo realizar la operasion', 'error')}); </script>";
        }
        modeloController::categoria();
        
    }
        
    // Eliminar la categoria
    static function delCategoria(){
        $id = $_POST['id'];
        $condition = 'id='.$id;
        $categori   = new Model();
        $dato       = $categori->eliminar('categorias',$condition);
        if($dato){
            echo "<script> window.addEventListener('load', function() { Swal.fire('Operasion exitosa!', 'La categoria se elimino', 'success')}); </script>";
        }else{
            echo "<script> window.addEventListener('load', function() { Swal.fire('Error!', 'No se pudo realizar la operasion', 'error')}); </script>";
        }
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
        if($dato){
            echo "<script> window.addEventListener('load', function() { Swal.fire('Operasion exitosa!', 'La categoria se agrego', 'success')}); </script>";
        }else{
            echo "<script> window.addEventListener('load', function() { Swal.fire('Error!', 'No se pudo realizar la operasion', 'error')}); </script>";
        }
        modeloController::categoria();
        
    }


    // Muestra la vista de la tabla de usuarios
    static function usuarios(){
        $tiendas   = new Model();
        $condition = "id_tienda='".$_SESSION['id_tienda']."'";
        $dato       = $tiendas->mostrar('users',$condition);
        require_once("views/usuarios.php");
    }

    // Añadir nuevo usuario
    static function addUsuario(){
        $_POST['m'] = null;
        $nombre = $_POST['name'];
        $apellido_p = $_POST['apellido_p'];
        $apellido_m = $_POST['apellido_m'];
        $user_name = $_POST['user_name'];
        $pass_conf = $_POST['conf_pass']; 
        $pass = $_POST['pass'];
        if (($pass != $pass_conf)){
            //Colocación de alertas
            echo "<script>  window.addEventListener('load', function() { Swal.fire('Error!', 'La contraseña no coincide', 'error')}); </script>"; 
            echo "<script>  document.body.innerHTML = ''; </script>";
            modeloController::usuarios();
            return "Error";
        }
        $pass = md5($pass);
        $email = $_POST['email'];
        $fecha_actual = date('Y-m-d H:i:s');
        $data = "'".$nombre."','".$apellido_m."','".$apellido_p."','".$user_name."','".$pass."','".$email."','".$fecha_actual."','".$_SESSION['id_tienda']."'";
        $categoria   = new Model();
        $dato       = $categoria->insertar('users',$data);
        if($dato){
            echo "<script> window.addEventListener('load', function() { Swal.fire('Operasion exitosa!', 'El usuario se ha registrado con exito', 'success')}); </script>";
        }else{
            echo "<script> window.addEventListener('load', function() { Swal.fire('Error!', 'No se pudo realizar la operasion', 'error')}); </script>";
        }
        modeloController::usuarios();
        
    }
    static function viewAddUsuario(){
        require_once("views/addUsuario.php");
    }

    // Muestra el form para editar un usuario
    static function viewEditUsuario(){
        $id = $_POST['id'];
        $condition = 'id='.$id;
        $categori   = new Model();
        $dato       = $categori->mostrar('users',$condition);
        $data_categoria = $dato[0][0];
        require_once("views/editarUsuario.php");
    }

    // Actualizar un usuario
    static function updateUsuario(){
        $id = $_POST['id'];
        $nombre = $_POST['name'];
        $apellido_p = $_POST['apellido_p'];
        $apellido_m = $_POST['apellido_m'];
        $user_name = $_POST['user_name'];
        $email = $_POST['email'];
        $fecha_actual = date('Y-m-d H:i:s');

        $data = "nombre='".$nombre."',apellido_p='".$apellido_p."',apellido_m='".$apellido_m."',user_name='".$user_name."',user_email='".$email."',date_added='".$fecha_actual."'";
        $condition = 'id='.$id;
        $categori   = new Model();
        $dato       = $categori->actualizar('users',$data,$condition);
        if($dato){
            echo "<script> window.addEventListener('load', function() { Swal.fire('Operasion exitosa!', 'La informacion se actualizo', 'success')}); </script>";
        }else{
            echo "<script> window.addEventListener('load', function() { Swal.fire('Error!', 'No se pudo realizar la operasion', 'error')}); </script>";
        }
        modeloController::usuarios();
        
    }

    // Eliminar usuario
    static function delUsuario(){
        $id = $_POST['id'];
        $condition = 'id='.$id;
        $categori   = new Model();
        $dato       = $categori->eliminar('users',$condition);
        if($dato){
            echo "<script> window.addEventListener('load', function() { Swal.fire('Operasion exitosa!', 'El usuario se elimino', 'success')}); </script>";
        }else{
            echo "<script> window.addEventListener('load', function() { Swal.fire('Error!', 'No se pudo realizar la operasion', 'error')}); </script>";
        }
        modeloController::usuarios();
        
    }
    

    // FUNCIONES PARA LA SECCIÓN DE PRODUCTOS
    static function addProducto(){
        session_start();
        $codigo = $_POST["codigo"];
        $nombre = $_POST["nombre"];
        $precio = $_POST['precio'];
        $stock = $_POST['stock'];
        $id_categoria = $_POST['categoria'];
        $id_tienda = $_POST['id_tienda'];
        // Realiza la lógica de guardar el producto en la base de datos
        $model = new Model();
        $resultado = $model->addProducto($codigo,$nombre,$precio,$stock,$id_categoria,$id_tienda);
        //Se redirecciona a la vista de inventario
        require_once("views/inventario.php");

        //Colocación de alertas
        if ($resultado == 'success') {
            echo "<script>Swal.fire('Registro exitoso!', 'El producto se ha registrado con exito', 'success')</script>";
        } else {
            echo "<script>Swal.fire('Registro fallido!', 'El producto se no ha registrado', 'error')</script>";

        }

    }

    static function viewEditProducto(){
        $id = $_POST['id'];
        $condition = 'id='.$id;
        $producto  = new Model();
        $dato       = $producto->mostrar('productos',$condition);
        $nombre_tienda = $_SESSION['nombre_tienda'];
        //$productos=$producto->get_productos($nombre_tienda);
        //$categoria = $producto->get_categoria($productos);
        $condition="id_tienda='".$_SESSION['id_tienda']."'";
        $dato = $producto->mostrar('categorias',$condition);
        $categoria = $dato[0];
        $data_producto = $dato[0][0];
        require_once("views/editarProducto.php");
    }

    //Funcion para actualizar productos
    static function updateProducto(){
        $codigo = $_POST["codigo"];
        $nombre = $_POST["nombre"];
        $precio = $_POST['precio'];
        $stock = $_POST['stock'];
        $id_producto=$_POST['id_producto'];
        $id_categoria = $_POST['categoria'];
        $id_tienda = $_POST['id_tienda'];
        $modelo = new Model();
        $resultado = $modelo->updateProducto($codigo,$nombre,$precio,$stock,$id_categoria,$id_tienda,$id_producto);
        //Se redirecciona a la vista de inventario
        require_once("views/inventario.php");

        //Colocación de alertas
        if ($resultado == 'success') {
            echo "<script>Swal.fire('Actualización exitoso!', 'El producto se ha actualizado con exito', 'success')</script>";
        } else {
            echo "<script>Swal.fire('Actualización fallido!', 'El producto se no ha actualizado', 'error')</script>";

        }
    }

}