<?php

use Framework\Request;
use Controller\ExeptionController;
use Framework\Controller;


define('VIEW_DIR', 'View');

spl_autoload_register(function ($className)     //автолоадинг работает только если название паки с файлом и неймспейс совпадают
   {
    require $className . '.php';
   });

$request = new Request($_GET, $_POST);    // отсыл суп.глоб.масс. в private св-ва и обработка if null

$controller = $request->get('controller', 'default');   // get from private + default if null
$action = $request->get('action', 'index');     // -||-

$controller = 'Controller\\' . ucfirst($controller . 'Controller');     // изменяем назв. контроллера на имя файла
$action .= 'Action';        // экшена  -||-

try {
    if (!file_exists($controller . '.php'))     // проверка на существование файла + расширение
    {
        throw new \Exception("{$controller} -  not found");
    }

    $controller = new $controller();

    if (!method_exists($controller, $action))        // -||- метода
    {
        throw new \Exception("{$action} -  not found");
    }

    $content = $controller->$action();      // переменная для сбора и передачи контента

} catch (\Exception $e){

            $ec = new ExeptionController();
            $content = $ec->errorAction($e);
    }



require VIEW_DIR . DIRECTORY_SEPARATOR . 'layout.phtml';        // выкладываем все в вьюшку