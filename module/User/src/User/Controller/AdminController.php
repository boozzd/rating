<?php
/**
 *
 * @package User
 *
 */
namespace User\Controller;


use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Zend\Crypt\Password\Bcrypt;
use DoctrineORMModule\Stdlib\Hydrator\DoctrineEntity;

use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use Zend\Paginator\Paginator;

/**
 *
 * @package User
 */
class AdminController extends AbstractActionController
{

    protected $em;

    public function onDispatch( \Zend\Mvc\MvcEvent $e ){

        $this->getServiceLocator()->get(
            'Zend\View\Renderer\PhpRenderer')
            ->headTitle('Управление пользователями');

        $this->getServiceLocator()->get('viewhelpermanager')
            ->get('headScript')
            ->prependFile('/js/admin_user.js');

        $this->layout()->setVariable('menu_select_sub', 'users');
        return parent::onDispatch( $e );
    }

    /**
     * Admin - user index
     *
     * @return \Zend\View\Model\ViewModel Zend View Model
     */
    public function indexAction(){
        $this->layout()->setVariable('menu_select_sub', 'admin-users');
        $page = $this->params('page',1);
        $role = $this->params('role',null);
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        $qb->select('u')
            ->from('User\Entity\User', 'u')
            ->where('u.isDelete =  false');
        if($role){
            $qb->leftJoin('u.roles','r', "WITH")
                ->where('r.id =:role')
                ->andWhere('u.isDelete = false')
                ->setParameter('role', (int)$role);
        }
        $paginator = new Paginator(
            new DoctrinePaginator(new ORMPaginator($qb))
        );

        $paginator
            ->setCurrentPageNumber($page)
            ->setItemCountPerPage(20);
        $qb = $em->createQueryBuilder();

        $qb->select('r')
            ->from('User\Entity\Role', 'r');
        $roles = $qb->getQuery()->getResult();
        return new ViewModel(array(
            'users'=>$paginator,
            'page'=>$page,
            'roles'=>$roles,
            'role'=>$role,
        ));
    }

    /**
     * Admin - user edit
     *
     * @return \Zend\View\Model\ViewModel Zend View Model
     *
     */


    public function editAction()
    {
        $this->layout()->setVariable('menu_select_sub', 'admin-users');
        $id = $this->params('id');
        $em = $this->getEntityManager();
        $form = new \User\Form\AdminUserEditForm($em);
        if($id!=0){
            $user = $em->find('User\Entity\User', $id);

        }else $user = new \User\Entity\User();

        $form->setData(array(
            'email'=>$user->getEmail(),
            'roles'=>array_map(function($r){ return $r->getId(); }, $user->getRoles()),
            'lastname'=>$user->getLastname(),
            'firstname'=>$user->getFirstname(),
            'secondname'=>$user->getSecondname(),
        ));

        $request = $this->getRequest();
        if ($request->isPost()) {
            $data = $request->getPost();
            $form->setData($data);
            $form->setInputFilter(new \User\Form\AdminUserEditFilter($this->getServiceLocator()));
            if ($form->isValid()) {
                $user->setEmail($data['email']);
                $user->setLastname($data['lastname']);
                $user->setFirstname($data['firstname']);
                $user->setSecondname($data['secondname']);
                $roles = array();
                foreach ($data['roles'] as $value) {
                    $roles[] = $em->find('User\Entity\Role', $value);
                }
                $user->setRoles($roles);
                $bcrypt = new Bcrypt();
                $bcrypt->setCost(14);
                if (isset($data['password']) && $data['password'] != "")
                    $user->setPassword($bcrypt->create($data['password']));
                $em->persist($user);
                $em->flush();

                return $this->redirect()
                    ->toUrl($this->url()->fromRoute('admin-user', array('action' => 'edit', 'id' => $id)) . '#save-success');
            }
        }

        return new ViewModel(array(
            'user'=>$user,
            'form'=>$form
        ));
    }

    /**
     * Admin - user show
     * @return \Zend\View\Model\JsonModel
     */
    public function usershowAction(){
        $id = $this->params()->fromPost('id',null);
        $act = $this->params()->fromPost('act', true);
        if($act && $act!='false')
            $act = true;
        else $act = false;

        $em = $this->getEntityManager();
        $user = $em->find('User\Entity\User', $id);
        $user->setIsActive($act);
        $em->persist($user);
        $em->flush();
        return new JsonModel(array(
            'status'=> 'ok'
        ));
    }

    /**
     * Admin - user delete
     * @return \Zend\View\Model\JsonModel
     */
    public function userdeleteAction()
    {
        $id = $this->params()->fromPost('id', null);
        $em = $this->getEntityManager();
        $user = $em->find('User\Entity\User', $id);
        $email = explode('@',$user->getEmail());
        $new_email = $email[0].'_'.$user->getId().'@'.$email[1];
        $user->setIsActive(false);
        $user->setIsDelete(true);
        $user->setEmail($new_email);
        $em->persist($user);
        $em->flush();
        return new JsonModel(array(
            'status' => 'ok'
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