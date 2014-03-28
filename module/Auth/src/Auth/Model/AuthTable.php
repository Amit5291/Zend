<?php
namespace Auth\Model;

use Zend\Db\TableGateway\TableGateway;

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
             'username' => $auth->username,
             'password'  => $auth->password,
         );
	$username = $data['username'];
	$password = $data['password'];
    
        $rowset = $this->tableGateway->select(array('username' => $username,'password' => $password));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Username and Password Combination is wrong");
        }
	return $rowset;
    }
}