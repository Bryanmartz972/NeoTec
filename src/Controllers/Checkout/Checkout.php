<?php

namespace Controllers\Checkout;

use Controllers\PublicController;

class Checkout extends PublicController{
    public function run():void
    {
        $nombre_producto="";
               $descripcion_producto="";
               $codigo_producto="";
               $precio=0;
               $cantidad=0;
               $nombre_categoria="";
        $viewData = array();
        $tmp=\Dao\carrito::CarritoPaypal(); 
       
       if (isset($_POST["btnPagar"])) {
            $PayPalOrder = new \Utilities\Paypal\PayPalOrder(
                "test".(time() - 10000000),
                "http://localhost/nw/Neotec/index.php?page=checkout_error",
                "http://localhost/nw/Neotec/index.php?page=checkout_accept"
            );
            
           foreach($tmp as $item){
               $nombre_producto=$item["nombre_producto"];
               $descripcion_producto=$item["descripcion_producto"];
               $codigo_producto=$item["codigo_producto"];
               $precio=$item["precio"];
               $cantidad=$item["cantidad"];
               $nombre_categoria=$item["nombre_categoria"];
               $tax=15;
               $PayPalOrder->addItem($nombre_producto, $descripcion_producto, $codigo_producto, $precio, 15, $cantidad, "DIGITAL_GOODS");
         
           }



    
            $response = $PayPalOrder->createOrder();
            $_SESSION["orderid"] = $response[1]->result->id;
            \Utilities\Site::redirectTo($response[0]->href);
            die();
        }
        

        \Views\Renderer::render("paypal/checkout", $viewData);
    }
   
}
?>
