//MAIN STREAM
function loadStreamMainPlugin(target, width, height) {
	var code = '';
	code += '<embed type="application/x-vlc-plugin"';
	code += ' id="stream-main"';
	code += ' class="vlc-player"';
	code += ' name="stream-main"';
	code += ' width="' + width + '" height="' + height + '"';
	code += ' pluginspage="http://www.videolan.org"';
	code += ' target="' + target + '" />';
	
	$('#div-stream-main').html(code);
	
	var vlc = $('#stream-main').get(0);
	vlc.audio.toggleMute();
}

function getStreamMainWidth() {
	return $('#div-stream-main').width() - 15;
}

function getStreamMainHeight() {
	return getStreamMainWidth() * 0.45;
}