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
//                $this->pdo

                $this->router->redirect('/1');
            }
        }

        return $this->render('contact.phtml', ['form' => $form]);
    }
}