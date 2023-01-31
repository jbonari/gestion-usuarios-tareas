<?php
//session_start();
require_once 'autoload.php';
require_once 'config/Database.php';
require_once 'config/parameters.php';
require_once 'helpers/Utils.php';
?>

<!DOCTYPE HTML>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Actividad 4</title>
    <link rel="stylesheet" type="text/css" href="<?=base_url?>assets/css/styles.css" />
</head>
<body>

    <div id="container">
        <!--cabecera-->
        <header id="header">
            <div id="logo">
                <a href="<?=base_url?>">
                    Actividad 4 | Utilización de técnicas de acceso a datos
                </a>
            </div>
        </header>

    <!--menu-->

    <nav id="menu">
        <ul>
            <li>
                <a href="<?=base_url?>">Inicio</a>
            </li>
                <?php if(isset($_SESSION['admin'])): ?>
                    <li><a href="<?=base_url?>proyecto/gestion">Gestionar Proyectos</a></li>
                    <li><a href="<?=base_url?>usuario/gestion">Gestionar usuarios</a></li>
                    <li><a href="<?=base_url?>tarea/gestion">Gestionar tareas</a></li>
                    <li><a href="<?=base_url?>usuario/logout">Cerrar sesión</a></li>
                <?php endif; ?>

                <?php if(isset($_SESSION['identity'])&& !isset($_SESSION['admin'])): ?>
                    <li><a href="<?=base_url?>tarea/mis_tareas">Ver mis tareas asignadas</a></li>
                    <li><a href="<?=base_url?>usuario/logout">Cerrar sesión</a></li>
                <?php endif; ?>
    </nav>

    <div id="content">

        <!--contenido central-->
        <div id="central">
