<!doctype html>
<?php
    require($_SERVER["DOCUMENT_ROOT"] . '/controllers/new-connection.php');
    session_start();
?>
<html>
    <head>
        <title>Home</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/home.css">
    </head>
    <body>
        <ul>
            <li><h3>Coding Dojo Wall</h3></li>
            <li><h4>Welcome <?php echo $_SESSION['user_name']; ?></h4></li>
            <li><a href="">Log Off</a></li>
        </ul>


        <form action="../controllers/postMessage.php" method="post">
            <ul>
                <li><h5>Post a Message</h5></li>
                <li><input type="textarea" name="description" ></li>
                <li><input type="submit" name="Post a message" value="Post a message"></li>
            </ul>
        </form>

<?php
    function getComments($post_id){
        $messages = fetch("select * from comments where comments.post_id = $post_id");
        $temp="<ul>";
        foreach($messages as $key=>$message){
            $temp = $temp . "<li><p>{$message['description']}</p></li>";
        }

        $temp =  $temp . join("",array(
            "<li>",
            '<form action="../controllers/postComment.php" method="post">',
            '<input type="hidden" name="hpost_id" value="' . $post_id. '">',
            '<input type="textarea" name="description" >',
            '<input type="submit" name="Post a comment" value="Post a comment">',
            '</form>',
            "</li>",
        ));
        $temp = $temp. "</ul>";
        return $temp;
    }
?>
        <ul>
<?php 
    foreach($_SESSION['posts'] as $key=>$post){
        echo "<li>";
        echo "{$post['user_name']}-{$post['created_at']}";
        echo "<p>{$post['description']}</p>";
        echo getComments($post['id']);
/*echo join("",array(
                                "<ul>",
                                "<li>",
                                    '<form action="../controllers/postComment.php" method="post">',
                                    '<input type="hidden" name="hpost_id" value="' ,
                                                                                        "{$post['id']}",
                                                                                                '">',
                                        '<input type="textarea" name="description" >',
                                        '<input type="submit" name="Post a comment" value="Post a comment">',
                                    '</form>',
                                "</li>",
                            "</ul>"
));*/
        echo "</li>";
    }
?>
        </ul>

    </body>

</html>
