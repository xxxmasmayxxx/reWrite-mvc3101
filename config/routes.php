<?php

return [
    'default' => [
        'controller' => 'DefaultController',
        'action' => 'indexAction',
        'path' => '/1/'
    ],

    'book_list' => [
        'controller' => 'BookController',
        'action' => 'indexAction',
        'path' => '/1/books'
    ],

    'feedback' => [
        'controller' => 'FeedbackController',
        'action' => 'contactAction',
        'path' => '/1/feedback'
    ]
];