<?php


namespace Framework;


class Router
{

    private $routes;

    public function __construct(array $routes)
    {
        $this->routes = $routes;
    }

    public function redirect($to)
    {
        header("Location: {$to}");
        exit;
}
}