<?php

	class VideoGUI {
		
		public function getGUI($filter, $data) {
?>
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
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" type="text/css"/>
	<link rel='stylesheet' type='text/css' href='http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css'/>
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
					<li role="presentation" class="nav-option"><a href="index.php">Live Streams</a></li>
					<li role="presentation" class="nav-option active"><a href="videos.php">Surveillance Videos</a></li>
				</ul>
			</div>
			
			<div class="col-sm-10">
				<!-- FILTER -->
				<form class="row" action="" method="get">
					<div class="col-md-2">
						<p>From date* <input id="date-from" class="form-control date-picker" type="text" name="date-from" required/></p>
					</div>
					<div class="col-md-2">
						<p>To date* <input id="date-to" class="form-control date-picker" type="text" name="date-to" required/></p>
					</div>
					<div class="col-md-2">
						<p>From time <input id="time-from" class="form-control" type="time" name="time-from" value="<?php echo $filter->getTimeFrom(); ?>" /></p>
					</div>
					<div class="col-md-2">
						<p>To time <input id="time-to" class="form-control" type="time" name="time-to" value="<?php echo $filter->getTimeTo(); ?>" /></p>
					</div>
					<div class="col-md-2">
						<p>Show results<input class="form-control btn-info" type="submit" value="Go!" /></p>
					</div>
				</form>
			
				<!-- VIDEOS -->
				<div class="row">
<?php
foreach($data as $video) {
	if(file_exists('videos/' . $video->getFilename())) {
?>
					<div class="col-lg-3 col-md-4 col-sm-6">
						<h3><?php echo $video->getDate() . ' ' . $video->getTime(); ?></h3>
						<embed src="<?php echo 'videos/' . $video->getFilename(); ?>"  autostart="false" />
					</div>
<?php
	}
}
?>				
				</div>
			</div>
		</div>
		
		<footer>
			<p class="text-right">Made by Rosario Brancato</p>
		</footer>
		
	</div>
	<script>
		$(document).ready(function() {
			$('.date-picker').datepicker();
			$('.date-picker').datepicker('option', 'dateFormat', 'dd.mm.yy');
			
			$('#date-from').datepicker('setDate', '<?php echo $filter->getDateFrom(); ?>');
			$('#date-to').datepicker('setDate', '<?php echo $filter->getDateTo(); ?>');
		});
	</script>
</body>
<?php
		}
	}
?>