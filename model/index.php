<?php
class Model
{
    private $Modelo;
    private $db;
    private $datos;

    public function __construct()
    {
        $this->Modelo = array();
        $this->datos = array();
        $this->db = new PDO('mysql:host=localhost;dbname=db_tienda', "root", "root");
    }

    //BUSCAR LOG IN
    public function login($tabla, $condicion)
    {
        $consul = "select * from " . $tabla . " where " . $condicion . ";";
        $resultado = $this->db->query($consul);
        while ($filas = $resultado->fetchAll(PDO::FETCH_ASSOC)) {
            $this->datos[] = $filas;
        }
        return $this->datos;
    }
    
    //Función para mostrar los datos de tabla x
    public function mostrar($tabla,$condicion){
            $consul="select * from ".$tabla." WHERE ".$condicion.";";
            $resu=$this->db->query($consul);
            while($filas=$resu->fetchAll(PDO::FETCH_ASSOC)){
                $this->datos[]=$filas;
            }
            return $this->datos;    
    }
    //Consulta a la tabla tiendas, donde se muestren todas menos la root
    public function mostrar_tiendas()
    {
        $nombre_tienda = "root";
        $consul = "select * from tienda where nombre <> '" . $nombre_tienda . "'";
        $resu = $this->db->query($consul);
        while ($filas = $resu->fetchAll(PDO::FETCH_ASSOC)) {
            $this->datos[] = $filas;
        }
        return $this->datos;
    }

    //Consulta a la tabla tiendas, donde se muestren todas menos la root
    public function estado_tienda($id)
    {
        $sql = "SELECT * from tienda WHERE id =$id AND activa = 1 ;";
        $statement = $this->db->prepare($sql);
        $statement->execute();
        $results = $statement->fetchAll();
        // var_dump($results);
        if(!empty($results)){
            return true;
        }else{
            return false;
        }
        
    }


    //Función para encontrar tiendas dentro de la aplicación
    public function encontrar_tienda($id_tienda)
    {
        $consul = "select * from tienda where id=" . $id_tienda . ";";
        $resu = $this->db->query($consul);
        while ($filas = $resu->fetchAll(PDO::FETCH_ASSOC)) {
            $this->datos[] = $filas;
        }
        return $this->datos;
    }

    //Función para encontrar el usuario dentro de la aplicación
    public function encontrar_usuario($id)
    {
        $sql = "SELECT * from users where id=" . $id . ";";
        $statement = $this->db->prepare($sql);
        $statement->execute();
        $results = $statement->fetchAll();
        return $results;
    }

    //Funcion para añadir tienda desde ADMIN
    public function addTienda($nombre, $activa)
    {
        $sql = "INSERT INTO tienda(nombre,activa) VALUES('$nombre','$activa')";
        $statement = $this->db->prepare($sql);
        $resultado = $statement->execute();

        if ($resultado) {
            return "success";
        } else {
            return "failed";
        }
    }

    //Función impura para actualizar datos en la base de datos
    public function actualizar($tabla, $data, $condicion){
        $consulta="update ".$tabla." set ".$data." where ".$condicion;
        $resultado=$this->db->query($consulta);
        if($resultado){
            return true;
        }else{
            return false;
        }
    }

    //Funcion impura para eliminar datos de cualquier tabla de la BD
        public function eliminar($tabla, $condicion){
            $eli="delete from ".$tabla." where ".$condicion;
            $res=$this->db->query($eli);
            if($res){
                return true;
            }else{
                return false;
            }
        }

    //Función impura para insertar datos 
    public function insertar($tabla, $data){
        $consulta="insert into ".$tabla." values(null,".$data.")";
        $resultado=$this->db->query($consulta);
        if ($resultado){
            return true;
        }else{
            return false;
        }
    }

    //Funcion para consultar tienda
    public function consultaTienda($id_tienda)
    {
        $sql = "SELECT * from tienda where id=" . $id_tienda . ";";
        $statement = $this->db->prepare($sql);
        $statement->execute();
        $results = $statement->fetchAll();
        return $results;
    }

