<?php

return [
    'default' => [
        'controller' => 'DefaultController',
        'action' => 'indexAction',
        'pattern' => '/1/'
    ],

    'book_list' => [
        'controller' => 'BookController',
        'action' => 'indexAction',
        'pattern' => '/1/books'
    ],

    'book_page' => [
        'controller' => 'BookController',
        'action' => 'indexAction',
        'pattern' => '/1/books/{id}',
        'parameters' => [
            'id' => '[0-9]+'
        ]
    ],

    'feedback' => [
        'controller' => 'FeedbackController',
        'action' => 'contactAction',
        'pattern' => '/1/feedback'
    ]
];