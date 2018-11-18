<?php


namespace Framework;


class Router
{

    private $routes;

    private $currentRoute;

    public function __construct(array $routes)
    {
        $this->routes = $routes;
    }

    public function match(Request $request)
    {
        $url = $request->getUrl();

        $routes = $this->routes;

        foreach ($routes as $route)
        {
        $pattern = $route['pattern'];

            if(!empty($route['parameters']))
            {
                foreach ($route['parameters'] as $name => $regex)
                {
                    $pattern = str_replace('{' . $name . '}', '{' . $regex . '}', $pattern);
                }
            }

            $pattern = '@^' . $pattern . '$@';

            if(preg_match($pattern, $url, $matches))
            {
                array_shift($matches);

                    if(!empty($route['parameters']))
                    {
                        $result = array_combine(array_keys($route['parameters']), $matches);

                        $request->mergeGetWithArray($result);
                    }

                    $this->currentRoute = $route;

                    return;
            }

        }

            throw new \Exception('Page not found', 404);
    }

    private function getCurrentRouteAttribute($key)
    {
//        if(!$this->curentRoute)
//        {
//            return null;
//        }
//
//        return $this->curentRoute[$key];

        return $this->curentRoute[$key] ?? null;
;
    }

    public function getCurrentController()
    {
        return $this->getCurrentRouteAttribute('controller');
    }


    public function getCurrentAction()
    {
        return $this->getCurrentRouteAttribute('action');
    }

    public function redirect($to)
    {
        header("Location: {$to}");
        exit;
    }
}