<?php
return [
    'zf-content-negotiation' => [
        'selectors' => [],
    ],
    'db' => [
        'adapters' => [
            'dummy' => [],
            'ibmdb' => [],
        ],
    ],
    'zf-oauth2' => [
        'storage_settings' => [
            'client_table' => 'filesrdb.oauth_clients',
            'access_token_table' => 'filesrdb.oauth_access_tokens',
            'refresh_token_table' => 'filesrdb.oauth_refresh_tokens',
            'code_table' => 'filesrdb.oauth_codes',
            'user_table' => 'filesrdb.oauth_users',
            'jwt_table' => 'filesrdb.oauth_jwt',
            'scope_table' => 'filesrdb.oauth_scopes',
        ]
    ],
    'router' => [
        'routes' => [
            'oauth' => [
                'options' => [
                    'spec' => '%oauth%',
                    'regex' => '(?P<oauth>(/oauth))',
                ],
                'type' => 'regex',
            ],
        ],
    ],
];
