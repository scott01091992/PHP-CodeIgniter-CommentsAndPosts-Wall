<!DOCTYPE HTML>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title> Dashboard </title>
		<link rel='stylesheet' type='text/css' href='/assets/css/bootstrap.min.css'>
		<link rel='stylesheet' type='text/css' href='/assets/css/dashboard_styles.css'>
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
                <div class='col-xs-12'>
                    <h2>All users</h2>
                    <table class='table table-hover'>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Created At</th>
                            <th>User Level</th>
                        </tr>
                        <?php
                            foreach($users as $user){
                              if($user['security_level'] == 9){
                                $level = 'admin';
                              }elseif($user['security_level'] == 0){
                                $level = 'user';
                              }
                                echo "<tr>
                                          <td>".$user['id']."</td>
                                          <td><a href='show/{$user['id']}'>".ucfirst($user['first_name'])." ".ucfirst($user['last_name'])."</a></td>
                                          <td>".$user['email']."</td>
                                          <td>".$user['created_at']."</td>
                                          <td>".$level."</td>
                                     </tr>";
                            }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>