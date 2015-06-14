<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Rosario Brancato">

    <title>Security Camera</title>
	<link rel="shortcut icon" href="images/SecurityCameraIcon.png">

	<!--Google jQuery csn-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" type="text/css"/>
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

	<!-- My CSS -->
	<link rel="stylesheet" href="css/general.css" type="text/css">
	<link rel="stylesheet" href="css/main-view.css" type="text/css">
	<link rel="stylesheet" href="css/secondary-stream.css" type="text/css">
	
</head>
<body>
	<div class="container-fluid">
		<header>
			<h1 class="page-header text-center"><img class="logo" src="images/SecurityCameraIcon.png" /> Security Camera</h1>
		</header>
		
		<div class="row">
			<!-- SIDEBAR -->
			<div class="col-sm-2">
				<p>
					<ul class="nav nav-pills nav-stacked">
						<li role="presentation" class="nav-option active"><a href="#">Live Streams</a></li>
						<li role="presentation" class="nav-option"><a href="videos.php">Surveillance Videos</a></li>
					</ul>
				</p>
			</div>
			
			<div class="col-sm-10">
				<!-- MAIN STREAM -->
				<div class="row">
					<div id="div-stream-main" class="col-sm-12">
						<!-- inserted with js -->
					</div>
				</div>
				<!-- ADDITIONAL STREAMS -->
				<div id="div-streams" class="row">
					<div id="div-stream-form" class="col-sm-8 col-md-6 col-lg-4">
						<div class="well well-lg bg-transparent">
							<h3>Start additional stream</h3>
							
							<div class="dropdown">
								<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
									<span> Choose a stream... </span>
									<span class="caret"></span>
								</button>
								<ul id="dd-list" class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
<?php
								include_once('bo/Stream.php');
								include_once('db/StreamDAO.php');
								
								$dao = new StreamDAO();
								$streams = $dao->getStreams();
							
								foreach($streams as $stream) {
?>
									<li role="presentation">
										<div class="form-inline">
											<button class="form-control no-border stream-menu-item text-left" role="menuitem" tabindex="-1" href="#">
												<span class="dd-name"><?php echo $stream->getName(); ?></span><?php if(strlen($stream->getName()) > 0) { echo ' - '; } ?><span class="dd-ip"><?php echo $stream->getIp(); ?></span>:<span class="dd-port"><?php echo $stream->getPort(); ?></span>
											</button>
											<img class="icon" src="images/CloseIcon.png" />
										</div>
									</li>
<?php
								}								
?>	
								</ul>
							</div>
						
							<h4>... or input a new one.</h4>
							
							<div class="row">
								<div class="col-sm-8">IP adress*</div>
								<div class="col-sm-4">Port*</div>
							</div>
							<div class="row">
								<div class="col-sm-8"><input id="txt-stream-ip" class="form-control" type="text" maxlength="15" /></p><!--  --></div>
								<div class="col-sm-4"><input id="txt-stream-port" class="form-control" type="text" value="8554" maxlength="5" /></div>
							</div>
							<p>Name <input id="txt-stream-name" class="form-control" type="text" maxlength="30" /></p>
							<p><button id="btn-stream-start" class="btn btn-info">Start!</button></p>
						</div>
					</div>
					<input type="hidden" id="next_id" value="0" />
				</div>
				
			</div>
		</div>
		
		<footer>
			<p class="text-right">Made by Rosario Brancato</p>
		</footer>
		
	</div>
	 
	<script src="plugin/jquery.cookie.js"></script>
	<script src="js/cookie_utils.js"></script>
	<script src="js/stream-main.js"></script>
	<script src="js/stream-additional.js"></script>
	<script>
		$(document).ready(function() {
			//Main panel
<?php 
		$pid_stream = shell_exec('pidof raspivid');
		$pid_motion = shell_exec('pidof motion-mmal');
		if($pid_stream != null && strlen($pid_stream) > 0) {
			echo 'loadStreamMainPlugin(TARGET, getStreamMainWidth(), getStreamMainHeight());';
		} else if($pid_motion != null && strlen($pid_motion) > 0) {
			echo 'loadMotionPanel();';
		} else {
			echo 'loadControlPanel();';
		}
?>
			addDropDownClickEvents();
		
			$('#txt-stream-main-ip, #txt-stream-main-port').keyup(function(e) {
				//check if enter-key was released
				if(e.keyCode == '13') {
					$('#stream-start').trigger('click');
				}
			});
			
			$('#txt-stream-ip, #txt-stream-port, #txt-stream-name').keyup(function(e) {
				//check if enter-key was released
				if(e.keyCode == '13') {
					$('#btn-stream-start').trigger('click');
				}
			});
			
			//Add additional stream panel
			$('#btn-stream-start').click(function() {
				var width = getStreamAdditionalWidth();
				var height = getStreamAdditionalHeight();
				
				var name = $('#txt-stream-name').val();
				var id = $('#next_id').val();
				$('#next_id').val(parseInt(id) + 1);
				
				var ip = $('#txt-stream-ip').val();
				var port = $('#txt-stream-port').val();
				
				var target = 'http://' + ip;
				if(port.length > 0)  {
					target += ':' + port;
				}
				
				//Testing
				//var target = $('#txt-stream-ip').val();
				
				if(ip.length > 0 && port.length > 0) {
					addStreamAdditional(id, name, target, width, height);
					
					//clear fields
					$('#txt-stream-ip').val('');
					$('#txt-stream-port').val('8554');
					$('#txt-stream-name').val('');
					
					//save entry
					$.post('stream.php', { stream_add: 'stream_add', ip: ip, port: port, name: name }, function () {
						//add entry to dropdown
						var html = '';
						html += '<li role="presentation">';
						html += '	<div class="form-inline">';
						html += '		<button class="form-control no-border stream-menu-item text-left" role="menuitem" tabindex="-1" href="#">';
						if(name.length > 0) {
							html += '			<span class="dd-name">' + name + '</span> - <span class="dd-ip">' + ip + '</span>:<span class="dd-port">' + port + '</span>';
						} else {
							html += '			<span class="dd-name"></span><span class="dd-ip">' + ip + '</span>:<span class="dd-port">' + port + '</span>';
						}
						html += '		</button>'
						html += '		<img class="icon" src="images/CloseIcon.png" />';
						html += '	</div>';
						html += '</li>';
						$('#dd-list').append(html);
						addDropDownClickEvents();
					});
				}
			});
			
		});
			
	</script>
</body>