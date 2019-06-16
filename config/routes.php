<?php

return [
    'web' => [
        'GET' => [
            '/' => 'WelcomeController@index',
        ]
    ],

    'api' => [
        'GET' => [
            '/' => 'GraphQLController@response'
        ],
        'POST' => [
            '/' => 'GraphQLController@response'
        ],
    ]
];