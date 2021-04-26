<?php
namespace Controllers;

use Config\Request;
use Entities\Category;
use Repositories\CategoryRepository;
use Config\View;

class CategoryController
{

    public function findAll()
    {
        $_SESSION['message'] = 'Hello';
        $categoryRepository = new CategoryRepository();

        $categories = $categoryRepository->findAll();

        View::render("Templates/Category/CategoriesView.php", ["categories" => $categories]);
    }

    public function add(Request $request) {

        if ('GET' === $request->getMethod()) {
            View::render("Templates/Category/CategoryForm.php");
        }

        if ('POST' === $request->getMethod()) {
            $title = $_POST['title'];
            $description = $_POST['description'];


            $categoryRepository = new CategoryRepository();
            $lastId = $categoryRepository->findLastId();
            $category = new Category($lastId + 1, $title, $description);
            $categoryRepository->add($category);

            header('Location: /get/categories', true, 301);

            exit();
        }
    }

    public function edit(Request $request) {

        if ('GET' === $request->getMethod()) {
            $id = $_GET['id'];
            $categoryRepository = new CategoryRepository();
            $category = $categoryRepository->findById($id);

            View::render("Templates/Category/CategoryForm.php", ['category' => $category]);
        }

        if ('POST' === $request->getMethod()) {
            $id = $_POST['id'];
            $title = $_POST['title'];
            $description = $_POST['description'];

            $category = new Category($id, $title, $description);

            $categoryRepository = new CategoryRepository();
            $categoryRepository->edit($category);

            header("Location: /get/categories");
            die();
        }
    }

    public function delete() {

        $id = $_GET['id'];
        $categoryRepository = new CategoryRepository();
        $category = $categoryRepository->findById($id);
        $categoryRepository->delete($category);
        header("Location: /get/categories");
        die();
    }
}