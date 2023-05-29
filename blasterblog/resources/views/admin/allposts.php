<?php 
    namespace views;
    require '../../../app/autoloader.php';
    include "../layouts/main.php";
    use Controllers\auth\LoginController as LoginController;
    $ua = new LoginController;
    is_null($ua->sessionValidate()) ? header('Location: /portafolio/blasterblog/resources/views/auth/login.php') : '';
    head($ua);
?>

<section class="container pt-5"> 
    <h1 class="border-bottom rounded p-2 text-white bg-opacity-10" style="background-color: rgba(0, 0, 0, 0.6)">Mis publicaciones</h1> 
    <div class="card shadow">
        <div class="card-body">
           <table class="table table-striped">
            <thead>
                <th>Título</th>
                <th>Fecha</th>
                <th><i class="bi bi-gear"></i></th>
            </thead>
            <tbody id="all-posts">

            </tbody>
           </table>
        </div>        
        <div class="card-footer">
           
        </div>
    </div>

    <span class="d-inline-block mt-2" data-toggle="popover" data-content="Disabled popover">
      <button class="btn btn-primary" style="pointer-events: none;" type="button" disabled>Disabled button</button>
    </span>
   
</section>

<?php
    scripts("app_myposts");
?>
<script>
    $(function(){
        app_myposts.getAllPosts(<?=$ua->id?>);
    });
</script>
<?php
    foot();