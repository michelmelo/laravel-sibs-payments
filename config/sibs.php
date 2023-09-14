<?php

return [
    'mode'           => 'test',
    'host'           => env('SIBS_HOST', ''),
    'version'        => 'v1',
    'authentication' => [
        'userId'   => env('SIBS_AUTH_USERID', ''),
        'password' => env('SIBS_AUTH_PASSWORD', ''),
        'entityId' => env('SIBS_AUTH_ENTITYID', ''),
        'token'    => env('SIBS_AUTH_TOKEN', ''),
    ],
    'entity'  => env('SIBS_ENTITY', ''),
    'webHook' => env('SIBS_WEBHOOK_KEY', ''),
];
