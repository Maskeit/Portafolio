<?php 
    namespace views;
    require '../../../app/autoloader.php';
    include "../layouts/main.php";
    use Controllers\auth\LoginController as LoginController;
    $ua = new LoginController;
    is_null($ua->sessionValidate()) ? header('Location: /resources/views/auth/login.php') : '';
    head($ua);
?>
<h1>aqui va la configuracion</h1>
<?php
    scripts();
    foot();