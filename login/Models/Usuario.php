<?php
include("DB.php");
class Usuario{
    private $user;
    private $email;
    private $passwd;

    public function __construct(...$args) {
        $this->user = $args[0];
        $this->email = isset($args[1]) ? $args[1] : null;
        $this->passwd = $args[count($args) - 1];
    }
    
    function getUsers(){
        $conexionDB = new DB(); //creamos una instancia de la clase DB
        $conexion = $conexionDB->db_connect(); //utilizamos el metodo db_connect()
    
        if($conexion == null){
            echo "Hubo un error al conectar a la base de datos <br>";
        }else{
            $resultado_usuario = mysqli_query($conexion, "SELECT * FROM usuarios");
    
            if($resultado_usuario){
                $usuarios = []; //incializamos la variable $usuarios
    
                while($fila = mysqli_fetch_assoc($resultado_usuario)){
                    //$id = $fila['ID'];
                    $email = $fila['correo'];
                    $user = $fila['usuario'];
                    $passwd = $fila['passwd'];
                    $usuario = new Usuario($user ,$passwd,);
                    $usuarios[] = $usuario;
                }
                return $usuarios;
            } else{
                echo "error al realizar la consulta";
            }
        }
    }
    function authenticate($user){
        $conexionDB = new DB();
        $conexion = $conexionDB->db_connect();
        if($conexion == null){
            echo "Hubo un error al conectar a la base de datos <br>";
        }else{
            $stmt = mysqli_prepare($conexion, "SELECT * FROM usuarios WHERE usuario = ? LIMIT 1");
            mysqli_stmt_bind_param($stmt, "s", $user);
            mysqli_stmt_execute($stmt);
            $resultado_autenticado = mysqli_stmt_get_result($stmt);
            $fila = mysqli_fetch_assoc($resultado_autenticado);
            if ($fila) {
                return true; // el usuario ya existe
            } else {
                return false; // el usuario no existe
            }
        }
    }        
    // En la siguiente función, el parámetro $user es el nombre de usuario que se quiere comprobar
    
    function registrar(DB $db, $usuario, $email, $passwd) {
        //crear variables temporales
        $usuario_temp = $usuario;
        $email_temp = $email;
        $passwd_temp = $passwd;
        // Realizar la inserción de datos en la base de datos
        // Por ejemplo:
        $conn = $db->db_connect();
        if(!$conn){
        return null;
        }
        $sql = 'INSERT INTO usuarios (usuario, email, passwd) VALUES (?, ?, ?)';
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $usuario_temp, $email_temp, $passwd_temp);
        $stmt->execute();

        return $conn->affected_rows; //retorna la cantidad de filas afectadas por la consulta
    }

    //este siguiente metodo lo utilizamos para buscar en la bd al usuario que intenta logearse
    //si se encuentra entonces devolvemos true para que se inicie la sesion
    function logear(DB $db, $usuario, $passwd){
        //buscamos al usuario en la bd
        $conn = $db->db_connect();
        if(!$conn){
            return null;
        }
        $sql = ('SELECT * FROM usuarios WHERE (usuario = ? OR email = ?) AND passwd = ?');
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sss', $usuario, $usuario, $passwd);
        $stmt->execute();
        $result = $stmt->get_result();
        $fila = $result->fetch_assoc();
        if($fila !== null){
            $userFound = $fila['usuario'];
            $correo = $fila['email'];        
            return $userFound; //retorna el nombre de usuario
        } else{
            return false;
        }
    }
    
}

//malejandre@gmail.com  