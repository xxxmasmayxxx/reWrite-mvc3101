<?php

namespace Controller;

use Framework\Controller;
use Model\Form\FeedbackForm;
use Framework\Request;

class FeedbackController extends Controller
{

    public function contactAction(Request $request)
    {

        $form = new FeedbackForm( $request->post('name'),
                                        $request->post('email'),
                                        $request->post('message')
                                       );

        if ($request->isPost())
        {
            if ($form->isValid())
            {


                $this->router->redirect('/1');
            }
        }
//        var_dump($form);
        return $this->render('contact.phtml', ['form' => $form]);
    }
}