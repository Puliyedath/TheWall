<?php
    session_start();
    //postMessage to the database
    require($_SERVER["DOCUMENT_ROOT"] . '/controllers/new-connection.php');
    require($_SERVER["DOCUMENT_ROOT"] . '/models/comment.php');
    
    //if the comment is empty dont do anything 
    if (!isset($_POST['description']) || empty($_POST['description']) || ($_POST['description'] === "")){
        header('Location: ../views/home.php');
        exit();
    }

    $temp_comment = new comment($_POST, $_SESSION['user_id']);
    $query = $temp_comment->createComments();
    run_mysql_query($query);

    header('Location: ../views/home.php');

?>
