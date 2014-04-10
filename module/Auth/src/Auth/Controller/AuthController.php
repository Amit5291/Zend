<?php
namespace Auth\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Zend\Db\TableGateway\TableGateway;

use Auth\Model\Auth;
use Auth\Form\AuthForm;

use Auth\Model\UserTable;

use Auth\Model\Registration;
use Auth\Form\RegistrationForm;

use Zend\Authentication\Storage\Session as SessionStorage;

use Zend\Session\Storage\ArrayStorage;
use Zend\Session\SessionManager;

use Zend\Session\Validator\HttpUserAgent;

use Zend\Session\Container;

class AuthController extends AbstractActionController
{
	protected $authTable = null;
	protected $registrationTable = null;
	protected $userTable = null;
 	function __construct(){
		
	}
        public function authAction()
        { 
	   $authform = new AuthForm();
	   $authform->get('submit')->setValue('Login');
           $request = $this->getRequest();
	   $session = new Container('base');
	   if($request->isPost()){
		$auth = new Auth();
		$authform->setInputFilter($auth->getInputFilter());
		$authform->setData($request->getPost());
		
		if($authform->isValid()){
		    $auth->exchangeArray($authform->getData());
		    $userdetail = $this->getAuthTable()->authauth($auth);
		   // print_r($userdetail);
		   //return array('userdetail' => $userdetail,'authform' => $authform);
		   if(is_object($userdetail)){
		        $populateStorage = array('id' => $userdetail->id, 'username' => $userdetail->username);
			$storage         = new ArrayStorage($populateStorage);
			$manager         = new SessionManager();
			$manager->setStorage($storage);
			$manager->getValidatorChain()->attach('session.validate', array(new HttpUserAgent(), 'isValid'));
			$session->offsetSet('username', $userdetail->username);
			$session->offsetSet('id', $userdetail->id);
			$session->offsetSet('email', $userdetail->email);
			
		   }else{
			
			return array('errormsg'=>$userdetail,'authform' => $authform);
		   }
		}
	     }
	   if(isset($_SESSION['base']['username'])){  
	   $friendlist = $this->getAuthTable()->getFriendlist($_SESSION['base']['id']);
			return array('friendlist' => $friendlist);
	   }else{
	   return array('authform' => $authform);
	   }
        }
	
	
	
	public function registrationAction()
        {
	    $registrationform = new RegistrationForm();
	    $registrationform->get('submit')->setValue('Register');
	    $request = $this->getRequest();
	     if($request->isPost()){
		$registration = new Registration();
		$registrationform->setInputFilter($registration->getInputFilter());
		$registrationform->setData($request->getPost());
		
		if($registrationform->isValid()){
			 $registration->exchangeArray($registrationform->getData());
			 $result = $this->getRegistrationTable()->saveregistration($registration);
			if(is_array($result)){
				 return array('successmsg'=> $result['msg'],'registrationform' => $registrationform);
			}else{
			   return array('errormsg'=> $result,'registrationform' => $registrationform);
			}

		}
	     }
	    return array('registrationform' => $registrationform);
        }
	
	public function searchAction(){
		 $session = new Container('base');	
		 $searchresult = "";
		 $request = $this->getRequest();
		if($request->isPost()){
		     //print_r($request->getPost());
		     $searchItem = $request->getPost()->searchitem;
		      $usertable = new UserTable();
		     $searchresult = $usertable->fetchSearchResult($searchItem);
		      return array('searchresult'=> $searchresult);
		     
		}
		  return array('searchresult'=> $searchresult);
	}
	
	public function logoutAction(){
	   	$session = new Container('base');
                $session->getManager()->getStorage()->clear('base');
		return $this->redirect()->toRoute('auth');
	}
	
	public function getAuthTable()
	{
	    if (!$this->authTable) {
	       $sm = $this->getServiceLocator();
	       $this->authTable = $sm->get('Auth\Model\AuthTable');
	    }
	    return $this->authTable;
	}
	
	public function getRegistrationTable()
	{
	    if (!$this->registrationTable) {
	       $sm = $this->getServiceLocator();
	       $this->registrationTable = $sm->get('Auth\Model\RegistrationTable');
   
	    }
	    return $this->registrationTable;
	}
	
	
}
