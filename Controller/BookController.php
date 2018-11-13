<?php

namespace Controller;

use Framework\Controller;
use Framework\Request;

class BookController extends Controller
{
    public function indexAction(Request $request )
    {
        return $this->render('index.phtml', [
            'books' => [1, 2, 3],               //  compact($books = [1, 2, 3], $authors = 'adcsa dfwrwedqs')
            'authors' => 'adcsa dfwrwedqs'
        ]);
    }

    public function showAction(Request $request)
    {
        return $request->get('id');
    }
}