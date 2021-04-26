<?php
namespace Config;


class View
{

    public static function render($path, $args = [])
    {
        require_once "Templates/Header.php";
        require_once "Templates/MainNavigation.php";
        require_once $path;
        require_once "Templates/Footer.php";
    }
}