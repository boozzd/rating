<?php
namespace User\Form;

use Zend\Form\Form;

class UserEditForm extends Form{

    public function __construct($em)
    {

        parent::__construct('edit');

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
                'id' => 'key',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Фамилия:',
                'label_attributes' => array(
                    'class' => ''
                ),
            ),
        ));

        $this->add(array(
            'name' => 'firstname',
            'attributes' => array(
                'type' => 'text',
                'placeholder' => 'Иван',
                'id' => 'key',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Имя:',
                'label_attributes' => array(
                    'class' => ''
                ),
            ),
        ));

        $this->add(array(
            'name' => 'secondname',
            'attributes' => array(
                'type' => 'text',
                'placeholder' => 'Иванов',
                'id' => 'key',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Отчество:',
                'label_attributes' => array(
                    'class' => ''
                ),
            ),
        ));
    }
}
