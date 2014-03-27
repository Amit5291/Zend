<?php
 namespace Forum\Model;

 use Zend\Db\TableGateway\TableGateway;

 class AnswerTable
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

     public function getAnswer($id)
     {
         $id  = (int)$id;
         
        // $rowset = $this->tableGateway->select(array('quesid' => $id));
        $rowset = $this->tableGateway->select(array('quesid' => $id));
         return $rowset;
         //$row = $rowset->current();
         //if (!$row) {
         //    throw new \Exception("Could not find row $id");
         //}
         //print_r($row);
     }
     
      public function addLikes($id)
     {
         $id  = (int)$id;
        $result = $this->tableGateway->select(array('id' => $id));
        $likes = $result->likes;
        $likes = $likes+1;
        
        $data = array(
                 'likes' => $likes,     
                      );
         
        // $rowset = $this->tableGateway->select(array('quesid' => $id));
        $rowset = $this->tableGateway->update($data,array('id' => $id));
         return $rowset;
         //$row = $rowset->current();
         //if (!$row) {
         //    throw new \Exception("Could not find row $id");
         //}
         //print_r($row);
     }

     public function saveAnswer(Answer $answer)
     {
         $data = array(
             'answer' => $answer->answer,
             'quesid'  => $answer->quesid,
             'likes' => '1',
             );

         $id = (int) $answer->id;
         if ($id == 0) {
             $this->tableGateway->insert($data);
         } else {
             if ($this->getAnswer($id)) {
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