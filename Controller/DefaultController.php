<?php

namespace Controller;

class DefaultController
{

    public function indexAction()
    {
        ob_start();     // буферизация без которой require вылезет в верху layout

        require ('View/default/index.phtml');

       return ob_get_clean(); // возврат и закрытие буфера
    }
}