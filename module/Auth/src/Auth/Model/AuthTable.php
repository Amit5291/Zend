<?php
namespace Auth\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Adapter\DbTable as AuthAdapter;
use Zend\Db\Adapter\Adapter as DbAdapter;
use Zend\Db\Authentication;
use Zend\Authentication\Result;
use Zend\Db\Sql\Sql;
 use Zend\Db\Sql\Select;
 use Zend\Db\Sql\Insert;
  use Zend\Db\Sql\Delete;
   use Zend\Db\Adapter\Driver\ResultInterface;
 use Zend\Db\ResultSet\ResultSet;


class AuthTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }
	

    public function authauth(Auth $auth)
    {
	$data = array(
             'username'  => $auth->username,
             'password'  => $auth->password,
         );
	$username = $data['username'];
	$password = $data['password'];
	
	$dbAdapter = new DbAdapter(array(
                'driver' => 'Pdo_Mysql',
                'database' => 'zf2tutorial',
		'username' => 'root',
		'password' => 'root'
            ));
        $adapter = new AuthAdapter(
                $dbAdapter,
                'auth',
                'username',
                'password'
                );
	

            $adapter->setIdentity($username);
            $adapter->setCredential($password);
            
	    
           
	    
            $auth = new AuthenticationService();
            $result = $auth->authenticate($adapter);
	    switch ($result->getCode()) {

	    case Result::FAILURE_IDENTITY_NOT_FOUND:
		return $msg = "Either Username or Password is wrong";
		break;
	
	    case Result::FAILURE_CREDENTIAL_INVALID:
		return $msg = "Either Username or Password is wrong";
		break;
	
	    case Result::SUCCESS:
		//echo "Authentication Successful";
		 $columnsToReturn = array(
		'id', 'username', 'email'
	          );
		 
	//	   $sql_sel = new Sql($dbAdapter, 'registration');
	//         $select = $sql->select();
	//         $select->from('registration')->where('username ='. $username);
	        return $rowset = $adapter->getResultRowObject($columnsToReturn);
		
		
		//echo $_SESSION['base']['username'];
		break;
	
	    default:
		/** do stuff for other failure **/
		break;
            }
    
//        $rowset = $this->tableGateway->select(array('username' => $username,'password' => $password));
//        $row = $rowset->current();
//        if (!$row) {
//            throw new \Exception("Username and Password Combination is wrong");
//        }
//	return $rowset;
    }
    
    public function getFriendlist($id){
	$rowArr = array();
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
	
	$select->join(
                'friendlist', // table name
                'friendlist.friend_id = registration.id' // expression to join on (will be quoted by platform object before insertion),
                //array('bar', 'baz'), // (optional) list of columns, same requirements as columns() above
               // $select::JOIN_INNER // (optional), one of inner, outer, left, right also represented by constants in the API
         );
        $select->where('`friendlist`.`user_id` ='. $id);
        $statement = $sql_sel->prepareStatementForSqlObject($select);
	$resultSet = new ResultSet();
        $resultSet->initialize($statement->execute());
	foreach ($resultSet as $row) {
	   array_push($rowArr,$row->fullname);
	   array_push($rowArr,$row->username);
	   array_push($resultArr,$rowArr);
	   $rowArr = array();
	}
	return $resultArr;
    }
}