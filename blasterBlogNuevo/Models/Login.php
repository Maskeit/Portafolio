<?php
include_once "DB.php";

class Login{
    protected $idUser;
    protected $email;
    protected $username;
    protected $passwd;

    public function __construct($idUser, $email, $username, $passwd){
        $this->idUser = $idUser;
        $this->email = $email;
        $this->username = $username;
        $this->passwd = $passwd;
    }

    /*El siguiente metodo para comprueba si las credenciales de inicio de sesión
     son válidas, es decir, si el usuario y la contraseña proporcionados 
     coinciden con los datos almacenados en la base de datos.*/
    public function checkLogin() {
        $db = new DB();
        $result = $db->authenticate($this->username, $this->passwd);
        if($result){
            //iniciar sesion y redirigir a la pagina de inicio
            session_start();
            $_SESSION['username'] = $this->username;
            header('Location: ../views/home.php');
            exit;
        }else{
            //mostrar un mensaje de error y regresarlo al login
            $error_message = "credenciales incorrectas";
            header("Location: ../views/login.php?error=". urlencode($error_message));
            exit;
        }
    }
}



