<?php
    namespace Controllers\Sec;

use Controllers\PrivateController;

class permisos extends PrivateController{
    public function run():void{
        $data=array();
        $data["funciones"]=array();
        $tmp=\Dao\Security\Security::getAllFeature();
        foreach($tmp as $item){
            $data["funciones"][]=$item;
        }

        $time=time();
        $token=md5("permisos".$time);
        $_SESSION["permisos_xss_token"]=$token; 
        $_SESSION["permisos_xss_token_tts"]=$time;

        $tmp=\Dao\Security\Security::getAllFuncionesRoles();
        $data["funciones_roles"]=array();
        foreach($tmp as $i){
            $data["funciones_roles"][]=$i;
        }


        \Views\Renderer::render("security/permisos",$data);

    }
}
?>