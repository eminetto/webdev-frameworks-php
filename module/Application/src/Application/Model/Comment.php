<?php

namespace Application\Model;

 use Zend\InputFilter\InputFilter;
 use Zend\InputFilter\InputFilterAwareInterface;
 use Zend\InputFilter\InputFilterInterface;

 class Comment implements InputFilterAwareInterface
 {
     public $id;
     public $description;
     public $post_id;
     public $name;
     public $email;
     public $webpage;
     public $comment_date;
     private $inputFilter;

     public function exchangeArray($data)
     {
        $this->id     = (!empty($data['id'])) ? $data['id'] : null;
        $this->description = (!empty($data['description'])) ? $data['description'] : null;
        $this->post_id  = (!empty($data['postid'])) ? $data['postid'] : null;
        $this->name  = (!empty($data['name'])) ? $data['name'] : null;
        $this->email  = (!empty($data['email'])) ? $data['email'] : null;
        $this->webpage  = (!empty($data['webpage'])) ? $data['webpage'] : null;
        $this->comment_date  = (!empty($data['comment_date'])) ? $data['comment_date'] : null;
     }

     public function setInputFilter(InputFilterInterface $inputFilter)
         {
                 throw new \Exception("NÃ£o usado");
         }

         /**
         * Configura os filtros dos campos da classe
         *
         * @return Zend\InputFilter\InputFilter
         */
        public function getInputFilter()
        {
                if (!$this->inputFilter) {
                        $inputFilter = new InputFilter();
 
                        $inputFilter->add(array(
                                'name'     => 'id',
                                'required' => true,
                                'filters'  => array(
                                    array('name' => 'Int'),
                                ),
                        ));
 
                        $inputFilter->add(array(
                                'name'     => 'description',
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
                                                        'min'      => 1,
                                                        'max'      => 100,
                                                ),
                                        ),
                                ),
                        ));
 
                        $inputFilter->add(array(
                                'name'     => 'name',
                                'required' => true,
                                'filters'  => array(
                                        array('name' => 'StripTags'),
                                        array('name' => 'StringTrim'),
                                ),
                        ));
                        $inputFilter->add(array(
                                'name'     => 'email',
                                'required' => true,
                                'filters'  => array(
                                        array('name' => 'StripTags'),
                                        array('name' => 'StringTrim'),
                                ),
                        ));
                        $inputFilter->add(array(
                                'name'     => 'webpage',
                                'required' => true,
                                'filters'  => array(
                                        array('name' => 'StripTags'),
                                        array('name' => 'StringTrim'),
                                ),
                        ));

                        $inputFilter->add(array(
                                'name'     => 'comment_date',
                                'required' => false,
                                'filters'  => array(
                                        array('name' => 'StripTags'),
                                        array('name' => 'StringTrim'),
                                ),
                        ));
 
                        $inputFilter->add(array(
                                'name'     => 'postid',
                                'required' => true,
                                'filters'  => array(
                                    array('name' => 'Int'),
                                ),
                        ));
 
                        $this->inputFilter = $inputFilter;
                }
 
                return $this->inputFilter;
        }

        public function getArrayCopy()
        {
                return get_object_vars($this);
        }
 }