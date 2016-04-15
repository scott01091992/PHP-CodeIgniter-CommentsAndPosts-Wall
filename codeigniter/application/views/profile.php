<!DOCTYPE HTML>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title> Register </title>
		<link rel='stylesheet' type='text/css' href='/assets/css/bootstrap.min.css'>
		<link rel='stylesheet' type='text/css' href='/assets/css/register_styles.css'>
		<script src='/assets/js/jquery-2.2.0.min.js'></script>
		<script src='/assets/js/bootstrap.min.js'></script>
        <style>
            table, th, tr, td{
                border: 1px solid black;
            }
        </style>
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
            			<a href='/dashboard' class="navbar-brand">Dashboard</a>
          			</div>
          			<div id="navbar" class="navbar-collapse collapse">
            			<ul class="nav navbar-nav">
              				<li class="active"><a href="/profile">Profile</a></li>
            			</ul>
            			<ul class="nav navbar-nav navbar-right">
              				<li><a href="/signout">Sign out</a></li>
            			</ul>
          			</div>
        		</div>
        	</nav>
            <div class='row'>
                <div class='col-xs-6'>
                   <h1>Edit Profile</h1>
                </div>
            </div>
            <div class='row'>
                <div class='col-xs-6'>
                   <div id='edit-info'>
                        <h3>Edit Information</h3>
                        <form action='/update_info' method='post'>
                            <div class='form-group'>
                                <label for='email'>Email Address</label>
                                <label class='form_error'><?php echo form_error('email'); ?></label>
                                <input class='form-control' type='email' name='email' value=<?= "'".$user['email']."'" ?>>
                            </div>
                            <div class='form-group'>
                                <label for='first_name'>First Name:</label>
                                <label class='form_error'><?php echo form_error('first_name'); ?></label>
                                <input class='form-control' type='text' name='first_name' value=<?= "'".$user['first_name']."'" ?>>
                            </div>
                            <div class='form-group'>
                                <label for='last_name'>Last Name:</label>
                                <label class='form_error'><?php echo form_error('last_name'); ?></label>
                                <input class='form-control' type='text' name='last_name'value=<?= "'".$user['last_name']."'" ?>>
                            </div>
                            <button class='btn btn-default' type='submit'>Save</button>
                        </form>
                   </div>
                </div>
                <div class='col-xs-6'>
                    <div id='password_change'>
                        <h3>Change Password</h3>
                        <form action='/update_password' method='post'>
                            <div class='form-group'>
                                <label for='password'>Password</label>
                                <label class='form_error'><?php echo form_error('password'); ?></label>
                                <input class='form-control' type='password' name='password'>
                            </div>
                            <div class='form-group'>
                                <label for='confirm'>Password Confirmation:</label>
                                <label class='form_error'><?php echo form_error('confirm'); ?></label>
                                <input class='form-control' type='password' name='confirm'>
                            </div>
                            <button class='btn btn-default' type='submit'>Update Password</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class='row'>
                <div class='col-xs-12'>
                    <div id='edit-description'>
                        <h3>Edit Description</h3>
                        <form action='/update_description' method='post'>
                            <div class='form-group'>
                                <label for='desciption'>Description:</label>
                                <label class='form_error'><?php echo form_error('description'); ?></label>
                                <textarea class='form-control' name='description' placeholder=<?= "'".$user['description']."'" ?>></textarea>
                            </div>
                            <button class='btn btn-default' type='submit'>Save</button>
                        </form>
                    </div>
                </div>
            </div>                            
        </div>
    </body>
</html>