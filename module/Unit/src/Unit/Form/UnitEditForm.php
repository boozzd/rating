<?php
namespace Unit\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class UnitEditForm extends Form{

    public function __construct($em, $id)
    {

        parent::__construct('unit');

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

        $institute = $em->getRepository('Unit\Entity\Unit')->getUnitsArray(0);
        array_unshift($institute, 'Не выбрано');

        if($id > 0){
            unset($institute[$id]);
        }

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

    }
}
