<?php
namespace User\Form;

use Zend\Form\Form;

class UserEditForm extends Form{

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
