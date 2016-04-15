<!DOCTYPE HTML>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title> Register </title>
		<link rel='stylesheet' type='text/css' href='/assets/css/bootstrap.min.css'>
		<link rel='stylesheet' type='text/css' href='/assets/css/wall_styles.css'>
		<script src='/assets/js/jquery-2.2.0.min.js'></script>
		<script src='/assets/js/bootstrap.min.js'></script>
        <?php 
            function make_timestamp($time){
                $time_passed = time() - strtotime($time);
                if($time_passed < 3600){
                    if(floor($time_passed/60) == 1){
                        return floor($time_passed/60)." minute ago";
                    }
                    else{
                        return floor($time_passed/60)." minutes ago";
                    }
                }elseif($time_passed < 86400){
                    if(floor($time_passed/3600) == 1){
                        return floor($time_passed/3600)." hour ago";
                    }
                    else{
                        return floor($time_passed/3600)." hours ago";
                    }
                   
                }elseif($time_passed < 604800){
                    if(floor($time_passed/86400) == 1){
                        return floor($time_passed/86400)." day ago";
                    }
                    else{
                        return floor($time_passed/86400)." days ago";
                    }
                   
                }else{
                    return date('F jS Y', strtotime($message['message']['created_at']));
                }
            }
        ?>
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
                    <h2><?= ucfirst($user['first_name']).' '.ucfirst($user['last_name']) ?></h2>
                    <table class='table table-bordered'>
                      <tr>
                        <th>Registered at:</th>
                        <td><?= $user['created_at'] ?></td>
                      </tr>
                      <tr>
                        <th>User ID:</th>
                        <td><?= $user['id'] ?></td>
                      </tr>
                      <tr>
                        <th>Email Address:</th>
                        <td><?= $user['email'] ?></td>
                      </tr>
                      <tr>
                        <th>Description:</th>
                        <td><?= $user['description'] ?></td>
                      </tr>
                    </table>
                    <h2>Leave a message for <?= ucfirst($user['first_name']) ?></h2>
                    <form id='message_form' action=<?= "'"."/post_message/{$user['id']}"."'" ?> method='post'>
                        <div class='form-group'>
                            <label for='message_text'>Message:</label>
                            <textarea class='form-control' name='message_text'></textarea>
                        </div>
                        <button class='btn btn-default' type='submit'>Post</button>
                    </form>
                    <?php
                        foreach($messages['messages'] as $message){
                            $messager = ucfirst($message['message']['first_name']);
                            $message_timestamp = make_timestamp($message['message']['created_at']);
                            echo "<span class='comment_name'>{$messager} wrote:</span><span class='timestamp'>{$message_timestamp}</span>
                                 <div class='message_box'>".$message['message']['message']."</div>";
                                    foreach($message['comments'] as $comment){
                                        $commenter = ucfirst($comment['first_name'])." ".ucfirst($comment['last_name']);
                                        $comment_timestamp = make_timestamp($comment['created_at']);
                                        echo "<span class='comment_name'>{$commenter} Commented</span><span class='timestamp'>{$comment_timestamp}</span>";
                                        echo "<div class='message_box'>{$comment['comment']}</div>";
                                    }

                            echo "<form class='comment_form' action='/post_comment/{$message['message']['id']}' method='post'>
                                    <div class='form-group'>
                                        <input type='hidden' name='page' value='{$user['id']}'>
                                        <input type='hidden' name='message_user' value='{$message['message']['users_id']}'>
                                        <textarea class='form-control' name='comment_text'></textarea>
                                    </div>
                                    <button class='btn btn-default' type='submit'>Comment</button></form>";
                                   
                        }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>