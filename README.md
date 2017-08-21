# event-source

an event-source demo

	use event-source to make a progress bar of demo

### #demo 

<a target="_blank" href="http://github.zhusaidong.cn/event-source/">demo</a>

### #how to use

this project simply encapsulates two files

	EventSource.class.php
<pre><code>
$eventSource = new EventSource;
$lastEventId = $eventSource->getLastEventId();
$eventSource
	->setLastEventId(1)
	->setData([])
	->setEvent('ProgressEvent')
	->setRetry(1000)
	->output();
</code></pre>

	EventSource.js

<pre><code>
_EventSource("demo.php",
	[
		{
			//Custom Event
			event:'ProgressEvent',
			callback:function(data)
			{
				//code...
			}
		},
		{
			//default Event
			callback:function(data)
			{
			}
		}
	]);
</code></pre>
