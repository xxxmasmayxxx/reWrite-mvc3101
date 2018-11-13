<?php


namespace Framework;


class Router
{

    private $routes;

    private $curentRoute;

    public function __construct(array $routes)
    {
        $this->routes = $routes;
    }

    public function match(Request $request)
    {
        $url =$request->getUrl();

        $routes = $this->routes;

        foreach ($routes as $route)
        {
        $pattren = $route['pattern'];

            if(!$route['parameters'])
            {
                foreach ($route['parameters'] as $name => $regex)
                {
                    $pattren = str_replace('{' . $name . '}', '{' . $regex . '}', $pattren);
                }
            }

         $pattren = '@^' . $pattren . '$@';

            if(preg_match($pattren, $url, $matches))
            {
                array_shift($matches);

                    if(!empty($route['parameters']))
                    {
                        $resault = array_combine(array_keys($route['parameters']), $matches);

                        $request->mrgeGetWithArray($resault);
                    }

                    $this->curentRoute = $route;

                    return;
            }

        }
    }

    public function redirect($to)
    {
        header("Location: {$to}");
        exit;
    }
}