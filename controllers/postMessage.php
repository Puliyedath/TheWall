<?php
    session_start();
    //postMessage to the database
    require($_SERVER["DOCUMENT_ROOT"] . '/controllers/new-connection.php');
    require($_SERVER["DOCUMENT_ROOT"] . '/models/post.php');

    $temp_post = new post($_POST, $_SESSION['user_id']);
    $query = $temp_post->createPosts();
    run_mysql_query($query);

    $_SESSION['posts'] = $_SESSION['posts'] . $temp_post->getDescription();
    $_SESSION['posts'] = fetch(join(" ",array(
            "select posts.id,posts.created_at, users.user_name, posts.description from users",
            "LEFT JOIN posts", 
            "ON users.id = posts.user_id",
            'order by posts.id desc'
            )));

    header('Location: ../views/home.php');

?>
