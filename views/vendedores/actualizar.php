
<main class="contenedor seccion">

    <h1>Actualizar Vendedor</h1>
    <a href="/admin" class="boton boton-verde">Volver</a>

    <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error?>
        </div>  
    <?php endforeach; ?>

    <!-- enctype="multipart/form-data" *Para Imagenes* -->
    <form class="formulario" method="POST" enctype="multipart/form-data">
        
    <?php include __DIR__ . '/formulario_vendedores.php' ?>

    <div class="mgr">
        <input type="submit" value="Actualizar Vendedor" class="boton boton-verde">
    </div>

    </form>
    
</main>