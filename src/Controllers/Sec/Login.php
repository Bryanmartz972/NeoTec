<?php
namespace Controllers\Sec;
class Login extends \Controllers\PublicController
{
    private $txtEmail = "";
    private $txtPswd = "";
    private $errorEmail = "";
    private $errorPswd = "";
    private $generalError = "";
    private $hasError = false;

    public function run() :void
    {
        if ($this->isPostBack()) {
            $this->txtEmail = $_POST["txtEmail"];
            $this->txtPswd = $_POST["txtPswd"];

            if (!\Utilities\Validators::IsValidEmail($this->txtEmail)) {
                $this->errorEmail = "¡Correo no tiene el formato adecuado!";
                $this->hasError = true;
            }
            if (\Utilities\Validators::IsEmpty($this->txtPswd)) {
                $this->errorPswd = "¡Debe ingresar una contraseña!";
                $this->hasError = true;
            }
            if (! $this->hasError) {
                if ($dbUser = \Dao\Security\Security::getUsuarioByEmail($this->txtEmail)) {
                    if ($dbUser["estado"] != \Dao\Security\Estados::ACTIVO) {
                        $this->generalError = "¡Credenciales son incorrectas!";
                        $this->hasError = true;
                        error_log(
                            sprintf(
                                "ERROR: %d %s tiene cuenta con estado %s",
                                $dbUser["codigo_usuario"],
                                $dbUser["correo_electronico"],
                                $dbUser["estado"]
                            )
                        );
                    }
                    if (!\Dao\Security\Security::verifyPassword($this->txtPswd, $dbUser["password"])) {
                        $this->generalError = "¡Credenciales son incorrectas!";
                        $this->hasError = true;
                        error_log(
                            sprintf(
                                "ERROR: %d %s contraseña incorrecta",
                                $dbUser["codigo_usuario"],
                                $dbUser["correo_electronico"]
                            )
                        );
                        // Aqui se debe establecer acciones segun la politica de la institucion.
                    }
                    if (! $this->hasError) {
                        \Utilities\Security::login(
                            $dbUser["codigo_usuario"],
                            $dbUser["nombre_usuario"],
                            $dbUser["correo_electronico"]
                        );
                        if (\Utilities\Context::getContextByKey("redirto") !== "") {
                            \Utilities\Site::redirectTo(
                                \Utilities\Context::getContextByKey("redirto")
                            );
                        } else {
                            \Utilities\Site::redirectTo("index.php?page=index");
                        }
                    }
                } else {
                    error_log(
                        sprintf(
                            "ERROR: %s trato de ingresar",
                            $this->txtEmail
                        )
                    );
                    $this->generalError = "¡Credenciales son incorrectas!";
                }
            }
        }
        $dataView = get_object_vars($this);
        \Views\Renderer::render("security/login", $dataView);
    }
}
?>
