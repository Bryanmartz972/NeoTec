<?php

namespace Dao\Mnt;

use Dao\Table;

class CrudCarritos extends Table
{
    public static function obtenerCrudCarritos()
    {
        $sqlStr = "SELECT * from carrito;";
        return self::obtenerRegistros($sqlStr, array());
    }

    public static function obtenerCrudCarrito($codigo_carrito)
    {
        $sqlStr = "SELECT * from carrito where codigo_carrito = :codigo_carrito;";
        return self::obtenerUnRegistro($sqlStr, array("codigo_carrito" => intval($codigo_carrito)));
    }

    public static function crearCrudCarritos($codigo_usuario, $fechaCreado, $fechaExpira, $estado)
    {
        $sqlstr = "INSERT INTO carrito (codigo_usuario, fechaCreado, fechaExpira, estado, ) 
        values (:codigo_usuario, :fechaCreado, :fechaExpira, :estado, :);";
        $parametros = array(
            "codigo_usuario" => $codigo_usuario,
            "fechaCreado" => $fechaCreado,
            "fechaExpira" => $fechaExpira,
            "estado" => $estado,
        );
        return self::executeNonQuery($sqlstr, $parametros);
    }

    public static function editarCrudCarritos($codigo_carrito, $codigo_usuario, $fechaCreado, $fechaExpira, $estado)
    {
        $sqlstr = "UPDATE carrito set  codigo_usuario=:codigo_usuario, fechaCreado=:fechaCreado, fechaExpira=:fechaExpira, estado=:estado =:  where codigo_carrito = :codigo_carrito;";
        $parametros = array(
            "codigo_usuario" => $codigo_usuario,
            "fechaCreado" => $fechaCreado,
            "fechaExpira" => $fechaExpira,
            "estado" => $estado,

            "codigo_carrito" => intval($codigo_carrito)
        );
        return self::executeNonQuery($sqlstr, $parametros);
    }

    public static function eliminarCrudCarritos($codigo_carrito)
    {
        $sqlstr = "DELETE FROM carrito where codigo_carrito=:codigo_carrito;";
        $parametros = array(
            "codigo_carrito" => intval($codigo_carrito)
        );
        return self::executeNonQuery($sqlstr, $parametros);
    }
}