    //Funcion para actualizar datos en tienda 
    public function EditTienda($id_tienda, $nombre, $activa)
    {
        $sql = "UPDATE tienda SET nombre='$nombre', activa='$activa' WHERE id=$id_tienda";
        $statement = $this->db->prepare($sql);
        $resultado = $statement->execute();

        if ($resultado) {
            // La operación se realizó correctamente
            return "success";
        } else {
            // La operación falló
            return "failed";
        }

    }


    //Funcion para traer los productos de x tienda
    public function get_productos($nombre_tienda){
        $sql = "SELECT productos.*,categorias.nombre as cat_nombre FROM productos 
        JOIN tienda on tienda.id=productos.id_tienda 
        JOIN categorias on categorias.id = productos.id_categoria 
        where tienda.nombre = '$nombre_tienda';";
        $statement = $this->db->prepare($sql);
        $statement->execute();
        $results = $statement->fetchAll();
        return $results;
    }

    //Funcion para traer categorias es una tienda
    public function get_categoria($data)
    {
        foreach ($data as $key => $value) {
            $id_categoria=$value['id_categoria'];
        }
        $sql = "SELECT * from categorias where id=" . $id_categoria . ";";
        $statement = $this->db->prepare($sql);
        $statement->execute();
        $results = $statement->fetchAll();
        return $results;
    }

    //Funcion para añadir productos
    public function addProducto($codigo,$nombre,$precio,$stock,$id_categoria,$id_tienda)
    {
        $sql = "INSERT INTO productos(codigo,nombre,precio,stock,id_categoria,id_tienda) VALUES('$codigo','$nombre','$precio','$stock','$id_categoria','$id_tienda')";
        $statement = $this->db->prepare($sql);
        $resultado = $statement->execute();

        if ($resultado) {
            return "success";
        } else {
            return "failed";
        }
    }

    //Funcion para actulizar la información del producto
    public function updateProducto($codigo,$nombre,$precio,$stock,$id_categoria,$id_tienda,$id_producto){
        $sql = "UPDATE productos SET codigo='$codigo', nombre='$nombre',precio='$precio',
        stock='$stock',id_categoria='$id_categoria' WHERE id=$id_producto";
        $statement = $this->db->prepare($sql);
        $resultado = $statement->execute();

        if ($resultado) {
            // La operación se realizó correctamente
            return "success";
        } else {
            // La operación falló
            return "failed";
        }
    }

    // FUNCIONES PARA OBTENER DATOS DEL DASHBOARD

    //Funcion para el conteo de productos
    public function totalProductos($id_tienda){
        $sql = "SELECT COUNT(*) AS conteoProductos from productos where id_tienda=" . $id_tienda . ";";
        $statement = $this->db->prepare($sql);
        $statement->execute();
        $results = $statement->fetchAll();
        return $results;
    }

    //Funcion para el conteo de Categorias
    public function totalCategorias($id_tienda){
        $sql = "SELECT COUNT(*) AS conteoCategorias from categorias where id_tienda=" . $id_tienda . ";";
        $statement = $this->db->prepare($sql);
        $statement->execute();
        $results = $statement->fetchAll();
        return $results;
    }

    //Funcion para el conteo de usuarios
    public function totalUsuarios($id_tienda){
        $sql = "SELECT COUNT(*) AS conteoUsuarios from users where id_tienda=" . $id_tienda . ";";
        $statement = $this->db->prepare($sql);
        $statement->execute();
        $results = $statement->fetchAll();
        return $results;
    }

    //Funcion para el conteo de cambios
    //public function totalCambios($id_tienda){
    //    $sql = "SELECT COUNT(*) AS conteoCambios from historial where id_tienda=" . $id_tienda . ";";
    //    $statement = $this->db->prepare($sql);
    //    $statement->execute();
    //    $results = $statement->fetchAll();
    //    return $results;
    //}

    //Funcion para obtener el stock del producto
    public function stock($id_producto){
        $sql = "SELECT stock from productos where id=" . $id_producto . ";";
        $statement = $this->db->prepare($sql);
        $statement->execute();
        $results = $statement->fetchAll();
        return $results;
    }

    public function updateStock($stock,$id_producto){
        $sql = "UPDATE productos SET stock='$stock' WHERE id=$id_producto";
        $statement = $this->db->prepare($sql);
        $resultado = $statement->execute();

        if ($resultado) {
            // La operación se realizó correctamente
            return "success";
        } else {
            // La operación falló
            return "failed";
        }
    }


}
?>
