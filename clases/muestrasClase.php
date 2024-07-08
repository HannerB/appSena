<?php

    class muestra{
        public $id_muestra;
        public $cod_muestra;
        public $producto;
        public $prueba;
        public $atributo = null;

        public function guardarMuestra(){
            global $con;

            $script =  "INSERT INTO muestras(cod_muestra,id_producto,prueba,atributo) VALUES ('$this->cod_muestra', '$this->producto', '$this->prueba','$this->atributo');";
            mysqli_query($con,$script);

        }

        public function consultarMuestrasPruebaTriangular()
        {
            global $con;
            $script = "SELECT * FROM muestras WHERE id_producto='$this->producto' AND prueba=1";
            $result = mysqli_query($con,$script);
            $listado_muestras =  array();
            while ($row = mysqli_fetch_array($result) ) {
                $listado_muestras[] =  array(
                    "id"=>$row['id_muestras'],
                    "codigo" => $row['cod_muestra']
                );
            }

            return $listado_muestras;
        }
        public function consultarMuestrasPruebaDuoTrio()
        {
            global $con;
            $script = "SELECT * FROM muestras WHERE id_producto='$this->producto' AND prueba=2";
            $result = mysqli_query($con,$script);
            $listado_muestras =  array();
            while ($row = mysqli_fetch_array($result) ) {
                $listado_muestras[] =  array(
                    "id"=>$row['id_muestras'],
                    "codigo" => $row['cod_muestra']
                );
            }

            return $listado_muestras;
        }
        public function consultarMuestrasPruebaOrdenamiento()
        {
            global $con;
            $script = "SELECT * FROM muestras WHERE id_producto='$this->producto' AND prueba=3";
            $result = mysqli_query($con,$script);
            $listado_muestras =  array();
            while ($row = mysqli_fetch_array($result) ) {
                $listado_muestras[] =  array(
                    "id"=>$row['id_muestras'],
                    "codigo" => $row['cod_muestra']
                );
            }

            return $listado_muestras;
        }
        
        public function consultarTipoAtributoPruebaOrden()
        {
            global $con;
            $script = "SELECT DISTINCT(atributo) FROM `muestras` WHERE atributo!='' AND id_producto = '$this->producto';";
            $result = mysqli_query($con,$script);

            $nombre_atributo = "ATRIBUTO";

            if (mysqli_num_rows($result)>0) {
                $nombre_atributo =  mysqli_fetch_array($result)['atributo'];
            }

            return strtoupper($nombre_atributo);
        }

        public function actualizarMuestra(){
            global $con;
            $script = "UPDATE muestras SET atributo = '$this->atributo' WHERE id_producto =  '$this->producto' AND prueba = 3";
            mysqli_query($con,$script);
        }

        public function eliminarMuestra(){
            global $con;
            $script = "DELETE FROM muestras WHERE id_muestras = '$this->id_muestra'";
            mysqli_query($con,$script);
        }

    }
?>