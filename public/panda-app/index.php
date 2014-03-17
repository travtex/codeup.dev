<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Hot Panda!</title>
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />
    <link rel="stylesheet" href="css/main.css" />
    <link href='http://fonts.googleapis.com/css?family=Slackey' rel='stylesheet' type='text/css'>
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
</head>
<body>
	<div class="container clearfix">
		<h1 class="title">PandaRate</h1>
		<div id="display">
			<img id="current_panda" />
			<h3 id="score_track">Average Score: 
				<span id="average"></span>
			</h3>
		</div>
		<br />

		<div id="get_rank col-md-8">
			<p id="rank_text">
		  		<label for="rank">Rank That Panda:</label>
		  		<input type="text" id="rank" style="border:0; font-weight:bold;">
			</p>
	 
			<div id="slider"></div>
			<div id="buttons" class="btn-group btn-group-justified">
			  <div class="btn-group">
			    <button type="button" id="rank_panda" name="rank_panda" class="btn btn-default">Rank Panda</button>
			  </div>
			
			  <div class="btn-group">
			    <button type="button" id="new_panda" name="new_panda" class="btn btn-default">New Panda</button>
			  </div>
</div>
		</div>


	</div>

	<script>
	$(function() {
	    $( "#slider" ).slider({
	      value: 5,
	      min: 1,
	      max: 10,
	      step: 1,
	      slide: function( event, ui ) {
	        $( "#rank" ).val( ui.value );
	      }
	    });
	    $( "#rank" ).val( $( "#slider" ).slider( "value" ) );
	  });

	
  	</script>

	</script>
</body>
</html>