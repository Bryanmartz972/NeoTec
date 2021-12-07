<?php
/**
 * PHP Version 7.2
 *
 * @category Public
 * @package  Controllers
 * @author   Orlando J Betancourth <orlando.betancourth@gmail.com>
 * @license  MIT http://
 * @version  CVS:1.0.0
 * @link     http://
 */
namespace Controllers;

/**
 * Index Controller
 *
 * @category Public
 * @package  Controllers
 * @author   Orlando J Betancourth <orlando.betancourth@gmail.com>
 * @license  MIT http://
 * @link     http://
 */
class Index extends PublicController
{
    /**
     * Index run method
     *
     * @return void
     */
    public function run() :void
    {
        \Utilities\Site::addLink("public/css/style.css");
        /*
        1. Conseguir de BD los eegistros de Heroes activos
        2. Inyectarlo en un arreglo de vista
        3. Mostrar los heros panels en la vista
        */
        $viewData= array();
        $viewData["page"] = $this->toString();
       
        $viewData["algomas"] = "esto es algo mas que se envia a la vista";
        \Views\Renderer::render("index", $viewData);
    }
}
?>
