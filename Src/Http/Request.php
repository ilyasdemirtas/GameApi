<?php

namespace GameApi\Src\Http;

class Request
{
    private $request;

    public function __construct()
    {
        $this->request = $_SERVER;
    }

    public function path()
    {
        return $this->request['REQUEST_URI'] ?? null;
    }

    public function method()
    {
        return $this->request['REQUEST_METHOD'];
    }

    public function getContent()
    {
        return file_get_contents('php://input');
    }

}
