<?php
namespace Application\Controller;

use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\AbstractActionController;
use Application\Form\Comment as CommentForm;
use Application\Model\Comment as CommentModel;

/**
 * Controlador que gerencia os comentários
 * 
 * @category Application
 * @package Controller
 * @author  Elton Minetto <eminetto@coderockr.com>
 */
class CommentController extends AbstractActionController
{
    /**
    * Mostra os comentários cadastrados
    * @return void
    */
    public function indexAction()
    {
      $tableGateway = $this->getServiceLocator()->get('Application\Model\CommentTableGateway');
      $post_id = (int) $this->params()->fromRoute('id', 0);

      $comments = $tableGateway->fetchAll($post_id);
        return new ViewModel(array(
            'comments' => $comments
        ));
    }

    public function listAction(){
        $tableGateway = $this->getServiceLocator()->get('Application\Model\CommentTableGateway');
        $post_id = (int) $this->params()->fromRoute('id', 0);

        $comments = $tableGateway->fetchAll($post_id);
    
        return new ViewModel(array(
            'comments' => $comments
        ));   
    }

    public function saveAction()
    {
        $form = new CommentForm();
        $tableGateway = $tableGateway = $this->getServiceLocator()->get('Application\Model\CommentTableGateway');
        $request = $this->getRequest();
        if ($request->isPost()) {
            $comment = new CommentModel;
            $form->setInputFilter($comment->getInputFilter());
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $data = $form->getData();
                $data['comment_date'] = date('Y-m-d H:i:s');
                $comment->exchangeArray($data);
                $tableGateway->save($comment);
                return $this->redirect()->toUrl('/comment/list');
            }
        }
        $id = (int) $this->params()->fromRoute('id', 0);
        if ($id > 0) {
            $comment = $tableGateway->get($id);
            $form->bind($comment);
            $form->get('submit')->setAttribute('value', 'Edit');
        }
        return new ViewModel(
            array('form' => $form)
        );
    }

    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if ($id == 0) {
            throw new \Exception("Código obrigatório.");
        }
        $tableGateway = $this->getTableGateway()->delete($id);
        
        return $this->redirect()->toUrl('/comments/list');
    }
}