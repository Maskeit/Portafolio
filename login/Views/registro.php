<?php
    include("layouts/main.php");
    head();
?>

<div class="container">
    <div class="row align-self-center">
        <div class="col">
            <h1 class="mt-5 w-50 mx-auto">Registrar cuenta</h1>
        </div>
    </div>
    <div class="card mt-5 w-50 mx-auto">
        <div class="card-body">
            <form action="../Controllers/RegistroController.php" id="login-form" method="post" name="formData">
                <div class="form-group">
                    <label for="email">Correo</label>
                    <input type="text" 
                           id="email" 
                           class="form-control" 
                           name="email" 
                           placeholder="Correo Electronico">
                </div>
                <div class="form-group">
                    <label for="username">Elija un nombre de Usuario</label>
                    <small class="form-text text-danger d-none mb-2" 
                            id="usuarioOcupado">
                    
                    </small>
                    <input type="text" 
                            id="username"
                            class="form-control"
                            name="usuario"
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
                    
                </small>
                <div class="d-grid gap-2 my-2">
                    <button class="btn btn-primary" type="submit"><i class="bi bi-person-circle" name="btn-submit" id="btn"></i>
                        Registrarse
                    </button>
                    <div class="pequenoTexto"><a href="login.php">¿ya tienes una cuenta? Inicia sesion aqui.</a></div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $.ajax({
        type: "POST",
        url: "../Controllers/RegistroController.php",
        data: {
          username: $('#username').val()
        },
        dataType: "json",
        success: function(response) {
          console.log(response);
          if (response.status == "ocupado") {
            var usuarioOcupado = document.getElementById("usuarioOcupado");
            usuarioOcupado.classList.remove('d-none');
            usuarioOcupado.classList.add('d-block');
            usuarioOcupado.textContent = "El nombre de usuario ya está ocupado.";
          }
        },
        // error: function() {
        //   alert("Hubo un error al procesar la solicitud");
        // }
      });
      
</script>
<?php
scripts();
?>