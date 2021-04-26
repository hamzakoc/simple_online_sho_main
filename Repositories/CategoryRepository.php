<?php
namespace Repositories;

use Entities\Category;

class CategoryRepository
{

    /**
     * @return Category[]
     */
    public function findAll()
    {
        $content = file_get_contents(__DIR__.'/../db/categories.txt');
        if (0 === strlen($content)) {
            return [];
        }
        $lines = explode(PHP_EOL, $content);
        $categories = [];

        foreach ($lines as $line) {

            $idPos = strpos($line, " ");
            $id = substr($line, 0, $idPos);
            $titlePos = $idPos + 1;
            $title = substr($line, $titlePos, 60);

            $descPos = $titlePos + 60;
            $description = substr($line, $descPos, 100);

            $category = new Category($id, $title, $description);
            $categories[] = $category;
        }
        return $categories;
    }

    /**
     * @param $str
     * @return Category[]
     */
    public function search($str)
    {
        $categories = $this->findAll();

        $filteredCategories = [];

        foreach ($categories as $category) {
            if ($this->isFound($category->getTitle(), $str) || $this->isFound($category->getDescription(), $str)) {
                $filteredCategories[] = $category;
            }
        }

        return $filteredCategories;
    }

    /**
     * @param $id
     * @return Category
     */
    public function findById($id)
    {
        $categories = $this->findAll();

        foreach ($categories as $category) {
            if ((int)$category->getId() === (int)$id) {
                return $category;
            }
        }

        return null;
    }

    /**
     * @param
     * @return int
     */
    public function findLastId()
    {
        $categories = $this->findAll();

        $id = 0;
        foreach ($categories as $category) {
            $id = (int)$category->getId();
        }

        return $id;
    }

    public function add(Category $category) {

        $count = count($this->findAll());
        return file_put_contents ( __DIR__.'/../db/categories.txt', (0 < $count ? PHP_EOL : '') . $category->toFileLine(),FILE_APPEND);
    }

    public function edit(Category $category) {

        $categories = $this->findAll();


        $newCategories = '';
        foreach ($categories as $dbCategory) {
            if ((int)$dbCategory->getId() === (int)$category->getId()) {
                $newCategories .= ($newCategories === '' ? '': PHP_EOL) . $category->toFileLine();
            } else {
                $newCategories .= ($newCategories === '' ? '': PHP_EOL) . $dbCategory->toFileLine();
            }
        }
        return file_put_contents ( __DIR__.'/../db/categories.txt', $newCategories);
    }

    public function delete(Category $category) {

        $categories = $this->findAll();


        $newCategories = '';
        foreach ($categories as $dbCategory) {
            if ((int)$dbCategory->getId() !== (int)$category->getId()) {
                $newCategories .= ($newCategories === '' ? '': PHP_EOL) . $dbCategory->toFileLine();
            }
        }
        return file_put_contents ( __DIR__.'/../db/categories.txt', $newCategories);
    }

    private function isFound($haystack, $needle) {
        $haystack = mb_strtoupper($haystack, "UTF-8");
        $needle = mb_strtoupper($needle, "UTF-8");

        $pos = strpos($haystack, $needle);
        return $pos !== FALSE;
    }
}