<?php
    session_start();
    //postMessage to the database
    require($_SERVER["DOCUMENT_ROOT"] . '/controllers/new-connection.php');
    require($_SERVER["DOCUMENT_ROOT"] . '/models/comment.php');

    $temp_comment = new comment($_POST, $_SESSION['user_id']);
    $query = $temp_comment->createComments();
    run_mysql_query($query);

    header('Location: ../views/home.php');

?>
