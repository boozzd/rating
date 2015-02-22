<?php
/**
 * 
 * @package User
 * 
 */
namespace User\Controller;

// use User\Model;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Crypt\Password\Bcrypt;
use DoctrineORMModule\Stdlib\Hydrator\DoctrineEntity;

/**
 *
 * @package User
 */
class IndexController extends AbstractActionController
{

    protected $em;
    /**
     * Index - index
     * 
     * @return Zend\View\Model\ViewModel Zend View Model
     */
    public function indexAction()
    {
        $this->getServiceLocator()->get('Zend\View\Renderer\PhpRenderer')->headTitle('Личная страница');
        $em = $this->getEntityManager();
        $id = $this->zfcUserAuthentication()->getIdentity()->getId();
        $user = new \User\Entity\User($id);
        return new ViewModel(array(
            'user' => $user,
        ));
    }

    /**
     * Index - registration
     *
     * @return Zend\View\Model\ViewModel Zend View Model
     *
     */
    public function registrationAction()
    {
        $this->layout('layout/authenticate');
        $this->getServiceLocator()->get('Zend\View\Renderer\PhpRenderer')->headTitle('Регистрация');
        $em = $this->getEntityManager();

        $form = new \User\Form\RegistrationForm($em);

        $user = new \User\Entity\User();

        $request = $this->getRequest();
        $send = false;
        if ($request->isPost()) {
            $form->setInputFilter(new \User\Form\RegistrationFilter($this->getServiceLocator()));
            $data = $request->getPost();

            $form->setData($request->getPost());

            if ($form->isValid()) {

                $user->setEmail($data['email']);
                $user->setUcode(uniqid());
                $user->setUpcode(uniqid());
                $roles = array();
                $data['roles'] = array('2');
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
                $send = true;
            }
        }
        return new ViewModel(array(
            'form' => $form,
            'send' => $send,
        ));
    }

    public function editAction()
    {
        $this->layout()->setVariable('menu_select_sub', 'edit-me');
        $this->getServiceLocator()->get('Zend\View\Renderer\PhpRenderer')->headTitle('Изменение личных данных');
        $em = $this->getEntityManager();

        $id = $this->zfcUserAuthentication()->getIdentity()->getId();

        $user = $em->find('User\Entity\User', $id);

        $form = new \User\Form\UserEditForm($em, $user->getInstitute());
        $form->setHydrator(new DoctrineEntity($em,'User\Entity\User'));
        $form->bind($user);
        $form->setData(array(
            'institute' => $user->getInstitute(),
            'chair' => $user->getChair(),
        ));

        $request = $this->getRequest();

        if($request->isPost()){

            $form->setInputFilter(new \User\Form\UserEditFilter($this->getServiceLocator()));
            $data = $request->getPost();
            $form->setData($data);

            $unit_id = $data['chair'] ? $data['chair'] : $data['institute'];
            $unit = $em->find('Unit\Entity\Unit', $unit_id);
            $user->setUnit($unit);

            if($form->isValid()){

                $em->persist($user);
                $em->flush();

                return $this->redirect()
                    ->toUrl($this->url()->fromRoute('user', array('action' => 'edit')) . '#save-success');
            }else{
                return $this->redirect()
                    ->toUrl($this->url()->fromRoute('user', array('action' => 'edit')) . '#remove-success');
            }

        }

        return new ViewModel(array(
            'form' => $form,
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