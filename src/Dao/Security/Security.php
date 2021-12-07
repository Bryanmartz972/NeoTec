<?php
namespace Dao\Security;

if (version_compare(phpversion(), '7.4.0', '<')) {
        define('PASSWORD_ALGORITHM', 1);  //BCRYPT
} else {
    define('PASSWORD_ALGORITHM', '2y');  //BCRYPT
}
/*
usercod     bigint(10) AI PK
useremail   varchar(80)
username    varchar(80)
userpswd    varchar(128)
userfching  datetime
userpswdest char(3)
userpswdexp datetime
userest     char(3)
useractcod  varchar(128)
userpswdchg varchar(128)
usertipo    char(3)

 */

use Exception;

use function Symfony\Component\DependencyInjection\Loader\Configurator\ref;

class Security extends \Dao\Table
{
    static public function newUsuario($email, $password)
    {
        if (!\Utilities\Validators::IsValidEmail($email)) {
            throw new Exception("Correo no es válido");
        }
        if (!\Utilities\Validators::IsValidPassword($password)) {
            throw new Exception("Contraseña debe ser almenos 8 caracteres, 1 número, 1 mayúscula, 1 símbolo especial");
        }

        $newUser = self::_usuarioStruct();
        //Tratamiento de la Contraseña
        $hashedPassword = self::_hashPassword($password);

        unset($newUser["fecha_creacion"]);
        unset($newUser["password_lastchange"]);

        $newUser["codigo_usuario"] = substr(uniqid(),0, -3);
        $newUser["nombre_usuario"] = ["nombre_usuario"] ;
        $newUser["correo_electronico"] = $email;
        $newUser["usuarioactcod"] = hash("sha256", $email.time());
        $newUser["password"] = $hashedPassword;
        $newUser["estado"] = Estados::ACTIVO;
        $newUser["password_estado"] = Estados::ACTIVO;
        $newUser["password_fexpirar"] = date('Y-m-d', time() + 7776000);  
        $newUser["tipo_usuario"] = UsuarioTipo::PUBLICO;

        $sqlIns = "INSERT INTO `usuarios`
        (`codigo_usuario`,
        `nombre_usuario`,
        `correo_electronico`,
        `usuarioactcod`,
        `password`,
        `fecha_creacion`,
        `estado`,
        `password_estado`,
        `password_fexpirar`,
        `tipo_usuario`,
        `password_lastchange`)
        VALUES
        (:codigo_usuario,
        :nombre_usuario,
        :correo_electronico,
        :usuarioactcod,
        :password,
        now(),
        :estado,
        :password_estado,
        :password_fexpirar,
        :tipo_usuario,
        now());";

        return self::executeNonQuery($sqlIns, $newUser);

    }

    static public function getUsuarioByEmail($email)
    {
        $sqlstr = "SELECT * from `usuarios` where `correo_electronico` = :correo_electronico;";
        $params = array("correo_electronico"=>$email);

        return self::obtenerUnRegistro($sqlstr, $params);
    }
    
    static private function _saltPassword($password)
    {
        /*if ($salt % 2 == 0) {
            return $password . $salt;
        }
        return $salt . $password
        */
        return hash_hmac(
            "sha256",
            $password,
            \Utilities\Context::getContextByKey("PWD_HASH")
        );
    }

    static private function _hashPassword($password)
    {
        return password_hash(self::_saltPassword($password), PASSWORD_ALGORITHM);
    }

    static public function verifyPassword($raw_password, $hash_password)
    {
        return password_verify(
            self::_saltPassword($raw_password),
            $hash_password
        );
    }


    static private function _usuarioStruct()
    {
        return array(
            "codigo_usuario"      => "",
            "nombre_usuario"    => "",
            "correo_electronico"     => "",
            "usuarioactcod"     => "",
            "password"   => "",
            "fecha_creacion"  => "",
            "estado"  => "",
            "password_estado"      => "",
            "password_fexpirar"   => "",
            "tipo_usuario"  => "",
            "password_lastchange"     => "",
        );
    }
    static public function insertFuncionesRoles($codigorol, $codigo_funcion, $funcion_rol_estado, $fecha_exp){
        $query="INSERT INTO `funciones_roles`
        (`codigorol`,
        `codigo_funcion`,
        `funcion_rol_estado`,
        `fecha_exp`)
        VALUES
        (
        :codigorol,
        :codigo_funcion,
        :funcion_rol_estado,
        :fecha_exp);";
        $parameters=array(
            "codigorol"=>$codigorol,
            "codigo_funcion"=>$codigo_funcion,
            "funcion_rol_estado"=>$funcion_rol_estado,
            "fecha_exp"=>$fecha_exp
        );

        return self::executeNonQuery($query, $parameters);
    }
    static public function UpdateFuncionesRoles($codigorol, $codigo_funcion, $funcion_rol_estado, $fecha_exp){
        $query="UPDATE `funciones_roles`
        SET
        `funcion_rol_estado` =:funcion_rol_estado,
        `fecha_exp` =:fecha_exp
        WHERE `codigorol` =:codigorol AND `codigo_funcion` =:codigo_funcion;";
        $parameters=array(
            "funcion_rol_estado"=>$funcion_rol_estado,
            "fecha_exp"=>$fecha_exp,
            "codigorol"=>$codigorol,
            "codigo_funcion"=>$codigo_funcion
        );
        return self::executeNonQuery($query, $parameters);    
}

static public function GetByIdPermisos($codigorol, $codigo_funcion){
    $query="SELECT * from funciones_roles where codigorol=:codigorol and codigo_funcion=:codigo_funcion";
    $parameters=array(
        "codigorol"=>$codigorol,
        "codigo_funcion"=>$codigo_funcion
    );
    return self::obtenerUnRegistro($query, $parameters);
    
}

