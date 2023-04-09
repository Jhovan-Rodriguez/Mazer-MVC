<?php
    class Model{
        private $Modelo;
        private $db;
        private $datos;

        public function __construct(){
            $this->Modelo  = array();
            $this->datos = array();
            $this->db = new PDO('mysql:host=localhost;dbname=tienda',"root","");
        }

        //BUSCAR LOG IN
        public function login($tabla, $condicion){
            $consul="select * from ".$tabla." where ".$condicion.";";
            $resultado=$this->db->query($consul);
            while($filas=$resultado->fetchAll(PDO::FETCH_ASSOC)){
                $this->datos[]=$filas;
            }
            return $this->datos;
        }

        public function mostrar($tabla,$condicion){
            $consul="select * from ".$tabla.";";
            $resu=$this->db->query($consul);
            while($filas=$resu->fetchAll(PDO::FETCH_ASSOC)){
                $this->datos[]=$filas;
            }
            return $this->datos;
        }

        public function mostrar_tiendas(){
            $nombre_tienda = "root";
            $consul="select * from tienda where nombre <> '" . $nombre_tienda . "'";
            $resu=$this->db->query($consul);
            while($filas=$resu->fetchAll(PDO::FETCH_ASSOC)){
                $this->datos[]=$filas;
            }
            return $this->datos;
        }

        public function encontrar_tienda($id_tienda){
            $consul="select * from tienda where id=".$id_tienda.";";
            $resu=$this->db->query($consul);
            while($filas=$resu->fetchAll(PDO::FETCH_ASSOC)){
                $this->datos[]=$filas;
            }
            return $this->datos;
        }

        public function encontrar_usuario($id)
        {
            $sql = "SELECT * from users where id=".$id.";";
            $statement = $this->db->prepare($sql);
            $statement->execute();
            $results=$statement->fetchAll();
            return $results;
        }


    }
?>