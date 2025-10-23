<?php

require_once __DIR__ . '/../Models/Usuario.php';

session_start();

if(isset($_SESSION['email'])) {
    header('Location: ./index.php');
} else {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = sha1($_POST['password']);
        $usuario = Usuario::getUser($email, $password);
        if($usuario){
            $_SESSION['email'] = $usuario;
            $_SESSION['info'] = 'Login correcto';
            header('Location: ./publicIndexController.php');
        } else {
            $_SESSION['info'] = 'Usuario o contraseña incorrectos';
        }
    }
}

include_once __DIR__ . '/../Views/login.view.php';