<?php
namespace Auth\Model;

  use Zend\InputFilter\InputFilter;
  use Zend\InputFilter\Input;
  use Zend\Validator;
  use Zend\InputFilter\InputFilterAwareInterface;
  use Zend\InputFilter\InputFilterInterface;

class Registration implements InputFilterAwareInterface
{
    public $username;
    public $password;
    public $fullname;
    public $email;
    public $dob;
    protected $inputFilter;
    
    public function exchangeArray($data) 
    {
        $this->username = (!empty($data['username'])) ? $data['username'] : null;
        $this->fullname = (!empty($data['fullname'])) ? $data['fullname'] : null;
        $this->email = (!empty($data['email'])) ? $data['email'] : null;
	$this->password = (!empty($data['password'])) ? $data['password'] : null;
	$this->password = hash('sha512',$this->password);
	$this->dob = (!empty($data['dob'])) ? $data['dob'] : null;
	
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
                 'name'     => 'username',
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
                             'min'      => 4,
                             'max'      => 45,
                         ),
                     ),
                 ),
             ));
             $inputFilter->add(array(
                 'name'     => 'fullname',
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
                             'min'      => 4,
                             'max'      => 45,
                         ),
                     ),
                 ),
             ));
	     
            $inputFilter->add(array(
                 'name'     => 'email',
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
                             'min'      => 4,
                             'max'      => 45,
                         ),
                     ),
                 ),
             ));
                   
             $pass = $inputFilter->add(array(
                 'name'     => 'password',
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
                             'min'      => 4,
                             'max'      => 45,
                         ),
                     ),
                 ),
             ));
             $cpass = $inputFilter->add(array(
                 'name'     => 'cpassword',
                 'required' => true,
                 'filters'  => array(
                     array('name' => 'StripTags'),
                     array('name' => 'StringTrim'),
                 ),
                 'validators' => array(
                     array(
                         'name'    => 'Identical',
                         'options' => array(
			     'token' => 'password', 
                             'encoding' => 'UTF-8',
                             'min'      => 4,
                             'max'      => 100,
                         ),
                     ),
                 ),
             ));
	      
	      $inputFilter->add(array(
                 'name'     => 'dob',
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
                             'min'      => 4,
                             'max'      => 100,
                         ),
                     ),
                 ),
             ));
            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }	
}