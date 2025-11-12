<?php

require_once __DIR__ . '/../Config/Conexion.php';
require_once __DIR__ . '/../Models/Comercio.php';



$razonesSociales = Titular::obtenerRazonesSociales();
$rubros = Rubro::obtenerRubros();

$idComercio = $_GET['idComercio'];

$comercio = Comercio::obtenerPorId($idComercio);


require_once __DIR__ . '/../Views/comercioEditar.view.php';

