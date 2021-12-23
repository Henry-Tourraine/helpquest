<?php
    session_start();
    if(isset($_SESSION["name"])){
        $name = $_SESSION["name"];
        echo "Bonjour $name";
    
    echo <<<HTML
    <button onclick="fetch('log_out.php').then(e=>window.location.replace('/helpquest-back/'))">se déconnecter</button>
HTML;  
    }else{
        echo <<<HTML

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connect</title>
</head>
<body>
    <div>
        <label for="">Email</label>
        <input type="text" name="email">
    </div>
    <div>
        <label for="">Mot de passe</label>
        <input type="text" name="password">
    </div>
    <button id="send">Valider</button>
    <script>
        let sendable = false
        window.addEventListener('DOMContentLoaded', ()=>{
        let [email, getEmail , setEmail] =  ["", ()=>{return document.getElementsByName('email')[0]}, ()=>{email = document.getElementsByName('email')[0].value}];
            
        let [password, getPassword , setPassword] = ["", ()=>{return document.getElementsByName('password')[0]}, ()=>{password = document.getElementsByName('password')[0].value}];

        [getPassword(), getEmail()].forEach(e=>addEventListener('input', (ev)=>{
            
            switch(ev.target.name){
                case 'email':
                    setEmail();
                case 'password':
                    setPassword()    
            }
        }))
        if(getPassword().value != "" || getPassword().value != undefined){
                if(getEmail().value != "" || getEmail().value != undefined){
                    sendable = true;
                }
            } 
        function sign_in(){
            if(sendable==true){
                    fetch('connection.php', {method: 'POST', headers: {'Content-Type': 'application/json'}, body:  JSON.stringify({"email": email, "password_": password})})
                    .then(e=> e.json())
                    .then(r=>{console.log(r.name);
                                if(r.name != false){
                                    window.location.replace('/helpquest-back/');
                                }})
                } }    
        document.getElementById('send').addEventListener('click', ()=>{
            sign_in()
        })            
    })
        
            
        
    </script>
HTML; 
}
?>    
</body>
</html>

