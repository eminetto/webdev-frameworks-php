<?php
namespace Application\Model;

 use Zend\Db\TableGateway\TableGateway;

 class CommentTableGateway
 {
     protected $tableGateway;

     public function __construct(TableGateway $tableGateway)
     {
         $this->tableGateway = $tableGateway;
     }

     public function fetchAll($post_id)
     {
         $resultSet = $this->tableGateway->select(array('post_id' => $post_id));
         return $resultSet;
     }

     // public function get($id)
     // {
     //     $id  = (int) $id;
     //     $rowset = $this->tableGateway->select(array('id' => $id));
     //     $row = $rowset->current();
     //     if (!$row) {
     //         throw new \Exception("Não encontrado id $id");
     //     }
     //     return $row;
     // }

     // public function save(Comment $comment)
     // {
     //     $data = array(
     //         'name'  => $comment->name,
     //         'description'  => $comment->description,
     //         'name'  => $comment->name,
     //         'comment_date'  => $comment->comment_date,
     //     );

     //     $id = (int) $comment->id;
     //     if ($id == 0) {
     //         $this->tableGateway->insert($data);
     //     } else {
     //         if ($this->get($id)) {
     //             $this->tableGateway->update($data, array('id' => $id));
     //         } else {
     //             throw new \Exception('Post não existe');
     //         }
     //     }
     // }

     // public function delete($id)
     // {
     //     $this->tableGateway->delete(array('id' => (int) $id));
     // }
 }