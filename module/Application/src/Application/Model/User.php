<?php

namespace Application\Model;

 use Zend\InputFilter\InputFilter;
 use Zend\InputFilter\InputFilterAwareInterface;
 use Zend\InputFilter\InputFilterInterface;

 class User implements InputFilterAwareInterface
 {
		 private $id;
		 private $username;
		 private $password;
		 private $name;
		 private $valid;
		 private $role;
		 private $inputFilter;

		private function __constructor($id, $username, $password, $name, $valid, $role){
		 	$this->id = $id;
		 	$this->username = $username;
		 	$this->password = $password;
		 	$this->name = $name;
		 	$this->valid = $valid;
		 	$this->role = $role;
		}

		 //usado pelo TableGateway
		public function exchangeArray($data)
		{
			$id     = (!empty($data['id'])) ? $data['id'] : null;
			$username = (!empty($data['username'])) ? $data['username'] : null;
			$password  = (!empty($data['password'])) ? $data['password'] : null;
			$name  = (!empty($data['name'])) ? $data['name'] : null;
			$valid  = (!empty($data['valid'])) ? $data['valid'] : 0;
			$role  = (!empty($data['role'])) ? $data['role'] : null;
			self::__constructor($id, $username, $password, $name, $valid, $role);
		}

		 // Exigido pela implementaÃ§Ã£o da interface InputFilterAwareInterface
		 public function setInputFilter(InputFilterInterface $inputFilter)
		 {
				 throw new \Exception("Não usado");
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
								'name'     => 'username',
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
											'min' => 4,
											'max' => 200,
										),
									),
								),
						));
 
						$inputFilter->add(array(
								'name'     => 'password',
								'required' => true,
								'validators' => array(
									array(
										'name'    => 'StringLength',
										'options' => array(
											'encoding' => 'UTF-8',
											'min' => 5,
											'max' => 250,
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
								'validators' => array(
									array(
										'name'    => 'StringLength',
										'options' => array(
											'encoding' => 'UTF-8',
											'min' => 4,
											'max' => 200,
										),
									),
								),
						));

						$inputFilter->add(array(
								'name'     => 'valid',
								'required' => true,
								'filters'  => array(
									array('name' => 'Int'),
								),
						));
						$inputFilter->add(array(
								'name'     => 'role',
								'required' => true,
								'filters'  => array(
										array('name' => 'StripTags'),
										array('name' => 'StringTrim'),
								),
								'validators' => array(
									array(
										'name' => 'StringLength',
										'options' => array(
											'encoding' => 'UTF-8',
											'min' => 4,
											'max' => 20,
										),
									),
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

		public function getId(){
			return $this->id;
		}
		public function getUsername(){
			return $this->username;
		}
		public function getPassword(){
			return $this->password;
		}
		public function getName(){
			return $this->name;
		}
		public function getValid(){
			return $this->valid;
		}
		public function getRole(){
			return $this->role;
		}
 }