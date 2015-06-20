<?php
namespace Application\Form;

use Zend\Form\Form;
use Zend\Form\Element;
use Zend\Form\Element\MultiCheckbox;

class User extends Form
{
    public function __construct()
    {
        parent::__construct('user');
        $this->setAttribute('method', 'post');
        $this->setAttribute('action', '/user/save');
    
        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type'  => 'hidden',
            ),
        ));
    
        $this->add(array(
            'name' => 'username',
            'attributes' => array(
                'type'  => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Username',
                'class' => 'control-label',
            ),
        ));
        $this->add(array(
            'name' => 'password',
            'attributes' => array(
                'type'  => 'password',
                'class' => 'form-control'
            ),
            'options' => array(
                'label' => 'Password',
                'class' => 'control-label'
            ),
        ));
        $this->add(array(
            'name' => 'name',
            'attributes' => array(
                'type'  => 'text',
                'class' => 'form-control'
            ),
            'options' => array(
                'label' => 'Name',
                'class' => 'control-label'
            ),
        ));
        $this->add(array(
            'name' => 'valid',
            'type' => 'Zend\Form\Element\Radio',
            'options' => array(
                'label' => 'Valid',
                'class' => 'control-label',
                'value_options' => array(
                    '0' => 'No',
                    '1' => 'Yes',
                )
            ),
        ));
        $this->add(array(
            'name' => 'role',
            'attributes' => array(
                'type'  => 'text',
                'class' => 'form-control'
            ),
            'options' => array(
                'label' => 'Role',
                'class' => 'control-label'
            ),
        ));
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Enviar',
                'id' => 'submitbutton',
                'class' => 'btn btn-success'
            ),
        ));
    }
}