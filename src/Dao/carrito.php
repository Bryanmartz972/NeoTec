<?php
    namespace Dao;
    class carrito extends Table{
        public static function AddCart(){
            $query="INSERT INTO `carrito`
            (
            `codigo_usuario`,
            `fechaCreado`,
            `fechaExpira`,
            `estado`)
            VALUES
            (
            :codigo_usuario,
            now() ,
            :fechaExpira, 'ACT');";
            $parameters=array(
                "codigo_usuario"=> \Utilities\Security::getUserId(),
                "fechaExpira"=> date('Y-m-d', time()+7776000)
            );

            return self::executeNonQuery($query, $parameters);
        }
        
        public static function AddCartDetail($codigo_producto, $cantidad, $precio){
      
            $query="INSERT INTO `carrito_detalle`
            (
            `codigo_carrito`,
            `codigo_producto_c`,
            `cantidad`,
            `precio`)
            VALUES
            (
            (select max(codigo_carrito) from carrito),
            :codigo_producto_c,
            :cantidad,
            :precio);";
            $parameters=array(
                "codigo_producto_c"=>$codigo_producto,
                "cantidad"=>$cantidad,
                "precio"=>$precio
            );
            return self::executeNonQuery($query, $parameters);
        }

        public static function UpdateCartDetail($cantidad, $precio, $codigo_carrito, $codigo_producto){
                $query="UPDATE `carrito_detalle`
                SET
                `cantidad` = :cantidad,
                `precio` = :precio
                WHERE `codigo_cartito` = :codigo_carrito and `codigo_producto`= :codigo_producto;";
                $parameters=array(
                    "cantidad"=>$cantidad,
                    "precio"=>$precio,
                    "codigo_carrito"=>$codigo_carrito,
                    "codigo_producto"=>$codigo_producto
                );
                return self::executeNonQuery($query, $parameters);
        }

        public static function Deleteproducto($codigo_producto){
            $query="DELETE from carrito_detalle where codigo_producto_c=:codigo_producto_c and codigo_carrito=(SELECT MAX(codigo_carrito) from carrito);";
            $parameters=array(
                "codigo_producto_c"=>$codigo_producto
            );

            return self::executeNonQuery($query, $parameters);
        }

        public static function getAllShopChart(){
            $query="SELECT A.codigo_carrito, A.codigo_usuario,  B.codigo_producto_c, B.cantidad, B.precio, C.nombre_producto, C.descripcion_producto, C.codigo_categoria, C.uri_img, C.cantidad_stock , truncate((B.cantidad*B.precio),2) as subtotal FROM carrito as A
            join carrito_detalle as B on B.codigo_carrito=A.codigo_carrito
            join productos as C on B.codigo_producto_c= C.codigo_producto
            where A.estado='ACT';";
                    return self::obtenerRegistros($query, array());
        }

        public static function getCarritoId(){
            $query="SELECT max(codigo_carrito) as codigo_carrito from carrito where estado='ACT';";
            return self::obtenerUnRegistro($query, array());
        }

        public static function StockProduct($codigo_producto){
            $query="SELECT cantidad_stock from productos where codigo_producto=:codigo_producto;";
            $parameters=array(
                "codigo_producto"=>$codigo_producto
            );
            return self::obtenerUnRegistro($query, $parameters);
        }
        public static function CarritoItems(){
            $query="SELECT count(B.codigo_producto_c) as count FROM carrito as A
            join carrito_detalle as B on A.codigo_carrito=B.codigo_carrito
            where A.estado='ACT';";
            return self::obtenerUnRegistro($query, array());
        }

        public static function CheckStock($cantidad, $codigo_producto){
            $query="SELECT  if( :cantidad >cantidad_stock , 'false' , 'true' )  FROM productos where codigo_producto=:codigo_producto;";
            $parameters=array(
                "cantidad"=>$cantidad,
                "codigo_producto"=>$codigo_producto
            );
            return self::obtenerUnRegistro($query, $parameters);
        }

        public static function StockProductoReduce($codigo_producto, $cantidad){
            $query="UPDATE productos set cantidad_stock= cantidad_stock - :cantidad_stock where codigo_producto=:codigo_producto; ";
            $parameters=array(
                "cantidad_stock"=>$cantidad,
                "codigo_producto"=>$codigo_producto
            ); 
            return self::executeNonQuery($query, $parameters);
        }
        public static function carrito_update($codigo_carrito){
            $query="UPDATE carrito SET estado = 'INA' WHERE (`codigo_carrito` = :codigo_carrito);";
            
            return self::executeNonQuery($query ,array("codigo_carrito"=>$codigo_carrito));
        }

        public static function CarritoPaypal(){
            $query="SELECT C.nombre_producto, C.descripcion_producto,C.codigo_producto, C.precio,B.cantidad, D.nombre_categoria FROM carrito as A
            join carrito_detalle as B on A.codigo_carrito=B.codigo_carrito 
            join productos as C on C.codigo_producto= B.codigo_producto_c
            join categorias as D on D.codigo_categoria= C.codigo_categoria
            where A.codigo_carrito=(select max(codigo_carrito) from carrito) and A.estado='ACT';";
            return self::obtenerRegistros($query, array());
        }


    }
?>