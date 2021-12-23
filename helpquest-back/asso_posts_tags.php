<?php
    session_start();
    include('db.php');
    if(isset($_SESSION['id'])){
        if(isset($_POST)){
        $json = file_get_contents('php://input');

  
        $data = json_decode($json);
     
        $post_id = $data->post_id;
        var_dump($post_id);
        $tags = $data->tags_id;
        var_dump($images);
        
        
        foreach($tags as $tag_id){
            $sql = "INSERT INTO asso_posts_tags(post_id, tag_id) VALUES($post_id, $tag_id)";
            $result = $conn->query($sql);
            if($result == true){
                echo "asso_posts_tags mis à jour \n"; 
            }else{
                echo "query failed";
            }
        }
        
           
    }else{
        echo "presque";  
    }
    }else{
        echo "Nous n'avons pas pu publier votre article";       
    }
?>