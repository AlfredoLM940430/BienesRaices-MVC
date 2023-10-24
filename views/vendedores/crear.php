
<main class="contenedor seccion">

    <h1>Registrar Vendedor</h1>
    <a href="/admin" class="boton boton-verde">Volver</a>

    <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error?>
        </div>  
    <?php endforeach; ?>

    <!-- enctype="multipart/form-data" *Para Imagenes* -->
    <form class="formulario" method="POST" action="/vendedor/crear" enctype="multipart/form-data">
        
    <?php include __DIR__ . '/formulario_vendedores.php' ?>

    <div class="mgr">
        <input type="submit" value="Registrar vendedor" class="boton boton-verde">
    </div>

    </form>
    
</main>