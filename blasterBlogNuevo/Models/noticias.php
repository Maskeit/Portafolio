<?php
include_once "DB.php";

class Noticias {
    public $idArticle;
    public $titulo;
    public $extracto;
    public $fecha;
    public $texto;
    public $imagen;

    public function __construct($idArticle, $titulo, $extracto, $fecha, $texto, $imagen) {
        $this->idArticle = $idArticle;
        $this->titulo = $titulo;
        $this->extracto = $extracto;
        $this->fecha = $fecha;
        $this->texto = $texto;
        $this->imagen = $imagen;
    }

    public function getInfo() {
        $info = "{$this->idArticle} <br> {$this->titulo} <br> {$this->extracto} <br> {$this->fecha} <br> {$this->texto} <br> {$this->imagen} <br><br>";
        return $info;
    }
}

$conexionBD = new DB();
$conexion = $conexionBD->db_connect();

if($conexion == null){
    echo "error al conectar a la base de datos";
} else {
    $resultado_book = mysqli_query($conexion, "SELECT * FROM articulos");

    if($resultado_book){
        $noticias = []; // Inicializar la variable $noticias
        while($fila = mysqli_fetch_assoc($resultado_book)){
             $idArticle = $fila["id"];
             $titulo = $fila["titulo"];
             $extracto = $fila["extracto"];
             $fecha = $fila["fecha"];
             $texto = $fila["texto"];
             $imagen = $fila["thumb"];
             $noticia = new Noticias($idArticle, $titulo, $extracto, $fecha, $texto, $imagen);
             $noticias[] = $noticia;
        }
        $noticias_json = json_encode($noticias);
        echo '<script>var noticias = ' .$noticias_json . ';</script>';

    } else {
        echo "error al realizar la consulta";
    }
}


// if($conexion == null){
//     echo "error al conectar a la base de datos";
// } else {
//     $resultado_book = mysqli_query($conexion, "SELECT * FROM articulos");

//     if($resultado_book){
//         $noticias = []; // Inicializar la variable $noticias
//         while($fila = mysqli_fetch_assoc($resultado_book)){
//              $idArticle = $fila["id"];
//              $titulo = $fila["titulo"];
//              $extracto = $fila["extracto"];
//              $fecha = $fila["fecha"];
//              $texto = $fila["texto"];
//              $imagen = $fila["thumb"];
//              $noticia = new Noticias($idArticle, $titulo, $extracto, $fecha, $texto, $imagen);
//              $noticias[] = $noticia;
//         }
//     } else {
//         echo "error al realizar la consulta";
//     }
// }

// foreach ($noticias as $noticia) {
//     echo $noticia->getInfo();
// }

// $noticias_json = json_encode($noticias);
// echo "<script>var noticias = $noticias_json;
//         console.log(noticias)</script>";
