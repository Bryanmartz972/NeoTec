<?php
namespace Controllers\Sec; 

class funcionesroles extends \Controllers\PrivateController{
    public function run():void{
        $data = array();
        $ModalTitles = array(
            "INS" => "Nueva Categoria Panel",
            "UPD" => "Actualizando %s - %s",
            "DSP" => "Detalle de %s - %s",
            "DEL" => "Eliminando %s - %s"
        );
        $data["ModalTitle"] = "";
            $data["codigorol"] = "";
            $data["nombre_funcion"] = "";
            $data["funcion_rol_estado"] = "";
            $data["funcion_rol_estado_act"] = true;
            $data["funcion_rol_estado_ina"] = false;
            $data["fecha_exp"] = "";
            $data["readonly"] = "";
            $data["showCommitBtn"] = true;

            if($this->isPostBack()){
                $data["mode"]=$_POST["mode"];
                $data["codigorol"]=$_POST["codigorol"];
                $data["codigo_funcion"]=$_POST["codigo_funcion"];
                $data["token"] = $_POST["token"];
                $this->verificarToken();
                if($data["token"]!=$_SESSION["permisos_xss_token"]){
                    $time = time();
                    $token = md5("permisos".$time);
                    $_SESSION["permisos_xss_token"] = $token;
                    $_SESSION["permisos_xss_token_tts"] = $time;
                    \Utilities\Site::redirectToWithMsg(
                        "index.php?page=sec_permisos",
                        "Algo sucedió mal intente de nuevo :("
                    );
                }
                if($data["mode"]!='DEL'){
                    $data["codigorol"] = $_POST["codigo_rol"];
                    $data["codigo_funcion"] = $_POST["nombre_funcion"];
                    $data["funcion_rol_estado"] = $_POST["funcion_rol_estado"];
                    $data["fecha_exp"] = $_POST["fecha_exp"].time();
                }

                switch($data["mode"]){
                    case 'INS':
                            $ok=\Dao\Security\Security::insertFuncionesRoles(
                                $data["codigorol"],
                                $data["codigo_funcion"],
                                $data["funcion_rol_estado"],
                                $data["fecha_exp"]
                            );
                            if($ok){
                                \Utilities\Site::redirectToWithMsg(
                                    "index.php?page=sec_permisos",
                                    "Función Rol agregado Exitosamente"
                                );
                            }
                                break; 
                    case 'UPD':
                                $ok=\Dao\Security\Security::UpdateFuncionesRoles(
                                    $data["codigorol"],
                                    $data["codigo_funcion"],
                                    $data["funcion_rol_estado"],
                                    $data["fecha_exp"]
                                );
                                if($ok){
                                    \Utilities\Site::redirectToWithMsg(
                                        "index.php?page=sec_permisos",
                                        "Función Rol modificado Exitosamente"
                                    );
                                }
                                break;
                }
            }else{
                $data["mode"]=$_GET["mode"];
                $data["codigorol"]=isset($_GET["id"])?$_GET["id"]:0;
                $data["codigo_funcion"]=isset($_GET["id2"])?$_GET["id2"]:0;
            }

            if($data["mode"]=='INS'){
                
                $data["ModalTitle"]="Agregando nuevo permiso";
                $data["roles"]=\Dao\Security\Security::getRoles();
                $data["funciones"]=\Dao\Security\Security::getAllFeature();
            }else{
                $data["roles"]=\Dao\Security\Security::getRoles();
                $data["funciones"]=\Dao\Security\Security::getAllFeature();
                $permisoItem=\Dao\Security\Security::GetByIdPermisos($data["codigorol"], $data["codigo_funcion"]);
                if(!$permisoItem){
                    \Utilities\Site::redirectToWithMsg(
                        "index.php?page=sec_permisos",
                        "No existe el registro"
                      );  
                }
                \Utilities\ArrUtils::mergeFullArrayTo($permisoItem, $data);
                $data["funcion_rol_estado_act"]=$data["funcion_rol_estado"]=="ACT";
                $data["funcion_rol_estado_ina"]=$data["funcion_rol_estado"]=="INA";
                if($data["mode"]=='DEL' || $data["mode"]=='DSP'){
                    $data["readonly"]="readonly";
                    $data["showCommitBtn"]= $data["mode"]=="DEL";
                }
            }
            \Views\Renderer::render("security\permiso",$data);
    }
    private function verificarToken(){
        if(!isset($_SESSION["permisos_xss_token"])){
          \Utilities\Site::redirectToWithMsg(
            "index.php?page=sec_permisos",
            "Algo sucedio mal intente de nuevo"
          );
        }else{
            $time=time();
            if($time-$_SESSION["permisos_xss_token_tts"]>86400){
              \Utilities\Site::redirectToWithMsg(
                "index.php?page=sec_permisos",
                "Algo Sucedio mal intente de nuevo"
              );
            }
  
        }
      }

}

?>