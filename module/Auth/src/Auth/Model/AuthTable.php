<?php
namespace Auth\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Adapter\DbTable as AuthAdapter;
use Zend\Db\Adapter\Adapter as DbAdapter;
use Zend\Db\Authentication;
use Zend\Authentication\Result;


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
}