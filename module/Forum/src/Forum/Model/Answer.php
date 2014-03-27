<?php

 namespace Forum\Model;
 
  use Zend\InputFilter\InputFilter;
  use Zend\InputFilter\InputFilterAwareInterface;
  use Zend\InputFilter\InputFilterInterface;

 class Answer implements InputFilterAwareInterface
 {
     public $id;
     public $answer;
     public $quesid;
     public $inputFilter;
     
     public function exchangeArray($data)
     {
         $this->id     = (!empty($data['id'])) ? $data['id'] : null;
          $this->quesid  = (!empty($data['quesid'])) ? $data['quesid'] : null;
         $this->answer = (!empty($data['answer'])) ? $data['answer'] : null;
              $this->likes  = (!empty($data['likes'])) ? $data['likes'] : null;
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
                 'name'     => 'likes',
                 'required' => false,
                 'filters'  => array(
                     array('name' => 'Int'),
                 ),
             ));
             
                $inputFilter->add(array(
                 'name'     => 'quesid',
                 'required' => true,
                 'filters'  => array(
                     array('name' => 'Int'),
                 ),
             ));


             $inputFilter->add(array(
                 'name'     => 'answer',
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

