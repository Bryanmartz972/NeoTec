<?php
namespace Controllers\Mnt;

use Controllers\PublicController;

class CrudProducto extends PublicController
{
    private function nope()
    {
        \Utilities\Site::redirectToWithMsg(
            "index.php?page=mnt_crudproductos",
            "Ocurrió algo inesperado. Intente Nuevamente."
        );
    }
    private function yeah()
    {
        \Utilities\Site::redirectToWithMsg(
            "index.php?page=mnt_crudproductos",
            "Operación ejecutada Satisfactoriamente!"
        );
    }
    public function run() :void
    {
        $viewData = array(
            "mode_dsc"=>"",
            "mode" => "",
            "codigo_producto" => "",
            
            "nombre_producto" => "",
            "descripcion_producto" => "",
            "precio" => "",
            "cantidad_stock" => "",
            "codigo_categoria" => "",
           
            "hasErrors" => false,
            "aErrors" => array(),
            "showaction"=>true,
            "readonly" => false
        );
        $modeDscArr = array(
            "INS" => "Nuevo Producto",
            "UPD" => "Editando Producto (%s) %s",
            "DEL" => "Eliminando Producto (%s) %s",
            "DSP" => "Detalle de Producto (%s) %s"
        );

        if ($this->isPostBack()) {
            // se ejecuta al dar click sobre guardar
            $viewData["mode"] = $_POST["mode"];
            $viewData["codigo_producto"] = $_POST["codigo_producto"] ;
            
            $viewData["descripcion_producto"] = $_POST["descripcion_producto"];
            $viewData["precio"] = $_POST["precio"];
            $viewData["cantidad_stock"] = $_POST["cantidad_stock"];
            $viewData["codigo_categoria"] = $_POST["codigo_categoria"];
            // Validaciones de Errores
            switch($viewData["mode"]) {
            case "INS":
                if ( \Dao\Mnt\CrudProductos::crearCrudProductos(
                        
                      
                        $viewData["nombre_producto"],
                        $viewData["descripcion_producto"],
                        $viewData["precio"],
                        $viewData["cantidad_stock"],
                        $viewData["codigo_categoria"],
                     
                    )
                ) {
                    $this->yeah();
                }
                break;
            case "UPD":
                if (\Dao\Mnt\CrudProductos::editarCrudProductos(
                    $viewData["codigo_producto"],
                  
                    $viewData["nombre_producto"],
                    $viewData["descripcion_producto"],
                    $viewData["precio"],
                    $viewData["cantidad_stock"],
                    $viewData["codigo_categoria"],
                   
                )) {
                    $this->yeah();
                }
                break;
            case "DEL":
                if (\Dao\Mnt\CrudProductos::eliminarCrudProductos(
                    $viewData["codigo_producto"]
                )) {
                    $this->yeah();
                }
                break;
            }
        } else {
            // se ejecuta si se refresca o viene la peticion
            // desde la lista
            if (isset($_GET["mode"])) {
                if (!isset($modeDscArr[$_GET["mode"]])) {
                    $this->nope();
                }
                $viewData["mode"] = $_GET["mode"];
            } else {
                $this->nope();
            }
            if (isset($_GET["codigo_producto"])) {
                $viewData["codigo_producto"] = $_GET["codigo_producto"];
            } else {
                if ($viewData["mode"] !=="INS") {
                    $this->nope();
                }
            }
        }

        // Hacer elementos en comun
       
        if ($viewData["mode"] == "INS") {
            $viewData["mode_dsc"] = $modeDscArr["INS"];
        } else {
            $tmpCrudProducto = \Dao\Mnt\CrudProductos::obtenerCrudProducto($viewData["codigo_producto"]);
            
            $viewData["nombre_producto"] = $tmpCrudProducto["nombre_producto"];
            $viewData["descripcion_producto"] = $tmpCrudProducto["descripcion_producto"];
            $viewData["precio"] = $tmpCrudProducto["precio"];
            $viewData["cantidad_stock"] = $tmpCrudProducto["cantidad_stock"];
            $viewData["codigo_categoria"] = $tmpCrudProducto["codigo_categoria"];

            $viewData["mode_dsc"]  = sprintf(
                $modeDscArr[$viewData["mode"]],
                $viewData["codigo_producto"],
               
                $viewData["nombre_producto"],
                $viewData["descripcion_producto"],
                $viewData["precio"],
                $viewData["cantidad_stock"],
                $viewData["codigo_categoria"]
            );
            if ($viewData["mode"] == "DSP") {
                $viewData["showaction"]= false ;
                $viewData["readonly"] = "readonly";
            }
            if ($viewData["mode"] == "DEL") {
                $viewData["readonly"] = "readonly";
            }

        }


        \Views\Renderer::render("mnt/CrudProducto", $viewData);
    }
}
?>