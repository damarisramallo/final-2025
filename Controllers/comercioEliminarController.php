<?php

require_once __DIR__ . '/../Models/Comercio.php';

$idComercio = $_POST['id'];

$comercio = Comercio::obtenerPorId($idComercio);

$comercio->eliminar();

header("Location: ".$_SERVER['HTTP_REFERER']);