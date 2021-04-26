<?php
namespace Config;

use Config\Request;
use Controllers\CategoryController;
use Controllers\DefaultController;
use Controllers\ItemsController;

class Routing
{

    /**
     * @var Request
     */
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function getResponse()
    {
        switch ($this->request->getUri()) {

            case "/":
            case "/index":

                $controller = new DefaultController();
                $controller->index();

                break;

            case "/login":

                $controller = new DefaultController();
                $controller->login($this->request);

                break;

            case "/logout":

                $controller = new DefaultController();
                $controller->logout();

                break;

            case "/search":

                $controller = new DefaultController();
                $controller->search();

                break;

            case "/get/categories":

                $controller = new CategoryController();
                $controller->findAll();

                break;

            case "/add/category":

                $controller = new CategoryController();
                $controller->add($this->request);

                break;

            case "/edit/category":

                $controller = new CategoryController();
                $controller->edit($this->request);

                break;

            case "/delete/category":

                $controller = new CategoryController();
                $controller->delete();

                break;

            case "/get/items/by/category":

                $controller = new ItemsController();
                $controller->findByCategory();

                break;

            case "/get/items":

                $controller = new ItemsController();
                $controller->findAll();

                break;

            case "/add/item":

                $controller = new ItemsController();
                $controller->add($this->request);

                break;

            case "/edit/item":

                $controller = new ItemsController();
                $controller->edit($this->request);

                break;

            case "/delete/item":

                $controller = new ItemsController();
                $controller->delete();

                break;
            default:
                echo "<h1>Routing ".$this->request->getUri()." not found</h1>";
                break;
        }
    }
}