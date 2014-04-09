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
 use Zend\Json\Json;
class ProfileController extends AbstractActionController
{
  protected $userTable = null;
  
  public function userAction()
        {
	   $user = $this->params()->fromRoute('id', 0);
	    if (!$user) {
             return $this->redirect()->toRoute('auth');
            }
	   $session = new Container('base');	
	   if(!isset($_SESSION['base']['username'])){
		return $this->redirect()->toRoute('auth');
	     }else{
		 $usertable = new UserTable();
		 $userdetail = $usertable->fetchUserDetail($user);
		 return array('userdetail'=> $userdetail[0], 'user'=>$user, 'status'=>$userdetail[1]);
	     }
        }
        
  public function addAction(){
         $request = $this->getRequest();
         $response = $this->getResponse();
          if ($request->isPost()) {
             $post_data = $request->getPost();
              $user_id = $post_data['id'];
                 $usertable = new UserTable();
	         $req_response = $usertable->sendRequest($user_id);
                return $this->getResponse()->setContent($req_response);
              }
            }
    public function getrequestAction(){
        
                 $usertable = new UserTable();
	         $req_response = $usertable->getRequest();
                 return $this->getResponse()->setContent(($req_response));
              
            }              
    
    
  public function getUserTable()
	{
	    if (!$this->userTable) {
	       $sm = $this->getServiceLocator();
	       $this->userTable = $sm->get('Auth\Model\UserTable');
   
	    }
	    return $this->userTable;
	}	
}