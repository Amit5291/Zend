<?php
namespace Auth\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Adapter\DbTable as AuthAdapter;
use Zend\Db\Adapter\Adapter as DbAdapter;
use Zend\Db\Authentication;
use Zend\Authentication\Result;

use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Insert;

class RegistrationTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }
	

    public function saveregistration(Registration $registration)
    {
	$data = array(
             'username'  => $registration->username,
	     'fullname'  => $registration->fullname,
             'password'  => $registration->password,
	     'dob'       => $registration->dob,
	     'email'     => $registration->email, 
         );
	
	$username = $data['username'];
	$fullname = $data['fullname'];
	$password = $data['password'];
	$dob      = $data['dob'];
	$email    = $data['email'];
	
	$dbAdapter = new DbAdapter(array(
                'driver' => 'Pdo_Mysql',
                'database' => 'zf2tutorial',
		'username' => 'root',
		'password' => 'root'
            ));
	$reg_ip = $_SERVER['REMOTE_ADDR'];
	$sql = new Sql($dbAdapter, 'registration');
	
        $insert = $sql->insert();
	//$insert = new Insert('registration');
	$insert->columns(array('fullname','email','dob','reg_ip','reg_date'));
	$insert->values(array(
		'fullname' => $fullname,
		'email' => $email,
		'dob' => $dob,
		'reg_ip' => $reg_ip,
		'reg_date' =>  date("Y-m-d H:i:s"),
	   ));
	 $statement = $sql->prepareStatementForSqlObject($insert);
         $results = $statement->execute();
	 if($results){
		$sql1 = new Sql($dbAdapter, 'auth');
		$insert = $sql1->insert();
	       //$insert = new Insert('registration');
	       $insert->columns(array('username','email','password'));
	       $insert->values(array(
		       'username' => $username,
		       'email' => $email,
		       'password' => $password,
		  ));
		$statement = $sql1->prepareStatementForSqlObject($insert);
		$results = $statement->execute();
		return $results;
	 }
//        $adapter = new AuthAdapter(
//                $dbAdapter,
//                'auth',
//                'username',
//                'password'
//                );
//	
//
//            $adapter->setIdentity($username);
//            $adapter->setCredential($password);
//            
//	    
//           
//	    
//            $auth = new AuthenticationService();
//            $result = $auth->authenticate($adapter);
//	    switch ($result->getCode()) {
//
//	    case Result::FAILURE_IDENTITY_NOT_FOUND:
//		echo "Username or password is wrong";
//		break;
//	
//	    case Result::FAILURE_CREDENTIAL_INVALID:
//		echo "Username or password is wrong";
//		break;
//	
//	    case Result::SUCCESS:
//		//echo "Authentication Successful";
//		 $columnsToReturn = array(
//		'id', 'username', 'email'
//	          );
//	        return $rowset = $adapter->getResultRowObject($columnsToReturn);
//		
//		
//		//echo $_SESSION['base']['username'];
//		break;
//	
//	    default:
//		/** do stuff for other failure **/
//		break;
//            }
    
//        $rowset = $this->tableGateway->select(array('username' => $username,'password' => $password));
//        $row = $rowset->current();
//        if (!$row) {
//            throw new \Exception("Username and Password Combination is wrong");
//        }
//	return $rowset;
    }
}