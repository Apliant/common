var Contactbox = function(){};
var contactboxes = [];
var contactboxid = 0;
Contactbox.prototype = {
	id: 0,
	init: function(){
		$(".contactarea").append(
			'<div class="contactbox" id="contactbox_id_'+this.id+'">'+
			'<div class="contactbox-header" id="contact_header_'+this.id+'">'+
			'<i class="fa fa-edit"></i> Contacts'+
			'</div>'+
			'<div class="contactbox-add"><div class="row"><div class="col-sm-12 contactbox-add-col"><div class="input-group contactbox-input-group">'+
			'<input type="text" id="contactbox_add_box_'+this.id+'" class="contactbox-addbox phone form-control"/><div class="input-group-btn">'+
			'<button id="contactbox_add_button_'+this.id+'" class="contactbox-addbtn btn btn-primary" data-id="'+this.id+'">Add</button></div></div>'+
			'</div><div class="row"><div class="col-sm-12 contactbox-body-row">'+
			'<div class="contactbox-body" id="contactbox_body_'+this.id+'" data-id="'+this.id+'">'+
			'</div></div></div>'+
			'<div class="contactbox-controls"><div class="row"><div class="col-sm-12"><div class="input-group">'+
			'<input type="text" id="contact_control_message_'+this.id+'" class="contactbox-searchbox phone form-control"/><div class="input-group-btn">'+
			'<button id="contact_control_search_'+this.id+'" class="contactbox-searchbtn btn btn-primary">Find</button></div>'+
			'</div>'+
			'</div>'
			);
		contactboxes.push(this);
		
		$("#contactbox_body_"+this.id).on("click", "div", function(){
			contactboxes[$(this).parent().data("id")].contactClickedCallback($(this));			
		});

		$("#contactbox_add_button_"+this.id).on("click", function(){
			var id = $(this).data("id");
			var val = $("#contactbox_add_box_"+id).val();
			val = val.replace(/\(/g, "").replace(/\)/g, "").replace(/ /g, "").replace(/-/g, "");
			console.log(val);
			if(val == '' || val == null || val.length < 11)
			{
				console.log("invalid number");
				return;
			}

			contactboxes[id].addContact(val, val, true);
			val = val.replace("+", "");
			$("#div_id_"+val).click();
		});
		$('#contact_header_'+this.id).on('click', function(){
			$(this).siblings().slideToggle(400, function(){});
		});

		$("#contactbox_body_"+this.id).contextmenu({
			delegate: '.hasMenu',
			autoFocus: true,
			preventContextMenuForPopup: true,
			preventSelect: true,
			taphold: true,
			menu: [
			{title: "Rename", cmd: "rename", uiIcon: "ui-icon-copy"}
			],
			select: function(event, ui)
			{
				var target = ui.target; 
				if(target.data("id") == undefined)
				{
					target = ui.target.parent();
				}
				var number = target.attr("data-number");
				var id = target.attr("data-id");
				console.log(number + " " + id);
				switch(ui.cmd)
				{
					case "rename":
					var text = target.find(".alias").text();
					var alias = prompt("Name: ", text);
					if(alias != null)
					{
						target.find(".alias").text(alias);
					}
					break;
				}

				contactboxes[id].contextmenuCallback(ui.cmd, target);
			},
			beforeOpen: function(event, ui)
			{
				ui.menu.zIndex(100000);
			}
		});
	},
	addContact: function(number, alias, runcallback){
		console.log(number + " " + alias);
		var id = number.replace("+", "");
		var body = $("#contactbox_body_"+this.id);
		var exists = false;
		body.children().each(function(){
			var n = $(this).data("number") + "";
			if(n.indexOf(number) > -1 || number.indexOf(n) > -1)
			{
				exists = true;
				return false;
			}
		});
		if(!exists)
		{
			$("#contactbox_body_"+this.id).append('<div class="hasMenu" data-number="'+number+'" id="div_id_'+id+'" data-id="'+this.id+'"><span class="alias">'+alias+'</span></div>');

			if(runcallback)
			{
				this.addContactCallback(number, alias, true);
			}
		}
	},
	updateRead: function(number, unread)
	{
		console.log(unread);
		var html = "";
		if(unread > 0)
		{
			html += '<span class="badge pull-right inbox-badge" style="background-color: red">'+unread+'</span>';
		}

		number = number.replace("+", "");

		var contact = $("#div_id_"+number);
		console.log(contact);
		contact.find(".badge").remove();
		contact.append(html);
	},
	contactRightClicked: function(div){

	},
	addContactCallback: function(number, alias){},
	contactClickedCallback: function(div){
		console.log("you clicked "+ $(this).data("number"));
	},
	contactRightClickedCallback: function(){},
	contextmenuCallback: function(command, div){}

}