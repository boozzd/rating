<?php
/**
 *
 * @package Admin
 *
 */
namespace Admin\Controller;

// use Admin\Model;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 *
 * @package Columndata
 */
class ColumndataController extends AbstractActionController
{
    protected $em;
    /**
     * Index - Columndata
     *
     * @return Zend\View\Model\ViewModel Zend View Model
     */
    public function indexAction()
    {
        $em = $this->getEntityManager();
        $type = $this->params('type');
        $column = $em->getRepository('Admin\Entity\Columndata');

    }

    public function getEntityManager()
    {
        if (null === $this->em) {
            $this->em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        }
        return $this->em;
    }

}