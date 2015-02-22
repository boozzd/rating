<?php
namespace User\Form;

use Zend\InputFilter\InputFilter;

class UserEditFilter extends InputFilter{

    public function __construct($sm){



        $this->add(array(
            'name' => 'lastname',
            'required' => false,
            'filters' => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name' => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'max' => 100,
                    ),
                ),
            ),
        ));

        $this->add(array(
            'name' => 'firstname',
            'required' => false,
            'filters' => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name' => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'max' => 100,
                    ),
                ),
            ),
        ));

        $this->add(array(
            'name' => 'secondname',
            'required' => false,
            'filters' => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name' => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'max' => 100,
                    ),
                ),
            ),
        ));

        $this->add(array(
            'name' => 'institute',
            'required' => true,
        ));

        $this->add(array(
            'name' => 'chair',
            'required' => false,
        ));
    }
}
