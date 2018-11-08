<?php

namespace Controller;

use Framework\Controller;
use Model\Form\FeedbackForm;
use Framework\Request;

class FeedbackController extends Controller
{

    public function contactAction(Request $request)
    {

        $form = new FeedbackController( $request->post('name'),
                                        $request->post('email'),
                                        $request->post('message')
                                       );

        return $this->render('contact.phtml');
    }
}