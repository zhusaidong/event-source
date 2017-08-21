# event-source

an event-source demo to progress bar

### demo 

<a target="_blank" href="http://github.zhusaidong.cn/event-source/">demo</a>

### how to use

this project simply encapsulates two files

	EventSource.class.php

<code>
$eventSource = new EventSource;

$lastEventId = $eventSource->getLastEventId();

$eventSource
	->setLastEventId(1)
	->setData([])
	->setEvent('ProgressEvent')
	->setRetry(1000)
	->output();
</code>

	EventSource.js

<code>
_EventSource("demo.php",
	[
		{
			//自定义事件
			event:'ProgressEvent',
			callback:function(data)
			{
				//code...
			}
		},
		{
			//默认
			callback:function(data)
			{
			}
		}
	]);
</code>
