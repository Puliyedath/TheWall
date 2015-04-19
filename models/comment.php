<?php
    class comment{

        private $description;
        var $created_at ;
        private $user_id ;
        private $post_id;

        private function validate($comment_description,$comment_user_id, $comment_post_id){
            return true;
        }

        function __construct($post,$user_id){

            if(!(self::validate($comment_description,$comment_user_id, $comment_post_id))){
                return false ;
            }
            $this->description = $post['description'];
            $this->created_at = date('Y-m-d H:i:s');
            $this->user_id = $user_id;
            $this->post_id = $post['hpost_id'];
        }

        public function toString(){
            return join("<===>", array(
                $this->description,
                $this->created_at ,
                $this->user_id ,
                $this->post_id
            )) . "<br>";

        }

        //functions to create and update comments
        function createComments(){
            return join("",array(
                "insert into comments(description, created_at, user_id, post_id) values(",
                "'{$this->description}',",
                "'{$this->created_at}',",
                "{$this->user_id},",
                "{$this->post_id}",
                ")"
            ));

        }
    }
?>
