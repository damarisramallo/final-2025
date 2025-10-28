<?php

require_once __DIR__ . '/../Config/Conexion.php';
require_once __DIR__ . '/../Models/Titular.php';

$razonesSociales = Titular::obtenerRazonesSociales();


require_once __DIR__ . '/../Views/titularesIndex.view.php';