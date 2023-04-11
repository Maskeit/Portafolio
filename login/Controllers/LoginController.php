<?php session_start();
//comprobamos si ya se tiene una sesion inciada y si es asi lo redirigimos al contenido
if(isset($_SESSION['usuario'])){
    header('Location: ../Views/inicio.php');
    die();
}
include ("../Models/Usuario.php");

//comprobamos si ya han sido enviados los datos
if($_SERVER['REQUEST_METHOD']=='POST'){
    //validamos que los datos hayan sido rellenados
    $nombre_usuario = filter_var(strtolower($_POST['usuario']), FILTER_SANITIZE_STRING);
    $passwd = $_POST['passwd'];
    $passwd = hash('sha512', $passwd);

    $errores = '';

    //Comprobamos que ninguno de los campos este vacio
    if(empty($nombre_usuario) or empty($passwd)){
        $errores = '<li>Por favor rellene los campos correctamente.</li>';
    }
    //verificamos que la variable errores este vacia para seguir
    if (!empty($errores)) {
        echo "<ul>" . $errores . "</ul>";
    }else{
        $conexionDB = new DB();
        $usuario = new Usuario($nombre_usuario, $passwd );
        /**aqui se crea la sesion */
        if($usuario->logear($conexionDB, $nombre_usuario, $passwd)){
            $_SESSION['usuario'] = $nombre_usuario;
            //despues de registrar al usuario redirigiremos para que inicie sesion
            header('Location: ../Views/inicio.php');
        }else{
            header('Location: ../Views/login.php');
            // $errores = '<li>Credenciales incorrectas</li>';
            // echo "<ul>" . $passwd . $errores . "</ul>";
        }
    }
}