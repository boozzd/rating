<?php
/**
 * 
 * @package Unit
 * 
 */
namespace Unit\Controller;

// use Admin\Model;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;

class IndexController extends AbstractActionController
{
    protected $em;
    /**
     * Index - Index
     * 
     * @return \Zend\View\Model\ViewModel Zend View Model
     */
    public function indexAction()
    {
    }

    /**
     * Index - GetChildrenUnit
     *
     * @return \Zend\View\Model\JsonModel
     */
    public function getchildrenunitsAction()
    {
        $id = $this->params()->fromPost('id', null);
        if($id){
            $em = $this->getEntityManager();
            $unit = $em->getRepository('Unit\Entity\Unit')->getUnitsArray($id);
            return new JsonModel(array(
                'result'=> $unit,
            ));
        }
        return new JsonModel();
    }

    public function getEntityManager()
    {
        if (null === $this->em) {
            $this->em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        }
        return $this->em;
    }
  
}