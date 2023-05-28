<?php

namespace app;

require_once "autoloader.php";
use Controllers\auth\LoginController as LoginController;
use Controllers\PostController as PostController;

if(!empty($_POST)){

    //*************LOGIN */
    $login = in_array('_login',array_keys(filter_input_array(INPUT_POST)));
    if($login){
        $datos = filter_input_array(INPUT_POST,FILTER_SANITIZE_SPECIAL_CHARS);
        $userLogin = new LoginController();
        print_r($userLogin->userAuth($datos));
        
    }

    /*************REGISTER */
    $register = in_array('_register',array_keys(filter_input_array(INPUT_POST)));
    if($register){
        $datos = filter_input_array(INPUT_POST,FILTER_SANITIZE_SPECIAL_CHARS);
        $userRegister = new LoginController();
        print_r($userRegister->userRegister($datos));
    }

    // //***************GUARDAR NUEVA PUBLICACIÓN */
    // $gp =  in_array('_gp',array_keys(filter_input_array(INPUT_POST)));
    // if($gp){
    //     $datos = filter_input_array(INPUT_POST,FILTER_SANITIZE_SPECIAL_CHARS);
    //     $post = new PostController();
    //     $post->newPost($datos);
    //     header('Location: /portafolio/blasterblog/resources/views/autores/newpost.php');
    // }
    //***************GUARDAR NUEVA PUBLICACIÓN */
$gp = in_array('_gp', array_keys(filter_input_array(INPUT_POST)));
if ($gp) {
    $datos = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);
    // Obtener información del archivo enviado
    $imagen = $_FILES['thumb'];

    // Obtener el nombre y la ubicación temporal del archivo
    $nombreArchivo = $imagen['name'];
    $ubicacionTemporal = $imagen['tmp_name'];

    // Definir la carpeta de destino para guardar la imagen
    $carpetaDestino = '/portafolio/blasterblog/resources/images/' . $nombreArchivo;

    // Mover el archivo desde la ubicación temporal a la carpeta de destino
    move_uploaded_file($ubicacionTemporal, $_SERVER['DOCUMENT_ROOT'] . $carpetaDestino);

    // Crear el array de datos con la información de la publicación
    $datos = [
        'uid' => $datos['uid'],
        'title' => $datos['title'],
        'body' => $datos['body'],
        'thumb' => $carpetaDestino
    ];

    $post = new PostController();
    $post->newPost($datos);
    header('Location: /portafolio/blasterblog/resources/views/autores/newpost.php');
}

        //***************GUARDAR COMENTARIO*/
    $sc =  in_array('_sc',array_keys(filter_input_array(INPUT_POST)));
    if($sc){
        $datos = filter_input_array(INPUT_POST,FILTER_SANITIZE_SPECIAL_CHARS);
        $post = new PostController();
        print_r($post->saveComment($datos));
    }
        //*****************ACTUALIZAR POST ************* */
    $ud = in_array('_ud', array_keys(filter_input_array(INPUT_POST)));
    if ($ud) {
        $pid = filter_input(INPUT_POST, 'pid', FILTER_SANITIZE_NUMBER_INT);
        $uid = filter_input(INPUT_POST, 'uid', FILTER_SANITIZE_NUMBER_INT);
        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
        $body = filter_input(INPUT_POST, 'body', FILTER_SANITIZE_STRING);

        $data = [
            'pid' => $pid,
            'uid' => $uid,
            'title' => $title,
            'body' => $body,
        ];

        $post = new PostController();
        $result = $post->update($data);
        // Redirigir a la página de la publicación actualizada
        header('Location: /portafolio/blasterblog/resources/views/autores/myposts.php');
        exit;
    }


}

/****************************************GETS ************ recibe las petciciones del front****/

if(!empty($_GET)){
     //*************LOGOUT */
     $logout = in_array('_logout',array_keys(filter_input_array(INPUT_GET)));
     if($logout){
        $userLogout = new LoginController();
        $userLogout->logout();
        header('Location: /portafolio/blasterblog/resources/views/home.php');
     }
     //******************CARGAR PUBLICACIONES PREVIAS */
    $pp = in_array('_pp',array_keys(filter_input_array(INPUT_GET)));
    if($pp){
        $post = new PostController();
        print_r($post->getPosts());
    }
    //******************CARGAR LA PUBLICACION MAS RECIENTE */
    $lp = in_array('_lp',array_keys(filter_input_array(INPUT_GET)));
    if($lp){
        $l = filter_input_array(INPUT_GET)["limit"];
        $lastpost = new PostController();
        print_r($lastpost->getPosts($l));
    }

    //******************CARGAR PUBLICACION SELECCIONADA*/
    $op = in_array('_op',array_keys(filter_input_array(INPUT_GET)));
    if($op){
        $pid = filter_input_array(INPUT_GET)["pid"];        
        $post = new PostController();
        print_r($post->getPosts(1,$pid));
    }

    //******************Mostrar publicacion seleccionada VERPOST */
    $vp = in_array('_vp',array_keys(filter_input_array(INPUT_GET)));
    if($vp){
        $pid = filter_input_array(INPUT_GET)["pid"];        
        $post = new PostController();
        print_r($post->getPosts(1,$pid));
    }
    
    //**********************CARGAR MIS PUBLICACIONES ******************/
    $mp = in_array('_mp',array_keys(filter_input_array(INPUT_GET)));
    if($mp){
        $uid = filter_input_array(INPUT_GET)["uid"];
        $post = new PostController();
        print_r($post->getMyPosts($uid));
    }
    //******************ACTIVAR/DESACTIVA PUBLICACIÓN *********************/
    $tpa =  in_array('_tpa',array_keys(filter_input_array(INPUT_GET)));
    if($tpa){
        $pid = filter_input_array(INPUT_GET)["pid"];
        $post = new PostController();
        print_r(json_encode(['r' => $post->togglePostActive($pid)]));
    }
        //******************ELIMINAR PUBLICACIÓN *********************/
    $dp =  in_array('_dp',array_keys(filter_input_array(INPUT_GET)));
    if($dp){
        $pid = filter_input_array(INPUT_GET)["pid"];
        $post = new PostController();
        $post->deletePost($pid);
        // Redirigir a la lista de publicaciones
        header('Location: /portafolio/blasterblog/resources/views/autores/myposts.php');
    }

    //**********************RECUPERAR COMENTARIO DE UNA PUBLICACION******************/
    $pm = in_array('_pm',array_keys(filter_input_array(INPUT_GET)));
    if($pm){
        $pid = filter_input_array(INPUT_GET)["pid"];
        $post = new PostController();
        print_r($post->getPostComments($pid));
    }

        //****************** ACTUALIZAR PUBLICACION*************** */
    $ud = in_array('_ud',array_keys(filter_input_array(INPUT_GET)));
    if($ud){
        $pid = filter_input_array(INPUT_GET)["pid"];
        $post = new PostController();
    }
}


