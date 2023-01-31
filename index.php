<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CRUD - Alicia Ruiznavarro</title>

  <link rel="stylesheet" href="style.css">
</head>

<body>

  <?php

  include('conexion.php');

  $conexion = $base->query("SELECT * FROM productos");
  $registros = $conexion->fetchAll(PDO::FETCH_OBJ);

  if (isset($_POST["cr"])) {
    $codigoarticulo = $_POST["CODIGOARTICULO"];
    $seccion = $_POST["SECCION"];
    $nombrearticulo = $_POST["NOMBREARTICULO"];
    $precio = $_POST["PRECIO"];
    $fecha = $_POST["FECHA"];
    $importado = $_POST["IMPORTADO"];
    $paisdeorigen = $_POST["PAISDEORIGEN"];

    $sql = "INSERT INTO productos (CODIGOARTICULO, SECCION, NOMBREARTICULO, PRECIO, FECHA, IMPORTADO, PAISDEORIGEN) VALUES(:codArt, :seccion, :nomArt, :precio, :fecha, :importado, :paisOri)";
    $resultado = $base->prepare($sql);
    $resultado->execute(array(":codArt" => $codigoarticulo, ":seccion" => $seccion, ":nomArt" => $nombrearticulo, ":precio" => $precio, ":fecha" => $fecha, ":importado" => $importado, ":paisOri" => $paisdeorigen));

    header("location:index.php");
  }

  if (isset($_POST["submit"]) && !empty($_POST["busqueda"])) {
    $codigoarticulo = "%" . $_POST["busqueda"] . "%";
    $seccion = "%" . $_POST["busqueda"] . "%";
    $nombrearticulo = "%" . $_POST["busqueda"] . "%";
    $precio = "%" . $_POST["busqueda"] . "%";
    $fecha = "%" . $_POST["busqueda"] . "%";
    $importado = "%" . $_POST["busqueda"] . "%";
    $paisdeorigen = "%" . $_POST["busqueda"] . "%";
    
    $conexion = $base->prepare("SELECT * FROM productos WHERE CODIGOARTICULO LIKE :codArt or SECCION LIKE :seccion or NOMBREARTICULO LIKE :nomArt or PRECIO LIKE :precio or FECHA LIKE :fecha or IMPORTADO LIKE :importado or PAISDEORIGEN LIKE :paisOri");
    $conexion->execute(array(":codArt" => $codigoarticulo, ":seccion" => $seccion, ":nomArt" => $nombrearticulo, ":precio" => $precio, ":fecha" => $fecha, ":importado" => $importado, ":paisOri" => $paisdeorigen));
    $registros = $conexion->fetchAll(PDO::FETCH_OBJ);

  } else {
    $conexion = $base->query("SELECT * FROM productos");
    $registros = $conexion->fetchAll(PDO::FETCH_OBJ);
  }

  ?>

  <h1>CRUD</h1>

  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <table width="50%" border="0" align="center">
      <tr>
        <td class="primera_fila">CODIGOARTICULO</td>
        <td class="primera_fila">SECCION</td>
        <td class="primera_fila">NOMBREARTICULO</td>
        <td class="primera_fila">PRECIO</td>
        <td class="primera_fila">FECHA</td>
        <td class="primera_fila">IMPORTADO</td>
        <td class="primera_fila">PAISDEORIGEN</td>
        <td class="sin">&nbsp;</td>
        <td class="sin">&nbsp;</td>
        <td class="sin">&nbsp;</td>
      </tr>


      <?php

      foreach ($registros as $articulo): ?>

      <tr>
        <td> <?php echo $articulo->CODIGOARTICULO ?> </td>
        <td> <?php echo $articulo->SECCION ?> </td>
        <td> <?php echo $articulo->NOMBREARTICULO ?> </td>
        <td> <?php echo $articulo->PRECIO ?> </td>
        <td> <?php echo $articulo->FECHA ?> </td>
        <td> <?php echo $articulo->IMPORTADO ?> </td>
        <td> <?php echo $articulo->PAISDEORIGEN ?> </td>


        <td class="bot"><a href="borrar.php?CODIGOARTICULO=<?php echo $articulo->CODIGOARTICULO ?>"><input type='button' name='del' id='del'
              value='Borrar'></a></td>
        <td class='bot'><a
            href="actualizar.php?CODIGOARTICULO=<?php echo $articulo->CODIGOARTICULO ?> & SECCION=<?php echo $articulo->SECCION ?> & NOMBREARTICULO=<?php echo $articulo->NOMBREARTICULO?> & PRECIO=<?php echo $articulo->PRECIO ?>& FECHA=<?php echo  $articulo->FECHA ?> & IMPORTADO=<?php echo $articulo->IMPORTADO ?> & PAISDEORIGEN=<?php echo $articulo->PAISDEORIGEN ?>"><input
              type='button' name='up' id='up' value='Actualizar'></a></td>
             
      </tr>

      <?php endforeach; ?>


      <tr>
      <td><input type='text' name='CODIGOARTICULO' size='10' class='centrado'></td>
        <td><input type='text' name='SECCION' size='10' class='centrado'></td>
        <td><input type='text' name='NOMBREARTICULO' size='10' class='centrado'></td>
        <td><input type='text' name='PRECIO' size='10' class='centrado'></td>
        <td><input type='text' name=' FECHA' size='10' class='centrado'></td>
        <td><input type='text' name=' IMPORTADO' size='10' class='centrado'></td>
        <td><input type='text' name=' PAISDEORIGEN' size='10' class='centrado'></td>
        <td class='bot'><input type='submit' name='cr' id='cr' value='Insertar'></td>
      </tr>

      <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>
          <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <input type="text" name="busqueda">
          </form>
        </td>
        <td><input type="submit" name="submit" value="Seleccionar"></td>
        <td><a href="index.php"><button>Mostrar Todo</button></a></td>
      </tr>
  </table>

    <p>&nbsp;</p>
</body>

</html>