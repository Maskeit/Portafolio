<?php
    include("layouts/main.php");

    head();
?>
<div class="container">
    <div class="row align-self-center">
        <div class="col">
            <h1 class="mt-5 w-50 mx-auto">Iniciar Sesión</h1>
        </div>
    </div>
    <div class="card mt-5 w-50 mx-auto">
        <div class="card-body">
            <form action="" id="login-form" method="post">
                <div class="form-group">
                    <?php
                         include "../Controllers/LoginController.php"; 
                    ?>
                    <label for="username">Usuario</label>
                    <input type="text" 
                            id="username"
                            class="form-control"
                            name="username"
                            placeholder="usuario" required>
                </div>
                <div class="form-group">
                    <label for="passwd">Contraseña</label>
                    <input type="password"
                             name="passwd"
                             id="passwd"
                             class="form-control"
                             required>
                </div>
                <small class="form-text text-danger d-none mb-2" id="error">
                    Datos de inicio de sesión incorrectos.
                </small>
                <div class="d-grid gap-2 my-2">
                    <button class="btn btn-primary" type="submit"><i class="bi bi-person-circle" name="btn-submit"></i>
                        Iniciar sessión 
                    </button>
                    <div class="pequeñoTexto"><a href="registro.php">¿No tienes una cuenta? Registrate aquí.</a></div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php 
    scripts();
?>
<script type="text/javascript">
    $(function(){
        const lf = $("login-form");
        lf.on("submit", function(e){
            e.preventDefault();
            e.stopPropagation();

            const data = new FormData();
            data.append("username",$("#username").val());
            data.append("passwd",$("#passwd").val());
            data.append("_login","");
            fetch(app.routes.login,{
                method : "POST",
                body : data
            })
                .then ( resp => resp.json())
                .then ( resp => {
                    if(resp.r !== false){
                        location.href = "../home.php";
                        //app.view("home");   
                    }else{
                        $("#error").removeClass("d-none");
                    }
                }).catch( err => console.error( err ));
        })
    })

</script>