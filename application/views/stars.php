<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
  <head>
    <title>CLC Stars</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
    <link href="css/flat-ui.css" rel="stylesheet">
    <link href="css/stars.css" rel="stylesheet" media="screen">
  </head>
  <body>
  	<div class="header">
  		<h1>CLC Stars</h1>
  	</div>
  	<div class="container"> 		
  		<div class="row">
  			<div class="span3 form">
  				<label>Give star to:</label>
					<select name="vote_to" class="span3">
						<option value="0"></option>
						<?php foreach ($stars->result() as $star) : ?>
						<option value="<?php echo $star->id; ?>"><?php echo $star->name; ?></option>
						<?php endforeach; ?>
					</select>
					
					<label>Given By:</label>
					<select name="vote_from" value="Given by:" class="span3">
						<option value="0"></option>
						<?php foreach ($stars->result() as $star) : ?>
						<option value="<?php echo $star->id; ?>"><?php echo $star->name; ?></option>
						<?php endforeach; ?>
					</select>
					
					<label>Reason:</label>
					<textarea name="reason" class="span3"></textarea>
					
					<div class="btn-container">
						<button type="submit" class="btn btn-large btn-block btn-info">Give a Star!</button>
					</div>
				</div>
				<div class="span9">
					<table class="chart">
						<thead>
							<tr>
								<th>Name</th>
								<th>Star Power</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							foreach ($stars->result() as $star)
							{
									echo '<tr id="' . $star->id . '">';
									echo '<td class="name">' . $star->name . '</td>';
									echo '<td class="stars">';
								
									for ($i=0; $i<$star->stars; $i++)
									{
											echo '<i class="icon-star"></i>';
									}
									
									echo ' <span class="star-count">(' . $star->stars . ')</span>';
									echo '</td>';
									echo '</tr>';
							}
							?>
						</tbody>
					</table>
				</div>
  		</div>
  	</div>
  	<!--
  	<div class="history">
  		<ul>
				<?php 
				foreach ($votes->result() as $vote)
				{
						echo '<li>';
						echo $vote->timestamp;
						echo '</li>';
				}
				?>
  		</ul>
  	</div>
  	-->
    
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!--<script src="js/jquery.dropkick-1.0.0.js"></script>-->
    <script>
    	$().ready(function() {
    	
    		//$("select").dropkick();
    		
	    	$('button').click(function(e) {
		    	e.preventDefault();
		    	// get form stuff
		    	var vote_from = $('select[name="vote_from"]').val();
		    	var vote_to = $('select[name="vote_to"]').val();
		    	var reason = $('textarea[name="reason"]').val();
		    	console.log(vote_from);
		    	console.log(vote_to);
		    	console.log(reason);
		    	// pass to db
		    	$.ajax({
			    	url: 'http://stars.sitesbyjoe.com/index.php/welcome/give',
			    	method: 'post',
			    	data: 'vote_from=' + vote_from + '&vote_to=' + vote_to + '&reason=' + reason,
			    	success: function(data) {
				    	data = $.parseJSON(data);
				    	console.log(data);
				    	console.log(data.id);
				    	console.log(data.stars);

				    	// make the stars
				    	var num_stars = Number(data.stars);
				    	var star_string = '';
				    	
				    	for (i=0; i<num_stars; i++) {
					    	star_string += '<i class="icon-star"></i>';
				    	}
				    	star_string += ' <span class="star-count">(' + data.stars + ')</span>';
				    	console.log(star_string);
				    	
				    	$('tr[id="' + data.id + '"] td.stars').html(star_string);
				    	//$('button').fadeOut();
				    	$('.btn-container').append('<em>Thanks for Giving!</em>');
				    	$('.btn-container em').delay(3000).fadeOut();
				    	// reset controls next
				    	$('select[name="vote_to"]').val('0');
				    	$('textarea[name="reason"]').val('');
			    	}
		    	});
	    	});
    	});
    </script>
  </body>
</html>