<?php

require_once __DIR__ . '/../Models/Rubro.php';
require_once __DIR__ . '/../Models/Documentacion.php';

$tiposDocumentacion = Documentacion::obtenerTiposDocumentacion();

require_once __DIR__ . '/../Views/rubrosAlta.view.php';