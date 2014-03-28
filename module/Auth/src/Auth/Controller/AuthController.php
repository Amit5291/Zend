<?php
namespace Auth\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Zend\Db\TableGateway\TableGateway;

use Auth\Model\Auth;
use Auth\Form\AuthForm;

class AuthController extends AbstractActionController
{
	protected $authTable = null;
 	
        public function authAction()
        { 
	   $authform = new AuthForm();
	   $authform->get('submit')->setValue('Login');
           $request = $this->getRequest();
	   if($request->isPost()){
		$auth = new Auth();
		$authform->setInputFilter($auth->getInputFilter());
		$authform->setData($request->getPost());
		
		if($authform->isValid()){
	
		   $auth->exchangeArray($authform->getData());
		    $userdetail = $this->getAuthTable()->authauth($auth);
		      return array('userdetail' => $userdetail,'authform' => $authform);
		}
	   }
	   
	   return array('authform' => $authform);
	   
        }
	
	public function dashboardAction()
        { 
	   
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
