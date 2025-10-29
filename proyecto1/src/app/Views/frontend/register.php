<main class="content">
    <div class="register-box">
        <h2>Formulario de registro:</h2>

        <form method="post" action="/register">
            <!--Como el formulario tiene method="post" y action="/register",
            el navegador envía petición POST a la ruta /login del servidor de la página.-->
            <div class="form-group">
                <label for="username">Usuario</label>
                <input type="text" id="username" name="username">
            </div>

            <div class="form-group">
                <label for="username">e-mail</label>
                <input type="text" id="email" name="email">
            </div>

            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password">
            </div>

            <div class="form-group">
                <label for="password">Repite la contraseña</label>
                <input type="password" id="repeat-password" name="repeat-password">
            </div>

            <button type="submit">Registrarse</button>
        </form>

    </div>
</main>