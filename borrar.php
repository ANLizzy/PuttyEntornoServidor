<?php
    include('conexion.php');
    $codigoarticulo = $_GET["CODIGOARTICULO"];
    $seccion = $_GET["SECCION"];
    $nombrearticulo = $_GET["NOMBREARTICULO"];
    $precio = $_GET["PRECIO"];
    $fecha = $_GET["FECHA"];
    $importado = $_GET["IMPORTADO"];
    $paisdeorigen =$_GET["PAISDEORIGEN"];

    $base->query("DELETE FROM productos WHERE CODIGOARTICULO = '$codigoarticulo' OR SECCION = '$seccion' OR NOMBREARTICULO = '$nombrearticulo' OR PRECIO = '$precio' OR FECHA = '$fecha' OR IMPORTADO = '$importado' OR PAISDEORIGEN = '$paisdeorigen'");

    header("Location: index.php");
?>