<?php
namespace Entities;

class Category implements \JsonSerializable
{

    private $id;
    private $title;
    private $description;

    /**
     * Category constructor.
     * @param $id
     * @param $title
     * @param $description
     */
    public function __construct($id, $title, $description)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
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
    }

    public function toFileLine()
    {
        $id = $this->id;
        $title = $this->fillSpaces($this->title, 60);
        $description = $this->fillSpaces($this->description, 100);
        return $id . ' ' . $title . ' ' . $description;
    }

    private function fillSpaces($str, $maxLen) {

        if (strlen($str) < $maxLen) {
            return str_pad($str, $maxLen);
        } else {
            return substr($str, 0, $maxLen);
        }
    }

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
        ];
    }
}