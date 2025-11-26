<?php

require_once __DIR__ . '/../Models/Rubro.php';

$idRubro = $_POST['id'];

$rubro = Rubro::obtenerRubroPorId($idRubro);

$rubro->eliminar();

header("Location: ".$_SERVER['HTTP_REFERER']);