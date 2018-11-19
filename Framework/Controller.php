<?php


namespace Framework;


use Model\Repository\FeedbackRepository;

class Controller
{
protected $router;

protected $feedbackRepository;

protected $session;

protected $logger;

    use PdoTrait;

    public function setRouter(Router $router)
    {
        $this->router = $router;

        return $this;
}

    public function setFeedbackRepository(FeedbackRepository $feedbackRepository)
    {
        $this->feedbackRepository = $feedbackRepository;

        return $this;
    }

    public function setSession(Session $session)
    {
        $this->session = $session;

        return $this;
    }

    protected function render($view, array $assoc = [])
    {
        $class = get_class($this);  // узнаем класс с неймспейсом
        $folderClass = strtolower(str_replace(['Controller', '\\'], '', $class)); // убираем неймспейс и понижаем
                                                                                            // заглавные буквы

        $path = VIEW_DIR . DS . $folderClass . DS . $view;  // склеиваем путь

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