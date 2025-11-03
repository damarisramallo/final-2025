<?php

require_once __DIR__ . '/../Config/Conexion.php';
require_once __DIR__ . '/../Models/Comercio.php';

$comercios = Comercio::obtenerComercios();


require_once __DIR__ . '/../Views/comercioIndex.view.php';