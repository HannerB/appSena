<?php

    class configuracion{
        private $idconfig =  1;
        public $cabina;
        public $producto;


        public function consultarNombreDeProducto(){
            global $con;

            $script = "SELECT nombre FROM `configuracion` AS c INNER JOIN producto AS p ON c.producto_habilitado = p.id_producto;";
            $result =  mysqli_query($con,$script);
            $nombreProducto = null;
            if (mysqli_num_rows($result)>0) {
                $nombreProducto = mysqli_fetch_array($result)['nombre'];
            }

            return $nombreProducto;
        }
        
        public function consultarIdProducto(){
            global $con;

            $script = "SELECT producto_habilitado FROM configuracion;";
            $result =  mysqli_query($con,$script);
            $producto_habilitado = null;
            if (mysqli_num_rows($result)>0) {
                $producto_habilitado = mysqli_fetch_array($result)['producto_habilitado'];
            }

            return $producto_habilitado;
        }
        
        public function consultarCabina(){
            global $con;

            $script = "SELECT num_cabina FROM configuracion;";
            $result =  mysqli_query($con,$script);
            $cabina = null;
            if (mysqli_num_rows($result)>0) {
                $cabina = mysqli_fetch_array($result)['num_cabina'];
            }

            return $cabina;
        }
        
        public function actualizarCabina(){
            global $con;

            $script = "UPDATE configuracion SET num_cabina = ".$this->cabina."  WHERE id_config = ".$this->idconfig;
            $result = mysqli_query($con,$script);
        }
        
        public function actualizarProductoHabilitado(){
            global $con;

            $script = "UPDATE configuracion SET producto_habilitado = ".$this->producto."  WHERE id_config = ".$this->idconfig;
            $result = mysqli_query($con,$script);
        }

    }

?>