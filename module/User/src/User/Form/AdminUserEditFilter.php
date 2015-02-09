<?php
namespace User\Form;

use Zend\InputFilter\InputFilter;

class AdminUserEditFilter extends InputFilter{

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
            'name'     => 'email',
            'required' => true,
            'filters'  => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name'    => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min'      => 3,
                        'max'      => 100,
                    ),
                ),
                array(
                    'name' => 'EmailAddress',
                )
            ),
        ));

        $this->add(array(
            'name' => 'password',
            'required' => false,
            'filters' => array(
                array('name' => 'StripTags'),
                array('name'=> 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name' => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min' => 6,
                        'max' => 100,
                    )
                ),
            )
        ));

        $this->add(array(
            'name' => 'password-confirm',
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
                        'min' => 6,
                        'max' => 100,
                    ),
                ),
                array(
                    'name' => 'Identical',
                    'options' => array(
                        'token' => 'password',
                        'messages' => array(
                            \Zend\Validator\Identical::NOT_SAME => 'Введенные пароли не совпадают.',
                        ),
                    ),

                ),
            )
        ));
    }
}
