<?php
require_once __DIR__ . '/../Models/Rubro.php';
require_once __DIR__ . '/../Models/Titular.php';
require_once __DIR__ . '/../Models/Comercio.php';

$cantidadRubros = Rubro::cantidadDeRubros();
$cantidadRazones = Titular::cantidadDeRazones();
$cantidadComercios = Comercio::cantidadDeComercios();


require_once __DIR__ . '/../Views/dashboardIndex.view.php';