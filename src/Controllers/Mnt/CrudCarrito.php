<?php
namespace Controllers\Mnt;

use Controllers\PublicController;

class CrudCarrito extends PublicController
{
    private function nope()
    {
        \Utilities\Site::redirectToWithMsg(
            "index.php?page=mnt_crudcarritos",
            "Ocurrió algo inesperado. Intente Nuevamente."
        );
    }
    private function yeah()
    {
        \Utilities\Site::redirectToWithMsg(
            "index.php?page=mnt_crudcarritos",
            "Operación ejecutada Satisfactoriamente!"
        );
    }
    public function run() :void
    {
        $viewData = array(
            "mode_dsc"=>"",
            "mode" => "",
            "codigo_carrito" => "",
            
            "codigo_usuario" => "",
            "fechaCreado" => "",
            "fechaExpira" => "",
            "estado" => "",
                       
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
            $viewData["codigo_carrito"] = $_POST["codigo_carrito"] ;
            
            $viewData["codigo_usuario"] = $_POST["codigo_usuario"];
            $viewData["fechaCreado"] = $_POST["fechaCreado"];
            $viewData["fechaCreado"] = $_POST["fechaCreado"];
            $viewData["fechaExpira"] = $_POST["fechaExpira"];
            $viewData["estado"] = $_POST["estado"];
            // Validaciones de Errores
            switch($viewData["mode"]) {
            case "INS":
                if ( \Dao\Mnt\CrudCarritos::crearCrudCarritos(
                        
                        $viewData["codigo_usuario"],
                        $viewData["fechaCreado"],
                        $viewData["fechaExpira"],
                        $viewData["estado"],
                     
                    )
                ) {
                    $this->yeah();
                }
                break;
            case "UPD":
                if (\Dao\Mnt\CrudCarritos::editarCrudCarritos(
                    $viewData["codigo_carrito"],
                  
                    $viewData["codigo_usuario"],
                    $viewData["fechaCreado"],
                    $viewData["fechaExpira"],
                    $viewData["estado"],
                   
                )) {
                    $this->yeah();
                }
                break;
            case "DEL":
                if (\Dao\Mnt\CrudCarritos::eliminarCrudCarritos(
                    $viewData["codigo_carrito"]
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
            if (isset($_GET["codigo_carrito"])) {
                $viewData["codigo_carrito"] = $_GET["codigo_carrito"];
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
            $tmpCrudCarrito = \Dao\Mnt\CrudCarritos::obtenerCrudCarrito($viewData["codigo_carrito"]);
            
            $viewData["codigo_usuario"] = $tmpCrudCarrito["codigo_usuario"];
            $viewData["fechaCreado"] = $tmpCrudCarrito["fechaCreado"];
            $viewData["fechaExpira"] = $tmpCrudCarrito["fechaExpira"];
            $viewData["estado"] = $tmpCrudCarrito["estado"];

            $viewData["mode_dsc"]  = sprintf(
                $modeDscArr[$viewData["mode"]],
                $viewData["codigo_carrito"],
               
                $viewData["codigo_usuario"],
                $viewData["fechaCreado"],
                $viewData["fechaExpira"],
                $viewData["estado"],
            );
            if ($viewData["mode"] == "DSP") {
                $viewData["showaction"]= false ;
                $viewData["readonly"] = "readonly";
            }
            if ($viewData["mode"] == "DEL") {
                $viewData["readonly"] = "readonly";
            }

        }
        \Views\Renderer::render("mnt/CrudCarrito", $viewData);
    }
}
