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
				<ul class="nav nav-pills nav-stacked">
					<li role="presentation" class="nav-option active"><a href="#">Live Streams</a></li>
					<li role="presentation" class="nav-option"><a href="videos.php">Surveillance Videos</a></li>
				</ul>
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
					<div id="div-stream-form" class="col-lg-4">
						<h3>Start additional stream</h3>
						
						<p>
							<div class="dropdown">
								<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
									<span> Choose a stream... </span>
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
									<li role="presentation"><a role="menuitem" tabindex="-1" href="#"> Some guy's stream - 123.123.123.123:12345 </a></li>
								</ul>
							</div>
						</p>
					
						<h4>or input one</h4>
						
						<p>IP adress* <input id="txt-stream-ip" class="form-control" type="text" /></p><!--maxlength="15"-->
						<p>Port* <input id="txt-stream-port" class="form-control" type="text" value="8554" maxlength="5" /></p>
						<p>Name <input id="txt-stream-name" class="form-control" type="text" maxlength="30" /><p>
						<button id="btn-stream-start" class="btn btn-info">Start!</button>
					</div>
					<input type="hidden" id="next_id" value="0" />
				</div>
				
			</div>
		</div>
		
		<footer>
			<p class="text-right">Made by Rosario Brancato</p>
		</footer>
		
	</div>
	 
	<script src="js/constants.js"></script>
	<script src="js/stream-main.js"></script>
	<script src="js/stream-additional.js"></script>
	<script>
		$(document).ready(function() {
			//Main panel
			loadControlPanel();
		
			//Add additional stream panel
			$('#btn-stream-start').click(function() {
				var width = getStreamAdditionalWidth();
				var height = getStreamAdditionalHeight();
				
				var name = $('#txt-stream-name').val();
				var id = $('#next_id').val();
				$('#next_id').val(parseInt(id) + 1);
				
				/*var ip = $('#txt-stream-ip').val();
				var port = $('#txt-stream-port').val();
				var target = 'http://' + ip;
				if(port.length > 0)  {
					target += ':' + port;
				}*/
				
				//Testing
				var target = $('#txt-stream-ip').val();
				
				addStreamAdditional(id, name, target, width, height);
				
				//clear fields
				$('#txt-stream-ip').val('');
				$('#txt-stream-port').val('8554');
				$('#txt-stream-name').val('');
			});
		
		});
	</script>

</body>