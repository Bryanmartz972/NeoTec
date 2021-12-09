<?php
namespace Controllers\Mnt;

use Controllers\PublicController;

class CrudUsuario extends PublicController
{
    private function nope()
    {
        \Utilities\Site::redirectToWithMsg(
            "index.php?page=mnt_crudusuarios",
            "Ocurrió algo inesperado. Intente Nuevamente."
        );
    }
    private function yeah()
    {
        \Utilities\Site::redirectToWithMsg(
            "index.php?page=mnt_crudusuarios",
            "Operación ejecutada Satisfactoriamente!"
        );
    }
    public function run() :void
    {
        $viewData = array(
            "mode_dsc"=>"",
            "mode" => "",
            "codigo_usuario" => "",
            
            "nombre_usuario" => "",
            "correo_electronico" => "",
            "fecha_creacion" => "",
            "estado" => "",
            "password_estado" => "",
           
            "hasErrors" => false,
            "aErrors" => array(),
            "showaction"=>true,
            "readonly" => false
        );
        $modeDscArr = array(
            "INS" => "Nuevo Usuario",
            "UPD" => "Editando Usuario (%s) %s",
            "DEL" => "Eliminando Usuario (%s) %s",
            "DSP" => "Detalle de Usuario (%s) %s"
        );

        if ($this->isPostBack()) {
            // se ejecuta al dar click sobre guardar
            $viewData["mode"] = $_POST["mode"];
            $viewData["codigo_usuario"] = $_POST["codigo_usuario"] ;
            
            $viewData["correo_electronico"] = $_POST["correo_electronico"];
            $viewData["fecha_creacion"] = $_POST["fecha_creacion"];
            $viewData["estado"] = $_POST["estado"];
            $viewData["password_estado"] = $_POST["password_estado"];
            // Validaciones de Errores
            switch($viewData["mode"]) {
            case "INS":
                if ( \Dao\Mnt\CrudUsuarios::crearCrudUsuarios(
                        
                      
                        $viewData["nombre_usuario"],
                        $viewData["correo_electronico"],
                        $viewData["fecha_creacion"],
                        $viewData["estado"],
                        $viewData["password_estado"],
                     
                    )
                ) {
                    $this->yeah();
                }
                break;
            case "UPD":
                if (\Dao\Mnt\CrudUsuarios::editarCrudUsuarios(
                    $viewData["codigo_usuario"],
                  
                    $viewData["nombre_usuario"],
                    $viewData["correo_electronico"],
                    $viewData["fecha_creacion"],
                    $viewData["estado"],
                    $viewData["password_estado"],
                   
                )) {
                    $this->yeah();
                }
                break;
            case "DEL":
                if (\Dao\Mnt\CrudUsuarios::eliminarCrudUsuarios(
                    $viewData["codigo_usuario"]
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
            if (isset($_GET["codigo_usuario"])) {
                $viewData["codigo_usuario"] = $_GET["codigo_usuario"];
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
            $tmpCrudUsuario = \Dao\Mnt\CrudUsuarios::obtenerCrudUsuario($viewData["codigo_usuario"]);
            
            $viewData["nombre_usuario"] = $tmpCrudUsuario["nombre_usuario"];
            $viewData["correo_electronico"] = $tmpCrudUsuario["correo_electronico"];
            $viewData["fecha_creacion"] = $tmpCrudUsuario["fecha_creacion"];
            $viewData["estado"] = $tmpCrudUsuario["estado"];
            $viewData["password_estado"] = $tmpCrudUsuario["password_estado"];

            $viewData["mode_dsc"]  = sprintf(
                $modeDscArr[$viewData["mode"]],
                $viewData["codigo_usuario"],
               
                $viewData["nombre_usuario"],
                $viewData["correo_electronico"],
                $viewData["fecha_creacion"],
                $viewData["estado"],
                $viewData["password_estado"]
            );
            if ($viewData["mode"] == "DSP") {
                $viewData["showaction"]= false ;
                $viewData["readonly"] = "readonly";
            }
            if ($viewData["mode"] == "DEL") {
                $viewData["readonly"] = "readonly";
            }

        }


        \Views\Renderer::render("mnt/CrudUsuario", $viewData);
    }
}
?>