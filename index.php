<?php

use Framework\Request;
use Controller\ExeptionController;
use Framework\Router;

define('DS', DIRECTORY_SEPARATOR);
define('VIEW_DIR', 'View');

$PDOPASS = "PdoPass.php";   // имя файла с альтер настройками подключения к базе данных PDO

if (file_exists($PDOPASS))      // если есть сторонний файл с настройками подключения к базе данных то используется он
{                               // а если его нет то настройки устанавливаются здесь
    include_once $PDOPASS;

}else{
        $DSN = 'mysql:host=127.0.0.1;dbname=mvc1';
        $USER = 'root';
        $PASSWORD = null;
}

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

$pdo = new \PDO($DSN, $USER, $PASSWORD);

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
                    ->setRouter($router)
                    ->setPdo($pdo)
    ;

    if (!method_exists($controller, $action))        // -||- метода
    {
        throw new \Exception("{$action} -  not found");
    }

    $content = $controller->$action($request);      // переменная для сбора и передачи контента

} catch (\Exception $e){

            $ec = new ExeptionController();
            $content = $ec->errorAction($e);
    }



require VIEW_DIR . DS . 'layout.phtml';        // выкладываем все в вьюшку