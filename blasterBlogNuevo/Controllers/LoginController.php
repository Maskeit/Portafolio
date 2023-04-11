<?php
include_once "../Models/Login.php";
include_once "../Models/DB.php";

function login(){
    if(isset($_SESSION['username'])){ #verificamos si no se tiene una sesion, si es asi lo redirigimos directo al contenido
        header('Location: ../index.php');
        die();
    }
    //comprobamos si los datos han sido recibidos
    $errores = '';
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if( !empty($_POST['username']) and !empty($_POST["passwd"]) ){
            $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
            $passwd = filter_var($_POST['passwd'], FILTER_SANITIZE_STRING);
            //$passwd_hashed = password_hash($passwd, PASSWORD_DEFAULT);
            $login = new Login(null, null, $username, $passwd);//llama a la funcion login
        } else {
            $errores .= '<li>Por favor rellena todos los campos correctamente</li>';
        }
    }
    // Solo intenta iniciar sesión si se recibieron datos válidos
    if (isset($login) && $login->checkLogin()) {
        // Si el inicio de sesión es exitoso, redirecciona a la página de inicio
        header("Location: ../views/home.php");
        exit();
    } else {
        // Si el inicio de sesión falla, redirecciona a la página de inicio de sesión
        header("Location: ../views/login.php?error=1");
        exit();
    }
}