    static public function getAllFeature()
    {
        $sqlstr = "SELECT * from funciones;";
        
        return  self::obtenerRegistros($sqlstr, array());
    }
    static public function getAllFuncionesRoles()
    {
        $sqlstr = "SELECT * from funciones_roles;";
        
        return  self::obtenerRegistros($sqlstr, array());
    }
    static public function getFeature($fncod)
    {
        $sqlstr = "SELECT * from funciones where codigo_funcion=:codigo_funcion;";
        $featuresList = self::obtenerRegistros($sqlstr, array("codigo_funcion"=>$fncod));
        return count($featuresList) > 0;
    }

    static public function addNewFeature($fncod, $fndsc, $fnest, $fntyp )
    {
        $sqlins = "INSERT INTO `funciones` (`codigo_funcion`, `funcion_descripcion`, `funcion_estado`, `funcion_typ`)
            VALUES (:codigo_funcion , :funcion_descripcion , :funcion_estado , :funcion_typ );";

        return self::executeNonQuery(
            $sqlins,
            array(
                "codigo_funcion" => $fncod,
                "funcion_descripcion" => $fndsc,
                "funcion_estado" => $fnest,
                "funcion_typ" => $fntyp
            )
        );
    }

    static public function getFeatureByUsuario($userCod, $fncod)
    {
        $sqlstr = "select * from
        funciones_roles a inner join roles_usuarios b on a.codigorol = b.codigo_rol
        where a.funcion_rol_estado = 'ACT' and b.rol_estado='ACT' and b.codusuario=:usercod
        and a.codigo_funcion=:fncod limit 1;";
        $resultados = self::obtenerRegistros(
            $sqlstr,
            array(
                "usercod"=> $userCod,
                "fncod" => $fncod
            )
        );
        return count($resultados) > 0;
    }

    static public function getRol($rolescod)
    {
        $sqlstr = "SELECT * from roles where codigo_rol=:codigo_rol;";
        $featuresList = self::obtenerRegistros($sqlstr, array("codigo_rol" => $rolescod));
        return count($featuresList) > 0;
    }

    static public function getRolById($codigo_rol){
        $query="SELECT * from roles where codigo_rol=:codigo_rol;";
       $parameters=array("codigo_rol" => $codigo_rol);
       return self::obtenerUnRegistro($query, $parameters);

    }
    static public function getRoles(){
        $sqlstr = "SELECT * from roles ";
        return self::obtenerRegistros($sqlstr,array());
    }
    static public function modificarRol($descripcion, $estado, $codigo_rol){
        $sql="Update roles set descripcion_rol=:deescripcion, estado=:estado where codigo_rol=:codigo_rol";
        $parameters=array(
            "descripcion"=>$descripcion, 
            "estado"=>$estado, 
            "codigo_rol"=>$codigo_rol
        );
        return self::executeNonQuery($sql, $parameters);

    }

    static public function DeleteRol($codigo_rol){
        $query="DELETE FROM roles where codigo_rol=:codigo_rol";
        $parameters=array("codigo_rol"=>$codigo_rol);
        return self::executeNonQuery($query, $parameters);
    }

    static public function addNewRol($rolescod, $rolesdsc, $rolesest)
    {
        $sqlins = "INSERT INTO `roles` (`codigo_rol`, `descripcion_rol`, `estado`)
        VALUES (:codigo_rol, :descripcion_rol, :estado);";

        return self::executeNonQuery(
            $sqlins,
            array(
                "codigo_rol" => $rolescod,
                "descripcion_rol" => $rolesdsc,
                "estado" => $rolesest
            )
        );
    }

    static public function getRolesByUsuario($userCod, $rolescod)
    {
        $sqlstr = "select * from roles a inner join
        roles_usuarios b on a.codigo_rol = b.codigo_rol where a.estado = 'ACT'
        and b.codigo_rol=:usercod and a.codigo_rol=:rolescod limit 1;";
        $resultados = self::obtenerRegistros(
            $sqlstr,
            array(
                "usercod" => $userCod,
                "rolescod" => $rolescod
            )
        );
        return count($resultados) > 0;
    }

    static public function removeRolFromUser($userCod, $rolescod)
    {
        $sqldel = "UPDATE roles_usuarios set rol_estado='INA' 
        where codigo_rol=:rolescod and codusuario=:usercod;";
        return self::executeNonQuery(
            $sqldel,
            array("rolescod"=>$rolescod, "usercod"=>$userCod)
        );
    }

    static public function removeFeatureFromRol($fncod, $rolescod)
    {
        $sqldel = "UPDATE funciones_roles set funcion_rol_estado='INA'
        where codigo_funcion=:fncod and codigorol=:rolescod;";
        return self::executeNonQuery(
            $sqldel,
            array("fncod" => $fncod, "rolescod" => $rolescod)
        );
    }
    static public function getUnAssignedFeatures($rolescod)
    {
        
    }
    static public function getUnAssignedRoles($userCod)
    {

    }
    private function __construct()
    {
    }
    private function __clone()
    {
    }
}


?>
