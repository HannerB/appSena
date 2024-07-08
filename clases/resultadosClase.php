<?php

    class resultado{
        public $producto;
        public $prueba;
        public $atributo;
        public $cod_muestra;
        public $resultado;
        public $fecha;
        public $cabina;

        public function guardarResultadoTri_Duo($prueba,$matriz){
            global $con;
            
            $this->prueba = $prueba;

            for ($i=0; $i < count($matriz[0]); $i++) { 
                $cod_muestra = $matriz[0][$i];
                $resultado_muestra = $matriz[1][$i];

                $codigoRegistro = $this->generarCodigos();
                
                $script = "INSERT INTO resultados(codigo,producto,prueba,atributo,cod_muestra,resultado,fecha,cabina) VALUES(
                    '$codigoRegistro','$this->producto','$this->prueba','$this->atributo','$cod_muestra','$resultado_muestra','$this->fecha','$this->cabina'
                )";
                mysqli_query($con,$script);
                
            }

        }

        public function guardarResultadoOrden($prueba,$vector){
            global $con;
            
            $this->prueba = $prueba;

            $resultado = $vector[0];
            $atributo = $vector[1];

            
            $codigoRegistro = $this->generarCodigos();

            $script = "INSERT INTO resultados(codigo,producto,prueba,atributo,cod_muestra,resultado,fecha,cabina) VALUES(
                '$codigoRegistro','$this->producto','$this->prueba','$atributo',null,'$resultado','$this->fecha','$this->cabina'
            )";
            mysqli_query($con,$script);

        }

        public function consultarResultadosTrio_Ord($prueba){
            global  $con;

            $script = "SELECT cod_muestra,resultado FROM `resultados` WHERE cabina = '$this->cabina' AND fecha = '$this->fecha' AND producto = '$this->producto' AND prueba = $prueba;";
            $result = mysqli_query($con,$script);

            $matriz = array();
            
            $cols = array();
            $filas =  array();

            while ($row = mysqli_fetch_array($result)) {
                $cols[] = $row['cod_muestra'];
                $filas[] = $row['resultado'];
            }

            $matriz = array($cols,$filas);

            return $matriz;

        }

        public function consultarResultadosOrdenamiento(){
            global  $con;

            $script = "SELECT resultado,atributo FROM `resultados` WHERE cabina = '$this->cabina'AND fecha = '$this->fecha' AND producto = '$this->producto' AND prueba = 3;";
            $result = mysqli_query($con,$script);

            $muestras_preferidas = "";
            $atributoPrueba = "";

            while ($row = mysqli_fetch_array($result)) {
                $muestras_preferidas = $row['resultado'];
                $atributoPrueba = $row['atributo'];
            }

            return array($muestras_preferidas,$atributoPrueba);

        }

        public function consultarExistenciaValores(){
            global  $con;

            $script = "SELECT * FROM `resultados` WHERE cabina = '$this->cabina'AND fecha = '$this->fecha' AND producto = '$this->producto'";
            $result = mysqli_query($con,$script);

            if (mysqli_num_rows($result) > 0) {
                return true;
            }
            return false;

        }

        public function eliminarAsistencias(){
            global  $con;

            $script = "DELETE FROM `resultados` WHERE cabina = '$this->cabina'AND fecha = '$this->fecha' AND producto = '$this->producto'";
            mysqli_query($con,$script);
        }

        private function generarCodigos(){
            $alf="abcdefghijklmnopqrstuvwxyz";
            $codigo="";
            $numero=true;
            for ($i=0; $i < 4; $i++) { 
                if ($numero) {
                    $digito=rand(0,9);
                    $codigo=$codigo.$digito;
                    $numero=false;
                } else {
                    $posicion=rand(0,strlen($alf)-1);
                    $codigo=$codigo.strtolower($alf[$posicion]);
                    $numero=true;
                }
            }
            return $codigo;
        }

    }

?>