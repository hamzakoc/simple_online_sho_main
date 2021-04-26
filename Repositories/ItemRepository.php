<?php
namespace Repositories;

use Entities\Item;

class ItemRepository
{

    /**
     * @return Item[]
     */
    public function findAll()
    {
        $content = file_get_contents(__DIR__.'/../db/items.txt');
        if (0 === strlen($content)) {
            return [];
        }
        $lines = explode(PHP_EOL, $content);
        $items = [];

        foreach ($lines as $line) {

            $idEndPos = strpos($line, " ");
            $id = substr($line, 0, $idEndPos);

            $titleStartPos = $idEndPos + 1;
            $title = substr($line, $titleStartPos, 100);

            $descStartPos = $titleStartPos + 101;
            $description = substr($line, $descStartPos, 255);

            $priceStartPos = $descStartPos + 256;
            $priceEndPos = strpos($line, " ", $priceStartPos);
            $price = substr($line, $priceStartPos, $priceEndPos - $priceStartPos);

            $categoryIdEndPos = strpos($line, ' ', $priceEndPos + 1);
            $categoryId = substr($line, $priceEndPos + 1, $categoryIdEndPos - $priceEndPos);

            $imageStartPos = $priceEndPos + 1 + $categoryIdEndPos - $priceEndPos;
            $image = substr($line, $imageStartPos, strlen($line) - $imageStartPos);

            $item = new Item();
            $item->setId($id)
                ->setTitle($title)
                ->setDescription($description)
                ->setPrice($price)
                ->setCategoryId($categoryId)
                ->setImage($image);

            $items[] = $item;
        }
        return $items;
    }

    /**
     * @param $str
     * @return Item[]
     */
    public function search($str)
    {
        $items = $this->findAll();

        $filteredCategories = [];

        foreach ($items as $Item) {
            if ($this->isFound($Item->getTitle(), $str) || $this->isFound($Item->getDescription(), $str)) {
                $filteredCategories[] = $Item;
            }
        }

        return $filteredCategories;
    }

    /**
     * @param $id
     * @return Item
     */
    public function findById($id)
    {
        $items = $this->findAll();

        foreach ($items as $Item) {
            if ((int)$Item->getId() === (int)$id) {
                return $Item;
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
        $items = $this->findAll();

        $id = 0;
        foreach ($items as $Item) {
            $id = (int)$Item->getId();
        }

        return $id;
    }

    public function add(Item $Item) {

        $count = count($this->findAll());
        return file_put_contents ( __DIR__.'/../db/items.txt', (0 < $count ? PHP_EOL : '') . $Item->toFileLine(),FILE_APPEND);
    }

    public function edit(Item $Item) {

        $items = $this->findAll();


        $newCategories = '';
        foreach ($items as $dbItem) {
            if ((int)$dbItem->getId() === (int)$Item->getId()) {
                $newCategories .= ($newCategories === '' ? '': PHP_EOL) . $Item->toFileLine();
            } else {
                $newCategories .= ($newCategories === '' ? '': PHP_EOL) . $dbItem->toFileLine();
            }
        }
        return file_put_contents ( __DIR__.'/../db/items.txt', $newCategories);
    }

    public function delete(Item $Item) {

        $items = $this->findAll();


        $newCategories = '';
        foreach ($items as $dbItem) {
            if ((int)$dbItem->getId() !== (int)$Item->getId()) {
                $newCategories .= ($newCategories === '' ? '': PHP_EOL) . $dbItem->toFileLine();
            }
        }
        return file_put_contents ( __DIR__.'/../db/items.txt', $newCategories);
    }

    private function isFound($haystack, $needle) {
        $haystack = mb_strtoupper($haystack, "UTF-8");
        $needle = mb_strtoupper($needle, "UTF-8");

        return !(strpos($haystack, $needle) === false);
    }
}