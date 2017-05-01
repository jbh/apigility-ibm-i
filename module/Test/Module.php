<?php
namespace Test;

use ZF\Apigility\Provider\ApigilityProviderInterface;

class Module implements ApigilityProviderInterface
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return [
            'ZF\Apigility\Autoloader' => [
                'namespaces' => [
                    __NAMESPACE__ => __DIR__ . '/src',
                ],
            ],
        ];
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'Test\V1\Rest\EcommerceUser\EcommerceUserMapper' =>  function ($sm) {
                    $adapter = $sm->get('ibmdb');
                    return new \Test\V1\Rest\EcommerceUser\EcommerceUserMapper($adapter);
                },
            ),
        );
    }
}
