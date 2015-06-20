<?php
namespace Application\Form;

use Zend\Form\Form;

class Post extends Form
{
    public function __construct()
    {
        parent::__construct('post');
        $this->setAttribute('method', 'post');
        $this->setAttribute('action', '/post/save');
    
        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type'  => 'hidden',
            ),
        ));
    
        $this->add(array(
            'name' => 'title',
            'attributes' => array(
                'type'  => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Título',
                'class' => 'control-label',
            ),
        ));
        $this->add(array(
            'name' => 'description',
            'attributes' => array(
                'type'  => 'textarea',
                'class' => 'form-control'
            ),
            'options' => array(
                'label' => 'Texto do post',
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