<?php
 namespace Forum\Model;

 use Zend\Db\TableGateway\TableGateway;

 class ForumTable
 {
     protected $tableGateway;

     public function __construct(TableGateway $tableGateway)
     {
         $this->tableGateway = $tableGateway;
     }

     public function fetchAll()
     {
         $resultSet = $this->tableGateway->select();
         return $resultSet;
     }

     public function getForum($id)
     {
         $id  = (int) $id;
         $rowset = $this->tableGateway->select(array('id' => $id));
         $row = $rowset->current();
         if (!$row) {
             throw new \Exception("Could not find row $id");
         }
         return $row;
     }

     public function saveForum(Forum $forum)
     {
         $data = array(
             'question' => $forum->question,
             //'title'  => $forum->title,
         );

         $id = (int) $forum->id;
         if ($id == 0) {
             $this->tableGateway->insert($data);
         } else {
             if ($this->getForum($id)) {
                 $this->tableGateway->update($data, array('id' => $id));
             } else {
                 throw new \Exception('Forum id does not exist');
             }
         }
     }
     

     public function deleteForum($id)
     {
         $this->tableGateway->delete(array('id' => (int) $id));
     }
 }
 ?>