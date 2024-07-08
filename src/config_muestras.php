<?php
  include('../clases/conexion.php');

  session_start();
  if (!isset($_SESSION["accesoadmin"])) {
    header('location: ../index.php');
  }

  $nombreProducto = null;
  $habilitado = false;


  if (isset($_GET['producto'])) {
    if ($con) {
      //Consultar Nombre de producto
      $idprod = $_GET['producto']; 
      $script= "SELECT * FROM producto WHERE id_producto = $idprod";
      $result = mysqli_query($con,$script);
      while ($row = mysqli_fetch_array($result)) {
        $nombreProducto = $row['nombre'];
      }

      //Consultar si este producto esta activo
      $script= "SELECT * FROM configuracion WHERE producto_habilitado = $idprod";
      $result = mysqli_query($con,$script);
      if (mysqli_num_rows($result)>0) {
        $habilitado = true;
      }

    }
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CODIFICAR MUESTRAS</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style_muestras.css">
</head>
<body>
    <div class="contenedor">


        <section>
            <h1 class="mt-4">CONFIGURACION DE PRODUCTO</h1>
            <form id="form-producto"  class="mb-4">
                <label for="">NOMBRE PRODUCTO</label>
                <input type="text"  id="nombreProducto" class="form-control mb-2" value="<?php echo $nombreProducto;?>" required>
                <label for="" class="me-2 mb-3"><input type="checkbox" id="habilitado" <?php echo $habilitado ? 'checked' : '';?>> Realizar pruebas con este producto</label>
                <div class="d-flex justify-content-center">
                    <input type="submit" class="btn btn-success"  value="Actualizar Producto">
                </div>
            </form>
        </section>

        <section class="sect-muestras mb-5">
            <h2>Mis Muestras</h2>
            <form class="mb-5" id="form-muestras">
                <div class="mb-3">
                    <label for="" class="form-label">Codigo Muestra</label>
                    <input type="text" class="form-control" id="codigo-muestra" required>
                </div>
                <div class="text-center"><button id="btn-codigo" type="button">Generar un codigo de muestra</button></div>
                <div class="mb-3">
                    <label for="" class="form-label">Tipo de Prueba</label>
                    <select id="tipo-prueba" class="form-select">
                        <option value="1">PRUEBA TRIANGULAR</option>
                        <option value="2">PRUEBA DUO-TRIO</option>
                        <option value="3">PRUEBA ORDENAMIENTO</option>
                    </select>
                </div>
                <div class="mb-3" id="cont-atributos" style="display: none;">
                    <label for="" class="form-label">Tipo de atributos</label>
                    <select id="atributos-prueba" class="form-select">
                      <option value="sabor">SABOR</option>
                        <option value="olor">OLOR</option>
                        <option value="color">COLOR</option>
                        <option value="textura">TEXTURA</option>
                        <option value="apariencia">APARIENCIA</option>
                    </select>
                </div>
                <div class="mb-3 text-center">
                    <button class="btn btn-outline-success" type="submit">GUARDAR</button>
                    <button class="btn btn-danger" type="button" id="btncancelar">CANCELAR</button>
                </div>
            </form>

            <div class="text-center mb-4"> 
                <!-- <a href="">Desea realizar nuevas muestras con este producto?</a> -->
            </div>

        </section>
        <hr>
         <!-- PRUEBA TRIANGULAR -->
         <h3>MUESTRAS DE PRUEBA TRIANGULAR</h3>
         <div class="table-prueba-triangular mb-5">
            <table class="table table-success table-bordered">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">CODIGO</th>
                    <th scope="col">ELIMINAR MUESTRA</th>
                  </tr>
                </thead>
                <tbody class="table-light" id="cuerpo-table-uno">
                  
                </tbody>
              </table>
         </div>


         <!-- PRUEBA DUO - TRIO -->
         <h3>MUESTRAS DE PRUEBA DUO - TRIO</h3>
         <div class="table-prueba-duo mb-5">
            <table class="table table-success table-bordered">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">CODIGO</th>
                    <th scope="col">ELIMINAR MUESTRA</th>
                  </tr>
                </thead>
                <tbody class="table-light" id="cuerpo-table-dos">
                  
                </tbody>
              </table>
         </div>

         <!-- PRUEBA ORDENAMIENTO -->
         <h3>MUESTRAS DE PRUEBA ORDENAMIENTO - (<span id="atributo-prueba-span">ATRUBUTO</span>)</h3>
         <div class="table-prueba-orden mb-5">
            <table class="table table-success table-bordered">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">CODIGO</th>
                    <th scope="col">ELIMINAR MUESTRA</th>
                  </tr>
                </thead>
                <tbody class="table-light" id="cuerpo-table-tres">
                  
                </tbody>
              </table>
         </div>

    </div>
</body>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script src="../js/jquery-3.6.1.min.js"></script>
<script src="../js/sweetalert2.all.min.js"></script>
<script src="../js/scriptMuestras.js"></script>
</html>