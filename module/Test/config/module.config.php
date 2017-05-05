<?php
return [
    'service_manager' => [
        'factories' => [
            \Test\V1\Rest\Test\TestResource::class => \Test\V1\Rest\Test\TestResourceFactory::class,
            \Test\V1\Rest\EcommerceUser\EcommerceUserResource::class => \Test\V1\Rest\EcommerceUser\EcommerceUserResourceFactory::class,
        ],
    ],
    'router' => [
        'routes' => [
            'test.rest.test' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/test[/:test_id]',
                    'defaults' => [
                        'controller' => 'Test\\V1\\Rest\\Test\\Controller',
                    ],
                ],
            ],
            'test.rest.ecommerce-user' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/ecommerce-user[/:ecommerce_user_id]',
                    'defaults' => [
                        'controller' => 'Test\\V1\\Rest\\EcommerceUser\\Controller',
                    ],
                ],
            ],
        ],
    ],
    'zf-versioning' => [
        'uri' => [
            0 => 'test.rest.test',
            1 => 'test.rest.ecommerce-user',
        ],
    ],
    'zf-rest' => [
        'Test\\V1\\Rest\\Test\\Controller' => [
            'listener' => \Test\V1\Rest\Test\TestResource::class,
            'route_name' => 'test.rest.test',
            'route_identifier_name' => 'test_id',
            'collection_name' => 'test',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \Test\V1\Rest\Test\TestEntity::class,
            'collection_class' => \Test\V1\Rest\Test\TestCollection::class,
            'service_name' => 'Test',
        ],
        'Test\\V1\\Rest\\EcommerceUser\\Controller' => [
            'listener' => \Test\V1\Rest\EcommerceUser\EcommerceUserResource::class,
            'route_name' => 'test.rest.ecommerce-user',
            'route_identifier_name' => 'ecommerce_user_id',
            'collection_name' => 'ecommerce_user',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [
                0 => 'sort',
                1 => 'username',
                2 => 'usersWithUsernameLike',
            ],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \Test\V1\Rest\EcommerceUser\EcommerceUserEntity::class,
            'collection_class' => \Test\V1\Rest\EcommerceUser\EcommerceUserCollection::class,
            'service_name' => 'EcommerceUser',
        ],
    ],
    'zf-content-negotiation' => [
        'controllers' => [
            'Test\\V1\\Rest\\Test\\Controller' => 'HalJson',
            'Test\\V1\\Rest\\EcommerceUser\\Controller' => 'HalJson',
        ],
        'accept_whitelist' => [
            'Test\\V1\\Rest\\Test\\Controller' => [
                0 => 'application/vnd.test.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
            'Test\\V1\\Rest\\EcommerceUser\\Controller' => [
                0 => 'application/vnd.test.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
        ],
        'content_type_whitelist' => [
            'Test\\V1\\Rest\\Test\\Controller' => [
                0 => 'application/vnd.test.v1+json',
                1 => 'application/json',
            ],
            'Test\\V1\\Rest\\EcommerceUser\\Controller' => [
                0 => 'application/vnd.test.v1+json',
                1 => 'application/json',
            ],
        ],
    ],
    'zf-hal' => [
        'metadata_map' => [
            \Test\V1\Rest\Test\TestEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'test.rest.test',
                'route_identifier_name' => 'test_id',
                'hydrator' => \Zend\Hydrator\ArraySerializable::class,
            ],
            \Test\V1\Rest\Test\TestCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'test.rest.test',
                'route_identifier_name' => 'test_id',
                'is_collection' => true,
            ],
            \Test\V1\Rest\EcommerceUser\EcommerceUserEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'test.rest.ecommerce-user',
                'route_identifier_name' => 'ecommerce_user_id',
                'hydrator' => \Zend\Hydrator\ArraySerializable::class,
            ],
            \Test\V1\Rest\EcommerceUser\EcommerceUserCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'test.rest.ecommerce-user',
                'route_identifier_name' => 'ecommerce_user_id',
                'is_collection' => true,
            ],
        ],
    ],
    'zf-content-validation' => [
        'Test\\V1\\Rest\\EcommerceUser\\Controller' => [
            'input_filter' => 'Test\\V1\\Rest\\EcommerceUser\\Validator',
        ],
    ],
    'input_filter_specs' => [
        'Test\\V1\\Rest\\EcommerceUser\\Validator' => [
            0 => [
                'required' => false,
                'validators' => [],
                'filters' => [],
                'name' => 'id',
                'description' => 'ID of user. USER_ID in data table.',
            ],
            1 => [
                'required' => true,
                'validators' => [],
                'filters' => [],
                'name' => 'username',
            ],
            2 => [
                'required' => true,
                'validators' => [],
                'filters' => [],
                'name' => 'email',
            ],
            3 => [
                'required' => false,
                'validators' => [],
                'filters' => [],
                'name' => 'first_name',
            ],
            4 => [
                'required' => false,
                'validators' => [],
                'filters' => [],
                'name' => 'last_name',
            ],
            5 => [
                'required' => false,
                'validators' => [],
                'filters' => [],
                'name' => 'created_at',
            ],
            6 => [
                'required' => false,
                'validators' => [],
                'filters' => [],
                'name' => 'modified_at',
            ],
        ],
    ],
    'controllers' => [
        'factories' => [],
    ],
    'zf-rpc' => [],
];
