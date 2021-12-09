<?php
namespace Controllers\Admin;

class Admin extends \Controllers\PrivateController
{
    public function __construct()
    {
        parent::__construct();
    }
    public function run() :void
    {
        \Views\Renderer::render("admin/admin", array());
    }
}
?>
