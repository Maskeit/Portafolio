<?php
    include("layouts/main.php");
    include_once("../Controllers/GaleriaController.php");

    head();
?>

<div class="row mx-auto" style="50%">
    <h1>El arte que mas te gusta</h1>
</div>
<div class="row mx-auto">
    <div class="text-center" style="display: flex; justify-content: space-between; margin-top: 120px;">
        <img src="../resources/img/oceano3.png" class="img-thumbnail " style="width: 20%; box-shadow: 2px 2px 3px rgba(0,0,0,.8); -webkit-transition: all .3s ease; -o-transition: all .3s ease; transition: all .3s ease; " alt="...">
        <img src="../resources/img/oceano3.png" class="img-thumbnail "  style="width: 20%; box-shadow: 2px 2px 3px rgba(0,0,0,.8); -webkit-transition: all .3s ease; -o-transition: all .3s ease; transition: all .3s ease; " alt="...">
        <img src="../resources/img/oceano3.png" class="img-thumbnail "  style="width: 20%; box-shadow: 2px 2px 3px rgba(0,0,0,.8); -webkit-transition: all .3s ease; -o-transition: all .3s ease; transition: all .3s ease; " alt="...">
        <img src="../resources/img/oceano3.png" class="img-thumbnail "  style="width: 20%; box-shadow: 2px 2px 3px rgba(0,0,0,.8); -webkit-transition: all .3s ease; -o-transition: all .3s ease; transition: all .3s ease; " alt="...">
    </div>
    <div class="text-center" style="display: flex; justify-content: space-between; margin-top: 120px;">
        <img src="../resources/img/oceano3.png" class="img-thumbnail " style="width: 20%; box-shadow: 2px 2px 3px rgba(0,0,0,.8); -webkit-transition: all .3s ease; -o-transition: all .3s ease; transition: all .3s ease; " alt="...">
        <img src="../resources/img/oceano3.png" class="img-thumbnail "  style="width: 20%; box-shadow: 2px 2px 3px rgba(0,0,0,.8); -webkit-transition: all .3s ease; -o-transition: all .3s ease; transition: all .3s ease; " alt="...">
        <img src="../resources/img/oceano3.png" class="img-thumbnail "  style="width: 20%; box-shadow: 2px 2px 3px rgba(0,0,0,.8); -webkit-transition: all .3s ease; -o-transition: all .3s ease; transition: all .3s ease; " alt="...">
        <img src="../resources/img/oceano3.png" class="img-thumbnail "  style="width: 20%; box-shadow: 2px 2px 3px rgba(0,0,0,.8); -webkit-transition: all .3s ease; -o-transition: all .3s ease; transition: all .3s ease; " alt="...">
    </div>
</div>

<div class="paginacionGaleria">
	<!-- Si el usuario esta en la pagina principal entonces no mostramos el enlace a una pagina anterior -->
		<?php if ($pagina_actual != 1): ?>
			<a href="galeria.php?p=<?php echo $pagina_actual -1; ?>" class="izquierdaGaleria"><i class="fa fa-long-arrow-left"></i> Pagina Anterior</a>
		<?php endif ?>
	<!-- Si el usuario esta en la pagina principal entonces no mostramos el enlace a una pagina siguiente -->
		<?php if ($total_paginas != $pagina_actual): ?>
			<a href="galeria.php?p=<?php echo $pagina_actual +1; ?>" class="derechaGaleria">Pagina Siguiente <i class="fa fa-long-arrow-right"></i></a>
		<?php endif ?>
</div>




<?php
    scripts();
    foot();