<?php
namespace User\Form;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use DoctrineModule\Validator\NoObjectExists;



class RegistrationFilter extends InputFilter
{
    public function __construct($sm)
    {
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
                    'name' => '\DoctrineModule\Validator\NoObjectExists',
                    'options' => array(
                        'object_repository' => $sm->get('doctrine.entitymanager.orm_default')->getRepository('User\Entity\User'),
                        'fields' => array('email'),
                        'messages' => array(
                            'objectFound' => 'Пользователь с таким e-mail уже зарегистрирован.',
                        ),
                    ),

                ),
                array(
                    'name' => 'EmailAddress',
                )
            ),
        ));

        $this->add(array(
            'name' => 'password',
            'required' => true,
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
            'required' => true,
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