<?php
 namespace Auth\Model;

 use Zend\Db\TableGateway\TableGateway;
 
 use Zend\Db\Adapter\Adapter as DbAdapter;
 
 use Zend\Db\Sql\Sql;
 use Zend\Db\Sql\Select;
 use Zend\Db\Sql\Insert;
 use Zend\Db\Sql\Where;
 use Zend\Db\Adapter\Driver\ResultInterface;
 use Zend\Db\ResultSet\ResultSet;
 use Zend\Db\Sql\Predicate\Like;
 use Zend\Session\Container;
 class UserTable
 {

     public function fetchUserDetail($user)
     {
      $dbAdapter = new DbAdapter(array(
                'driver' => 'Pdo_Mysql',
                'database' => 'zf2tutorial',
		'username' => 'root',
		'password' => 'root'
            ));
        
        $sql_sel = new Sql($dbAdapter);
  
        
        $select = $sql_sel->select();
	$select->from('registration');
        $select->where(array('username'=>$user));
        $statement = $sql_sel->prepareStatementForSqlObject($select);
	$resultSet = new ResultSet();
        $resultSet->initialize($statement->execute());
        
         $select_1 = $sql_sel->select();
	 $select_1->from('addrequest');
         $select_1->where(array('sender_id'=> $_SESSION['base']['id'],'receiver_id'=>$resultSet->current()->id));
         $statement_1 = $sql_sel->prepareStatementForSqlObject($select_1);
         $resultSet_1 = new ResultSet();
         $resultSet_1->initialize($statement_1->execute());
         if($resultSet_1->count() == 1){
           $status = "Request Sent";
           }else{
              $select_2 = $sql_sel->select();
              $select_2->from('addrequest');
              $select_2->where(array('sender_id'=> $resultSet->current()->id,'receiver_id'=> $_SESSION['base']['id']));
              $statement_2 = $sql_sel->prepareStatementForSqlObject($select_2);
              $resultSet_2 = new ResultSet();
              $resultSet_2->initialize($statement_2->execute());
              if($resultSet_2->count() == 1){
                   $status = "Accept Request";
                }else{
                   $status = "Add User";
                }
              
             }
        return array($resultSet->current(),$status);
     }
     
     public function fetchSearchResult($searchitem){
      $resultArr = array();
         $dbAdapter = new DbAdapter(array(
                'driver' => 'Pdo_Mysql',
                'database' => 'zf2tutorial',
		'username' => 'root',
		'password' => 'root'
            ));
      $sql_sel = new Sql($dbAdapter);
        $select = $sql_sel->select();
	$select->from('registration');
     

         $where = new Where();
         $where->like('fullname', '%'.$searchitem.'%');

        $select->where($where);  
      
      
        $statement = $sql_sel->prepareStatementForSqlObject($select);
	$resultSet = new ResultSet();
        $resultSet->initialize($statement->execute());
         //$a = $resultSet->current();
           foreach ($resultSet as $row) {
             array_push($resultArr,$row);
             }
             return $resultArr;
      }
      
      public function sendRequest($id){
       $session = new Container('base');	
           $dbAdapter = new DbAdapter(array(
                'driver' => 'Pdo_Mysql',
                'database' => 'zf2tutorial',
		'username' => 'root',
		'password' => 'root'
            ));
      $sql = new Sql($dbAdapter,'addrequest');
        $insert = $sql->insert();
        $insert->columns(array('sender_id', 'receiver_id'));
        $insert->values(array('sender_id'=>$_SESSION['base']['id'],  'receiver_id'=>$id));
        $statement = $sql->prepareStatementForSqlObject($insert);
         $results = $statement->execute();
         
         if($results){
          return "Request Sent";
         }
     
      }
      
      public function getRequest(){
       $resultArr = array();
       $html="";
         $session = new Container('base');	
           $dbAdapter = new DbAdapter(array(
                'driver' => 'Pdo_Mysql',
                'database' => 'zf2tutorial',
		'username' => 'root',
		'password' => 'root'
            ));
         $sql_sel = new Sql($dbAdapter);
        $select = $sql_sel->select();
	$select->from('addrequest');
        $select->where(array('receiver_id'=>$_SESSION['base']['id']));
        $statement = $sql_sel->prepareStatementForSqlObject($select);
	$resultSet = new ResultSet();
        $resultSet->initialize($statement->execute());
        foreach ($resultSet as $row) {
           //array_push($resultArr,$row);
              $sql  = new Sql($dbAdapter);
              $select = $sql->select();
              $select->from('registration');
              $select->where(array('id'=>$row['sender_id']));
              $statement = $sql_sel->prepareStatementForSqlObject($select);
              $resultSet_1 = new ResultSet();
              $resultSet_1->initialize($statement->execute()); 
               array_push($resultArr,$resultSet_1->current()->fullname);
                $html .="<li><a href='/'".$resultSet_1->current()->username."'>".$resultSet_1->current()->fullname."</a></li><li class='divider'></li>";
             }
          
            return $html;
      }
 }