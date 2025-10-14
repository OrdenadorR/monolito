<main class="content">
    <div class="login-box">
        <h2>Iniciar sesión</h2>

        <form method="post" action="/login">
            <!--Como el formulario tiene method="post" y action="/login",
            el navegador envía petición POST a la ruta /login del servidor de la página.-->
            <div class="form-group">
                <label for="username">Usuario</label>
                <input type="text" id="username" name="username" required value = "Tu nombre">
            </div>

            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" required value = "Tu contraseña">
            </div>

            <button type="submit">Entrar</button>
        </form>

    </div>
</main>