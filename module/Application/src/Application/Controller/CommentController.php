<?php
namespace Application\Controller;

use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\AbstractActionController;

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

      //$comments = $tableGateway->fetchAll($post_id);
        return new ViewModel(array());
    }

    public function listAction(){
        $tableGateway = $this->getServiceLocator()->get('Application\Model\CommentTableGateway');
        $post_id = (int) $this->params()->fromRoute('id', 0);

        var_dump($post_id);

        $comments = $tableGateway->fetchAll($post_id);
    
        return new ViewModel(array(
            'comments' => $comments
        ));   
    }
}