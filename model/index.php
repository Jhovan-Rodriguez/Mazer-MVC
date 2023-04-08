<?php
    class Model{
        private $Modelo;
        private $db;
        private $datos;

        public function __construct(){
            $this->Modelo  = array();
            $this->datos = array();
            $this->db = new PDO('mysql:host=localhost;dbname=db_tienda',"root","root");
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


    }
?>