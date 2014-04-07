<?php
namespace Auth\Form;

use Zend\Form\Form;

class RegistrationForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('auth');
        $this->add(array(
            'name' => 'username',
            'attributes' => array(
                'type'  => 'text',
		'placeholder' => 'Username',
		'class' => 'form-control',
            ),
            'options' => array(
               // 'label' => 'Username',
            ),
        ));
	
	 $this->add(array(
            'name' => 'fullname',
            'attributes' => array(
                'type'  => 'text',
		'placeholder' => 'Fullname',
		'class' => 'form-control',
            ),
            'options' => array(
               // 'label' => 'Full Name',
            ),
        ));
	 
	$this->add(array(
            'name' => 'email',
            'attributes' => array(
                'type'  => 'email',
		'placeholder' => 'Email',
		'class' => 'form-control',
            ),
            'options' => array(
                
            ),
        ));
	 
        $this->add(array(
            'name' => 'password',
            'attributes' => array(
                'type'  => 'password',
		'placeholder' => 'Password',
		'class' => 'form-control',
            ),
            'options' => array(
                //'label' => 'Password',
            ),
        ));
	
	   $this->add(array(
            'name' => 'cpassword',
            'attributes' => array(
                'type'  => 'password',
		'placeholder' => 'Confirm Password',
		'class' => 'form-control',
            ),
            'options' => array(
                //'label' => 'Password',
            ),
        ));
	   
	$this->add(array(
            'name' => 'dob',
            'attributes' => array(
                'type'  => 'text',
		'placeholder' => 'Date of Birth',
		'class'  => 'span2 datepicker form-control',

            ),
            'options' => array(
                //'label' => 'Password',
            ),
        ));
//        $this->add(array(
//            'name' => 'rememberme',
//			'type' => 'checkbox', // 'Zend\Form\Element\Checkbox',			
////            'attributes' => array( // Is not working this way
////                'type'  => '\Zend\Form\Element\Checkbox',
////            ),
//            'options' => array(
//                'label' => 'Remember Me?',
////				'checked_value' => 'true', without value here will be 1
////				'unchecked_value' => 'false', // witll be 1
//            ),
//        ));			
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Go',
                'id' => 'submitbutton',
		'class' => 'btn btn-primary',
            ),
        )); 
    }
}