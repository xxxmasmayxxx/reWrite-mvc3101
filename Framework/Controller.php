<?php


namespace Framework;


class Controller
{
protected $router;
protected $pdo;

    public function setRouter(Router $router)
    {
        $this->router = $router;

        return $this;
}

    public function setPdo(\PDO $pdo)
    {
        $this->pdo = $pdo;

        return $this;
}

    protected function render($view, array $assoc = [])
    {
        $class = get_class($this);  // узнаем класс с неймспейсом
        $folderClass = strtolower(str_replace(['Controller', '\\'], '', $class)); // убираем неймспейс и понижаем
                                                                                            // заглавные буквы

        $path = VIEW_DIR . DIRECTORY_SEPARATOR . $folderClass . DIRECTORY_SEPARATOR . $view;  // склеиваем путь

        if (!file_exists($path))        // проверка на существование вьюшки
        {
            throw new \Exception("{$path} - Path to view file not correct");
        }

        $vars = extract($assoc);

        ob_start();     // буферизация без которой require вылезет в верху layout

        require ($path);

        return ob_get_clean(); // возврат и закрытие буфера
    }
}