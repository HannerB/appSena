<?php

    class calificacion{
        public $idPane;
        public $producto;
        public $prueba;
        public $atributo;
        public $cod_muestras;
        public $comentario;
        public $fecha;
        public $cabina;

        public function guardarCalificacion(){
            global $con;

            $script = "INSERT INTO calificaciones(idpane,producto,prueba,atributo,cod_muestras,comentario,fecha,cabina) VALUES ( '$this->idPane', '$this->producto', '$this->prueba' , '$this->atributo' , '$this->cod_muestras', '$this->comentario', '$this->fecha' , '$this->cabina')";
            mysqli_query($con,$script);

        }

        public function consultarCabinas(){
            global $con;

            $script = "SELECT DISTINCT(cabina) FROM `calificaciones`";
            $result = mysqli_query($con,$script);

            $cabinas = array();

            while ($row =  mysqli_fetch_array($result)) {
                $cabinas[] = $row['cabina'];
            }

            return $cabinas;

        }

        public function consultarListadoProductos(){
            global $con;

            $script = "SELECT distinct(producto),p.nombre FROM `calificaciones` AS c INNER JOIN producto AS p ON c.producto = p.id_producto WHERE fecha = '$this->fecha';";
            $result = mysqli_query($con,$script);

            $productos = array();

            while ($row =  mysqli_fetch_array($result)) {
                $productos[] = array(
                    "id"=> $row['producto'],
                    "nombre" => $row['nombre'],
                );
            }

            return $productos;

        }

        public function consultarPersonasPrueba()
        {
            global $con;

            $script = "SELECT p.nombres,cod_muestras FROM `calificaciones` AS c INNER JOIN panelistas AS p ON c.idpane = p.idpane WHERE prueba = $this->prueba AND cabina = $this->cabina  AND fecha = '$this->fecha ' AND producto = $this->producto;";
            $result = mysqli_query($con,$script);

            $personas = array();
            while ($row = mysqli_fetch_array($result)) {
                $personas[] = array(
                    "nombre" => $row['nombres'],
                    "muestras" => $row['cod_muestras'],
                );
            }

            return $personas;
        }



        public function realizarResultadoPruebaTriangular_Duo($prueba){
            global $con;

            //consultar prueba triangular
            $script = "SELECT * FROM `muestras` WHERE prueba = $prueba AND id_producto = $this->producto;";
            $result = mysqli_query($con,$script);

            $listado_muestras =  array();

            if (mysqli_num_rows($result)>0) {
                while ($row = mysqli_fetch_array($result)) {
                    $listado_muestras[] = $row['cod_muestra'];
                }
                $matriz = array();
    
                if (count($listado_muestras) > 0) {
                    $cols = array();
                    $filas =  array();
    
                    foreach ($listado_muestras as $key => $value) {
                        $cols[] = $value;
    
                        $script = "SELECT COUNT(*) FROM `calificaciones` WHERE prueba = $prueba AND fecha = '$this->fecha' AND producto = $this->producto AND cod_muestras = '$value';";
                        $result2 = mysqli_query($con,$script);
    
                        if (mysqli_num_rows($result2)) {
                            while ($row =  mysqli_fetch_array($result2)) {
                                $filas[] = $row['COUNT(*)'];
                            }
                        }
    
                    }
    
                    $matriz = array($cols,$filas);
    
                }
    
                return $matriz;
            }

            return null;
            
        }


        public function realizarResultadoPruebaOrdenamiento(){
            global $con;

            $script = "SELECT cod_muestras,atributo FROM `calificaciones` WHERE prueba = 3 AND fecha = '$this->fecha' AND producto = $this->producto;";
            $result = mysqli_query($con,$script);

            $conteo_muestras = array();
            $atributoPrueba = "";

            if (mysqli_num_rows($result)>0) {
                
                while ($row = mysqli_fetch_array($result)) {
                    $codigoMuestra =  $row['cod_muestras'];
                    $atributoPrueba =  $row['atributo'];
    
                    $codigo =  explode(',',$codigoMuestra);
    
                    $mas_guastado =  $codigo[0];
    
                    if (array_key_exists($mas_guastado,$conteo_muestras)) {
                        $conteo_muestras[$mas_guastado] += 1;
                    }else{
                        $conteo_muestras[$mas_guastado] = 1;
                    }
    
                }
    
                $muestras_preferidas = "";
                
                //COMPARAR CUAL LA CANTIDAD DE PREFERIDO
                $numMax = max($conteo_muestras);
    
                foreach ($conteo_muestras as $key => $value) {
                    if ($value == $numMax) {
                        $muestras_preferidas= $muestras_preferidas!="" ? $muestras_preferidas.",".$key : $key;
                    }
                }
    
                return array($muestras_preferidas,$atributoPrueba);
            }

            return null;


        }


    }

?>