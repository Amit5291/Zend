<?php
namespace Forum\Controller;

    use Zend\Mvc\Controller\AbstractActionController;
    use Zend\View\Model\ViewModel;
    use Forum\Model\Forum;          // <-- Add this import
    use Forum\Model\Answer; 
    use Forum\Form\ForumForm;
    use Forum\Form\AnswerForm;
 class ForumController extends AbstractActionController
 {
    protected $forumTable;
    protected $answerTable;
    public function indexAction()
     {
      return new ViewModel(array(
          'forum' => $this->getForumTable()->fetchAll(),
      ));
     }

    public function addAction()
     {
        $form = new ForumForm();
        $form->get('submit')->setValue('Add');
        $request = $this->getRequest();
         if ($request->isPost()) {
             $forum = new Forum();
             $form->setInputFilter($forum->getInputFilter());
             $form->setData($request->getPost());

             if ($form->isValid()) {
                 $forum->exchangeArray($form->getData());
                 $this->getForumTable()->saveForum($forum);

                 // Redirect to list of albums
                 return $this->redirect()->toRoute('forum');
             }
         }
        return array('form' => $form);
     }

     public function viewAction()
     {
        $id = (int) $this->params()->fromRoute('id', 0);
         if (!$id) {
             return $this->redirect()->toRoute('forum', array(
                'action' => 'index'
             ));
         }
         
        try {
             $forum = $this->getForumTable()->getForum($id);
         }
         catch (\Exception $ex) {
             return $this->redirect()->toRoute('forum', array(
                 'action' => 'index'
             ));
         }
         
         if(isset($_POST['likes'])){
            
            } 
         $form = new AnswerForm();
         $form->get('submit')->setValue('Add Answer');
    
         $request = $this->getRequest();
         if ($request->isPost()) {
             $answer = new Answer();
             $form->setInputFilter($answer->getInputFilter());
             $form->setData($request->getPost());
             
             if ($form->isValid()) {
                 $answer->exchangeArray($form->getData());
                 $this->getAnswerTable()->saveAnswer($answer);
                  $form->get('answer')->setValue('');
                    return array('forum' => $forum,
                       'form' => $form,
                       'answer' => $this->getAnswerTable()->getAnswer($answer->quesid));
                 
                 // Redirect to list of albums
                 //return $this->redirect()->toRoute('forum');
             }
         }
         
          return array('forum' => $forum,
                       'form' => $form,
                       'answer' => $this->getAnswerTable()->getAnswer($forum->id));
       
     } 

     public function deleteAction()
     {
         
     }
     
     public function getForumTable()
     {
         if (!$this->forumTable) {
             $sm = $this->getServiceLocator();
             $this->forumTable = $sm->get('Forum\Model\ForumTable');
         }
         return $this->forumTable;
     }
     
      public function getAnswerTable()
     {
         if (!$this->answerTable) {
            $sm = $this->getServiceLocator();
            $this->answerTable = $sm->get('Forum\Model\AnswerTable');

         }
         return $this->answerTable;
     }
 }
?>