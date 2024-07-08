<?php

    class producto{
        public $idprod;
        public $nombre;
        
        public function guardarProducto()
        {
            global $con;

            $script =  "INSERT INTO producto (nombre) VALUES ('$this->nombre');";
            mysqli_query($con,$script);

        }

        public function consultarProductos()
        {
            global $con;
            $script =  "SELECT * FROM producto";
            $result =  mysqli_query($con,$script);

            $productos = array();
            while ($row = mysqli_fetch_array($result) ) {
                $productos[] =  array(
                    "id"=>$row['id_producto'],
                    "nombre"=>$row['nombre'],
                );
            }

            return $productos;
        }

        public function actualizarProducto(){
            global $con;

            $script =  "UPDATE  producto SET nombre = '$this->nombre' WHERE id_producto = $this->idprod;";
            mysqli_query($con,$script);
        }
        

    }

?>