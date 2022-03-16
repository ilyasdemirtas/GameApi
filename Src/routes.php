<?php

$routes = [
    '/api/v1/user/signup' => [
        'controller' => 'AuthController',
        'action' => 'signup',
        'method' => 'POST'
    ],
    '/api/v1/user/signin' => [
        'controller' => 'AuthController',
        'action' => 'signin',
        'method' => 'POST'
    ],
    '/api/v1/endgame' => [
        'controller' => 'GameController',
        'action' => 'endgame',
        'method' => 'POST'
    ],
    '/api/v1/leaderboard' => [
        'controller' => 'GameController',
        'action' => 'leaderboard',
        'method' => 'GET'
    ]
];