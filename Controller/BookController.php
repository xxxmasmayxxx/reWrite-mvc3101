<?php

namespace Controller;

use Framework\Controller;

class BookController extends Controller
{
    public function indexAction()
    {
        return $this->render('index.phtml');
        }
}