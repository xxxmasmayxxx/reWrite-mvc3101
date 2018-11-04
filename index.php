<?php

spl_autoload_register(function ($className)     //автолоадинг работает только если название паки с файлом и неймспейс совпадают
   {
    require $className . '.php';
   });

$request = new Model\Request($_GET, $_POST);    // отсыл суп.глоб.масс. в private св-ва и обработка if null

$controller = $request->get('controller', 'default');   // get from private + default if null
$action = $request->get('action', 'index');     // -||-

$controller = 'Controller\\' . ucfirst($controller . 'Controller');     // изменяем назв. контроллера на имя файла
$action .= 'Action';        // экшена  -||-

if (!file_exists($controller . '.php'))     // проверка на существование файла + расширение
{
    exit("{$controller} not found");
}

$controller = new $controller();

if (!method_exists($controller, $action))        // -||- метода
{
    exit("{$action} not found");
}

$content = $controller->$action();      // переменная для сбора и передачи контента



require 'View/layout.phtml';        // выкладываем все в вьюшку