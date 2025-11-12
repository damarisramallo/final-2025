<?php

require_once __DIR__ . '/../Config/Conexion.php';
require_once __DIR__ . '/../Models/Titular.php';
require_once __DIR__ . '/../Models/Rubro.php';

$razonesSociales = Titular::obtenerRazonesSociales();
$rubros = Rubro::obtenerRubros();

require_once __DIR__ . '/../Views/comercioAlta.view.php';