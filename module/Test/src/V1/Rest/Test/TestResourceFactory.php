<?php
namespace Test\V1\Rest\Test;

class TestResourceFactory
{
    /**
     * @param \Zend\ServiceManager\ServiceManager $services
     * @return TestResource
     */
    public function __invoke($services)
    {
        $db = $services->get('ibmdb');
        return new TestResource($db);
    }
}
