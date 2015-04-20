<?php
    require($_SERVER["DOCUMENT_ROOT"] . '/models/user.php');
    require($_SERVER["DOCUMENT_ROOT"] . '/controllers/new-connection.php');
    require($_SERVER["DOCUMENT_ROOT"] . '/models/post.php');
    session_start();

    
    $action = array(
        'register' => function(){
            

            $validation = array(
                    'name' => function($name){
                        if(empty($name) || ($name === "")){
                            return "name cannot be empty";
                        }   
                            return "";
                    },  
                    'password' => function($pwd){
                        if (empty($pwd)){
                            return "password field cannot be empty";
                        }elseif (strlen($pwd) < 4){
                            return  "password field needs to have more than 4 characters";
                        }
                        return "";
                    },
                    'email' => function($email){
                        if(!(filter_var($email, FILTER_VALIDATE_EMAIL))){
                            return "email is invalid";
                        }
                        return "";
                    }

                );

            //validate the input
            $errors = array();
            $errors['first_name'] = $validation['name']($_POST['first_name']);
            $errors['last_name'] = $validation['name']($_POST['last_name']);
            $errors['user_name'] = $validation['name']($_POST['user_name']);
            $errors['email'] = $validation['email']($_POST['email']);
            $errors['password'] = $validation['password']($_POST['password']);

            $fields = array('first_name','last_name','user_name','email','password');
            $result = true;
            foreach($fields as $field){
                if ($errors[$field] !== ""){
                    $result = false;
                }
            }

            if ($result === false){
                header('Location: ../views/index.php');
                $_SESSION['errors'] = $errors;
                exit();
            }


            //if the user is already registered
            $query = "select id,user_name from users where user_name='{$_POST['user_name']}' and password='{$_POST['password']}'";
            if (count(fetch($query)) > 0){
                $_SESSION['register'] = "user is already registered";
                header('Location: ../views/index.php');
                exit();
            }

            $temp_user = new user($_POST);
            $query = $temp_user->addUser();

            run_mysql_query($query);
            $query = "select id,user_name from users where user_name='{$_POST['user_name']}' and password='{$_POST['password']}'";
            $user = fetch($query);

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['user_name'];
        },

        'login' => function(){
            //this query should only return one result - validate that
            $query = "select id,user_name from users where user_name='{$_POST['user_name']}' and password='{$_POST['password']}'";
            $user = fetch($query);

            //invalid login
            if ($user === null ){
                $_SESSION['login'] = "invalid login credentials";
                header('Location: ../views/index.php');
                exit();
            }

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['user_name'];
        }

    );


    
    $action[$_POST['action']]();

    $posts =fetch("select posts.id,posts.description,users.user_name,posts.created_at from posts LEFT JOIN users on posts.user_id = users.id");
    $_SESSION['posts']= $posts;
    header('Location: ../views/home.php');

?>
