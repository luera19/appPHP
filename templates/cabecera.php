<?php

//Bloqueo de Sesion
session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location:../index.php');
}

?>


<!doctype html>
<html lang="es">

<head>
    <title>Aplicación de Certificados</title>
    <link rel="shortcut icon" href="../src/logo.jpg">

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    <!-- Option 1: Include in HTML -->
    <link rel="stylesheet" 
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css"
    />
    
</head>

<body>
    <!--NAVBAR--->
    <nav class="navbar navbar-expand navbar-light bg-light">
        <div class="nav navbar-nav">

            <a class="nav-item nav-link" href="index.php">Inicio</a>
            <a class="nav-item nav-link" href="../secciones/vista_alumnos.php">Alumnos</a>
            <a class="nav-item nav-link" href="../secciones/vista_cursos.php">Cursos</a>
            <a class="nav-item nav-link" href="../secciones/cerrar.php">Cerrar Sesión</a>
        </div>
    </nav>

    <div class="container">