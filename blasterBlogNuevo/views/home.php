<?php
    //este es el inicio para los que tengan una sesion iniciada
    include("layouts/main.php");

    head();
?>
<div class="row mx-auto" style="90%">
    <div class="col-9">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                <img src="../resources/img/oceano3.png" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                <img src="../resources/img/MolinoWallpaper.png" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                <img src="../resources/img/tazablaster3.png" class="d-block w-100" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <div class="col-3">
        <div class="temas-container">
            <h1>temas</h1>
            <ul>
                <li>Cine</li>
                <li>Arquitectura</li>
                <li>Arte</li>
                <li>Otros.</li>
            </ul>
        </div>
    </div>

    <!--
        Aqui comienza el cuerpo del inicio
    -->
    <?php include_once "../Models/Noticias.php"; ?>
    <?php foreach ($noticias as $noticia):?>
    <div class="col-9">
        <div id="content" class="content">
            <!--publicaciones  se maneja con el DOM-->
            <div class="card text-center">
                <div class="card-header">
                    <h1><?php echo $titulo ?></h1>
                </div>
                <div class="card-body">
                <img src="..." class="img-fluid" alt="...">
                    <p class="card-text"><?php echo $texto ?></p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
                <div class="card-footer text-muted">
                <?php echo $fecha ?>
                </div>
            </div>

        </div>
    </div>
    <?php endforeach ?>
</div>
<?php
    scripts();
    foot();