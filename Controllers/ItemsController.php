<?php

namespace Controllers;

use Config\Request;
use Config\View;
use Entities\Item;
use Repositories\CategoryRepository;
use Repositories\ItemRepository;

class ItemsController
{

    public function findAll()
    {
        $itemRepository = new ItemRepository();
        $items = $itemRepository->findAll();

        $itemRepository = new CategoryRepository();
        $categories = $itemRepository->findAll();


        View::render("Templates/Item/ItemsView.php", ["items" => $items, 'categories' => $categories]);
    }

    public function findByCategory()
    {
        $category_id = isset($_GET['category_id']) ? $_GET['category_id'] : 0;
        $itemRepository = new ItemRepository();

        $itemsByCategory = [];
        if (0 < (int) $category_id) {
            $items = $itemRepository->findAll();

            foreach ($items as $item) {
                if ((int)$item->getCategoryId() === (int)$category_id) {
                    $itemsByCategory[] = $item;
                }
            }
        }

        $itemRepository = new CategoryRepository();
        $categories = $itemRepository->findAll();


        View::render("Templates/Item/ItemsView.php", ["items" => $itemsByCategory, 'categories' => $categories]);
    }

    public function add(Request $request)
    {

        if ('GET' === $request->getMethod()) {

            $categoryRepository = new CategoryRepository();
            $categories = $categoryRepository->findAll();

            View::render("Templates/Item/ItemForm.php", ['categories' => $categories]);
        }

        if ('POST' === $request->getMethod()) {

            $image = $_FILES["image"]["name"];

            $target_dir = __DIR__ . "/../uploads/";
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            getimagesize($_FILES["image"]["tmp_name"]);
            move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);


            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $categoryId = $_POST['categoryId'];


            $itemRepository = new ItemRepository();
            $lastId = $itemRepository->findLastId();

            $item = new Item();
            $item->setId($lastId + 1)
                ->setTitle($title)
                ->setDescription($description)
                ->setCategoryId($categoryId)
                ->setPrice($price);

            if ($image){
                $item->setImage($image);
            }
            $itemRepository->add($item);

            header('Location: /get/items', true, 301);
            exit();
        }
    }


    public function edit(Request $request)
    {

        if ('GET' === $request->getMethod()) {
            $id = $_GET['id'];
            $itemRepository = new ItemRepository();
            $item = $itemRepository->findById($id);

            $categoryRepository = new CategoryRepository();
            $categories = $categoryRepository->findAll();

            View::render("Templates/Item/ItemForm.php", ['item' => $item, 'categories' => $categories]);
        }

        if ('POST' === $request->getMethod()) {

            $target_dir = __DIR__ . "/../uploads/";
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            getimagesize($_FILES["image"]["tmp_name"]);
            move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

            $id = $_POST['id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $categoryId = $_POST['categoryId'];
            $price = $_POST['price'];
            $image = $_FILES["image"]["name"];


            $itemRepository = new ItemRepository();

            $item = new Item();
            $item->setId($id)
                ->setTitle($title)
                ->setDescription($description)
                ->setCategoryId($categoryId)
                ->setPrice($price);

            if ($image){
                $item->setImage($image);
            }
            $itemRepository->edit($item);

            header("Location: /get/items");
            die();
        }
    }

    public function delete()
    {

        $id = $_GET['id'];
        $itemRepository = new ItemRepository();
        $item = $itemRepository->findById($id);
        $itemRepository->delete($item);
        header("Location: /get/items");
        die();
    }
}