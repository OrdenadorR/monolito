<main class="content">
    <div class="login-box">
        <h2>Iniciar sesión</h2>

        <form method="post" action="/login">
            <!-- El formulario envía una petición POST a /login -->
            <div class="form-group">
                <label for="username">Usuario::</label>
                <input type="text" id="username" name="username" required placeholder="Tu nombre">
            </div>

            <div class="form-group">
                <label for="password">Contraseña::</label>
                <input type="password" id="password" name="password" required placeholder="Tu contraseña">
            </div>

            <button type="submit">Entrar</button>
        </form>
    </div>
</main>