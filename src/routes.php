<?php
// Routes
//use MyTest;

$app->get('/hello', FeedbackBatch\MyTest::class . ':hello');

$app->get('/readQueue', FeedbackBatch\FeedbackQueue::class . ':readQueue');
$app->get('/sendMessage', FeedbackBatch\FeedbackQueue::class . ':sendMessage');


//include_once 'lib/MyTest.php';

$app->get('/test', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    $a = new FeedbackBatch\MyTest(null);
    $a->hello();
    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});
