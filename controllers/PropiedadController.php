<?php 

namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

class PropiedadController{

    // Trasportando mismo objeto
    public static function index(Router $router) {

        //Consulta db
        $propiedades = Propiedad::all();

        $vendedores = Vendedor::all();

        //Solicitud condicional
        $registro = $_GET['registro'] ?? null;

        $router->render('propiedades/admin', [

            //key => value **Pasandoselo a la vista
            'propiedades' => $propiedades,
            'vendedores' => $vendedores,
            'registro' => $registro
                       
        ]);
    }

    public static function crear(Router $router) {

        $propiedad = new Propiedad;
        $vendedores = Vendedor::all();

        // Detectar errores
        $errores = Propiedad::getErrores();

        //Ejecucion del codigo al enviar el formulario
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
        
            //Declarar nueva instancia ↑↑ use App\Propiedad;
            $propiedad = new Propiedad($_POST['propiedad']);

            //Nombre unico
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
            
            //Setear imagen
            //Redimencionar imagen con intervention
            if($_FILES['propiedad']['tmp_name']['imagen']){

                $imagen = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
                $propiedad->setImagen($nombreImagen);
            }
            
            //Validar
            $errores = $propiedad ->validar();

            // Revision para insertar
            if(empty($errores)){

                //Carpeta Imagenes
                $carpetaImagenes = '../../imagenes/';
                if(!is_dir(CARPETA_IMAGENES)){
                    mkdir(CARPETA_IMAGENES);
                }

                //Guardar imagen
                $imagen->save(CARPETA_IMAGENES . $nombreImagen);
                
                //Guardar datos
                $propiedad -> guardar();
            }
        }

        $router->render('propiedades/crear', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }

    public static function actualizar(Router $router) {

        $id = validarORedireccionar('/admin');

        $propiedad = Propiedad::find($id);
        $vendedores = Vendedor::all();

        $errores = Propiedad::getErrores();

        //Ejecucion del codigo al enviar el formulario
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            //Asignar atributos *name="propiedad[titulo]"* desde formulario_propiedades.php
            $args =$_POST['propiedad'];

            $propiedad->sincronizar($args);

            //Validacion
            $errores = $propiedad->validar();

            /* **Subida de archivos ** */
            //Nombre unico
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            //Subida de archivos
            if($_FILES['propiedad']['tmp_name']['imagen']){

                $imagen = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
                $propiedad->setImagen($nombreImagen);

            }

            // Revision para insertar
            if(empty($errores)) {
                // Almacenar la imagen
                if($_FILES['propiedad']['tmp_name']['imagen']) {

                    $imagen->save(CARPETA_IMAGENES . $nombreImagen); 
                }

                $propiedad->guardar();
            }
        }

        $router->render('/propiedades/actualizar', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }

    public static function eliminar() {
        
        //Formulario Eliminar, guardar ID seleccionado
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            //Validar ID
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);
            
            if($id){

                $tipo = $_POST['tipo'];
                
                if(validarContenido($tipo)){
                    $propiedad = Propiedad::find($id);
                    $propiedad->eliminar();
                }
            }
        }
    }

}