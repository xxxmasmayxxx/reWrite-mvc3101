<?php

namespace Controller;

use Framework\Controller;

class BookController extends Controller
{
    public function indexAction()
    {
        return $this->render('index.phtml', [
            'books' => [1, 2, 3],               //  compact($books = [1, 2, 3], $authors = 'adcsa dfwrwedqs')
            'authors' => 'adcsa dfwrwedqs'
        ]);
    }

}