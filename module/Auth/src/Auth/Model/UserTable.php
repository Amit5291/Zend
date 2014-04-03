<?php
 namespace Auth\Model;

 use Zend\Db\TableGateway\TableGateway;
 
 use Zend\Db\Adapter\Adapter as DbAdapter;
 
 use Zend\Db\Sql\Sql;
 use Zend\Db\Sql\Select;
 use Zend\Db\Adapter\Driver\ResultInterface;
 use Zend\Db\ResultSet\ResultSet;
 class UserTable
 {

     public function fetchUserDetail($id)
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
        $select->where(array('id'=>$id));
        $statement = $sql_sel->prepareStatementForSqlObject($select);
	$resultSet = new ResultSet();
        $resultSet->initialize($statement->execute());
         return $resultSet->current();
        
     }
 }