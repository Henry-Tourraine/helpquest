<?php
  include('db.php');
  $json = file_get_contents('php://input');

  echo $json;
  $data = json_decode($json);
  

  $name_ = $data->name;
  $surname = $data->surname;
  $birthdate = $data->birth;
  $ip = $data->ip;
  $pseudo = $data->pseudo;
  $email = $data->email;
  $password_ = $data->password;
  $password_ = password_hash($password_, PASSWORD_DEFAULT);


  $create = $conn->query('INSERT INTO users(name_, surname,	birthdate,	ip,	pseudo,	email,	password_) VALUES("'.$name_.'", "'.$surname.'", "'.$birthdate.'", "'.$ip.'","'.$pseudo.'","'.$email.'", "'.$password_.'")');
  if($create === true){
    echo "\n Vous êtes insrit !";
  }else{
    echo "Une erreur est survenue";
  }
?>