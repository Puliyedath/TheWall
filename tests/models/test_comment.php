<?php
    //echo $_SERVER["DOCUMENT_ROOT"] . '/models/comment.php';
    require($_SERVER["DOCUMENT_ROOT"] . '/models/comment.php');
    $test_comment = new comment("test_description",20,300);
    echo $test_comment->toString();
    echo "<br>";
    $test_comment->like();
    echo $test_comment->toString();

    //test whether a collection gets created from an associative array
    $comments = array(array(
        'description' =>'description', 
        'created_at' =>'created_at', 
        'updated_at' =>'updated_at', 
        'user_id' =>'user_id', 
        'post_id' =>'post_id', 
        'test' =>'test', 
        'tester' =>'tester', 
    ),
    array(
        'description' =>'description2', 
        'created_at' =>'created_at2', 
        'updated_at' =>'updated_at2', 
        'user_id' =>'user_id2', 
        'post_id' =>'post_id2', 
        'test' =>'test2', 
        'tester' =>'tester2', 
    ));


    $colComments = createColComments($comments);
    foreach($colComments as $comment){
        echo $comment->toString();
    }
?>
