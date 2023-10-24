<main class="contenedor seccion">
    <h1>Administrador de Bienes Raices</h1>
    
    <?php 

    if($registro) {
        $mensaje = Notificaciones(intval($registro));
        if($mensaje) { ?>
            <p class="alerta exito"><?php echo s($mensaje); ?> </p>
        <?php }
    }?>

    <div class="mgr">
        <a href="/propiedad/crear" class="boton boton-verde">Nueva propiedad</a>
        <a href="/vendedor/crear" class="boton boton-amarillo">Nuevo Vendedor</a>
    </div>

    <h2>Propiedades</h2>
    
    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Accion</th>
            </tr>
        </thead>
        
        <!-- Resultado de la BD -->
        <tbody>
            <?php  foreach($propiedades as $propiedad): ?>
            <tr>
                <td><?php echo $propiedad->id; ?></td>
                <td><?php echo $propiedad->titulo; ?></td>
                <td><img class="imagen-tabla" src="/imagenes/<?php echo $propiedad->imagen; ?>" alt="imagen-tabla"></td>
                <td><?php echo '$' . number_format($propiedad->precio); ?></td>
                <td>
                    <a class="boton-amarillo-block" href="/propiedad/actualizar?id=<?php echo $propiedad->id; ?>">Actualizar</a>
                    <form method="POST" class="w-100" action="/propiedad/eliminar">
                        <input type="hidden" name="id" value="<?php echo $propiedad->id; ?>">
                        <input type="hidden" name="tipo" value="propiedad">
                        <input type="submit" class="boton-rojo-block" value="Eliminar">   
                    </form>                       
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Vendedores</h2>

    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Telefono</th>
                <th>Accion</th>
            </tr>
        </thead>
        
        <!-- Resultado de la BD -->
        <tbody>
            <?php  foreach($vendedores as $vendedor): ?>
            <tr>
                <td><?php echo $vendedor->id; ?></td>
                <td><?php echo $vendedor->nombre . " " . $vendedor->apellido; ?></td>
                <td><?php echo $vendedor->telefono; ?></td>
                <td>
                    <a class="boton-amarillo-block" href="/vendedor/actualizar?id=<?php echo $vendedor->id; ?>">Actualizar</a>

                    <form method="POST" class="w-100" action="/vendedor/eliminar">
                        <input type="hidden" name="id" value="<?php echo $vendedor->id; ?>">
                        <input type="hidden" name="tipo" value="vendedor">
                        <input type="submit" class="boton-rojo-block" value="Eliminar">   
                    </form>                       
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</main>