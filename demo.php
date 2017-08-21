<?php
/**
* EventSource demo
* @author Zsdroid [635925926@qq.com]
*/
require_once('EventSource.class.php');

$time = date('Y-m-d H:i:s');
$progress = range(1,100);

$eventSource = new EventSource;

$lastEventId = $eventSource->getLastEventId();
if($lastEventId == null)
{
	$progressId = 1;
}
else if($lastEventId == count($progress))
{
	$eventSource->stop();
}
else
{
	//进度操作
	$addProgress = rand(1,20);
	$progressId = $lastEventId + $addProgress;
	$progressId > count($progress) and $progressId = count($progress);
}

$eventSource
	->setLastEventId($progressId)
	->setData([$progress[$progressId - 1],$time])
	->setEvent('ProgressEvent')
	->setRetry(1000)
	->output();
