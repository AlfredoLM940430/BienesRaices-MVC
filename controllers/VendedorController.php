<?php 

namespace Controllers;
use MVC\Router;
use Model\Vendedor;

class VendedorController{

    public static function crear(Router $router) {

        $vendedor = new Vendedor();
        // Detectar errores
        $errores = Vendedor::getErrores();

        //Ejecucion del codigo al enviar el formulario
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            //Crear instancia
            $vendedor = new Vendedor($_POST['vendedor']);

            //Validar campos vacios
            $errores = $vendedor->validar();

            //Guardar si no existen errores
            if(empty($errores)){
                $vendedor->guardar();
            }
        }

        $router->render('vendedores/crear', [
            'vendedor' => $vendedor,
            'errores' => $errores
        ]);
    }

    public static function actualizar(Router $router) {
        
        $id = validarORedireccionar('/admin');

        //Obtener vendedor
        $vendedor = Vendedor::find($id);

        // Detectar errores
        $errores = Vendedor::getErrores();

        //Ejecucion del codigo al enviar el formulario
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            
            //Asignar valores
            $args = $_POST['vendedor'];

            //Sincronizar objetos en memoria con loq ue el usuario escribio
            $vendedor->sincronizar($args);

            //validacion
            $errores = $vendedor->validar();

            if(empty($errores)){
                $vendedor->guardar();
            }
        }

        $router->render('vendedores/actualizar', [
            'vendedor' => $vendedor,
            'errores' => $errores
        ]);

    }

    public static function eliminar() {
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            //Validar ID
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if($id) {
                //Valida tipo *propiedad/vendedor*
                $tipo = $_POST['tipo'];

                if(validarContenido($tipo)){
                    $vendedor = Vendedor::find($id);
                    $vendedor->eliminar();
                }
            }
        }
    }
}