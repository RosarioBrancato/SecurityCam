//MAIN STREAM
function loadControlPanel(target = '') {
	//Remove windows bad ip
	if(target == '::1') {
		target = '';
	}
	
	$(window).unbind('resize');
	
	//get object with all cookie values
	var cookie = getCookieObj();
	
	var code = '';
	code += '<div class="well well-lg bg-transparent">';
	code += '	<h3>Stream and Motion Sensor are turned off.</h3>';
	if(isCookieObjValid(cookie)) {
		code += '	<p>IP Adress* <input id="txt-stream-main-ip" class="form-control" type="text" value="' + cookie.stream_main_ip + '" /></p>';
		code += '	<p>Port* <input id="txt-stream-main-port" class="form-control" type="text" value="' + cookie.stream_main_port + '" /></p>';
	} else {
		code += '	<p>IP Adress* <input id="txt-stream-main-ip" class="form-control" type="text" value="' + target + '" /></p>';
		code += '	<p>Port* <input id="txt-stream-main-port" class="form-control" type="text" value="8554" /></p>';
	}
	code += '	<p>';
	code += '		<span><button id="stream-start" class="btn btn-warning">Start Streaming</button></span>';
	code += '		<span><button id="motion-start" class="btn btn-info">Start the Motion Sensor</button></p></span>';
	code += '	</p>';
	code += '</div>';
	
	$('#div-stream-main').html(code);
			
	$('#stream-start').click(function() {
		var ip = $('#txt-stream-main-ip').val();
		var port = $('#txt-stream-main-port').val();
		
		if(ip.length > 0 && port.length > 0) {
			saveCookies();
			var target = 'http://' + ip + ':' + port;
			
			var html = '';
			html += '<div class="well well-lg bg-transparent">';
			html += '	<h3>Stream is starting up...</h3>';
			html += '</div>';		
			$('#div-stream-main').html(html);

			$.post('stream.php', { stream_start: 'stream_start' }, function() {
				setTimeout(function() {
					//Insert vlc player
					var width = getStreamMainWidth();
					var height = getStreamMainHeight();
					loadStreamMainPlugin(target, width, height);
				}, 5000);
			});
		} else {
			alert('Geben Sie eine IP-Adresse und ein Port ein.');
		}
	});
	
	$('#motion-start').click(function() {
		//saveCookies();
		loadMotionPanel();
		$.post('stream.php', { motion_start: 'motion_start' });
	});
}

function loadMotionPanel() {
	$(window).unbind('resize');
	
	var code = '';
	code += '<div class="well well-lg bg-transparent">';
	code += '	<h3>Motion sensor is turned on.</h3>';
	code += '	<p><button id="motion-end" class="btn btn-danger">Turn Motion Sensor Off</button></p>';
	code += '</div>';	
	
	$('#div-stream-main').html(code);
	
	$('#motion-end').click(function() {
		loadControlPanel();
		$.post('stream.php', { motion_end: 'motion_end' });
	});
}

function loadStreamMainPlugin(target, width, height) {
	var code = '';
	code += '<embed type="application/x-vlc-plugin"';
	code += ' id="stream-main"';
	code += ' class="vlc-player"';
	code += ' name="stream-main"';
	code += ' width="' + width + '" height="' + height + '"';
	code += ' pluginspage="http://www.videolan.org"';
	code += ' target="' + target + '" />';
	
	code += '<p><button id="stream-end" class="btn btn-danger">Turn Stream Off</button></p>';
	
	$('#div-stream-main').html(code);
	
	var vlc = $('#stream-main').get(0);
	vlc.audio.toggleMute();
		
	$('#stream-end').click(function() {
		loadControlPanel();
		$.post('stream.php', { stream_end: 'stream_end' });
	});
			
	//Reload vlc player if window has been resized
	$(window).resize(function() {
		clearTimeout($.data(this, 'resizeTimer'));
		$.data(this, 'resizeTimer', setTimeout(function() {
			var width = getStreamMainWidth();
			var height = getStreamMainHeight();
			var target = $('#stream-main').attr('target');
			loadStreamMainPlugin(target, width, height);
		}, 200));
	});
}

function getStreamMainWidth() {
	return $('#div-stream-main').width() - 15;
}

function getStreamMainHeight() {
	return getStreamMainWidth() * 0.45;
}
