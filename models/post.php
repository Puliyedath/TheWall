<?php
    class post{

        private $description;
        var $created_at ;
        var $updated_at ;
        private $user_id ;
        var $likes = 0;

        private function validate($post_description,$post_user_id, $post_post_id){
            return true;
        }

        function __construct($post,$user_id){

            if(!(self::validate($post_description,$post_user_id))){
                return false ;
            }
            $this->description = $post['description'];
            $this->created_at = date('Y-m-d H:i:s');
            $this->updated_at = $this->created_at;
            $this->user_id = $user_id;
        }

        function getLikes(){
            return $this->likes;
        }

        function like(){
            $this->likes++;
        }

        function getDescription(){
            return "<li><p>{$this->description}</p></li>";
        }


        public function toString(){
            return join("<===>", array(
                $this->likes,
                $this->description,
                $this->created_at ,
                $this->updated_at ,
                $this->user_id 
            )) . "<br>";

        }


        //functions to create and update posts
        public function createPosts(){
            return join("",array(
                "insert into posts(description, created_at, updated_at, user_id) values(",
                "'{$this->description}',",
                "'{$this->created_at}',",
                "'{$this->updated_at}',",
                "{$this->user_id}",
                ")"
            ));

        }

    }
    function updatePosts($id){
        return join("",array(
            "UPDATE COMMENTS",
            "set updated_at=",
            "now()",
            "where id=$id"
        ));
    }

    //this method requires an associative array
    function createColPosts($assComments){
        $output = array();
        foreach($assComments as $key=>$value){
            $temp = new post($value['description'],$value['user_id']);
            $temp->created_at = $value['created_at'];
            $temp->updated_at = $value['updated_at'];
            $temp->like = $value['likes'];
            array_push($output,$temp);

        }
        return $output;

    }

?>
