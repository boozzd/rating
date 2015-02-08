<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace User;

use Zend\Mvc\MvcEvent;
use BjyAuthorize\View\RedirectionStrategy;
use Zend\Validator\AbstractValidator;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();

        $strategy = new RedirectionStrategy();

        // eventually set the route name (default is ZfcUser's login route)
        $strategy->setRedirectRoute('zfcuser-login');

        $eventManager->attach($strategy);

        $serviceManager = $e->getApplication()->getServiceManager();
        $viewModel = $e->getApplication()->getMvcEvent()->getViewModel();

        $auth = $serviceManager->get('zfcuser_auth_service');
        if($auth->hasIdentity()){
            $viewModel->auth = $auth->getIdentity();
        }

        /**
         * Change layout on login action
         */
        $eventManager->attach(MvcEvent::EVENT_ROUTE, function(MvcEvent $e){
            $routeMatch = $e->getRouteMatch();
            $controller = $routeMatch->getParam('controller');
            $action    = $routeMatch->getParam('action');
            if($controller == 'zfcuser' && $action == 'login'){
                $e->getViewModel()->setTemplate('layout/authenticate');
            }
        });

        /**
         * Translate for form error and captcha translate
         */
        $translator=$e->getApplication()->getServiceManager()->get('translator');
        $translator->addTranslationFile(
            'phpArray',
            './vendor/zendframework/zendframework/resources/languages/ru/Zend_Validate.php'
        );
        $translator->addTranslationFile(
            'phpArray',
            './vendor/zendframework/zendframework/resources/languages/ru/Zend_Captcha.php'
        );
        AbstractValidator::setDefaultTranslator($translator);
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
}
