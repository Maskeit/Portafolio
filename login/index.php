<?php session_start();

// comprobamos que el usuario tenga una sesion inciada sino matamos la ejecucion de la pagina
if(isset($_SESSION['usuario'])){
    header('Location: Views/inicio.php');
    die();
} else{
    //enviamos al usuario al formulario de login
    header('Location: Views/login.php');
}