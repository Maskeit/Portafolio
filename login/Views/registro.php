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
            <form action="../Controllers/registroController.php" id="login-form" method="post">
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
                    <input type="text" 
                            id="username"
                            class="form-control"
                            name="usuario"
                            placeholder="usuario" required>
                </div>
                <div class="form-group">
                    <label for="username">Edad</label>
                    <input type="text" 
                            id="edad"
                            class="form-control"
                            name="edad"
                            placeholder="edad" required>
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
                    <button class="btn btn-primary" type="submit"><i class="bi bi-person-circle" name="btn-submit"></i>
                        Registrarse
                    </button>
                    <div class="pequenoTexto"><a href="login.php">¿ya tienes una cuenta? Inicia sesion aqui.</a></div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
scripts();
?>