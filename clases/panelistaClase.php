<?php

    class panelista{
        public $idpane;
        public $nombre;


        public function guardarPanelista(){
            global $con;

            $script = "INSERT INTO panelistas(nombres) VALUE ('$this->nombre');";
            mysqli_query($con,$script);

        }

        public function consultarIdPanelista(){
            global $con;

            $script = "SELECT * FROM panelistas WHERE nombres = '$this->nombre';";
            $result = mysqli_query($con,$script);

            if (mysqli_num_rows($result)>0) {
                return mysqli_fetch_array($result)["idpane"];
            }else{
                $this->guardarPanelista();
                return $this->consultarIdPanelista();
            }

            return null;
        }

    }

?>