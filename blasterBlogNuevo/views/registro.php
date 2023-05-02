<?php
    include("layouts/main.php");

    head();
?>
<div class="container">
    <div class="row align-self-center">
        <div class="col">
            <h1 class="mt-5 w-50 mx-auto">Registro</h1>
        </div>
    </div>
    <div class="card mt-5 w-50 mx-auto">
        <div class="card-body">
            <form action="" id="registro-form">
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" 
                            id="name"
                            class="form-control"
                            name="name"
                            placeholder="nombre" required>
                </div>
                <div class="form-group">
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
                <div class="form-group">
                    <label for="passwd">Repita Contraseña</label>
                    <input type="password"
                             name="passwd2"
                             id="passwd2"
                             class="form-control"
                             required>
                </div>
                <small class="form-text text-danger d-none mb-2" id="error">
                    Datos de inicio de sesión incorrectos.
                </small>
                <div class="d-grid gap-2 my-2">
                    <button class="btn btn-primary" type="submit"><i class="bi bi-person-circle"></i>
                        Iniciar sessión 
                    </button>
                    <div class="pequeñoTexto"><a href="login.php">¿Ya tiene una cuenta? Ingrse aqui.</a></div>
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
        const lf = $("registro-form");
        lf.on("submit", function(e){
            e.preventDefault();
            e.stopPropagation();

            const data = new FormData();
            data.append("username",$("#username").val());
            data.append("passwd",$("#passwd").val());
            data.append("_registro","");
            fetch(app.routes.registro,{
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