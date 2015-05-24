<!DOCTYPE html>
<html>
<head>
	<!-- Latest compiled and minified CSS -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

	<title>Login</title>
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<div class=".col-xs-12"><br><br></div>
		</div>
		<div class="row">
			<div class="col-md-4"></div>
			  <div class="col-md-4">

			  
			  	<?php 
				  	echo validation_errors();
					echo form_open('users/loggedIn', array('class'=>'form-horizontal'));  
				?>
				  <div class="form-group">
				    <label for="username" class="col-sm-2 control-label">Username</label>
				    <div class="col-sm-10">
				      <input type="username" class="form-control" name="username" id="username" placeholder="Username">
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="password" class="col-sm-2 control-label">Password</label>
				    <div class="col-sm-10">
				      <input type="password" class="form-control" id="password" name="password" placeholder="Password">
				    </div>
				  </div>
				  <div class="form-group">
				    <div class="col-sm-offset-2 col-sm-10">
				      <button type="submit" class="btn btn-default">Sign in</button>
				      &nbsp;<a href="<?php echo base_url().'forgot/'; ?>">Forgot Password</a>
				    </div>
				  </div>
				</form>

			  </div>

			  <div class="col-md-4"></div>
			  
			</div>
			
	</div>

</body>
</html>