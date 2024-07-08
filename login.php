<?php
    include("clases/conexion.php");
    session_start();
    $alerta = "";
    if (isset($_POST['contra'])) {
        $contra = $_POST['contra'];
        if ($con) {
            $script = "SELECT * FROM configuracion WHERE id_config = 1 ";
            $result = mysqli_query($con,$script);
            if (mysqli_num_rows($result) > 0) {
                $contra_config =  mysqli_fetch_array($result)['clave_acceso'];
                if ($contra_config == $contra) {
                    $_SESSION["accesoadmin"] = true;
                    header('location: src/panel_administracion.php');
                } else {
                    $alerta = "Clave de acceso incorrecta!";
                }
                
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
    <title>Document</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <style>
        body{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .formulario{
            margin: auto;
            margin-top: 60px;
            width: 40%;
        }

        h2{
            font-family: cursive;
            text-align: center;
            letter-spacing: 5px;
            font-size: 16pt;
        }
    </style>
</head>
<body>

    <nav class="navbar bg-success">
        <div class="container-fluid">
          <a class="navbar-brand text-light" style="font-weight: bold; text-transform: uppercase; margin: 0;"><img src="img/logo-de-Sena-sin-fondo-Blanco.png" alt="" width="50px"> Laboratorio sensorial de alimentos - Sena Cedagro</a>
          <form class="d-flex" role="search">
            <a href="index.php" class="btn btn-outline-light">VOLVER FORMULARIO</a>
          </form>
        </div>
    </nav>

    <form action="" method="POST" class="formulario border p-3">
        <h2 class="text-success mb-4">Acceso administracion</h2>
        <div class="mb-3">
            <label for="contra-access" class="form-label">Contraseña de accesso</label>
            <input type="password" name="contra" id="contra-access" class="form-control">
        </div>
        <div class="alert alert-danger" role="alert" style="display: <?php if($alerta != "") {echo 'block';}else{echo 'none';}?>">
            <?php if($alerta != "") {echo $alerta;}?>
        </div>
        <div class="text-center">
            <input type="submit" class="btn btn-outline-success">
        </div>
    </form>
</body>
</html>