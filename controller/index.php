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
                    $id_tienda=$u[0][0]['id_tienda'];
                
                    //$contition="id='".$id_tienda."' AND activa=1";
                    //$contition="id=2";
                    $tienda=$model->estado_tienda($id_tienda);
                    foreach($u as $value){
                        
                        if($tienda){
                            $_SESSION['nombre'] = $value[0]['user_name'];
                            $_SESSION['login_id'] = $value[0]['id'];
                            $_SESSION['id_tienda']= $value[0]['id_tienda'];
                            $info_tienda = $model->encontrar_tienda($value[0]['id_tienda']);
                            foreach($info_tienda as $data=>$datos){
                                $_SESSION['nombre_tienda']= $datos[0]['nombre'];
                            }
                        }
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
    static function tiendas($data_backup = null)
    {
        $tiendas = new Model();
        $dato = $tiendas->mostrar_tiendas();
        require_once("views/tiendas.php");
    }

    static function inventario()
    {

        $nombre_tienda = $_SESSION['nombre_tienda'];
        $inventario = new Model();
        $dato=$inventario->get_productos($nombre_tienda);
        if(!empty($dato)){
            $categoria = $inventario->get_categoria($dato);
        }
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
        // Creando copia de los datos para realizar la funcion de desacer cambios
        $condicion='nombre="'.$nombre.'"';
        $backup = $model->mostrar('tienda',$condicion);
        $backup = $backup[0][0];
        $data_backup = '[["m","delTienda"],["id","'.$backup['id'].'"]]';
        //Se redirecciona a la vista de tienda
        modeloController::tiendas($data_backup);
        //Colocación de alertas
        if ($resultado == 'success') {
            echo "<script>Swal.fire('Registro exitoso', 'La tienda se ha registrado con exito', 'success')</script>";
        } else {
            echo "<script>Swal.fire('Registro fallido', 'La tienda se no ha registrado', 'error')</script>";

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
        // Creando copia de los datos para realizar la funcion de desacer cambios
        $condicion='id='.$id;
        $backup = $model->mostrar('tienda',$condicion);
        $backup = $backup[0][0];
        $data_backup = '[["m","EditTienda"],["id","'.$backup['id'].'"],["nombre","'.$backup['nombre'].'"],["radio-stacked","'.$backup['activa'].'"]]';
        //Se llama a la funcion del modelo para editar tienda
        $resultado = $model->EditTienda($id, $nombre, $activa);
        modeloController::tiendas($data_backup);
        //Colocación de alertas
        if ($resultado == 'success') {
            echo "<script>Swal.fire('Actualización exitosa', 'La tienda se ha actualizado con exito', 'success')</script>";
        } else {
            echo "<script>Swal.fire('Actualización fallida', 'La tienda se no ha actualizado', 'error')</script>";

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

    //Funcion para eliminar las tiendas
    static function delTienda(){
        $id_tienda=$_POST['id'];
        $modelo = new Model();
        $condicion='id_tienda='.$id_tienda;
        $categorias = $modelo->mostrar('categorias',$condicion);
        $usuarios = $modelo->mostrar('users',$condicion);
        //Se valida que la tienda no tenga dependencias en ellas
        if(!empty($categorias) or !empty($usuarios)){
            modeloController::tiendas();
            echo "<script> window.addEventListener('load', function() { Swal.fire('Error', 'La tienda tiene dependencias en la aplicción, favor de eliminarlas', 'error')}); </script>";
        }else{
            //Si no tiene dependencias, se puede eliminar
            // Creando copia de los datos para realizar la funcion de desacer cambios
            $condicion='id='.$id_tienda;
            $backup = $modelo->mostrar('tienda',$condicion);
            $backup = $backup[0][0];
            $data_backup = '[["m","addTienda"],["nombre","'.$backup['nombre'].'"],["radio-stacked","'.$backup['activa'].'"]]';
            $dato=$modelo->eliminar('tienda',$condicion);
            if($dato){
                echo "<script> window.addEventListener('load', function() { Swal.fire('Operación exitosa', 'La tienda se eliminó correctamente', 'success')}); </script>";
            }else{
                echo "<script> window.addEventListener('load', function() { Swal.fire('Error', 'La tienda no se ha eliminado', 'error')}); </script>";
            }
            modeloController::tiendas($data_backup);
        }
    }

    // FUNCIONES PARA LA SECCIÓN DE CATEGORIAS

    // Muestra la vista de la tabla de categorias
    static function categoria($data_backup = null){
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
        // Creando copia de los datos para realizar la funcion de desacer cambios
        $backup = $categori->mostrar('categorias',$condition);
        $backup = $backup[0][0];
        $data_backup = '[["m","updateCategoria"],["id","'.$backup['id'].'"],["name","'.$backup['nombre'].'"],["descripcion","'.$backup['descripcion'].'"]]';
        $dato       = $categori->actualizar('categorias',$data,$condition);
        if($dato){
            echo "<script> window.addEventListener('load', function() { Swal.fire('Operación exitosa', 'La informacion se actualizo', 'success')}); </script>";
        }else{
            echo "<script> window.addEventListener('load', function() { Swal.fire('Error', 'No se pudo realizar la Operación', 'error')}); </script>";
        }
        modeloController::categoria($data_backup);
        
    }
        
    // Eliminar la categoria
    static function delCategoria(){
        $id = $_POST['id'];
        $condition = 'id='.$id;
        $categori   = new Model();

        //Validación de eliminación de dependencias
        $condicion='id_categoria='.$id;
        $validacion = $categori->mostrar('productos',$condicion);
        if(!empty($validacion)){
            modeloController::categoria();
            echo "<script> window.addEventListener('load', function() { Swal.fire('Error!', 'La categoria tiene productos ligados', 'error')}); </script>";
        }else{
            // Creando copia de los datos para realizar la funcion de desacer cambios
            $backup = $categori->mostrar('categorias',$condition);
            $backup = $backup[0][0];
            $data_backup = '[["m","addCategoria"],["name","'.$backup['nombre'].'"],["descripcion","'.$backup['descripcion'].'"]]';
            //Funcion para eliminar categorias
            $dato       = $categori->eliminar('categorias',$condition);
            if($dato){
                echo "<script> window.addEventListener('load', function() { Swal.fire('Operación exitosa', 'La categoria se elimino', 'success')}); </script>";
            }else{
                echo "<script> window.addEventListener('load', function() { Swal.fire('Error', 'No se pudo realizar la Operación', 'error')}); </script>";
            }
            //require_once("views/categorias.php");
            modeloController::categoria($data_backup);

        }
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
        
        // Creando copia de los datos para realizar la funcion de desacer cambios
        $condition = 'nombre="'.$nombre.'"';
        $backup = $categoria->mostrar('categorias',$condition);
        $backup = $backup[0][0];
        $data_backup = '[["m","delCategoria"],["id","'.$backup['id'].'"]]';


        if($dato){
            echo "<script> window.addEventListener('load', function() { Swal.fire('Operación exitosa', 'La categoria se agrego', 'success')}); </script>";
        }else{
            echo "<script> window.addEventListener('load', function() { Swal.fire('Error', 'No se pudo realizar la Operación', 'error')}); </script>";
        }
        modeloController::categoria($data_backup);
        
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
            echo "<script>  window.addEventListener('load', function() { Swal.fire('Error', 'La contraseña no coincide', 'error')}); </script>"; 
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
        
        
        // Creando copia de los datos para realizar la funcion de desacer cambios
        $condition = 'user_name="'.$user_name.'"';
        $backup = $categoria->mostrar('users',$condition);
        $backup = $backup[0][0];
        $data_backup = '[["m","delUsuario"],["id","'.$backup['id'].'"]]';
        // Se redirecciona a la vista de usuarios
        require_once("views/usuarios.php");
        if($dato){
            echo "<script> window.addEventListener('load', function() { Swal.fire('Operación exitosa', 'El usuario se ha registrado con exito', 'success')}); </script>";
        }else{
            echo "<script> window.addEventListener('load', function() { Swal.fire('Error', 'No se pudo realizar la Operación', 'error')}); </script>";
        }
        
    }
    //Redireccionar a la vista de agregar usuario
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
        // Creando copia de los datos para realizar la funcion de desacer cambios
        
        $backup = $categori->mostrar('users',$condition);
        
        $backup = $backup[0][0];
        
        $data_backup = '[["m","updateUsuario"],["id","'.$backup['id'].'"],["name","'.$backup['nombre'].'"],["apellido_p","'.$backup['apellido_p'].'"],["apellido_m","'.$backup['apellido_m'].'"],["user_name","'.$backup['user_name'].'"],["email","'.$backup['user_email'].'"]]';
        
        $dato       = $categori->actualizar('users',$data,$condition);
        if($dato){
            echo "<script> window.addEventListener('load', function() { Swal.fire('Operación exitosa!', 'La informacion se actualizo', 'success')}); </script>";
        }else{
            echo "<script> window.addEventListener('load', function() { Swal.fire('Error!', 'No se pudo realizar la Operación', 'error')}); </script>";
        }
        require_once("views/usuarios.php");
        
    }

    // Eliminar usuario
    static function delUsuario(){
        $id = $_POST['id'];
        $condition = 'id='.$id;
        $categori   = new Model();
        // Creando copia de los datos para realizar la funcion de desacer cambios
        $backup = $categori->mostrar('users',$condition);
        $backup = $backup[0][0];
        $data_backup = '[["m","recUsuario"],["name","'.$backup['nombre'].'"],["apellido_p","'.$backup['apellido_p'].'"],["apellido_m","'.$backup['apellido_m'].'"],["user_name","'.$backup['user_name'].'"],["pass","'.$backup['user_password'].'"],["email","'.$backup['user_email'].'"]]';

        $dato       = $categori->eliminar('users',$condition);
        //Se redirecciona a la vista de usuarios
        require_once("views/usuarios.php");
        if($dato){
            echo "<script> window.addEventListener('load', function() { Swal.fire('Operación exitosa', 'El usuario se elimino', 'success')}); </script>";
        }else{
            echo "<script> window.addEventListener('load', function() { Swal.fire('Error', 'No se pudo realizar la Operación', 'error')}); </script>";
        }
        
        
    }
    
    // RECUPERAR USUARIO ELIMINADO  
    static function recUsuario(){
        $_POST['m'] = null;
        $nombre = $_POST['name'];
        $apellido_p = $_POST['apellido_p'];
        $apellido_m = $_POST['apellido_m'];
        $user_name = $_POST['user_name']; 
        $pass = $_POST['pass'];
        $email = $_POST['email'];
        $fecha_actual = date('Y-m-d H:i:s');
        $data = "'".$nombre."','".$apellido_m."','".$apellido_p."','".$user_name."','".$pass."','".$email."','".$fecha_actual."','".$_SESSION['id_tienda']."'";
        $categoria   = new Model();
        $dato       = $categoria->insertar('users',$data);
        if($dato){
            echo "<script> window.addEventListener('load', function() { Swal.fire('Operación exitosa', 'El usuario se ha registrado con exito', 'success')}); </script>";
        }else{
            echo "<script> window.addEventListener('load', function() { Swal.fire('Error', 'No se pudo realizar la Operación', 'error')}); </script>";
        }
        require_once("views/usuarios.php");        
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
        $condicion='codigo='.$codigo;
        // Validar numero negativos
        if($codigo < 0 &&  $precio < 0 && $stock < 0){
            //Se redirecciona a la vista de inventario
            require_once("views/inventario.php");
            echo "<script>Swal.fire('Registro fallido', 'No se aceptan valores negativos', 'error')</script>";
        }
        
        // Realiza la lógica de guardar el producto en la base de datos
        $model = new Model();
        $resultado = $model->addProducto($codigo,$nombre,$precio,$stock,$id_categoria,$id_tienda);
        $backup = $model->mostrar('productos',$condicion);
        $backup = $backup[0][0];
        $data_backup = '[["m","delProducto"],["id","'.$backup['id'].'"]]';
        
        //Se redirecciona a la vista de inventario
        require_once("views/inventario.php");

        //Colocación de alertas
        if ($resultado == 'success') {
            echo "<script>Swal.fire('Registro exitoso', 'El producto se ha registrado con exito', 'success')</script>";
        } else {
            echo "<script>Swal.fire('Registro fallido', 'El producto se no ha registrado', 'error')</script>";

        }

    }

    //Función para la vista Editar producto
    static function viewEditProducto(){
        $id = $_POST['id'];
        $condition = 'id='.$id;
        //Se crea el modelo
        $producto  = new Model();
        //Se obtienen los valores del producto
        $dato= $producto->mostrar('productos',$condition);
        $nombre_tienda = $_SESSION['nombre_tienda'];
        // Se obtienen los datos de categorias
        $condition_tienda="id_tienda='".$_SESSION['id_tienda']."'";
        $dato_categorias = $producto->mostrar('categorias',$condition_tienda);
        //Variables a utilizar en la vista
        $categoria = $dato_categorias[1];
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

        $condicion='id='.$id_producto;
        $modelo = new Model();
        $backup = $modelo->mostrar('productos',$condicion);
        $backup = $backup[0][0];
        $data_backup = '[["m","updateProducto"],["id_producto","'.$backup['id'].'"],["codigo","'.$backup['codigo'].'"],["nombre","'.$backup['nombre'].'"],["precio","'.$backup['precio'].'"],["stock","'.$backup['stock'].'"],["categoria","'.$backup['id_categoria'].'"],["id_tienda","'.$backup['id_tienda'].'"]]';


        $resultado = $modelo->updateProducto($codigo,$nombre,$precio,$stock,$id_categoria,$id_tienda,$id_producto);
        //Se redirecciona a la vista de inventario
        require_once("views/inventario.php");

        //Colocación de alertas
        if ($resultado == 'success') {
            echo "<script>Swal.fire('Actualización exitoso', 'El producto se ha actualizado con exito', 'success')</script>";
        } else {
            echo "<script>Swal.fire('Actualización fallido', 'El producto se no ha actualizado', 'error')</script>";

        }
    }

    //Función para eliminar un producto
    static function delProducto(){
        //Utilizacion de variables
        $id_producto=$_REQUEST['id'];
        $condicion='id='.$id_producto;
        $modelo = new Model();
        // Creando copia de los datos para realizar la funcion de desacer cambios
        $backup = $modelo->mostrar('productos',$condicion);
        $backup = $backup[0][0];
        $data_backup = '[["m","addProducto"],["id","'.$backup['id'].'"],["codigo","'.$backup['codigo'].'"],["nombre","'.$backup['nombre'].'"],["precio","'.$backup['precio'].'"],["stock","'.$backup['stock'].'"],["categoria","'.$backup['id_categoria'].'"],["id_tienda","'.$backup['id_tienda'].'"]]';
        //$data_backup = "[['m','addProducto'],['id','{$backup['id']}'],['codigo','{$backup['codigo']}'],['nombre','{$backup['nombre']}'],['date_added','{$backup['date_added']}'],['precio','{$backup['precio']}'],['stock','{$backup['stock']}'],['id_categoria','{$backup['id_categoria']}'],['id_tienda','{$backup['id_tienda']}']]";
        
        //var_dump($data_backup);
        $resultado = $modelo->eliminar('productos',$condicion);
        //Se redirecciona a la vista de inventario
        require_once("views/inventario.php");

        //Colocación de alertas
        if ($resultado) {
            echo "<script>Swal.fire('Eliminación exitosa', 'El producto se ha eliminado con exito', 'success')</script>";
        } else {
            echo "<script>Swal.fire('Eliminación fallida', 'El producto se no ha actualizado', 'error')</script>";

        }
    }

    //Funcion para la vista Stock Producto
    static function viewStockProducto(){
        $id = $_POST['id'];
        $condition = 'id='.$id;
        //Se crea el modelo
        $producto  = new Model();
        //Se obtienen los valores del producto
        $dato= $producto->mostrar('productos',$condition);
        $nombre_tienda = $_SESSION['nombre_tienda'];
        // Se obtienen los datos de categorias
        $condition_tienda="id_tienda='".$_SESSION['id_tienda']."'";
        $dato_categorias = $producto->mostrar('categorias',$condition_tienda);
        //Variables a utilizar en la vista
        $categoria = $dato_categorias[1];
        $data_producto = $dato[0][0];
        require_once("views/stockProducto.php");
    }

    static function updateStock(){
        //Variables a utilizar
        $stock = $_POST["stock_edit"];
        $id_producto = $_POST['id_producto'];
        $opcion = $_POST["radio-stacked"];
 
        //Creación del modelo
        $modelo = new Model();
        $info_producto= $modelo->stock($id_producto);
        //var_dump($info_producto[0][0]);
        //die();

        //Cuando el usuario selecciona agregar stock
        if($opcion=='agregar'){
            $updateStock = $stock+$info_producto[0][0];
            $resultado = $modelo->updateStock($updateStock,$id_producto);
            require_once("views/inventario.php");
            if($resultado=='success'){
                echo "<script>Swal.fire('Actualización exitosa', 'El stock se ha agregado con exito', 'success')</script>";
            }else{
                echo "<script>Swal.fire('Actualización fallida', 'El stock se no ha agregado', 'error')</script>";
            }
        }
        //Cuando el usuario selecciona eliminar stock
        if($opcion=='eliminar'){
            //Se verifica que el stock no puede ser negativo
            if($stock>$info_producto[0][0]){
                require_once("views/inventario.php");
                echo "<script>Swal.fire('Error', 'No puede haber stock negativo', 'error')</script>";
            }else{
                //Se resta el stock
                $updateStock= $info_producto[0][0]-$stock;
                $resultado = $modelo->updateStock($updateStock,$id_producto);
                require_once("views/inventario.php");
                //Verifica si se realizó la operacion correctamente
                if($resultado=='success'){
                    echo "<script>Swal.fire('Actualización exitosa', 'El stock se ha eliminado con exito', 'success')</script>";
                }else{
                    echo "<script>Swal.fire('Actualización fallida', 'El stock se no ha eliminado', 'error')</script>";
                }
            }

        }

    }



}
