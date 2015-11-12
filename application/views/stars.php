<!DOCTYPE html>
<html>
  <head>
    <title>CLC Stars</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link href="css/flat-ui.css" rel="stylesheet">
    <link href="css/stars.css" rel="stylesheet" media="screen">
  </head>
  <body>
  	<div class="header">
  		<div class="pull-left">
	  		<h1><i class="fa fa-star"></i> Starboard</h1>
  		</div>
  		<div class="pull-right">
  			<button class="btn btn-large btn-info" data-toggle="modal" data-target="#myModal">Give a Star!</button>
  		</div>
  	</div>
  	
  	<section class="star-chart">
  		<table>
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
									echo '<i class="fa fa-star"></i>';
							}
							
							echo ' <span class="star-count">(' . $star->stars . ' stars)</span>';
							echo '</td>';
							echo '</tr>';
					}
					?>
				</tbody>
			</table>
  	</section>
  	
  	<div class="modal fade" id="myModal">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-body">
  	
				  	<section class="form">
							<label>Give star to:</label>
							<select name="vote_to" class="form-control">
								<option value="0"></option>
								<?php foreach ($stars->result() as $star) : ?>
								<option value="<?php echo $star->id; ?>"><?php echo $star->name; ?></option>
								<?php endforeach; ?>
							</select>
							
							<label>Given By:</label>
							<select name="vote_from" value="Given by:" class="form-control">
								<option value="0"></option>
								<?php foreach ($stars->result() as $star) : ?>
								<option value="<?php echo $star->id; ?>"><?php echo $star->name; ?></option>
								<?php endforeach; ?>
							</select>
							
							<label>Reason:</label>
							<textarea name="reason" class="form-control"></textarea>
							
							<div class="btn-container">
								<button type="submit" class="give btn btn-large btn-block btn-info">Give a Star!</button>
							</div>
						</section>
						
					</div>
				</div>
			</div>
  	</div>
    
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script>
    	$().ready(function() {
    	
    		//$("select").dropkick();
    		
	    	$('button.give').click(function(e) {
		    	e.preventDefault();
		    	// get form stuff
		    	var vote_from = $('select[name="vote_from"]').val();
		    	var vote_to = $('select[name="vote_to"]').val();
		    	var reason = $('textarea[name="reason"]').val();

		    	// pass to db
		    	$.ajax({
			    	url: 'http://stars.sitesbyjoe.com/index.php/welcome/give',
			    	method: 'post',
			    	data: 'vote_from=' + vote_from + '&vote_to=' + vote_to + '&reason=' + reason,
			    	success: function(data) {
				    	
				    	data = $.parseJSON(data);

				    	// make the stars
				    	var num_stars = Number(data.stars);
				    	var star_string = '';
				    	
				    	for (i=0; i<num_stars; i++) {
					    	star_string += '<i class="fa fa-star"></i>';
				    	}
				    	star_string += ' <span class="star-count">(' + data.stars + ' stars)</span>';
				    	console.log(star_string);
				    	
				    	$('tr[id="' + data.id + '"] td.stars').html(star_string);
				    	//$('button').fadeOut();
				    	$('.btn-container').append('<em>Thanks for Giving!</em>');
				    	setTimeout(function() {
					    	$('#myModal').modal('hide');
					    	// reset controls next
								$('select[name="vote_to"]').val('0');
								$('textarea[name="reason"]').val('');
				    	},2500);
				    	
			    	}
		    	});
	    	});
    	});
    </script>
  </body>
</html>