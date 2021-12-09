<?php

    namespace Controllers\Mnt;

    use Controllers\PublicController;
    use Views\Renderer;

    class CrudUsuarios extends PublicController
    {
        public function run() :void
        {
            $viewData = array();
            $viewData["items"] = \Dao\Mnt\CrudUsuarios::obtenerCrudUsuarios();
            $viewData["new_enabled"] = true;
            $viewData["edit_enabled"] = true;
            $viewData["delete_enabled"] = true;
            Renderer::render("mnt/crudusuarios", $viewData);
        }
    }
