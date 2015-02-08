<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    private $em;

    public function indexAction()
    {
        $this->getServiceLocator()->get('Zend\View\Renderer\PhpRenderer')->headTitle('Личная страница');
        $em = $this->getEntityManager();

        $id = $this->zfcUserAuthentication()->getIdentity()->getId();
        $user = $em->find('User\Entity\User', $id);

        return new ViewModel(array(
            'user' => $user,
        ));
    }

    public function getEntityManager()
    {
        if (null === $this->em) {
            $this->em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        }
        return $this->em;
    }
}
