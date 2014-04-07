<?php
 namespace Auth\Model;

 use Zend\Db\TableGateway\TableGateway;
 
 use Zend\Db\Adapter\Adapter as DbAdapter;
 
 use Zend\Db\Sql\Sql;
 use Zend\Db\Sql\Select;
  use Zend\Db\Sql\Where;
 use Zend\Db\Adapter\Driver\ResultInterface;
 use Zend\Db\ResultSet\ResultSet;
    use Zend\Db\Sql\Predicate\Like;
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
        return $resultSet->current();
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
 }