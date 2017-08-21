/*
EventSource
	@author zsdroid
*/
var _EventSource = (sourceUrl,option) =>
{
	if(typeof(EventSource) === "undefined")
	{
		throw ('your browser not support EventSource');
	}
	var source = new EventSource(sourceUrl);
	//Custom Event
	var customEvent = (event,callback) =>
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
		//if not set event,will use 'message' event
		customEvent((event != null || event != '') ? event : 'message',option[e].callback);
	}
}
