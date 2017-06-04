<?php 

namespace FeedbackBatch;

use FeedbackBatch\lib\Core;
use FeedbackBatch\lib\BatchJob;

class MyTest extends IndexController{
	
   protected $view;

   // constructor receives container instance
   public function __construct($view = null) {
   	   parent::__construct();
       $this->view = $view;
   }
	
   public function hello($request, $response, $args){
   	
//    		$c = new Core();
//    		$c->test();
//    		echo $c->test;

   		$c = new BatchJob();
   		$c->hello();
   		
   		die();
   	
   		$w = new FeedbackQueue();
   		echo "<pre>";
   		print_r(get_class_methods($response));
   		$this->view->logger->info("!!!!!!!!!!!!!!!!!!!");
   		return $response->withJson(array("data"=>"Tetete"));
   }
}

?>