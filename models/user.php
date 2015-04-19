<?php
    class user{

        private $first_name;
        private $last_name;
        private $user_name;
        private $email;
        private $password;

        function __construct($post){
            $this->first_name = $post['first_name'];
            $this->last_name = $post['last_name'];
            $this->user_name = $post['user_name'];
            $this->email = $post['email'];
            $this->password = $post['password'];
        }
        public function toString(){
            return join("<===>", array(
                $this->first_name,
                $this->last_name,
                $this->user_name,
                $this->email,
                $this->password
            )) . "<br>";

        }


        //functions to create and update comments
        public function addUser(){
            return join("",array(
                "insert into users(first_name, last_name, user_name, email, password) values(",
                "'{$this->first_name}',",
                "'{$this->last_name}',",
                "'{$this->user_name}',",
                "'{$this->email}',",
                "'{$this->password}'",
                ")"
            ));

        }

    }
    //this method requires an associative array
    function createUserCol($assComments){
        $output = array();
        foreach($assComments as $key=>$value){
            $temp = new comment($value['first_name'],$value['last_name'],$value['user_name'], $value['user_name'], $value['email'], $value['password']);
            array_push($output,$temp);

        }
        return $output;

    }

?>
