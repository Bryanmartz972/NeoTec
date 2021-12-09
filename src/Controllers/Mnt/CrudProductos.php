<?php

    namespace Controllers\Mnt;

    use Controllers\PublicController;
    use Views\Renderer;

    class CrudProductos extends PublicController
    {
        public function run() :void
        {
            $viewData = array();
            $viewData["items"] = \Dao\Mnt\CrudProductos::obtenerCrudProductos();
            $viewData["new_enabled"] = true;
            $viewData["edit_enabled"] = true;
            $viewData["delete_enabled"] = true;
            Renderer::render("mnt/crudproductos", $viewData);
        }
    }
