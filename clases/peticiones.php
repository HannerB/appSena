<?php

    include('../clases/conexion.php');
    include('../clases/configuracionClase.php');
    include('../clases/productoClase.php');
    include('../clases/muestrasClase.php');
    include('../clases/panelistaClase.php');
    include('../clases/calificacionesClase.php');
    include('../clases/resultadosClase.php');

    date_default_timezone_set('America/Mexico_City');

    $solicitud =  $_POST['peticion'];
    $config =  new configuracion();
    $producto = new producto();
    $muestra = new muestra();
    $pane =  new panelista();
    $calificacion = new calificacion();
    $resultado_calif = new resultado();

    $fechaActual =  date('Y-m-d');

    switch ($solicitud) {
        // ADMINISTRACION
        case 'guardarCabina':
            $cabina =  $_POST['cabina'];

            $config->cabina = $cabina;
            $config->actualizarCabina();
            
            break;
        case 'consultar-info-configuracion':
            $idProducto =  $config->consultarIdProducto();
            $nombreProducto =  $config->consultarNombreDeProducto();

            echo json_encode(array("nombreproduto"=>$nombreProducto,"fecha"=>$fechaActual,"id"=>$idProducto));

            break;
        case 'actualizarConfiguracionProducto':
            $idproducto = $_POST['producto'];

            $config->producto = $idproducto;
            $config->actualizarProductoHabilitado();

            break;
        //PRODUCTOS
        case 'guardarProducto':
            $productoGuardar = $_POST['producto'];

            $producto->nombre =  $productoGuardar;
            $producto->guardarProducto();

            break;
        case 'consultarProductos':
            echo json_encode($producto->consultarProductos());
            break;
        case 'actualizarProducto':
            $idproducto = $_POST['producto'];
            $nombreProducto = $_POST['nombreProducto'];

            $producto->idprod = $idproducto;
            $producto->nombre = $nombreProducto;

            $producto->actualizarProducto();

            break;
        
        //MUESTRA
        case 'guardarMuestra':
            $codigoMuestra = $_POST['codigo'];
            $producto = $_POST['producto'];
            $prueba = $_POST['tipo'];
            $atributoPrueba = $_POST['atributo'];

            $muestra->cod_muestra = $codigoMuestra;
            $muestra->producto =  $producto;
            $muestra->prueba =  $prueba;
            $muestra->atributo = $atributoPrueba;

            if ($prueba == 3) {
                $muestra->actualizarMuestra();
            }

            $muestra->guardarMuestra();

            break;
        case 'consultarMuestras':
            $producto = $_POST['producto'];

            $muestra->producto = $producto;
            $pruebaTriangular =  $muestra->consultarMuestrasPruebaTriangular();
            $pruebaDuo =  $muestra->consultarMuestrasPruebaDuoTrio();
            $pruebaOrden = $muestra->consultarMuestrasPruebaOrdenamiento();
            $nombreAtributoOrden = $muestra->consultarTipoAtributoPruebaOrden();

            $todas_muestras = array(
                "triangular" => $pruebaTriangular,
                "duo" => $pruebaDuo,
                "ordenamiento" => $pruebaOrden,
                "atributo" => $nombreAtributoOrden
            );

            echo json_encode($todas_muestras);

            break;
        case 'eliminarMuestra':
            $idmuestra =  $_POST['idMuestra'];
            $muestra->id_muestra =  $idmuestra;
            $muestra->eliminarMuestra();
            break;

        //RESULTADOS
        case 'guardarResultadosTrigular':
            $datosPanelista = $_POST['datos'];
            $pruebaTriangular = $_POST['prueba_uno'];
            
            $id_producto = $config->consultarIdProducto();
            $cabina =  $config->consultarCabina();

            $nombrePane = $datosPanelista["nombrePane"];
            $fechaPruebas = $datosPanelista["fecha"];

            $resultado_prueba_triangular = $pruebaTriangular['resultadoPruebaTriangular'];
            $comentario_triangular = $pruebaTriangular['comentarioTriangular'];

            $resultados_triangular = array("prueba"=> 1,"resultado"=>$resultado_prueba_triangular,"comentarios"=>$comentario_triangular,"atributo"=> null);

            $resultados_pruebas = array($resultados_triangular);

            $pane->nombre = $nombrePane;
            $idPane = $pane->consultarIdPanelista();

            foreach ($resultados_pruebas as $key => $value) {
                $calificacion->idPane = $idPane;
                $calificacion->producto = $id_producto;
                $calificacion->prueba = $value['prueba'];
                $calificacion->atributo = $value['atributo'];
                $calificacion->cod_muestras = $value['resultado'];
                $calificacion->comentario = $value['comentarios'];
                $calificacion->fecha = $fechaPruebas;
                $calificacion->cabina = $cabina;

                $calificacion->guardarCalificacion();

            }

            break;
        case 'guardarResultadosDuo':
            
            $datosPanelista = $_POST['datos'];
            $pruebaDuo = $_POST['prueba_dos'];

            $id_producto = $config->consultarIdProducto();
            $cabina =  $config->consultarCabina();

            $nombrePane = $datosPanelista["nombrePane"];
            $fechaPruebas = $datosPanelista["fecha"];

            $resultado_prueba_duo = $pruebaDuo['resultadoPruebaDuo'];
            $comentario_duo = $pruebaDuo['comentarioDuo'];

            $resultados_duo = array("prueba"=> 2,"resultado"=>$resultado_prueba_duo,"comentarios"=>$comentario_duo,"atributo"=> null);

            $resultados_pruebas = array($resultados_duo);

            $pane->nombre = $nombrePane;
            $idPane = $pane->consultarIdPanelista();

            foreach ($resultados_pruebas as $key => $value) {
                $calificacion->idPane = $idPane;
                $calificacion->producto = $id_producto;
                $calificacion->prueba = $value['prueba'];
                $calificacion->atributo = $value['atributo'];
                $calificacion->cod_muestras = $value['resultado'];
                $calificacion->comentario = $value['comentarios'];
                $calificacion->fecha = $fechaPruebas;
                $calificacion->cabina = $cabina;

                $calificacion->guardarCalificacion();

            }

            break;
        case 'guardarResultadoOrden':
            $datosPanelista = $_POST['datos'];
            $pruebaOrden = $_POST['prueba_tres'];

            $id_producto = $config->consultarIdProducto();
            $cabina =  $config->consultarCabina();

            $nombrePane = $datosPanelista["nombrePane"];
            $fechaPruebas = $datosPanelista["fecha"];

            $resultado_prueba_orden = $pruebaOrden['resultadoOrden'];
            $comentario_oreden = $pruebaOrden['comentario_tres'];
            $atributo_orden = $pruebaOrden['atributo'];

            $resultados_orden = array("prueba"=> 3,"resultado"=>$resultado_prueba_orden,"comentarios"=>$comentario_oreden,"atributo"=> $atributo_orden);

            $resultados_pruebas = array($resultados_orden);

            $pane->nombre = $nombrePane;
            $idPane = $pane->consultarIdPanelista();

            foreach ($resultados_pruebas as $key => $value) {
                $calificacion->idPane = $idPane;
                $calificacion->producto = $id_producto;
                $calificacion->prueba = $value['prueba'];
                $calificacion->atributo = $value['atributo'];
                $calificacion->cod_muestras = $value['resultado'];
                $calificacion->comentario = $value['comentarios'];
                $calificacion->fecha = $fechaPruebas;
                $calificacion->cabina = $cabina;

                $calificacion->guardarCalificacion();

            }

            break;
        /* case 'guardarResultados':
            $datosPanelista = $_POST['datos'];
            $pruebaTriangular = $_POST['prueba_uno'];
            $pruebaDuo = $_POST['prueba_dos'];
            $pruebaOrden = $_POST['prueba_tres'];

            $id_producto = $config->consultarIdProducto();
            $cabina =  $config->consultarCabina();

            $nombrePane = $datosPanelista["nombrePane"];
            $fechaPruebas = $datosPanelista["fecha"];

            $resultado_prueba_triangular = $pruebaTriangular['resultadoPruebaTriangular'];
            $comentario_triangular = $pruebaTriangular['comentarioTriangular'];

            $resultados_triangular = array("prueba"=> 1,"resultado"=>$resultado_prueba_triangular,"comentarios"=>$comentario_triangular,"atributo"=> null);

            $resultado_prueba_duo = $pruebaDuo['resultadoPruebaDuo'];
            $comentario_duo = $pruebaDuo['comentarioDuo'];

            $resultados_duo = array("prueba"=> 2,"resultado"=>$resultado_prueba_duo,"comentarios"=>$comentario_duo,"atributo"=> null);
            
            $resultado_prueba_orden = $pruebaOrden['resultadoOrden'];
            $comentario_oreden = $pruebaOrden['comentario_tres'];
            $atributo_orden = $pruebaOrden['atributo'];

            $resultados_orden = array("prueba"=> 3,"resultado"=>$resultado_prueba_orden,"comentarios"=>$comentario_oreden,"atributo"=> $atributo_orden);

            
            $resultados_pruebas = array($resultados_triangular,$resultados_duo,$resultados_orden);


            $pane->nombre = $nombrePane;
            $idPane = $pane->consultarIdPanelista();

            foreach ($resultados_pruebas as $key => $value) {
                $calificacion->idPane = $idPane;
                $calificacion->producto = $id_producto;
                $calificacion->prueba = $value['prueba'];
                $calificacion->atributo = $value['atributo'];
                $calificacion->cod_muestras = $value['resultado'];
                $calificacion->comentario = $value['comentarios'];
                $calificacion->fecha = $fechaPruebas;
                $calificacion->cabina = $cabina;

                $calificacion->guardarCalificacion();

            }

            break;
         */
        case 'consultarCabinas':
            $cabinas =  $calificacion->consultarCabinas();
            echo json_encode($cabinas);
            break;
        case 'consultraProductosFecha':
            $fecha_consultar =  $_POST['fecha'];

            $calificacion->fecha =  $fecha_consultar;

            $listado_productos =  $calificacion->consultarListadoProductos();

            echo json_encode($listado_productos);

            break;
        case 'realizarResultadosEstadisticos':
            $cabina = $_POST['cabina'];
            $fecha_elegida = $_POST['fecha'];
            $producto = $_POST['producto'];

            $calificacion->cabina = $cabina;
            $calificacion->fecha = $fecha_elegida;
            $calificacion->producto = $producto;

            $resultado_calif->producto = $producto;
            $resultado_calif->fecha = $fecha_elegida;
            $resultado_calif->cabina = $cabina;

            $existencia =  $resultado_calif->consultarExistenciaValores();

            if ($existencia) {
                if ($fecha_elegida == $fechaActual) {

                    $resultado_calif->eliminarAsistencias();

                    $result_triangular = $calificacion->realizarResultadoPruebaTriangular_Duo(1);
                    if ($result_triangular!=null) {
                        $resultado_calif->guardarResultadoTri_Duo(1,$result_triangular);
                    }

                    $result_duo = $calificacion->realizarResultadoPruebaTriangular_Duo(2);
                    if ($result_duo!=null) {
                        $resultado_calif->guardarResultadoTri_Duo(2,$result_duo);
                    }

                    $result_orden = $calificacion->realizarResultadoPruebaOrdenamiento();
                    if ($result_orden != null) {
                        $resultado_calif->guardarResultadoOrden(3,$result_orden);
                    }
                }
            }else{
                $result_triangular = $calificacion->realizarResultadoPruebaTriangular_Duo(1);
                if ($result_triangular!=null) {
                    $resultado_calif->guardarResultadoTri_Duo(1,$result_triangular);
                }

                $result_duo = $calificacion->realizarResultadoPruebaTriangular_Duo(2);
                if ($result_duo!=null) {
                    $resultado_calif->guardarResultadoTri_Duo(2,$result_duo);
                }

                $result_orden = $calificacion->realizarResultadoPruebaOrdenamiento();
                if ($result_orden != null) {
                    $resultado_calif->guardarResultadoOrden(3,$result_orden);
                }
            }


            $result_triangular = $resultado_calif->consultarResultadosTrio_Ord(1);
            $result_duo = $resultado_calif->consultarResultadosTrio_Ord(2);
            $result_orden =  $resultado_calif->consultarResultadosOrdenamiento();

            echo json_encode(array("triangular"=>$result_triangular,"duo"=>$result_duo,"orden"=>$result_orden));

            break;
        
        case 'consultarResultadosPersonas':
            $cabina=  $_POST['cabina'];
            $fecha_elegida = $_POST['fecha'];
            $idProducto = $_POST['producto'];
            $prueba = $_POST['prueba'];

            $calificacion->cabina = $cabina;
            $calificacion->fecha = $fecha_elegida;
            $calificacion->producto = $idProducto;
            $calificacion->prueba = $prueba;

            $listado_personas = $calificacion->consultarPersonasPrueba();

            echo json_encode($listado_personas);

            break;
        default:
            # code...
            break;
    }


?>