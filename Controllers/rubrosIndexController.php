<?php

require_once __DIR__ . '/../Models/Rubro.php';

$rubros = Rubro::obtenerRubros();

require_once __DIR__ . '/../Views/rubrosIndex.view.php';