<?php
namespace FeedbackBatch;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class IndexController{
	
	const QA_URL = "https://sqs.us-east-2.amazonaws.com/303498416083/userinit";
	
	const LOG_LOCATION = "../../../logs/app.log";
	
	public $test = "test";
	
	public $logger = null;
	
	public function __construct(){
		$log = new Logger('name');
		$log->pushHandler(new StreamHandler(__DIR__. DIRECTORY_SEPARATOR. IndexController::LOG_LOCATION, Logger::DEBUG));
		$this->logger = $log;
	}
	
	/**
	 * Get the Amazon Q url
	 */
	public function getSQSUrl(){
		if($this->getEnv() != null && $this->getEnv() == "QA" ){
			return IndexController::QA_URL;
		}
		else if($this->getEnv() != null && $this->getEnv() == "PR" ){
			return IndexController::QA_URL;
		}
		else {
			return IndexController::QA_URL;
		}
	}
	
	/**
	 * Get current LCP
	 */
	public function getEnv(){
		return getenv("LCP");
	}
}