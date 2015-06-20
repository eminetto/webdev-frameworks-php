<?php
namespace Application\Controller;

use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\AbstractActionController;
use Application\Form\Post as PostForm;
use Application\Model\Post as PostModel;

/**
 * Controlador que gerencia os posts
 * 
 * @category Application
 * @package Controller
 * @author  Elton Minetto <eminetto@coderockr.com>
 */
class PostController extends AbstractActionController
{

    private $tableGateway;

    private function getTableGateway()
    {
        if (!$this->tableGateway) {
            $this->tableGateway = $this->getServiceLocator()
                                       ->get('Application\Model\PostTableGateway');                                       
        }
        return $this->tableGateway;
    }

    /**
    * Mostra os posts cadastrados
    * @return void
    */
    public function indexAction()
    {
        $tableGateway = $this->getTableGateway();
        $posts = $tableGateway->fetchAll();

        return new ViewModel(array(
            'posts' => $posts
        ));
    }

    /**
    * Cria ou edita um post
    * @return void
    */
    public function saveAction()
    {
        $form = new PostForm();
        $tableGateway = $this->getTableGateway();
        $request = $this->getRequest();
        if ($request->isPost()) {
            $post = new PostModel;
            $form->setInputFilter($post->getInputFilter());
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $data = $form->getData();
                $data['post_date'] = date('Y-m-d H:i:s');
                $post->exchangeArray($data);
                $tableGateway->save($post);
                return $this->redirect()->toUrl('/post');
            }
        }
        $id = (int) $this->params()->fromRoute('id', 0);
        if ($id > 0) {
            $post = $tableGateway->get($id);
            $form->bind($post);
            $form->get('submit')->setAttribute('value', 'Edit');
        }
        return new ViewModel(
            array('form' => $form)
        );
    }

    /**
    * Exclui um post
    * @return void
    */
    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if ($id == 0) {
            throw new \Exception("Código obrigatório.");
        }
        $tableGateway = $this->getTableGateway()->delete($id);
        
        return $this->redirect()->toUrl('/post');
    }
}