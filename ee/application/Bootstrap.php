<?php

/**
 * Class Bootstrap
 */
require_once 'controllers/AdminController.php';

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    /**
     * @return Zend_Loader_Autoloader
     */
    protected function _initLoaderResources()
    {
        $autoLoader = Zend_Loader_Autoloader::getInstance();
        $path = realpath(APPLICATION_PATH . '/../..');

        $moduleNames = [
            'users'
        ];

        $modulePath = $path . '/ee/application/modules/';
        $defaultResourceType = [
            'forms' => [
                'path' => 'forms/',
                'namespace' => 'Forms',
            ],
            'service' => [
                'path' => 'service',
                'namespace' => 'Service',
            ],
        ];

        foreach ($moduleNames as $moduleName) {

            new Zend_Loader_Autoloader_Resource([
                'basePath' => $modulePath . strtolower(preg_replace('/([a-zA-Z])(?=[A-Z])/', '$1-', $moduleName)),
                'namespace' => ucfirst($moduleName),
                'resourceTypes' => $defaultResourceType,
            ]);
        }

        // Return it so that it can be stored by the bootstrap
        return $autoLoader;
    }
}
