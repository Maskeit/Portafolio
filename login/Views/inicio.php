<?php session_start();
if(isset($_SESSION['usuario'])){
  include("layouts/main.php");
  head();
}else{
  header('Location: login.php');
  die();
}
?>
<div class="alert alert-success" role="alert">
  hola <?php echo $_SESSION['usuario']; ?>
</div>