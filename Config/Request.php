<?php
namespace Config;

class Request
{
    private $uri;
    private $method;

    /**
     * Request constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return mixed
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * @param mixed $uri
     * @return Request
     */
    public function setUri($uri): Request
    {
        $this->uri = $uri;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param mixed $method
     * @return Request
     */
    public function setMethod($method): Request
    {
        $this->method = $method;
        return $this;
    }
}