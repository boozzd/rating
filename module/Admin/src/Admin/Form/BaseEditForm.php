<?php
namespace Admin\Form;

use Zend\Form\Form;

class BaseEditForm extends Form{

    public function __construct($em)
    {

        parent::__construct('base');

        $this->setLabelAttributes(array(
            'method' => 'post',
            'class' => 'form-horizontal',
            'role' => 'form',
        ));

        $this->add(array(
            'name' => 'name',
            'attributes' => array(
                'type' => 'text',
                'placeholder' => 'название',
                'id' => 'name',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Название:',
                'label_attributes' => array(
                    'class' => 'col-sm-2 control-label'
                ),
            ),
        ));

    }
}
