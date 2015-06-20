<?php
namespace Application\Form;

use Zend\Form\Form;
use Application\Form\Post as PostForm;

class Comment extends Form
{
    public function __construct()
    {
        parent::__construct('comment');
        $this->setAttribute('method', 'post');
        $this->setAttribute('action', '/comment/save');

        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type'  => 'hidden',
            ),
        ));

        $this->add(array(
            'name' => 'postid',
            'attributes' => array(
                'class' => 'form-control',
                'type' => 'number'
            ),
            'options' => array(
                'label' => 'Posts',
                'class' => 'form-control',
            ),
        ));
    
        $this->add(array(
            'name' => 'description',
            'attributes' => array(
                'type'  => 'textarea',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Descrição',
                'class' => 'control-label',
            ),
        ));
        $this->add(array(
            'name' => 'name',
            'attributes' => array(
                'type'  => 'text',
                'class' => 'form-control'
            ),
            'options' => array(
                'label' => 'Nome',
                'class' => 'control-label'
            ),
        ));

        $this->add(array(
            'name' => 'email',
            'attributes' => array(
                'type'  => 'email',
                'class' => 'form-control'
            ),
            'options' => array(
                'label' => 'Email',
                'class' => 'control-label'
            ),
        ));

        $this->add(array(
            'name' => 'webpage',
            'attributes' => array(
                'type'  => 'text',
                'class' => 'form-control'
            ),
            'options' => array(
                'label' => 'Webpage',
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