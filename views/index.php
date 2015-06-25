<!doctype html>
<?php
session_start();
?>
<html>
	<head>
		<meta charset="utf-8">
		<title>Coding Dojo - The Wall</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	</head>
	<body>

		<div class="container">
			<div class="jumbotron">
				<h1>Coding Dojo, The Wall</h1>
				<p>Start Posting</p>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<form class="col-xs-12 col-sm-12 col-md-6" id="login" action="../controllers/register.php" method="post">
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
							<input id="userName" class="form-control" type="text" name="user_name" placeholder="username">
						</div>
					</div>
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
							<input class="form-control" id="userPassword" type="text" name="password" placeholder="password">
						</div>
						
					</div>
					<input class="btn btn-primary" type="submit" name="action" value="login"><p> <?php echo $_SESSION['login'] ?>
				</form>
				<form class="col-xs-12 col-sm-12 col-md-6 col-md-6" id="register" action="../controllers/register.php" method="post" >
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
							<input type="text" class="form-control" name="first_name" placeholder="FirstName"><p><?php echo $_SESSION['errors']['first_name']?></p>
						</div>

					</div>
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
							<input type="text" name="last_name" class="form-control" placeholder="LastName"><p><?php echo $_SESSION['errors']['last_name']?></p>
						</div>
					</div>
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
							<input type="text" name="user_name" class="form-control" placeholder="UserName"><p><?php echo $_SESSION['errors']['user_name']?></p>
						</div>
					</div>
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
							<input type="text" name="email" class="form-control" placeholder="Email"><p><?php echo $_SESSION['errors']['email']?></p>
						</div>
					</div>
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
							<input type="text" name="password" class="form-control" placeholder="Password"><p><?php echo $_SESSION['errors']['password']?></p>
						</div>
					</div>
					<input class="btn btn-primary" type="submit" name="action" value="register"  ><p><?php echo $_SESSION['register'] ?></p>
				</form>
			</div>
		</div>
		<?php
		$_SESSION['errors'] = null;
		$_SESSION['login'] = null;
		$_SESSION['register'] = null;
		?>
	</body>
</html>
