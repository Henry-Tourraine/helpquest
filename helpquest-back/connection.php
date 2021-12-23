
<?php
  session_start();
  header('Content-Type: application/json');
  include('db.php');
  $json = file_get_contents('php://input');

  
  $data = json_decode($json);
  

  $email = $data->email;
  $password_ = $data->password_;
 
 

  $create = $conn->query("SELECT * FROM users WHERE email='$email'");
  

  if($create->num_rows == 1 ){
    $temp = $create -> fetch_all(MYSQLI_ASSOC);
    password_verify($password_, $temp[0]["password_"]);
    $_SESSION['name'] = $temp[0]["name_"];
    $_SESSION['surname'] = $temp[0]["surname"];
    $_SESSION['id'] = $temp[0]["id"];
    echo json_encode(array("name" => $temp[0]["name_"], "surname" => $temp[0]["surname"], "id" => $temp[0]["id"]));
    
    die();
  }else{
      echo json_encode(array("name" => false));
      die();
  }
  
  ?>