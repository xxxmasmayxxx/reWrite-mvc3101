<?php


namespace Controller;

use Framework\Controller;

class ExeptionController extends Controller
{

    public function errorAction(string $errorMessage = null)
    {
       $errorMessage = str_replace('Exception:','',$errorMessage); // убираем слово Exception

       $errorMessage = explode(' in ',$errorMessage);   // делим что оствлось по знаку in

       $errorMessage = $errorMessage[0];    // оставляем только ту часть сообщения которая нужна


        if (stripos($errorMessage, 'action')) {     // если в сообщении есть action

         return $this->render('index.phtml', [
             'type' => '400',
             'message' => 'Sorry problem with request',    // выдаем такую ошибку
             'errorMessage' => $errorMessage
         ]);
     }
         if (stripos($errorMessage, 'controller')) {        // -||-

             return $this->render('index.phtml', [
                 'type' => '400',
                 'message' => 'Sorry problem with request',
                 'errorMessage' => $errorMessage
             ]);

         }

        if (stripos($errorMessage, 'view')) {

            return $this->render('index.phtml', [
                'type' => '404',
                'message' => 'Sorry problem with foundation',
                'errorMessage' => $errorMessage
            ]);
        }

         else                                               // на всякий случай
         {
             return $this->render('index.phtml', [
                 'type' => '500',
                 'message' => 'Sorry unknown problem ',
                 'errorMessage' => $errorMessage
             ]);

         }
       }
    }
