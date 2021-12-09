<?php

namespace Dao\Mnt;

use Dao\Table;

class CrudProductos extends Table
{
    public static function obtenerCrudProductos()
    {
        $sqlStr = "SELECT * from productos;";
        return self::obtenerRegistros($sqlStr, array());
    }

    public static function obtenerCrudProducto($codigo_producto)
    {
        $sqlStr = "SELECT * from productos where codigo_producto = :codigo_producto;";
        return self::obtenerUnRegistro($sqlStr, array("codigo_producto" => intval($codigo_producto)));
    }

    public static function crearCrudProductos($nombre_producto, $descripcion_producto, $precio, $cantidad_stock, $codigo_categoria)
    {
        $sqlstr = "INSERT INTO productos (nombre_producto, descripcion_producto, precio, cantidad_stock, codigo_categoria) 
        values (:nombre_producto, :descripcion_producto, :precio, :cantidad_stock, :codigo_categoria);";
        $parametros = array(
            "nombre_producto" => $nombre_producto,
            "descripcion_producto" => $descripcion_producto,
            "precio" => $precio,
            "cantidad_stock" => $cantidad_stock,
            "codigo_categoria" => $codigo_categoria,
        );
        return self::executeNonQuery($sqlstr, $parametros);
    }

    public static function editarCrudProductos($codigo_producto, $nombre_producto, $descripcion_producto, $precio, $cantidad_stock, $codigo_categoria)
    {
        $sqlstr = "UPDATE productos set  nombre_producto=:nombre_producto, descripcion_producto=:descripcion_producto, precio=:precio, cantidad_stock=:cantidad_stock, codigo_categoria=:codigo_categoria  where codigo_producto = :codigo_producto;";
        $parametros = array(
            "nombre_producto" => $nombre_producto,
            "descripcion_producto" => $descripcion_producto,
            "precio" => $precio,
            "cantidad_stock" => $cantidad_stock,
            "codigo_categoria" => $codigo_categoria,

            "codigo_producto" => intval($codigo_producto)
        );
        return self::executeNonQuery($sqlstr, $parametros);
    }

    public static function eliminarCrudProductos($codigo_producto)
    {
        $sqlstr = "DELETE FROM productos where codigo_producto=:codigo_producto;";
        $parametros = array(
            "codigo_producto" => intval($codigo_producto)
        );
        return self::executeNonQuery($sqlstr, $parametros);
    }
}
