/*
EventSource
	@author zsdroid
*/
var _EventSource = function(sourceUrl,option)
{
	if(typeof(EventSource) === "undefined")
	{
		throw ('your browser not support EventSource');
	}
	var source = new EventSource(sourceUrl);
	//自定义event事件
	var customEvent = function(event,callback)
	{
		source.addEventListener(event,function(event)
			{
				event.dataArray = event.data.split("\n");
				callback.call(event,event.dataArray,event);
			},false);
	};
	for(var e in option)
	{
		var event = option[e].event || null;
		//没有设置event时,默认为message事件
		customEvent((event != null || event != '') ? event : 'message',option[e].callback);
	}
}
