<?php

namespace Controllers\Mnt;

use Controllers\PublicController;
use Views\Renderer;

class CrudCarritos extends PublicController
{
    public function run(): void
    {
        $viewData = array();
        $viewData["items"] = \Dao\Mnt\CrudCarritos::obtenerCrudCarritos();
        $viewData["new_enabled"] = true;
        $viewData["edit_enabled"] = true;
        $viewData["delete_enabled"] = true;
        Renderer::render("mnt/crudcarritos", $viewData);
    }
}
