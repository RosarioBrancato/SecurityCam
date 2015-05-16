//MAIN STREAM
function loadStreamMainPlugin(target, width, height) {
	var code = '<embed type="application/x-vlc-plugin"';
	code += ' id="stream-main"';
	code += ' class="vlc-player"';
	code += ' name="stream-main"';
	code += ' width="' + width + '" height="' + height + '"';
	code += ' mute="true"';
	code += ' windowless="false"';
	code += ' pluginspage="http://www.videolan.org"';
	code += ' target="' + target + '" />';
	
	$('#div-stream-main').html(code);
}

function getStreamMainWidth() {
	return $('#div-stream-main').width() - 15;
}

function getStreamMainHeight() {
	return getStreamMainWidth() * 0.45;
}