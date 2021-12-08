<?php
    namespace Dao;
    class productos extends Table{
        public static function getAllProductos($codigo_categoria){
            $query="SELECT * FROM productos where codigo_categoria=:codigo_categoria;";
            return self::obtenerRegistros($query, array("codigo_categoria"=>$codigo_categoria));
        }
        public static function getProductos(){
            $query="SELECT * FROM productos;";
            return self::obtenerRegistros($query, array());
        }
        public static function getTipo(){
            $query="SELECT * FROM tipo_producto;";
            return self::obtenerRegistros($query, array());
        }

        public static function getProductId($id){
            $query = "SELECT * FROM productos WHERE codigo_producto=:id;";
            $parameters = array("id" => $id);  
            return self::obtenerUnRegistro($query,$parameters);
        }

       public static function AddProduct($nombre_producto, $descripcion_producto, $precio, $cantidad_stock,$codigo_categorias, $uri_img){
            $query="INSERT INTO `productos`
            (`nombre_producto`,
            `descripcion_producto`,
            `precio`,
            `cantidad_stock`,
            `codigo_categoria`,
            `uri_img`)
            VALUES
            (:nombre_producto,
            :descripcion_producto,
            :precio,
            :cantidad_stock,
            :codigo_categoria,
            :uri_img);";

            $parameters=array(
                "nombre_producto"=>$nombre_producto,
                "descripcion_producto"=>$descripcion_producto,
                "precio"=>$precio, 
                "cantidad_stock"=>$cantidad_stock,
                "codigo_categoria"=>$codigo_categorias,
                "uri_img"=>$uri_img
            );

            return self::executeNonQuery($query, $parameters);
       }

       public static function UpdateProduct($nombre_producto, $descripcion_producto, $precio, $cantidad_stock,$codigo_categorias, $uri_img, $codigo_producto){
        $query="UPDATE `productos`
        SET
        `nombre_producto` = :nombre_producto,
        `descripcion_producto` = :descripcion_producto,
        `precio` = :precio,
        `cantidad_stock` = :cantidad_stock,
        `codigo_categoria` = :codigo_categoria,
        `uri_img` = :uri_img
        WHERE `codigo_producto` = :codigo_producto;";
        $parameters=array(
            "nombre_producto"=>$nombre_producto,
            "descripcion_producto"=>$descripcion_producto,
            "precio"=>$precio, 
            "cantidad_stock"=>$cantidad_stock,
            "codigo_categoria"=>$codigo_categorias,
            "uri_img"=>$uri_img,
            "codigo_producto"=>$codigo_producto
        );
        return self::executeNonQuery($query, $parameters);
       }

       public static function DeleteProduct ($id){
           $query="DELETE FROM productos where codigo_producto=:id";
           $parameters=array("id"=>$id);
           self::executeNonQuery($query, $parameters);
       }
    }


?>