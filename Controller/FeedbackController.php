<?php

namespace Controller;

use Framework\Controller;

class FeedbackController extends Controller
{

    public function contactAction()
    {
        return $this->render('contact.phtml');
    }
}