<?php

namespace Controllers;

use Config\Request;
use Config\View;
use Repositories\CategoryRepository;
use Repositories\ItemRepository;

class DefaultController
{
    public function index()
    {
        View::render("Templates/Default/DefaultView.php");
    }

    public function search()
    {
        $str = isset($_GET['search']) ? $_GET['search'] : '';

        $results = [];

        if ($str) {
            $categoryRepository = new CategoryRepository();
            $categories = $categoryRepository->search($str);

            $itemRepository = new ItemRepository();
            $items = $itemRepository->search($str);

            foreach ($categories as $category) {
                $results[] = $category;
            }

            foreach ($items as $item) {
                $results[] = $item;
            }
        }

        View::render("Templates/Default/SearchView.php", ['results' => $results]);
    }

    public function login(Request $request)
    {

        if ('GET' === $request->getMethod()) {

            $message = isset($_GET['message']) ? $_GET['message'] : '';

            View::render("Templates/Default/LoginView.php", ['message' => $message]);

        } else if ('POST' === $request->getMethod()) {

            $login = $_POST['login'];
            $password = $_POST['password'];

            if ($login === 'admin' && $password === 'pass1234') {

                $_SESSION['isLoggedIn'] = true;
                $_SESSION['login'] = $login;

                header('Location: /', true, 301);

            } else {

                header('Location: /login?message="Login or password is not correct"', true, 301);

            }
        }
    }

    public function logout()
    {

        unset($_SESSION['isLoggedIn']);
        unset($_SESSION['login']);

        header('Location: /', true, 301);
    }
}