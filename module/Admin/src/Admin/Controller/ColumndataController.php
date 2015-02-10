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
use Zend\View\Model\JsonModel;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use Zend\Paginator\Paginator;
use DoctrineORMModule\Stdlib\Hydrator\DoctrineEntity;


/**
 *
 * @package Columndata
 */
class ColumndataController extends AbstractActionController
{
    protected $em;
    /**
     * Index- Columndata
     *
     * @return \Zend\View\Model\ViewModel Zend View Model
     */
    public function indexAction()
    {
        $this->getServiceLocator()->get('Zend\View\Renderer\PhpRenderer')->headTitle('Данные заполнения');
        $em = $this->getEntityManager();
        $type = $this->params('type');
        $page = $this->params('page');
        $this->layout()->setVariable('menu_select_sub', 'admin-'.$type);
        $column = $em->getRepository('Admin\Entity\Columndata');
        $data = $column->getColumnDataByType($type);
        $types = $column->getTypes();
        $paginator = new Paginator(
            new DoctrinePaginator(new ORMPaginator($data))
        );

        $paginator
            ->setCurrentPageNumber($page)
            ->setItemCountPerPage(20);
        return new ViewModel(array(
            'column' => $paginator,
            'types' => $types,
            'type' => $type
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
        $type = $this->params('type');
        $id = $this->params('id');
        $this->layout()->setVariable('menu_select_sub', 'admin-'.$type);
        $em = $this->getEntityManager();
        if($id!=0){
            $column = $em->find('Admin\Entity\Columndata', $id);

        }else{
            $column = new \Admin\Entity\Columndata();
            $column->setType($type);
        }

        $form = new \Admin\Form\BaseEditForm($em);
        $form->setHydrator(new DoctrineEntity($em,'Admin\Entity\Columndata'));
        $form->bind($column);

        $request = $this->getRequest();

        if($request->isPost()){

            $form->setInputFilter(new \Admin\Form\BaseEditFilter($this->getServiceLocator()));
            $data = $request->getPost();
            $form->setData($data);

            if($form->isValid()){

                $em->persist($column);
                $em->flush();
                $id = $column->getId();
                return $this->redirect()
                    ->toUrl($this->url()->fromRoute('column-data-edit', array('action' => 'edit', 'id' => $id, 'type' => $type)) . '#save-success');
            }
        }
        return new ViewModel(array(
            'form' => $form,
            'column' => $column,
            'type' => $type
        ));
    }

    /**
     * Admin - user show
     * @return \Zend\View\Model\JsonModel
     */
    public function showAction(){
        $id = (int)$this->params('id',null);
        $act = $this->params()->fromPost('act', true);
        if($act && $act!='false')
            $act = true;
        else $act = false;

        $em = $this->getEntityManager();
        $column = $em->find('Admin\Entity\Columndata', $id);
        $column->setIsActive($act);
        $em->persist($column);
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