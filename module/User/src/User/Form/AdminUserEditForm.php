<?php
namespace User\Form;

use Zend\Form\Form;

class AdminUserEditForm extends Form{

    public function __construct($em, $institute_id)
    {

        parent::__construct('user');

        $this->setLabelAttributes(array(
            'method' => 'post',
            'class' => 'form-horizontal',
            'role' => 'form',
        ));

        $this->add(array(
            'name' => 'lastname',
            'attributes' => array(
                'type' => 'text',
                'placeholder' => 'Иванов',
                'id' => 'lastname',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Фамилия:',
                'label_attributes' => array(
                    'class' => 'col-sm-2 control-label'
                ),
            ),
        ));

        $this->add(array(
            'name' => 'firstname',
            'attributes' => array(
                'type' => 'text',
                'placeholder' => 'Иван',
                'id' => 'firstname',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Имя:',
                'label_attributes' => array(
                    'class' => 'col-sm-2 control-label'
                ),
            ),
        ));

        $this->add(array(
            'name' => 'secondname',
            'attributes' => array(
                'type' => 'text',
                'placeholder' => 'Иванов',
                'id' => 'secondname',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Отчество:',
                'label_attributes' => array(
                    'class' => 'col-sm-2 control-label'
                ),
            ),
        ));

        $this->add(array(
            'name' => 'email',
            'options' => array(
                'label' => 'eMail:',
                'label_attributes' => array('class' => 'col-sm-2 control-label')
            ),
            'attributes' => array(
                'type' => 'email',
                'placeholder' => 'Введите eMail',
                'id'=>'email',
                'class'=>'form-control',
            )
        ));

        $this->add(array(
            'name' => 'password',
            'attributes' => array(
                'type' => 'password',
                'placeholder' => 'Введите пароль',
                'id'=>'password',
                'class'=>'form-control',
            ),
            'options' => array(
                'label' => 'Пароль',
                'label_attributes' => array('class' => 'col-sm-2 control-label')
            )
        ));

        $this->add(array(
            'name' => 'password-confirm',
            'attributes' => array(
                'type' => 'password',
                'placeholder' => 'Повторите пароль',
                'id' => 'password-confirm',
                'class' => 'form-control'
            ),
            'options' => array(
                'label' => 'Повторите пароль',
                'label_attributes' => array('class'=>'col-sm-2 control-label')
            )
        ));

        $roles = array();
        foreach ($em->getRepository('User\Entity\Role')->findAll() as $value) {
            $roles[$value->getId()] = $value->getName();
            if($value->getRoleId() === 'guest'){
                unset($roles[$value->getId()]);
            }
        }

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'roles',
            'attributes' => array(
                'id'=>'roles',
                'class'=>'form-control pushbootdiv',
                'multiple'=>'multiple',
            ),
            'options' => array(
                'label' => 'Роли',
                'label_attributes' => array('class' => 'col-sm-2 control-label'),
                'value_options'=>$roles

            )
        ));

        $institute = $em->getRepository('Unit\Entity\Unit')->getUnitsArray(0);

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'institute',
            'attributes' => array(
                'id' => 'institute',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Институт',
                'label_attributes' => array(
                    'class' => 'col-sm-2 control-label',
                ),
                'value_options' => $institute,

            )
        ));

        if($institute_id){
            $chair = $em->getRepository('Unit\Entity\Unit')->getUnitsArray($institute_id);
        }else{
            reset($institute);
            $chair = $em->getRepository('Unit\Entity\Unit')->getUnitsArray(key($institute));
        }

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'chair',
            'attributes' => array(
                'id' => 'chair',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Кафедра',
                'label_attributes' => array(
                    'class' => 'col-sm-2 control-label',
                ),
                'empty_option' => 'Не выбрано',
                'value_options' => $chair,
                'disable_inarray_validator' => true,

            )
        ));

    }
}
