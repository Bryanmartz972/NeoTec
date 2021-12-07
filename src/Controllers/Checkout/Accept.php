<?php

namespace Controllers\Checkout;

use Controllers\PublicController;

class Accept extends PublicController{
    public function run():void
    {
        $dataview = array();
        $token = $_GET["token"] ? $_GET["token"]: "";
        $session_token = $_SESSION["orderid"] ?: "";
        if ($token !== "" && $token == $session_token) {
            $result = \Utilities\Paypal\PayPalCapture::captureOrder($session_token);
            $dataview["orderjson"] = json_encode($result, JSON_PRETTY_PRINT);
            $usuario=\Utilities\Security::getUserId();
             $ok=\Dao\transacciones::insertTransaction($dataview["orderjson"], $usuario );
             if($ok){
                $codigo=\Dao\carrito::getCarritoId();
                $ok1=\Dao\carrito::carrito_update($codigo["codigo_carrito"]);
                 \Utilities\Site::redirectToWithMsg(
                     "index.php?page=index",
                     "Se Guardo Tu Orden"
                 );
                 

             }

           
            
            
        } else {
            $dataview["orderjson"] = "No Order Available!!!";
        }
        \Views\Renderer::render("paypal/accept", $dataview);
    }
}

?>
