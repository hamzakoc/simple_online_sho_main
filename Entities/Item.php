<?php
namespace Entities;


class Item implements \JsonSerializable
{

    private $id;
    private $categoryId;
    private $title;
    private $description;
    private $price;
    private $image;

    public function __construct()
    {
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return trim($this->title);
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return trim($this->description);
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCategoryId()
    {
        return (int)$this->categoryId;
    }

    /**
     * @param mixed $categoryId
     */
    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return (int)$this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return trim($this->image);
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
        return $this;
    }

    public function toFileLine()
    {
        $id = $this->id;
        $title = $this->fillSpaces($this->title, 100);
        $description = $this->fillSpaces($this->description, 255);
        $price = $this->price;
        $categoryId = $this->categoryId;
        $image = trim($this->image);
        return $id . ' ' . $title . ' ' . $description . ' ' . $price . ' ' . $categoryId . ' ' . ' '. $image;
    }

    private function fillSpaces($str, $maxLen) {

        if (strlen($str) < $maxLen) {
            return str_pad($str, $maxLen);
        } else {
            return substr($str, 0, $maxLen);
        }
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'categoryId' => $this->categoryId,
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'image' => $this->image,

        ];
    }
}