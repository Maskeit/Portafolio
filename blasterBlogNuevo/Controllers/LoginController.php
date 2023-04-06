<?php

if(!empty($_POST["btn-submit"])){
    if (!empty($_POST["username"]) and !empty($_POST["passwd"]) ) {
        $username = $_POST["username"];
        $passwd = $_POST["password"];
        echo $username;
        echo $passwd;
    } else {
        echo "campos vacios";
    }
    

}
