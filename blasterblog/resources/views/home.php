<?php 
    namespace views;
    require '../../app/autoloader.php';
    include "./layouts/main.php";
    use Controllers\auth\LoginController as LoginController;
    $ua = new LoginController;
    head($ua);
?>
<div class="row mx-auto mb-2" >
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">

            <div id="itemsCarouselFirst" class="carousel-item active">
                <!-- /**aqui va la imagen con su texto */ -->
            </div>

            <div id="itemsCarouselSecond" class="carousel-item">
                <!-- /**aqui va la imagen con su texto */ -->
            </div>

            <div id="itemsCarouselThird" class="carousel-item">
                <!-- /**aqui va la imagen con su texto */ -->
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
<!-- /*** Parte de las publicaciones*/ -->
<div class="row mx-auto" style="90%">
    <div class="col-3">
        <div id="prev-posts" class="list-group">
            <!-- Publicaciones anteriores -->
        </div>
    </div>
    <div class="col-7">
        <div id="content" class="content">
            <!-- Última publicación/publicacion seleccionada -->
        </div>
    </div>
    <div class="col">
        <div id="dates" class="list-group">
            <!-- Fechas de publicaciones -->
        </div>
    </div>
</div>
<?php scripts();?>

<script type="text/javascript">
    $(function(){
        app.user.sv = <?=$ua->sv?'true':'false'?>;
        app.user.id = "<?=$ua->id?>";
        app.user.tipo = "<?=$ua->tipo?>";
        app.previousPosts();
        app.lastPost(1);
    });
</script>

<?php
    foot();