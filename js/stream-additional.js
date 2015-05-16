//ADDITIONAL STREAM
function addStreamAdditional(target, width, height, name) {
	var code = 	'<div class="col-lg-4">';
	if(name.length > 0) {
		code +=		'	<h3><img src="images/CloseIcon.png" height="25"><img> ' + name + '</h3>';
	} else {
		code +=		'	<h3><img src="images/CloseIcon.png" height="25"><img> ' + target + '</h3>';
	}
	code += 	'	<embed type="application/x-vlc-plugin"';
	code += 	' 	class="stream-additional"';
	code += 	' 	width="' + width + '" height="' + height + '"';
	code += 	' 	mute="true"';
	code += 	' 	windowless="false"';
	code += 	' 	pluginspage="http://www.videolan.org"';
	code += 	' 	target="' + target + '" />';
	code += 	'</div>';
	
	$('#div-stream-form').before(code);
}