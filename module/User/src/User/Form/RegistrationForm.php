<?php
namespace User\Form;

use Zend\Form\Form;


class RegistrationForm extends Form{


    public function __construct($em)
    {
        parent::__construct('user');
        $this->setAttribute('method', 'post');
        $this->setAttribute('class', 'form-signin');
        $this->setAttribute('role', 'form');

        $this->add(array(
            'name' => 'email',
            'options' => array(
                'label' => 'eMail:',
                'label_attributes' => array('class' => '')
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
                'label_attributes' => array('class' => 'f')
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
                'label_attributes' => array('class'=>'')
            )
        ));

        $this->add(array(
            'name' => 'captcha',
            'type' => 'Zend\Form\Element\Captcha',
            'attributes' =>array(
                'id' => 'captcha',
                'class' => 'form-control captcha-input',
            ),
            'options' => array(
                'captcha' => new \Zend\Captcha\Image(array(
                    'imgDir' => './public/img/captcha',
                    'ImgUrl' => '/img/captcha',
                    'width' => 300,
                    'height' => 60,
                    'wordlen' => 5,
                    'dotNoiseLevel' => 30,
                    'lineNoiseLevel' => 3,
                    'font' => './public/fonts/arial.ttf',
                    'fontSize' => 32,
                    'expiration' => 600,
                )),
                'label' => 'Введите символы с картинки:',
                'label_attributes' => array('class'=>'captcha-text clearfix'),
            ),
        ));



    }
}
        
