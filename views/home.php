<!doctype html>
<?php
session_start();
require($_SERVER["DOCUMENT_ROOT"] . '/controllers/new-connection.php');
?>
<html>
	<head>
		<title>Home</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	</head>
	<body>
		<nav class="navbar navbar-inverse">
			<div class-="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#wallNavBar">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#">Wall</a>
				</div>

			
			
			</div>
			<div classs="collapse navbar-collapse" id="wallNavBar" >
				<ul class="nav navbar-nav">
					<li class="active"><a href="#">Home</a></li>
					<li><a href="../controllers/logOff.php">LogOff</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="#"><span class="glyphicon glyphicon-user"></span>Welcome, <?php echo $_SESSION['user_name']; ?></a></li>
				</ul>
			</div>
		</nav>



		
		<div class="container">
			<form action="../controllers/postMessage.php" method="post">
				<div class="form-group">
					<label for="message">Post a Message</label>
					<input class="form-control" id="message" type="textarea" name="description" >

				</div>
				<div class="form-group text-right">
					<input type="submit" class="btn btn-primary" name="Post a message" value="Post a message">
				</div>
			</form>
		</div>

		<?php
		function getComments($post_id){
			//$messages = fetch("select * from comments where comments.post_id = $post_id");
			$messages = fetch(join(" ",array(
				"select comments.created_at, users.user_name,comments.description from comments",
					"LEFT JOIN users", 
					"ON comments.user_id = users.id where comments.post_id = $post_id"
			)));

			$temp="";
			if (!(array_key_exists('description',$messages))){
				foreach($messages as $key=>$message){
					$date = new DateTime($message['created_at']);
					$formateed_dateTime= $date->format('l jS F Y');
					$temp = $temp . "<div class='row'>";
					$temp = $temp . "<div class='col-md-4'>";
					$temp = $temp . "</div>";
					$temp = $temp . "<div class='col-md-8'>";
					$temp = $temp . "<div class='panel panel-success'><div class='panel-heading'><h5>{$message['user_name']} wrote on $formateed_dateTime</h5></div><p>{$message['description']}</p></div>";
					$temp = $temp . "</div>";
					$temp = $temp . "</div>";
				}
			}else{
				//fix for the fact when the library returns only one row
				$date = new DateTime($message['created_at']);
				$formateed_dateTime= $date->format('l jS F Y');
				$temp = $temp . "<div class='panel panel-info' ><h5>{$messages['user_name']} wrote on $formateed_dateTime</h5><p>{$messages['description']}</p></div>";
				//$temp = $temp . "<li class='comment pcomment' ><p>{$messages['description']}</p></li>";
			}

			$temp =  $temp . join("",array(
				'<div class="row">',
					'<div class="col-md-4">',
					'</div>',
					'<form class="col-md-8" action="../controllers/postComment.php" method="post">',
					"<div class='form-group'>",
					'<input type="hidden" name="hpost_id" value="' . $post_id . '">',
					'<input class="form-control" type="textarea" name="description" >',
					"</div>",
					"<div class='form-group text-right'>",
					'<input class="btn btn-primary" type="submit" name="Post a comment" value="Post a comment">',
					'</div>',
					'</form>',
					'</div>'
			));
			return $temp;
		}
		?>
		<div class="container">
			<?php 
			if (array_key_exists('description',$_SESSION['posts'])){
				$post = $_SESSION['posts'];
				$date = new DateTime($post['created_at']);
				$formateed_dateTime= $date->format('l jS F Y');
				echo "<div class='panel panel-info'>";
				echo "<div class='panel-heading'>";
				echo "<h5>{$post['user_name']} wrote on $formateed_dateTime</h5>";
				echo "</div>";
				echo "<div class='panel-content'>";
				echo "<p>{$post['description']}</p>";
				echo "</div>";
				echo "</div>";
				echo getComments($post['id']);
			}
			else{
				foreach($_SESSION['posts'] as $key=>$post){
					$date = new DateTime($post['created_at']);
					$formateed_dateTime= $date->format('l jS F Y');
					echo "<div class='panel panel-info'>";
					echo "<div class='panel-heading'>";
					echo "<h5>{$post['user_name']} wrote on $formateed_dateTime</h5>";
					echo "</div>";
					echo "<div class='panel-content'>";
					echo "<p>{$post['description']}</p>";
					echo "</div>";
					echo "</div>";
					echo getComments($post['id']);
				}
			}
			?>
		</div>
	</body>

</html>
