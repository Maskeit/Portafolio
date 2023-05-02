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
            <form action="../Controllers/LoginController.php" id="login-form" method="post">
                <div class="form-group">
                    <label for="username">Usuario</label>
                    <input type="text" 
                            id="username"
                            class="form-control"
                            name="usuario"
                            placeholder="usuario/correo" required>
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
                    
                </small>
                <div class="d-grid gap-2 my-2">
                    <button class="btn btn-primary" type="submit"><i class="bi bi-person-circle" name="btn-submit"></i>
                        Iniciar sessión 
                    </button>
                    <div class="pequenoTexto"><a href="registro.php">¿No tienes una cuenta? Registrate aquí.</a></div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
scripts();
?>