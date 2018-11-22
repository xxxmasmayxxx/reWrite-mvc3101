<?php

namespace Controller;

use Framework\Controller;
use Framework\Request;

class DefaultController extends Controller
{

    public function indexAction(Request $request)
    {
        return $this->render('index.phtml');
    }


    public function jsonAction(Request $request)
    {
        header('content-type: application/json');
        return json_encode(['a'=>1, 'b'=>2]);
    }
}