
<main class="contenedor seccion contenido-centrado">
    <h1>Iniciar sesión</h1>

    <?php foreach($errores as $error) : ?>

        <div class="alerta error">
            <?php echo $error ?>
        </div>

    <?php endforeach; ?>

    <form method="POST" class="formulario" action="/login">
        <fieldset>
                <legend>Email & Contraseña</legend>

                <label for="email">E-mail</label>
                <input type="email" name="email" placeholder="Correo E-Mail" id="email" required>

                <label for="password">Contraseña</label>
                <input type="password" name="password" placeholder="Tu Contraseña" id="password" required>

        </fieldset>

        <div class="mgr">
            <input type="submit" value="Iniciar sesión" class="boton boton-verde">
        </div>
        
    </form>
</main>