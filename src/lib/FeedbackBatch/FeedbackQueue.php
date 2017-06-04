<?php
namespace FeedbackBatch;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Aws\S3\S3Client;
use Aws\Sqs\SqsClient;
use Aws\Exception\AwsException;

class FeedbackQueue{
	
	const PR_URL = "https://sqs.us-east-2.amazonaws.com/303498416083/userinit";
	
	const QA_URL = "https://sqs.us-east-2.amazonaws.com/303498416083/userinit";
	
	private $logger = null;
	
	public $queue_url = FeedbackQueue::QA_URL;
	
	public function __construct(){
		$this->logger = \FeedbackBatch\lib\Core::logger($this);
		$lcp = getenv("LCP");
		if($lcp != null && $lcp == "PR"){
			$this->queue_url = \FeedbackBatch\FeedbackQueue::PR_URL;
		}
	}
	
	/**
	 * Read the current message queue
	 */
	public function readQueue(){
		$queueUrl = $this->queue_url;
	
		$client = new SqsClient([
				'credentials' => array(
						'key'    => 'AKIAIWULSUVRUIAI6Z2A',
						'secret' => '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'
				),
				'region' => 'us-east-2',
				'version' => 'latest'
		]);
		try {
			$result = $client->receiveMessage(array(
					'AttributeNames' => ['SentTimestamp'],
					'MaxNumberOfMessages' => 10,
					'MessageAttributeNames' => ['All'],
					'QueueUrl' => $queueUrl, // REQUIRED
					'WaitTimeSeconds' => 0,
			));
			if (count($result->get('Messages')) > 0) {
// 				echo "<pre>";
// 				print_r($result->get('Messages'));
				$this->logger->info("Got " . count($result->get('Messages')) . " messages.");
// 				$result = $client->deleteMessage([
// 						'QueueUrl' => $queueUrl, // REQUIRED
// 						'ReceiptHandle' => $result->get('Messages')[0]['ReceiptHandle'] // REQUIRED
// 				]);
			} else {
				echo "No messages in queue. \n";
			}
		} catch (AwsException $e) {
			// output error message if fails
			$this->logger->error($e->getMessage());
				
		}
		echo "QWEQWEQWE";
	}
	
	
	/**
	 * Insert new queue
	 * @param unknown $request
	 * @param unknown $response
	 * @param unknown $args
	 */
	public function sendMessage($request, $response, $args) {
		 
		// Instantiate the S3 client with your AWS credentials
		//         	$s3Client = S3Client::factory(array(
		//         			'credentials' => array(
		//         					'key'    => 'AKIAIWULSUVRUIAI6Z2A',
		//         					'secret' => 'eGmNVRQX/lZtLRQ6GPQhvX6OV/yfsGz9HfB/zgBE'
		//         			),
		//         			'region' => 'us-east-2',
		//         			'version'=> 'latest'
		//         	));
		 
		$qUrl = "https://sqs.us-east-2.amazonaws.com/303498416083/userinit";
		 
		echo "<pre>";
		 
		$client = new SqsClient([
				'credentials' => array(
						'key'    => 'AKIAIWULSUVRUIAI6Z2A',
						'secret' => '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'
				),
				'region' => 'us-east-2',
				'version' => 'latest'
		]);
		$params = [
				'DelaySeconds' => 10,
				'MessageAttributes' => [
						"Title" => [
								'DataType' => "String",
								'StringValue' => "The Hitchhiker's Guide to the Galaxy"
						],
						"Author" => [
								'DataType' => "String",
								'StringValue' => "Douglas Adams."
						],
						"WeeksOn" => [
								'DataType' => "Number",
								'StringValue' => "6"
						]
				],
				'MessageBody' => "Information about current NY Times fiction bestseller for week of 12/11/2016.",
				'QueueUrl' => $qUrl
		];
		try {
			$result = $client->sendMessage($params);
			print_r($result);
		} catch (AwsException $e) {
			// output error message if fails
			print_r($e->getMessage());
			error_log($e->getMessage());
		}
		 
		 
		echo "queue";
	}
}