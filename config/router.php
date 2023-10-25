<?php

return [
    [
        'verb' => 'POST',
        'pattern' => '/api/heartbeat',
        'route' => 'system/heartbeat'
    ],
    [
        'verb' => 'POST',
        'pattern' => '/api/sysinfo',
        'route' => 'system/sysinfo'
    ],
    [
        'verb' => 'POST',
        'pattern' => '/api/login',
        'route' => 'login/index'
    ],
    [
        'verb' => 'POST',
        'pattern' => '/api/logout',
        'route' => 'login/logout'
    ],
    [
        'verb' => 'GET',
        'pattern' => '/api/login-options',
        'route' => 'login/options'
    ],
    [
        'verb' => 'POST',
        'pattern' => '/api/currentUser',
        'route' => 'user/index'
    ],
    [
        'verb' => 'GET',
        'pattern' => '/api/users',
        'route' => 'user/users'
    ],
    [
        'verb' => 'GET',
        'pattern' => '/api/peers',
        'route' => 'peer/peers'
    ],
    [
        'verb' => 'GET',
        'pattern' => '/api/ab',
        'route' => 'address-book/pull'
    ],
    [
        'verb' => 'POST',
        'pattern' => '/api/ab',
        'route' => 'address-book/push'
    ],
    [
        'verb' => 'POST',
        'pattern' => '/api/audit/conn',
        'route' => 'audit/conn'
    ],
];