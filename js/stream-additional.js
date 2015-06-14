//ADDITIONAL STREAM
function addStreamAdditional(id, name, target, width, height) {
	var code = 	'';
	code += '<div class="col-sm-8 col-md-6 col-lg-4">';
	if(name.length > 0) {
		code +=	'	<h3><img id="close' + id + '" class="icon" src="images/CloseIcon.png" /> ' + name + '</h3>';
	} else {
		code +=	'	<h3><img id="close' + id + '" class="icon" src="images/CloseIcon.png" /> ' + target + '</h3>';
	}
	code += '	<embed type="application/x-vlc-plugin"';
	code += '		id="' + id + '"';
	code += ' 		class="stream-additional"';
	code += ' 		width="' + width + '" height="' + height + '"';
	code += ' 		pluginspage="http://www.videolan.org"';
	code += ' 		target="' + target + '" />';
	code += '</div>';
	
	$('#div-stream-form').before(code);
	
	var vlc = $('#' + id).get(0);
	vlc.audio.toggleMute();
	
	$('#close' + id).click(function() {
		$(this).parent().parent().remove();
	});
}

function getStreamAdditionalWidth() {
	return $('#div-stream-form').width()
}

function getStreamAdditionalHeight() {
	return getStreamAdditionalWidth() * 0.45;
}

function addDropDownClickEvents() {
	//register open stream event
	$('#dd-list li button').unbind('click');
	$('#dd-list li button').click(function() {
		var width = getStreamAdditionalWidth();
		var height = getStreamAdditionalHeight();
		
		var name = $(this).find('.dd-name').text();
		var id = $('#next_id').val();
		$('#next_id').val(parseInt(id) + 1);
		
		var ip = $(this).find('.dd-ip').text();
		var port = $(this).find('.dd-port').text();
		
		var target = 'http://' + ip;
		if(port.length > 0)  {
			target += ':' + port;
		}
		
		addStreamAdditional(id, name, target, width, height);
	});
	
	//register delete stream event
	$('#dd-list li img').unbind('click');
	$('#dd-list li img').click(function() {
		var button = $(this).parent().find('.stream-menu-item');
		
		var ip = $(button).find('.dd-ip').text();
		var port = $(button).find('.dd-port').text();
		var name = $(button).find('.dd-name').text();
		
		$.post('stream.php', { stream_delete: 'stream_delete', ip: ip, port: port, name: name }, function () {
			//remove entry from dropdown
			$(button).parent().parent().remove();
		});
	});
}



			