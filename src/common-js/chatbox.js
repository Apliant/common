var Chatbox = function(){};
var chatboxId = 0;
var chatboxes = {};
Chatbox.prototype = {
	id: null,
	to: "default",
	toAlias: "default",
	me: "default",
	hasFile: false,
	filePath: null,
	init: function(to, toAlias, me)
	{
		console.log("running chatbox init function");
		this.id = to.replace(/\(/g, "").replace(/\)/g, "").replace(/ /g, "").replace(/-/g, "").replace(/\+/g, "");
		this.to = to;
		this.toAlias = toAlias;
		this.me = me;
		/*if(chatboxes[this.id] == null)
		{
			console.log("chatboxes id is null");
			return;
		}*/
		chatboxes[this.id]= this;


		$(".chatarea").append("<div class=\"chatbox\" id=\"chatbox_"+this.id+"\">"+
			"<div class=\"chatbox-header\" id=\"chatbox_header_"+this.id+"\">"+
			this.toAlias+
			"<span class=\"exit\" id=\"chatbox_exit_"+this.id+"\" data-id=\""+this.id+"\"><i class='fa fa-close pull-right handy'></i></span>"+
			"</div>"+
			"<div class=\"chatbox-body\" id=\"chatbox_body_"+this.id+"\">"+
			"</div>"+
			"<div class=\"chatbox-controls\"><div class='row'><div class='col-sm-12'>"+
			"<select id='chatbox_quick_messages_"+this.id+"' class='chatbox-replyquick c-select' data-id='"+this.id+"'>"+
			"<option value='null'>Quick Message</option>"+
			"</select></div></div>"+
			"<div class='row textarea-row'><div class='col-sm-12'>"+
			"<div class='input-group'><span class='input-group-addon' data-toggle='popover' title='Click to attach...'><input type='file' style='position:absolute;width:39px;height:60px;opacity:0;margin-left:-13px;margin-right:-21px;margin-top:-22px;z-index:100001;cursor:pointer;' id='chatbox_attach_file_"+this.id+"' name='chatbox_files_"+this.id+"[]' data-id='"+this.id+"' data-url='/uploadfile' /><i class='fa fa-paperclip'></i></span><textarea id=\"chatbox_send_message_"+this.id+"\" class=\"chatbox-replybox form-control\" data-id=\""+this.id+"\" rows=\"2\"></textarea><div class='input-group-btn'><button id=\"chatbox_send_button_"+this.id+"\" class=\"chatbox-replybtn btn btn-primary pull-right btn-sm\" data-id=\""+this.id+"\">Send</button></div>"+
			"</div></div>"+
			"<div class='row'><div class='col-sm-12'><div class='chatbox-controls-buttons' id='chatbox-controls-buttons'>"+
			//"<input type='file' id='chatbox_attach_file_"+this.id+"' name='chatbox_files_"+this.id+"[]' class='chatbox-replybtn form-control' data-id='"+this.id+"' data-url='/uploadfile' multiple/>"+
			//"<button id='chatbox_attach_button_"+this.id+"' class='chatbox-replybtn btn btn-secondary btn-sm' data-id='"+this.id+"'>Attach</button>"+
			
			"</div></div></div>"+
			"</div>"+
			"</div>"
			);
		$("#chatbox_send_button_"+this.id).on("click", function(){
			var chatbox = chatboxes[$(this).attr("data-id")];
			var val = $("#chatbox_send_message_"+chatbox.id).val();
			if((val == '' || val == null) && !chatbox.hasFile)
			{
				return;
			}
			chatbox.addReply(val, true);
			$("#chatbox_send_message_"+chatbox.id).val("");
			$("#chatbox_attach_file_"+chatbox.id).val("");
		});

		$("#chatbox_attach_file_"+this.id).on("change", function(){
			console.log("Attaching file");
			
			var chatbox = chatboxes[$(this).attr("data-id")];
			var fileselect = $("#chatbox_attach_file_"+chatbox.id);
			console.log(fileselect);
			var files = fileselect[0].files;
			var formData = new FormData();
			formData.append('file', files[0], files[0].name);
			formData.append('id', chatbox.id);
			formData.append('filename', files[0].name);
			var xhr = new XMLHttpRequest();
			xhr.open('POST', fileselect.data("url"), true);
			xhr.onload = function(){
				var res = xhr.responseText;
				if(xhr.status === 200)
				{
					document.getElementById("chatbox-controls-buttons").innerHTML = "<i class='fa fa-paperclip'></i> "+files[0].name;
					chatbox.hasFile = true;
					chatbox.filePath = res;
				}
				else
				{
					alert("An error occured");
				}
			}

			xhr.send(formData);
		});

		$("#chatbox_quick_messages_"+this.id).on("change", function(){
			var chatbox = chatboxes[$(this).attr("data-id")];
			if($(this).val() != "null")
			{
				chatbox.addReply($(this).val(), true);
				$(this).val("null");
			}
		});

		
		$('#chatbox_header_'+this.id).on('click', function(){
			$(this).siblings().slideToggle(400, function(){});
		});

		$("#chatbox_exit_"+this.id).on("click", function(){
			var id = $(this).attr("data-id");
			var chatbox = chatboxes[id];
			chatbox.destroy();
			delete chatboxes[id];
		});

		$("#chatbox_send_message_"+this.id).on("keyup", function(e){
			if(e.which == 13)
			{
				$("#chatbox_send_button_"+$(this).attr("data-id")).click();
			}
		});

		var body = $("#chatbox_body_"+this.id);
		body.animate({scrollTop: body.attr("scrollHeight") - body.height()}, 3000);

		$(document.body).on("click", ".message img", function(){
			var id = $(this).data("id");
			var chatbox = chatboxes[id];
			chatbox.imageClickCallback($(this).prop("src"));
		});

		/*$('#chatbox_'+this.id).draggable({
			handle: "#chatbox_header_"+this.id
		});*/

	},
	addReceived: function(message, runcallback)
	{
		$("#chatbox_body_"+this.id).append(
			"<div class=\"message-received\">"+
			"<div class=\"message\">"+
			message+
			"</div>"+
			"</div>"
			);
		if(runcallback)
		{
			this.receivedCallback(this.to, message);
		}
	},
	addReply: function(message, runcallback)
	{
		origmessage = message;
		if(this.hasFile)
		{
			message = "<img src='"+this.filePath+"' data-id='"+this.id+"'/></br>" + message;
		}
		$("#chatbox_body_"+this.id).append(
			"<div class=\"message-reply\">"+
			"<div class=\"message\">"+
			message+
			"</div>"+
			"</div>"
			);
		if(runcallback)
		{
			if(this.hasFile)
			{
				console.log("file attached..attempting to send");
				this.hasFile = false;
				$('#chatbox-controls-buttons').html("");
				message = {"message": message, "origmessage": origmessage, "url": this.filePath};
			}
			this.replyCallback(this.to, message);
		}
	},
	addQuickMessage: function(message)
	{
		$("#chatbox_quick_messages_"+this.id).append(
			"<option value='"+message+"'>"+message+"</option>"
			);
	},
	receivedCallback: function(from, message){},
	replyCallback: function(to, message){},
	imageClickCallback: function(url){},
	destroy: function()
	{
		$("#chatbox_"+this.id).remove();
	}
};
