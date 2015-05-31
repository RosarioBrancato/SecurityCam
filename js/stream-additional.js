//ADDITIONAL STREAM
function addStreamAdditional(id, name, target, width, height) {
	var code = 	'';
	code += '<div class="col-lg-4">';
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