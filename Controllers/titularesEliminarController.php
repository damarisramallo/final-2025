<?php

require_once __DIR__ . '/../Models/Titular.php';

$idRazon = $_POST['id'];

$razon = Titular::obtenerPorId($idRazon);

$razon->eliminar();

header("Location: ".$_SERVER['HTTP_REFERER']);