<?php

require_once __DIR__ . '/../Models/Rubro.php';

$rubros = Rubro::obtenerRubros();

$cantidadRubros = Rubro::cantidadDeRubros();
$cantidadActivos = Rubro::cantidadDeRubrosActivos();
$cantidadInactivos = Rubro::cantidadDeRubrosInactivos();

require_once __DIR__ . '/../Views/rubrosIndex.view.php';