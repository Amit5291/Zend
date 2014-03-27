<?php
namespace Forum\Form;

 use Zend\Form\Form;

 class AnswerForm extends Form
 {
     public function __construct($name = null)
     {
         // we want to ignore the name passed
         parent::__construct('answer');

         $this->add(array(
             'name' => 'id',
             'type' => 'Hidden',
         ));
         
           $this->add(array(
             'name' => 'quesid',
             'type' => 'Hidden',
         ));
             $this->add(array(
             'name' => 'likes',
             'type' => 'Hidden',
         ));
         
         $this->add(array(
             'name' => 'answer',
             'type' => 'textarea',
             'options' => array(
                 'label' => 'Answer:-',
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