<?php session_start();

include ("../Models/Usuario.php");
//comprobamos si ya se tiene una sesion inciada y si es asi lo redirigimos al contenido
if(isset($_SESSION['usuario'])){
    header('Location: ../Views/inicio.php');
    die();
}

//comprobamos si ya han sido enviados los datos
if($_SERVER['REQUEST_METHOD']=='POST'){
    //validacion de los parametros de formulario
    if(
        (!isset($_POST['name'])) || 
        (!isset($_POST['email'])) || 
        (!isset($_POST['usuario'])) || 
        (!isset($_POST['passwd'])) || 
        (!isset($_POST['passwd2']))
    ){
        echo 'params error';
        return;
    }
    //validamos que los datos hayan sido rellenados
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $nombre_usuario = filter_var(strtolower($_POST['usuario']), FILTER_SANITIZE_STRING);
    //$edad = filter_var(strtolower($_POST['edad']), FILTER_SANITIZE_NUMBER_INT);
    $passwd = $_POST['passwd'];
    $passwd2 = $_POST['passwd2'];

    $errores = '';

    //Comprobamos que ninguno de los campos este vacio
    if(empty($name) or empty($nombre_usuario) or empty($email)or empty($passwd) or empty($passwd2)){
        $errores = '<li>Por favor rellene los campos correctamente.</li>';
    } else{
        //comprobamos que el usuario no exista ya
        $usuarioCheck = new Usuario($nombre_usuario, $passwd );
        $username = $usuarioCheck->authenticate($nombre_usuario);

        if($username){
            header('Content-Type: ..\public\valForms.js');
            echo json_encode(["status" => "ocupado"]);
            exit();
            //header('Location: ../Views/registro.php');
            //$errores = '<li>El usuario ya existe</li>';
        }else{
            $passwd = hash('sha512', $passwd);
            $passwd2 = hash('sha512', $passwd2);
            // Comprobamos que las contraseñas sean iguales.
            if ($passwd != $passwd2) {
                $errores .= '<li>Las contraseñas no son iguales</li>';
            }
        }
    }

    //verificamos que la variable errores este vacia para seguir
    if (!empty($errores)) {
        echo "<ul>" . $errores . "</ul>";
    }else{
        $conexionDB = new DB();
        $usuario = new Usuario($name, $nombre_usuario, $email, $passwd);
        $succes = $usuario->registrar($conexionDB, $name, $nombre_usuario, $email, $passwd);
        if($succes){
            //despues de registrar al usuario redirigiremos para que inicie sesion
            header('Location: ../Views/login.php');
        }else{
            header('Location: ../Views/registro.php');
        }
        
    }    
}
