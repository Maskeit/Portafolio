
<?php
//establecemos los parametros de la clase
class DB{
    public $db_host;
    public $db_name;
    public $db_user;
    public $db_passwd;
    public $conexion;

    //al construct le añadimos los argumentos que va tomar la funcion
    public function __construct($dbh = "localhost", $dbu = "root", $dbp = "", $dbn = "login"){
        $this->db_host = $dbh;
        $this->db_user = $dbu;
        $this->db_passwd = $dbp;
        $this->db_name = $dbn;
    }
    //creamo el metodo para conectar a la base de datos con los argumentos antes dados
    public function db_connect(){
        $this->conexion = mysqli_connect($this->db_host,
                                        $this->db_user,
                                        $this->db_passwd,
                                        $this->db_name);
        $this->conexion->set_charset("utf8");//definimos la codificacion
        //verificamos si la conexion a la base de datos fue exitosa sino retornamos un mensaje, de lo contrario retornamos la conexion
        if(mysqli_connect_errno()){
            echo "fallo la conexion";
            return null;
        }else{
            echo "se conecto satisfactoriamente";
            return $this->conexion;
        }
    }
}