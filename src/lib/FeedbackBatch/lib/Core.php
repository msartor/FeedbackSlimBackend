<?php
namespace FeedbackBatch\lib;

use FeedbackBatch\IndexController;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;


class Core extends IndexController{
	
	public function __construct(){
		parent::__construct();
	}
	
	public function test(){
	}
	
	
	/**
	 * Create the logger
	 * @param unknown $className
	 */
	public static function logger($className){
		$log = new Logger($className);
// 		echo __DIR__. DIRECTORY_SEPARATOR . IndexController::LOG_LOCATION;
// 		echo realpath(__DIR__. DIRECTORY_SEPARATOR . IndexController::LOG_LOCATION);die();
		$log->pushHandler(new StreamHandler(__DIR__. DIRECTORY_SEPARATOR . "..". DIRECTORY_SEPARATOR . IndexController::LOG_LOCATION, Logger::DEBUG));
		return $log;
	}
}