<?php
/**
* EventSource class
* @author Zsdroid [635925926@qq.com]
*/
class EventSource
{
	/**
	* @var $event event
	*/
	private $event = NULL;
	/**
	* @var $data data
	*/
	private $data = NULL;
	/**
	* @var $id id
	*/
	private $id = NULL;
	/**
	* @var $retry try time
	*/
	private $retry = NULL;
	
	/**
	* set event
	* @param string $event event
	* 
	* @return EventSource EventSource Object
	*/
	public function setEvent($event = NULL)
	{
		$this->event = $event;
		return $this;
	}
	/**
	* set data
	* @param array|string $data data
	* 
	* @return EventSource EventSource Object
	*/
	public function setData($data = [])
	{
		!is_array($data) and $data = [$data];
		$this->data = $data;
		return $this;
	}
	/**
	* set LastEventId
	* @param int $lastEventId LastEventId
	* 
	* @return EventSource EventSource Object
	*/
	public function setLastEventId($lastEventId = 1)
	{
		$this->id = $lastEventId;
		return $this;
	}
	/**
	* set retry
	* @param int $retry try time
	* 
	* @return EventSource EventSource Object
	*/
	public function setRetry($retry = 1000)
	{
		$this->retry = $retry;
		return $this;
	}
	/**
	* get the LAST_EVENT_ID
	* 	<br><br>
	* 	the first time you called the function, you will get NULL, because client not send LAST_EVENT_ID
	* 	<br>
	* 	so if the function returned NULL, you can initialize the LAST_EVENT_ID, and give it to <i>setLastEventId()<i>
	*/
	public function getLastEventId()
	{
		return isset($_SERVER['HTTP_LAST_EVENT_ID']) ? $_SERVER['HTTP_LAST_EVENT_ID'] : NULL;
	}
	/**
	* stop the EventSource
	*/
	public function stop()
	{
		if(PHP_VERSION >= 5.4)
			http_response_code('204');
		else
			header('HTTP/1.1 204 No Content');
		exit;
	}
	/**
	* output
	*/
	public function output()
	{
		$strs = [];
		$d = ['event','data','id','retry'];
		foreach($d as $value)
		{
			if($this->{$value} != NULL)
			{
				if(is_array($this->{$value}))
				{
					foreach($this->{$value} as $valuea)
					{
						$strs[] = $value.':'.$valuea;
					}
				}
				else
				{
					$strs[] = $value.':'.$this->{$value};
				}
			}
		}
		
		header('Content-Type: text/event-stream');
		header('Cache-Control: no-cache');
		echo implode(PHP_EOL,$strs).PHP_EOL.PHP_EOL;
		flush();
	}
}
