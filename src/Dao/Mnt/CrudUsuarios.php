<?php

namespace Dao\Mnt;

use Dao\Table;

class CrudUsuarios extends Table
{
    public static function obtenerCrudUsuarios()
    {
        $sqlStr = "SELECT * from usuarios;";
        return self::obtenerRegistros($sqlStr, array());
    }

    public static function obtenerCrudUsuario($codigo_usuario)
    {
        $sqlStr = "SELECT * from usuarios where codigo_usuario = :codigo_usuario;";
        return self::obtenerUnRegistro($sqlStr, array("codigo_usuario" => intval($codigo_usuario)));
    }

    public static function crearCrudUsuarios($nombre_usuario, $correo_electronico, $fecha_creacion, $estado, $password_estado)
    {
        $sqlstr = "INSERT INTO usuarios (nombre_usuario, correo_electronico, fecha_creacion, estado, password_estado) 
        values (:nombre_usuario, :correo_electronico, :fecha_creacion, :estado, :password_estado);";
        $parametros = array(
            "nombre_usuario" => $nombre_usuario,
            "correo_electronico" => $correo_electronico,
            "fecha_creacion" => $fecha_creacion,
            "estado" => $estado,
            "password_estado" => $password_estado,
        );
        return self::executeNonQuery($sqlstr, $parametros);
    }

    public static function editarCrudUsuarios($codigo_usuario, $nombre_usuario, $correo_electronico, $fecha_creacion, $estado, $password_estado)
    {
        $sqlstr = "UPDATE usuarios set  nombre_usuario=:nombre_usuario, correo_electronico=:correo_electronico, fecha_creacion=:fecha_creacion, estado=:estado, password_estado=:password_estado  where codigo_usuario = :codigo_usuario;";
        $parametros = array(
            "nombre_usuario" => $nombre_usuario,
            "correo_electronico" => $correo_electronico,
            "fecha_creacion" => $fecha_creacion,
            "estado" => $estado,
            "password_estado" => $password_estado,

            "codigo_usuario" => intval($codigo_usuario)
        );
        return self::executeNonQuery($sqlstr, $parametros);
    }

    public static function eliminarCrudUsuarios($codigo_usuario)
    {
        $sqlstr = "DELETE FROM usuarios where codigo_usuario=:codigo_usuario;";
        $parametros = array(
            "codigo_usuario" => intval($codigo_usuario)
        );
        return self::executeNonQuery($sqlstr, $parametros);
    }
}
