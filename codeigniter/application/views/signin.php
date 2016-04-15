<!DOCTYPE HTML>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title> Signin Page </title>
		<link rel='stylesheet' type='text/css' href='/assets/css/bootstrap.min.css'>
		<link rel='stylesheet' type='text/css' href='/assets/css/signin_styles.css'>
		<script src='/assets/js/jquery-2.2.0.min.js'></script>
		<script src='/assets/js/bootstrap.min.js'></script>
	</head>
	<body>
		<div class='container'>
			<nav class="navbar navbar-default">
        		<div class="container-fluid">
          			<div class="navbar-header">
            			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
             	 			<span class="sr-only">Toggle navigation</span>
              				<span class="icon-bar"></span>
              				<span class="icon-bar"></span>
              				<span class="icon-bar"></span>
            			</button>
            			<a class="navbar-brand">The Wall 2.0</a>
          			</div>
          			<div id="navbar" class="navbar-collapse collapse">
            			<ul class="nav navbar-nav">
              				<li class="active"><a href="/">Home</a></li>
            			</ul>
            			<ul class="nav navbar-nav navbar-right">
              				<li><a href="/">Sign in</a></li>
            			</ul>
          			</div>
        		</div>
        	</nav>
          	<div class='container-fluid'>
          		<div class='form_error'><?php echo $this->session->flashdata('result'); ?></div>
        		<div class='row'>
        			<div class='col-sm-6' class='col-xs-6'>
        				<form role="form" action='/login' method='post'>
						  	<div class="form-group">
						    	<label for="email">Email address:</label>
						  		<label class='form_error'><?php echo form_error('email'); ?></label>
						    	<input type="email" class="form-control" name="email">
						  	</div>
						  	<div class="form-group">
						    	<label for="password">Password:</label>
						  		<label class='form_error'><?php echo form_error('password'); ?></label>
						    	<input type="password" class="form-control" name="password">
						  	</div>
						  	<button type="submit" class="btn btn-default">Sign In</button>
						</form>
        			</div>
        		</div>
        		<div class='vert-offset'></div>
        		<div class='row'>
        			<div class='col-sm-6' class='col-xs-12'>
        				<a href='/register'>Dont have an account? Register</a>
        			</div>
        		</div>
        	</div>
      	</div>
	</body>
</html>
