<?php

namespace Controller;

class FeedbackController
{

    public function contactAction()
    {
        ob_start();     // буферизация без которой require вылезет в верху layout

        require ('View/feedback/contact.phtml');

        return ob_get_clean(); // возврат и закрытие буфера
    }
}