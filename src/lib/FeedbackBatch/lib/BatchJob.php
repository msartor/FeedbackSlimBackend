<?php 

namespace FeedbackBatch\lib;


use FeedbackBatch\IndexController;

class BatchJob extends Core{
	
	public $batchName = null;
	
	public function __construct(){
		
	}
	
	public function hello(){
		$log = Core::logger(get_class($this));
		$log->info("static method222",array("test"=>"1111"));
		//$this->logger->info("in Batchjob1111");
		//$this->logger->info("in Batchjob",array("eee"=>"rrr"));
	}
	
	
}

?>