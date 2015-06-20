<?php
namespace Application\Controller;

use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\AbstractActionController;
use Application\Form\User as UserForm;
use Application\Model\User as UserModel;

use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\DbSelect as PaginatorDbSelectAdapter;
use Zend\Db\Sql\Sql;

/**
 * Controlador que gerencia os users
 * 
 * @category Application
 * @package Controller
 * @author  Elton Minetto <eminetto@coderockr.com>
 */
class UserController extends AbstractActionController
{

    private $tableGateway;

    private function getTableGateway()
    {
        if (!$this->tableGateway) {
            $this->tableGateway = $this->getServiceLocator()
                                       ->get('Application\Model\UserTableGateway');                                       
        }
        return $this->tableGateway;
    }

    /**
    * Mostra os users cadastrados
    * @return void
    */
    public function indexAction()
    {
        $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $sql = new Sql($adapter);
        $select = $sql->select()->from('users');
        $paginatorAdapter = new PaginatorDbSelectAdapter($select, $sql);
        $paginator = new Paginator($paginatorAdapter);
        $paginator->setCurrentPageNumber($this->params()->fromRoute('page'));
        $paginator->setItemCountPerPage($this->params()->fromRoute('itens',2));

        return new ViewModel(array(
            'users' => $paginator
        ));
    }

    /**
    * Cria ou edita um user
    * @return void
    */
    public function saveAction()
    {
        $form = new UserForm();
        $tableGateway = $this->getTableGateway();
        $request = $this->getRequest();
        if ($request->isPost()) {
            $user = new UserModel;
            $form->setInputFilter($user->getInputFilter());
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $data = $form->getData();
                $data['post_date'] = date('Y-m-d H:i:s');
                $user->exchangeArray($data);
                $tableGateway->save($user);
                return $this->redirect()->toUrl('/user');
            }
        }
        $id = (int) $this->params()->fromRoute('id', 0);
        if ($id > 0) {
            $user = $tableGateway->get($id);
            $form->bind($user);
            $form->get('submit')->setAttribute('value', 'Edit');
        }
        return new ViewModel(
            array('form' => $form)
        );
    }

    /**
    * Exclui um user
    * @return void
    */
    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if ($id == 0) {
            throw new \Exception("Código obrigatório.");
        }
        $tableGateway = $this->getTableGateway()->delete($id);
        
        return $this->redirect()->toUrl('/user');
    }
}