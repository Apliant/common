var Pubsub = function(){};
Pubsub.prototype = {
	socket: null,
	debug_var: true,

	init: function(serverIp, port, agentId)
	{
		 this.debug("Attempting connection to "+serverIp+" on port "+port+" with agent ID: "+agentId);
		 this.socket = io.connect(serverIp+":"+port+"/", { query: "agentId="+agentId});
		 this.debug("Socket opened to " + serverIp + ":" + port);
	},

	subscribe: function(room, callback){
		if(this.socket == null)
		{
			return false;
		}
		this.socket.emit("subscribe", room);
		this.socket.on(room, callback);
		this.debug("Subscribed to " + room);
		return true;
	},

	unsubscribe: function(room){
		if(this.socket == null)
		{
			return false;
		}
		this.socket.emit("unsubscribe", room);
		this.debug("Unsubscribed from " + room);
	},

	publish: function(room, message){
		if(this.socket == null)
		{
			return false;
		}
		this.socket.emit("publish", room, message);
		this.debug("Published " + message + " to " + room);
		return true;
	},

	debug: function(message)
	{
		if(this.debug_var)
		{
			console.log(message);
		}
	}
};
