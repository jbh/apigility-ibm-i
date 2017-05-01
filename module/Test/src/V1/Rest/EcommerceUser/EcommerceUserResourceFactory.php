<?php
namespace Test\V1\Rest\EcommerceUser;

class EcommerceUserResourceFactory
{
    public function __invoke($services)
    {
        $mapper = $services->get('Test\V1\Rest\EcommerceUser\EcommerceUserMapper');
        return new EcommerceUserResource($mapper);
    }
}
