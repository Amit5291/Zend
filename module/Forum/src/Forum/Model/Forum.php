<?php

 namespace Forum\Model;
 
  use Zend\InputFilter\InputFilter;
  use Zend\InputFilter\InputFilterAwareInterface;
  use Zend\InputFilter\InputFilterInterface;

 class Forum implements InputFilterAwareInterface
 {
     public $id;
     public $question;
     public $inputFilter;

     public function exchangeArray($data)
     {
         $this->id       = (!empty($data['id'])) ? $data['id'] : null;
         $this->question = (!empty($data['question'])) ? $data['question'] : null;
         //$this->title  = (!empty($data['title'])) ? $data['title'] : null;
     }
     
       public function getArrayCopy()
       {
           return get_object_vars($this);
       }
     
      public function setInputFilter(InputFilterInterface $inputFilter)
     {
         throw new \Exception("Not used");
     }

     public function getInputFilter()
     {
         if (!$this->inputFilter) {
             $inputFilter = new InputFilter();

             $inputFilter->add(array(
                 'name'     => 'id',
                 'required' => true,
                 'filters'  => array(
                     array('name' => 'Int'),
                 ),
             ));

             $inputFilter->add(array(
                 'name'     => 'question',
                 'required' => true,
                 'filters'  => array(
                     array('name' => 'StripTags'),
                     array('name' => 'StringTrim'),
                 ),
                 'validators' => array(
                     array(
                         'name'    => 'StringLength',
                         'options' => array(
                             'encoding' => 'UTF-8',
                             'min'      => 1,
                             //'max'      => 255,
                         ),
                     ),
                 ),
             ));

             $this->inputFilter = $inputFilter;
         }

         return $this->inputFilter;
     }
 }

