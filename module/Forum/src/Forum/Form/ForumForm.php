<?php
namespace Forum\Form;

 use Zend\Form\Form;

 class ForumForm extends Form
 {
     public function __construct($name = null)
     {
         // we want to ignore the name passed
         parent::__construct('forum');

         $this->add(array(
             'name' => 'id',
             'type' => 'Hidden',
         ));
         $this->add(array(
             'name' => 'question',
             'type' => 'textarea',
             'options' => array(
                 'label' => 'Question:-',
             ),
             'attributes' => array(
                 'class' => 'form-control col-md-12',
             ),
         ));
         
         $this->add(array(
             'name' => 'submit',
             'type' => 'Submit',
             'attributes' => array(
                 'value' => 'Go',
                 'id' => 'submitbutton',
                 'class' => 'btn btn-primary',
             ),
         ));
     }
 }