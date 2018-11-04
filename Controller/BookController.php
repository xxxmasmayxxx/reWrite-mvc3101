<?php

namespace Controller;

class BookController
{
    public function indexAction()
    {
        ob_start();     // буферизация без которой require вылезет в верху layout

        require ('View/book/index.phtml');

        return ob_get_clean(); // возврат и закрытие буфера
        }
}