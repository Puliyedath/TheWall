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
        <ul id="header">
            <li><h2>Coding Dojo Wall</h2></li>
            <li><h4>Welcome <?php echo $_SESSION['user_name']; ?></h4></li>
            <li><a href="">Log Off</a></li>
        </ul>


        <form class="message" action="../controllers/postMessage.php" method="post">
            <ul>
                <li><h5>Post a Message</h5></li>
                <li><input type="textarea" name="description" ></li>
                <li><input type="submit" name="Post a message" value="Post a message"></li>
            </ul>
        </form>

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
                $temp = $temp . "<li class='comment pcomment' ><h5>{$message['user_name']} wrote on $formateed_dateTime</h5><p>{$message['description']}</p></li>";
            }
        }else{
            //fix for the fact when the library returns only one row
            $date = new DateTime($message['created_at']);
            $formateed_dateTime= $date->format('l jS F Y');
            $temp = $temp . "<li class='comment pcomment' ><h5>{$messages['user_name']} wrote on $formateed_dateTime</h5><p>{$messages['description']}</p></li>";
            //$temp = $temp . "<li class='comment pcomment' ><p>{$messages['description']}</p></li>";
        }

        $temp =  $temp . join("",array(
            "<li>",
            '<form class="comment" action="../controllers/postComment.php" method="post">',
                '<input type="hidden" name="hpost_id" value="' . $post_id . '">',
                '<input type="textarea" name="description" >',
                '<input type="submit" name="Post a comment" value="Post a comment">',
            '</form>',
            "</li>",
        ));
        return $temp;
    }
?>
        <ul>
<?php 
    if (array_key_exists('description',$_SESSION['posts'])){
        $post = $_SESSION['posts'];
        $date = new DateTime($post['created_at']);
        $formateed_dateTime= $date->format('l jS F Y');
        echo "<li class='pmessage message'>";
        echo "<h5>{$post['user_name']} wrote on $formateed_dateTime</h5>";
        echo "<p>{$post['description']}</p>";
        echo "</li>";
        echo getComments($post['id']);
    }
    else{
        foreach($_SESSION['posts'] as $key=>$post){
            $date = new DateTime($post['created_at']);
            $formateed_dateTime= $date->format('l jS F Y');
            echo "<li class='pmessage message'>";
            echo "<h5>{$post['user_name']} wrote on $formateed_dateTime</h5>";
            echo "<p>{$post['description']}</p>";
            echo "</li>";
            echo getComments($post['id']);
        }
    }
?>
        </ul>

    </body>

</html>
