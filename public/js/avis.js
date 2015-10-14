$(document).ready(function() {

	$('a').click(function(){
		if($(this).hasClass('like'))
			var t = 'like';
		else if ($(this).hasClass('dislike'))
			var t = 'dislike';
		var aviID = $(this).attr('class').substring($(this).attr('class').indexOf('/')+1);
		$.ajax ({
		    method: "POST",
	  		url: "?r=avi/saveLike",
	  		data: {avisId : aviID, type : t},
		    success: function(msg) {
		    	$(".like.\\/"+aviID).html('<span class="text-success glyphicon glyphicon-thumbs-up"></span> '+msg.substring(0, msg.indexOf('/'))); 	
		    	$(".dislike.\\/"+aviID).html('<span class="text-danger glyphicon glyphicon-thumbs-down"></span> '+msg.substring(msg.indexOf('/')+1)); 
			}
		});
	});
	
	
});
