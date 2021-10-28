<main class="container-fluid" id="login">
    <div class="container mt-2">
        <h1 class="text-uppercase">Iniciar Sesión</h1>
        <form action="<?= \App\Router::urlTo('iniciar-sesion') ;?>" method="post">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Ingrese su email">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Ingrese su contraseña">
            </div>
            <button type="submit" class="mt-4 text-uppercase btn btn-outline-light w-100">Ingresar</button>
        </form>
    </div>
</main>
