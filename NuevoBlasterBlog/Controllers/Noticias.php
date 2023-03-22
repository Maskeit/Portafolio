<?php
include_once "DB.php";

//creamos una nueva instancia de la clase ConexionBD
$conexionBD = new DB(); //"$conexionBD" es el nuevo objeto/instancia de la clase
$conexion = $conexionBD->db_connect(); //aqui usamos el metodo db_connect()

if($conexion == null){
    //en caso de que no se conecte
    echo "erro al conectar a la base de datos";
} else{
    //aqui la conexion se realizo satisfactoriamente
    $resultado_book = mysqli_query($conexion, "SELECT * FROM articulos"); //aqui hacemos la consulta correspondiente a la tabla articulos de la bd blasterblog

    if($resultado_book){
        while($fila = mysqli_fetch_assoc($resultado_book)){
             $idArticle = $fila["id"];
             $titulo = $fila["titulo"];
             $extracto = $fila["extracto"];
             $fecha = $fila["fecha"];
             $texto = $fila["texto"];
             $imagen = $fila["thumb"];
              // Creamos un objeto Noticia para cada registro de la tabla "articulos"
             $noticia = new Noticias($idArticle, $titulo, $extracto, $fecha,$texto, $imagen);
             //Agregamos el libro al arreglo de libros
             $noticias[] = $noticia;
        }
    } else{
        echo "error al realizar la consulta";
    }
}

class Noticias{

    public function __construct(
    private $idArticle, 
    private $titulo, 
    private $extracto, 
    private $fecha,
    private $texto, 
    private $imagen
    )
    {}

    public function getInfo(){
        $info = "$this->idArticle <br>, $this->titulo<br>, $this->extracto <br>, $this->fecha <br>, $this->texto <br>,$this->imagen <br><br>";
        return $info;
    }

}
foreach ($noticias as $noticia) {
    echo $noticia->getInfo();
}