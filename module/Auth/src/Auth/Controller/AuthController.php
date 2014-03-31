<?php
namespace Auth\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Zend\Db\TableGateway\TableGateway;

use Auth\Model\Auth;
use Auth\Form\AuthForm;

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
		   if($userdetail){
		        $populateStorage = array('id' => $userdetail->id, 'username' => $userdetail->username);
			$storage         = new ArrayStorage($populateStorage);
			$manager         = new SessionManager();
			$manager->setStorage($storage);
			$manager->getValidatorChain()->attach('session.validate', array(new HttpUserAgent(), 'isValid'));
			//print_r($storage);
			//print_r($manager);
			$session->offsetSet('username', $userdetail->username);
			$session->offsetSet('id', $userdetail->id);
			$session->offsetSet('email', $userdetail->email);
		   }	
		}
	   }
	   
	   return array('authform' => $authform);
	   
        }
	
	public function dashboardAction()
        {
	   $session = new Container('base');	
	   if(!isset($_SESSION['base']['username'])){
		return $this->redirect()->toRoute('auth');
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
			
		}
	     }
	    return array('registrationform' => $registrationform);
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
	
}
