<?php

    session_start();
  if (!isset($_SESSION["accesoadmin"])) {
      header('location: ../index.php');
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RESULTADOS PANEL</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style_resultados.css">
</head>
<body>
    <nav class="navbar bg-success">
      <div class="container-fluid">
        <a class="navbar-brand text-light" style="font-weight: bold; text-transform: uppercase; margin: 0;"><img src="../img/logo-de-Sena-sin-fondo-Blanco.png" alt="" width="50px"> Laboratorio sensorial de alimentos - Sena Cedagro</a>
        <a href="./panel_administracion.php" class="btn btn-outline-light">panel de administracion</a>
      </div>
    </nav>

    <div class="contenedor">
        <h1 class="text-center">PANEL DE RESULTADOS</h1>
        <div class="filtros mb-5">
            <form id="filtro-resultados">
                <div class="mb-3">
                    <label for="" class="form-label">Numero de cabina</label>
                    <select name="" id="cabinas-filtro" class="form-select">
                        <option value="select">Seleccione cabina</option>
                    </select>  
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Fecha prueba</label>
                    <input type="date" name="" id="fecha-filtro" class="form-control" required>
                </div>
                
                <div class="mb-3">
                    <label for="" class="form-label">Producto</label>
                    <select name="" id="productos-filtro" class="form-select">
                        <option value="select">Seleccione producto</option>
                    </select>  
                </div>

                <div class="text-end">
                    <button class="btn btn-outline-secondary" type="submit">GENERAR RESULTADOS</button>
                </div>
            </form>
        </div>
        <div class="resultados resultados-pruebas mb-5" id="resultados-pruebas">
            <hr>

            <!-- PRUEBA TRIANGULAR -->
            <h3 class="mt-4">PRUEBA TRIANGULAR</h3>
            <table class="table table-secondary table-bordered table-hover mb-4">
            <thead id="head-triangular">
                <tr>
                <th scope="col">#</th>
                <th scope="col">0800</th>
                <th scope="col">5000</th>
                <th scope="col">35200</th>
                </tr>
            </thead>
            <tbody class="table-light" id="body-triangular">
                <tr>
                <th scope="row">personas</th>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                </tr>
            </tbody>
            </table>
            <!-- FIN TRINAGULAR -->

            <!-- PRUEBA DUO - TRIO -->
            <h3>PRUEBA DUO - TRIO</h3>
            <table class="table table-secondary table-bordered table-hover mb-4">
            <thead id="head-duo">
                <tr>
                <th scope="col">#</th>
                <th scope="col">0800</th>
                <th scope="col">5000</th>
                <th scope="col">35200</th>
                </tr>
            </thead>
            <tbody class="table-light" id="body-duo">
                <tr>
                <th scope="row">personas</th>
                <td>10</td>
                <td>2</td>
                <td>0</td>
                </tr>
            </tbody>
            </table>
            <!-- FIN DUO - TRIO -->
            
            <!-- PRUEBA DUO - TRIO -->
            <h3>PRUEBA ORDENAMIENTO - ( <span id="atributo-prueba">ATRIBUTO</span> )</h3>
            <table class="table table-secondary table-bordered table-hover mb-4">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">resultado</th>
                </tr>
            </thead>
            <tbody class="table-light">
                <tr>
                <th scope="row">prefieren</th>
                <td id="preferencia-ordenamiento"></td>
                </tr>
            </tbody>
            </table>
            <!-- FIN DUO - TRIO -->

        </div>
        <div class="resultados resultado-pruebas-personas" id="resultado-pruebas-personas">
            <hr>
            <div class="mb-4 mt-4">
                <form>
                    <label for="" class="mb-2">Seleccione la prueba para ver los resultados de los panelistas</label>
                    <select name="" class="form-select" id="tipo-prueba-resultado">
                        <option value="select">SELECCIONE LA PRUEBA</option>
                        <option value="1">PRUEBA TRIANGULAR</option>
                        <option value="2">PRUEBA DUO - TRIO</option>
                        <option value="3">PRUEBA ORDENAMIENTO</option>
                    </select>
                </form>
            </div>
            <div class="tabla-personas">
                <table class="table table-dark table-bordered table-hover mb-4">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">NOMBRE</th>
                        <th scope="col">RESPUESTA</th>
                        </tr>
                    </thead>
                    <tbody class="table-light" id="listado-personas-prueba">
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script src="../js/jquery-3.6.1.min.js"></script>
<script src="../js/sweetalert2.all.min.js"></script>
<script src="../js/scriptResultados.js"></script>
</html>