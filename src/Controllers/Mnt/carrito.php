<?php
    namespace Controllers\Mnt;

use Controllers\PublicController;

use Views\Renderer;

class carrito extends PublicController{
    public function run():void{
            $data=array();
            $data["cart"]=array();
            $suma=0;
            $tmp=\Dao\carrito::getAllShopChart();

            foreach($tmp as $item){
                $data["cart"][]=$item;
                $suma+=$item["subtotal"];
                
            
            }
            $data["suma"]=$suma;
            $data["isv"]=number_format($suma*0.15,2);
            $data["total"]=number_format(floatval($data["suma"])+floatval($data["isv"]),2);
           
           
            $time=time();
            $token="carrito".$time;
            $_SESSION["carrito_xss_token"]=$token;
            $_SESSION["carrito_xss_token_tts"]=$time;  
            if(isset($_POST["BtnDelete"])){
                echo '<script>alert("Eliminado Exitosamente Del Carrito")</script>';
                $ok=\Dao\carrito::Deleteproducto(
                    $data["codigo_producto"]=$_POST["codigo_producto_c"]
                );
            }

            $data["PAYPAL_CLIENT_ID"]= \Utilities\Context::getContextByKey("PAYPAL_CLIENT_ID");


        \Views\Renderer::render("mnt\carrito", $data);
        
    }
   

}
?>