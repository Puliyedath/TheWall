<!doctype html>
<html>
    <head>
        <title></title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/index.css">
    </head>
    <body>
        <h1>The Wall</h1>
        <form id="login" action="../controllers/register.php" method="post">
            <ul>
                <li><input type="text" name="user_name" placeholder="username"></li>
                <li><input type="text" name="password" placeholder="password"></li>
                <li><input type="submit" name="action" value="login"></li>
            </ul>
        </form>
        <form id="register" action="../controllers/register.php" method="post">
            <ul>
                <li><input type="text" name="first_name" placeholder="FirstName"></li>
                <li><input type="text" name="last_name" placeholder="LastName"></li>
                <li><input type="text" name="user_name" placeholder="UserName"></li>
                <li><input type="text" name="email" placeholder="Email"></li>
                <li><input type="text" name="password" placeholder="Password"></li>
                <li><input type="submit" name="action" value="register"  ></li>
            </ul>
        </form>
    </body>
</html>
