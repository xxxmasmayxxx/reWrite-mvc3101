<?php

use Framework\Request;
use Controller\ExeptionController;
use Framework\Router;
use Model\Repository\FeedbackRepository;
use Framework\Session;
use Framework\Logger;

define('DS', DIRECTORY_SEPARATOR);
define('ROOT_DIR', __DIR__ . DS . '..');
define('VIEW_DIR', ROOT_DIR . DS . 'View');
define('CONFIG_DIR', ROOT_DIR . DS . 'config');
define('LOG_FILE', ROOT_DIR . DS . 'log' . DS . 'log.txt');

spl_autoload_register(function ($className)     //автолоадинг работает только если название паки с файлом
    // и неймспейс совпадают
{
    require ROOT_DIR . DS . $className . '.php';
});

$logger = new Logger(LOG_FILE);

$PDOPASS = ROOT_DIR . DS . "Security" . DS ."PdoPass.php";   // имя файла с альтер настройками подключения к базе данных PDO

if (file_exists($PDOPASS))      // если есть сторонний файл с настройками подключения к базе данных то используется он
{                               // а если его нет то настройки устанавливаются здесь
    include_once $PDOPASS;

    $logger->log('PDOPASS file included');


}else{
        $DSN = 'mysql:host=127.0.0.1;dbname=mvc1';
        $USER = 'root';
        $PASSWORD = null;

    $logger->log('PDOPASS file NOT included');
}

$pdo = new \PDO($DSN, $USER, $PASSWORD);
$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

$routes = require CONFIG_DIR . DS .'routes.php';

$request = new Request($_GET, $_POST, $_SERVER);    // отсыл суп.глоб.масс. в private св-ва и обработка if null
$router = new Router($routes); // создание роутера для использования переадресации в классах
                            // (request и router) пробрасываются в классы разными способами, request через св-ва
                            // функции а router через родительский класс но в родительский подается тоже через св-во
                            // функции. Это dependency injection pattern.

$session = (new Session())->start();

$logger->log('Session started');

$feedbackRepository = (new FeedbackRepository())->setPdo($pdo); //PDO для формы сетится отдельно от контроллеров

try {

    $router->match($request);
    $controller = $router->getCurrentController();   // получение контроллера с помощю св-тв класса
    $action = $router->getCurrentAction();     // -||- экшена

    if (!file_exists(ROOT_DIR . DS . $controller . '.php'))     // проверка на существование файла + расширение
    {
        throw new \Exception("{$controller} -  not found");
    }

    $controller = (new $controller())           // все нужные инструменты сетятся в экз. класса контроллера
                    ->setRouter($router)
                    ->setPDO($pdo)
                    ->setFeedbackRepository($feedbackRepository)
                    ->setSession($session)
    ;

    if (!method_exists($controller, $action))        // проверка на существование метода
    {
        throw new \Exception("{$action} -  not found");
    }

    $content = $controller->$action($request);      // переменная для сбора и передачи контента

} catch (\Exception $e){                            // ловим все ошибки

            $ec = new ExeptionController();         // через свой контроллер выводим их
            $content = $ec->errorAction($e);

            $logger->log($e);
}



require VIEW_DIR . DS . 'layout.phtml';        // выкладываем все в вьюшку