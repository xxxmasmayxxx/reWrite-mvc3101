<?php

use Framework\Request;
use Controller\ExeptionController;
use Framework\Router;


define('VIEW_DIR', 'View');

spl_autoload_register(function ($className)     //автолоадинг работает только если название паки с файлом
                                                                                    // и неймспейс совпадают
   {
    require $className . '.php';
   });

$request = new Request($_GET, $_POST);    // отсыл суп.глоб.масс. в private св-ва и обработка if null
$router = new Router(); // создание роутера для использования переадресации в классах
                            // (request и router) пробрасываются в классы разными способами, request через св-ва
                            // функции а router через родительский класс но в родительский подается тоже через св-во
                            // функции. Это dependency injection pattern.

$controller = $request->get('controller', 'default');   // get from private + default if null
$action = $request->get('action', 'index');     // -||-

$controller = 'Controller\\' . ucfirst($controller . 'Controller');     // изменяем назв. контроллера на имя файла
$action .= 'Action';        // экшена  -||-

try {
    if (!file_exists($controller . '.php'))     // проверка на существование файла + расширение
    {
        throw new \Exception("{$controller} -  not found");
    }

    $controller = (new $controller())        //
                    ->setRouter($router);

    if (!method_exists($controller, $action))        // -||- метода
    {
        throw new \Exception("{$action} -  not found");
    }

    $content = $controller->$action($request);      // переменная для сбора и передачи контента

} catch (\Exception $e){

            $ec = new ExeptionController();
            $content = $ec->errorAction($e);
    }



require VIEW_DIR . DIRECTORY_SEPARATOR . 'layout.phtml';        // выкладываем все в вьюшку