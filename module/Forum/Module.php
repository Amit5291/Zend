<?php
namespace Forum;

  use Forum\Model\Forum;
  use Forum\Model\ForumTable;
  use Forum\Model\Answer;
  use Forum\Model\AnswerTable;
  use Zend\Db\ResultSet\ResultSet;
  use Zend\Db\TableGateway\TableGateway;

  use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
  use Zend\ModuleManager\Feature\ConfigProviderInterface;

 class Module implements AutoloaderProviderInterface, ConfigProviderInterface
 {
     public function getAutoloaderConfig()
     {
         return array(
             'Zend\Loader\ClassMapAutoloader' => array(
                 __DIR__ . '/autoload_classmap.php',
             ),
             'Zend\Loader\StandardAutoloader' => array(
                 'namespaces' => array(
                     __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                 ),
             ),
         );
     }

     public function getConfig()
     {
         return include __DIR__ . '/config/module.config.php';
     }
     
       public function getServiceConfig()
     {
         return array(
             'factories' => array(
                 'Forum\Model\ForumTable' =>  function($sm) {
                     $tableGateway = $sm->get('ForumTableGateway');
                     $table = new ForumTable($tableGateway);
                     return $table;
                 },
                 'ForumTableGateway' => function ($sm) {
                     $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                     $resultSetPrototype = new ResultSet();
                     $resultSetPrototype->setArrayObjectPrototype(new Forum());
                     return new TableGateway('forum', $dbAdapter, null, $resultSetPrototype);
                 },
                 
                 'Forum\Model\AnswerTable' =>  function($sm) {
                     $tableGateway = $sm->get('AnswerTableGateway');
                     $table = new AnswerTable($tableGateway);
                     return $table;
                 },
                 'AnswerTableGateway' => function ($sm) {
                     $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                     $resultSetPrototype = new ResultSet();
                     $resultSetPrototype->setArrayObjectPrototype(new Answer());
                     return new TableGateway('answer', $dbAdapter, null, $resultSetPrototype);
                 },
             ),
             
         );
     }
     
 }
 ?>