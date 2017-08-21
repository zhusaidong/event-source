<?php
/**
* EventSource class
* @author Zsdroid [635925926@qq.com]
*/
class EventSource
{
	/**
	* @var $event 事件
	*/
	private $event = NULL;
	/**
	* @var $data 数据
	*/
	private $data = NULL;
	/**
	* @var $id id
	*/
	private $id = NULL;
	/**
	* @var $retry 重复时间
	*/
	private $retry = NULL;
	
	/**
	* 设置event事件
	* @param string $event 事件
	* 
	* @return EventSource EventSource对象
	*/
	public function setEvent($event = NULL)
	{
		$this->event = $event;
		return $this;
	}
	/**
	* 设置data数据
	* @param array|string $data 数据
	* 
	* @return EventSource EventSource对象
	*/
	public function setData($data = [])
	{
		!is_array($data) and $data = [$data];
		$this->data = $data;
		return $this;
	}
	/**
	* 设置LastEventId
	* @param int $lastEventId LastEventId
	* 
	* @return EventSource EventSource对象
	*/
	public function setLastEventId($lastEventId = 1)
	{
		$this->id = $lastEventId;
		return $this;
	}
	/**
	* 设置retry重复时间
	* @param int $retry 重复时间
	* 
	* @return EventSource EventSource对象
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
