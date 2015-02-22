<?php
/**
 *
 * @package Unit
 *
 */
namespace Unit\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use Zend\Paginator\Paginator;
use DoctrineORMModule\Stdlib\Hydrator\DoctrineEntity;


/**
 *
 * @package Unit
 */
class AdminController extends AbstractActionController
{
    protected $em;
    /**
     * Admin- index
     *
     * @return \Zend\View\Model\ViewModel Zend View Model
     */
    public function indexAction()
    {
        $this->getServiceLocator()->get('Zend\View\Renderer\PhpRenderer')->headTitle('Институты и кафедры');
        $em = $this->getEntityManager();
        $page = $this->params('page');
        $this->layout()->setVariable('menu_select_sub', 'admin-unit');
        $unit = $em->getRepository('Unit\Entity\Unit');
        $data = $unit->getUnits(0);
        $paginator = new Paginator(
            new DoctrinePaginator(new ORMPaginator($data))
        );
        $paginator
            ->setCurrentPageNumber($page)
            ->setItemCountPerPage(10);
        return new ViewModel(array(
            'units' => $paginator,
        ));

    }

    /**
     * Edit - Columndata
     *
     * @return \Zend\View\Model\ViewModel
     */
    public function editAction()
    {
        $this->getServiceLocator()->get('Zend\View\Renderer\PhpRenderer')->headTitle('Изменение данных');
        $this->layout()->setVariable('menu_select_sub', 'admin-unit-edit');

        $id = $this->params('id');

        $em = $this->getEntityManager();
        $form = new \Unit\Form\UnitEditForm($em, $id);

        if($id!=0){
            $unit = $em->find('Unit\Entity\Unit', $id);
            $form->setHydrator(new DoctrineEntity($em,'Unit\Entity\Unit'));
            $form->bind($unit);
            if($unit->getParent()){
                $form->setData(array('institute'=> $unit->getParent()->getId()));
            }
        }else{
            $unit = new \Unit\Entity\Unit();
        }

        $request = $this->getRequest();

        if($request->isPost()){

            $form->setInputFilter(new \Unit\Form\UnitEditFilter($this->getServiceLocator()));
            $data = $request->getPost();
            $form->setData($data);

            if($form->isValid()){

                $unit->setName($data['name']);

                if($data['institute']){
                    $parent = $em->find('Unit\Entity\Unit', $data['institute']);
                    $unit->setParent($parent);
                }

                $em->persist($unit);
                $em->flush();
                $id = $unit->getId();
                return $this->redirect()
                    ->toUrl($this->url()->fromRoute('admin-unit-edit', array('action' => 'edit', 'id' => $id)) . '#save-success');
            }
        }
        return new ViewModel(array(
            'form' => $form,
            'unit' => $unit,
        ));
    }

    /**
     * Admin - show
     * @return \Zend\View\Model\JsonModel
     */
    public function showAction(){
        $id = (int)$this->params('id',null);
        $act = $this->params()->fromPost('act', true);
        if($act && $act!='false')
            $act = true;
        else $act = false;

        $em = $this->getEntityManager();
        $unit = $em->find('Unit\Entity\Unit', $id);
        $unit->setIsActive($act);
        $em->persist($unit);
        $em->flush();
        return new JsonModel(array(
            'status'=> 'ok'
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