# event-source

an event-source demo

	use event-source to make a progress bar of demo

### what is event-source

[EventSource](https://developer.mozilla.org/en-US/docs/Web/API/EventSource)

### demo 

[demo](http://github.zhusaidong.cn/event-source/)

![gif](https://raw.githubusercontent.com/zhusaidong/event-source/master/gif.gif)

### usage

- php
```
$eventSource = new EventSource;
$lastEventId = $eventSource->getLastEventId();
$eventSource
	->setLastEventId(1)
	->setData([])
	->setEvent('ProgressEvent')
	->setRetry(1000)
	->output();
```

- js

```
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
```
