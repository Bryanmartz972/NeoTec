<?php
namespace Utilities; 
class Carrito {
        public static function carrito(){
            $tmp=\Dao\carrito::CarritoItems();
            $data=array();
            foreach($tmp as $i){
                $data["count"]=$i;
            }
            Context::setContext("CARKEY",$data["count"]);
        }
}

?>