<?php
  include('../clases/conexion.php');
  session_start();
  if (!isset($_SESSION["accesoadmin"])) {
      header('location: ../index.php');
  }


  $cabina =  0;
  $producto_activo = null;
  if ($con) {
    $script = "SELECT * FROM configuracion WHERE id_config = 1";
    $result = mysqli_query($con,$script);
    while ($row = mysqli_fetch_array($result)) {
      $cabina = $row['num_cabina'];
      $producto_activo = $row['producto_habilitado'];
    }
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PANEL DE ADMINISTRACION</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style_config.css">
    <script src="../js/jquery-3.6.1.min.js"></script>
</head>
<body>

    <nav class="navbar bg-success">
      <div class="container-fluid">
        <a class="navbar-brand text-light" style="font-weight: bold; text-transform: uppercase; margin: 0;"><img src="../img/logo-de-Sena-sin-fondo-Blanco.png" alt="" width="50px"> Laboratorio sensorial de alimentos - Sena Cedrago</a>
        <form class="d-flex" role="search">
          <a href="../index.php" class="btn btn-outline-light">cerrar sesion</a>
        </form>
      </div>
    </nav>

    <section class="text-center active" id="sect1">
        <div class="contenido">
            <h1 class="cont-title mb-4">PANEL DE ADMINISTRACION</h1>
            <div class="form-config">
                <form class="form-cabina mb-3 d-flex justify-content-between p-2">
                    <div class="div1">
                      <label for="cabina">NUMERO DE CABINA :</label>
                      <input type="number" id="cabina" min="1" max="3" value="<?php  echo $cabina;?>">
                    </div>
                    <div>
                      <a href="panel_resultados.php" class="btn btn-outline-success">visualizar resultados de cabina</a>
                    </div>
                </form>
                <hr>
                <form id="form-producto" class="mb-4">
                    <label for="">NOMBRE DE PRODUCTO :</label>
                    <input type="text" class="form-control me-2" id="nombreProducto">
                    <button type="submit">Agregar</button>
                </form>
                <div class="mb-2">
                  <button class="btn btn-secondary" id="refrescar-productos">Actualizar registros</button>
                </div>
                <div class="tabla-productos mb-5">
                    <table class="table table table-bordered table-light table-hover">
                      <thead class="table-dark">
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Nombre Producto</th>
                          <th scope="col">Configuracion</th>                        
                        </tr>
                      </thead>
                      <tbody id="listado-productos">

                      </tbody>
                    </table>
                </div>

                <div class="btns text-end">
                  <button class="btn btn-success" id="btnguardar">GUARDAR CAMBIOS</button>
                  <button class="btn btn-danger">CERRAR PANEL</button>
                </div>

            </div>
        </div>
    </section>
</body>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script src="../js/sweetalert2.all.min.js"></script>
<script src="../js/scriptAdministracion.js"></script>
</html>