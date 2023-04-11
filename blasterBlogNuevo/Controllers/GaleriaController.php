<?php
include_once '../Models/DB.php';
$img_por_pagina = 8;

$pagina_actual = (isset($_GET['p']) ? (int)$_GET['p'] : 1);
$inicio = ($pagina_actual > 1) ? $pagina_actual * $img_por_pagina - $img_por_pagina : 0;

$conexionBD = new DB();
$conexionGaleria = $conexionBD->db_connect();

if($conexionGaleria == null){
    echo "error al conectar a la base de datos";
}else{
    $result_galeria = mysqli_query($conexionGaleria, "SELECT SQL_CALC_FOUND_ROWS * FROM fotos LIMIT $inicio, $img_por_pagina");

    if(!$result_galeria){
        header('Location: ../index.php');
    }
    // // Ejecutamos otra consulta para conocer el numero de paginas que tendremos
$statement = mysqli_query($conexionGaleria,"SELECT FOUND_ROWS() as total_filas");
$resultado = $statement->fetch_array(MYSQLI_ASSOC);
$total_post = $resultado['total_filas'];


$total_paginas = ($total_post / $img_por_pagina);
$total_paginas = ceil($total_paginas);
}