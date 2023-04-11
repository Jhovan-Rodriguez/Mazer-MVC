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
        $this->db = new PDO('mysql:host=localhost;dbname=tienda', "root", "NoZo161018K");
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

    public function actualizar($tabla, $data, $condicion){
        $consulta="update ".$tabla." set ".$data." where ".$condicion;
        $resultado=$this->db->query($consulta);
        if($resultado){
            return true;
        }else{
            return false;
        }
    }

        public function eliminar($tabla, $condicion){
            $eli="delete from ".$tabla." where ".$condicion;
            $res=$this->db->query($eli);
            if($res){
                return true;
            }else{
                return false;
            }
        }

    public function insertar($tabla, $data){
        $consulta="insert into ".$tabla." values(null,".$data.")";
        $resultado=$this->db->query($consulta);
        if ($resultado){
            return true;
        }else{
            return false;
        }
    }

    public function consultaTienda($id_tienda)
    {
        $sql = "SELECT * from tienda where id=" . $id_tienda . ";";
        $statement = $this->db->prepare($sql);
        $statement->execute();
        $results = $statement->fetchAll();
        return $results;
    }

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


}
?>