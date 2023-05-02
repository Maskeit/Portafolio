<?php

class DB{
    public $db_host;
    public $db_name;
    private $db_user;
    private $db_passwd;
    private $conexion;

    public function __construct($dbh = "localhost", $dbn = "blasterblog", $dbu="root", $dbp = ""){
        $this->db_host = $dbh;
        $this->db_name = $dbn;
        $this->db_user = $dbu;
        $this->db_passwd= $dbp;
    }

    public function db_connect(){
        $this->conexion = mysqli_connect($this->db_host,
                                        $this->db_user,
                                        $this->db_passwd,
                                        $this->db_name);
        $this->conexion->set_charset("utf8");
        if(mysqli_connect_errno()){
            echo "Fallo la conexion a la base de datos";
            return null;
        }else{
            return $this->conexion;
        }
    }

    /* Método para autenticar al usuario */
    public function authenticate($username, $password) {
        $query = "SELECT * FROM username WHERE username='$username'";
        $result = mysqli_query($this->conexion, $query);
        $row = mysqli_fetch_assoc($result);
        $hashed_password = $row['passwd'];
        if (password_verify($password, $hashed_password)) {
            return true;
        } else {
            return false;
        }
    }
}
