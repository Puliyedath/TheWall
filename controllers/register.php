<?php
    require($_SERVER["DOCUMENT_ROOT"] . '/models/user.php');
    require($_SERVER["DOCUMENT_ROOT"] . '/controllers/new-connection.php');
    require($_SERVER["DOCUMENT_ROOT"] . '/models/post.php');
    session_start();

    $action = array(
        'register' => function(){
            $temp_user = new user($_POST);
            $query = $temp_user->addUser();

            run_mysql_query($query);
            $query = "select id,user_name from users where user_name='{$_POST['user_name']}' and password='{$_POST['password']}'";
            $user = fetch($query);
            $_SESSION['user_id'] = $user[0]['id'];
            $_SESSION['user_name'] = $user[0]['user_name'];
        },
        'login' => function(){
            $query = "select id,user_name from users where user_name='{$_POST['user_name']}' and password='{$_POST['password']}'";
            $user = fetch($query);
            $_SESSION['user_id'] = $user[0]['id'];
            $_SESSION['user_name'] = $user[0]['user_name'];
        }
    );

    $action[$_POST['action']]();
    
    //collect all the messages for that user and display it on the dashboard;
    //$posts=fetch("select * from posts where user_id={$_SESSION['user_id']}");
    $posts =fetch("select posts.id,posts.description,users.user_name,posts.created_at from posts LEFT JOIN users on posts.user_id = users.id");
    $_SESSION['posts']= $posts;
    header('Location: ../views/home.php');






?>
