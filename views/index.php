<!doctype html>
<?php
session_start();
?>
<html>
    <head>
        <title></title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/index.css">
    </head>
    <body>
        <div id="container">
            <h1>The Wall</h1>
            <form id="login" action="../controllers/register.php" method="post">
                <ul>
                    <li><input type="text" name="user_name" placeholder="username"></li>
                    <li><input type="text" name="password" placeholder="password"></li>
                    <li><input type="submit" name="action" value="login"><p> <?php echo $_SESSION['login'] ?></li>
                </ul>
            </form>
            <form id="register" action="../controllers/register.php" method="post">
                <ul>
                    <li><input type="text" name="first_name" placeholder="FirstName"><p><?php echo $_SESSION['errors']['first_name']?></p></li>
                    <li><input type="text" name="last_name" placeholder="LastName"><p><?php echo $_SESSION['errors']['last_name']?></p></li>
                    <li><input type="text" name="user_name" placeholder="UserName"><p><?php echo $_SESSION['errors']['user_name']?></p></li>
                    <li><input type="text" name="email" placeholder="Email"><p><?php echo $_SESSION['errors']['email']?></p></li>
                    <li><input type="text" name="password" placeholder="Password"><p><?php echo $_SESSION['errors']['password']?></p></li>
                    <li><input type="submit" name="action" value="register"  ><p><?php echo $_SESSION['register'] ?></p></li>
                </ul>
            </form>
        </div>
        <?php
           $_SESSION['errors'] = null;
           $_SESSION['login'] = null;
           $_SESSION['register'] = null;
           ?>
    </body>
</html>
