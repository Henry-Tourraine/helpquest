<?php


    if(isset($_SESSION["name"])){
        $name = $_SESSION["name"];
        echo "Bonjour $name";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class='form'>
        <div>
            <label for="">Prénom</label>
            <input type="text" name="prenom">
        </div>
        <div>
            <label for="">Nom</label>
            <input type="text" name="nom">
        </div>
        <div>
            <label for="">Date de naissance</label>
            <input type="date" name="birth">
        </div>
        <div>
            <label for="">Pseudo</label>
            <input type="text" name="pseudo">
        </div>
        <div>
            <label for="">Email</label>
            <input type="text" name="email">
        </div>
        <div>
            <label for="">Mot de passe</label>
            <input type="text" name="password">
        </div>
        <div>
            <label for="">Confirmer mot de passe:</label>
            <input type="text" name="pwd_check">
            <div id="error_pwd"></div>
        </div>
        <button onClick="create_account()">Valider</button>
        
    </div>
    <script>
            let sendable = false;
            var [name_, getName_, setName_] = ["", ()=>{return document.getElementsByName('nom')[0]}, ()=>{name_ = document.getElementsByName('nom')[0].value}];
            
            let [surname, getSurname, setSurname] = ["", ()=>{return document.getElementsByName('prenom')[0]}, ()=>{surname = document.getElementsByName('prenom')[0].value}];
            
            let [birth, getBirth, setBirth] =  ["", ()=>{return document.getElementsByName('birth')[0]}, ()=>{birth = document.getElementsByName('birth')[0].value}];
            
            let [ip, getIp, setIp] = ["", ()=>{return ip}, ()=>{return fetch('https://api.ipify.org?format=json').then(e=>e.json()).then(r=>{return ip = r.ip})}];

            let [pseudo, getPseudo , setPseudo] =  ["", ()=>{return document.getElementsByName('pseudo')[0]}, ()=>{pseudo = document.getElementsByName('pseudo')[0].value}];

            let [email, getEmail , setEmail] =  ["", ()=>{return document.getElementsByName('email')[0]}, ()=>{email = document.getElementsByName('email')[0].value}];
            
            let [password, getPassword , setPassword] = ["", ()=>{return document.getElementsByName('password')[0]}, ()=>{password = document.getElementsByName('password')[0].value}];
            
            let [pwd_check, getPwd_check, setPwd_check] = ["", ()=>{return document.getElementsByName('pwd_check')[0]}, ()=>{pwd_check = document.getElementsByName('pwd_check')[0].value}];
            
            let setError_pwd = (msg)=>document.getElementById('error_pwd').innerHTML=msg;
            document.addEventListener('DOMContentLoaded', ()=>{
                setIp();
            [getName_(), getSurname(), getBirth(), getPseudo(), getEmail(), getPassword(), getPwd_check()].forEach(e=>{
                e.addEventListener('input', ev=>{
                    
                    switch(ev.target.name){
                        case 'prenom':
                            setSurname();
                        case 'nom':
                            setName_();
                        case 'birth':
                            setBirth();
                        case 'pseudo':
                            setPseudo(); 
                        case 'email': 
                            setEmail();
                            checkEmail();
                        case 'password':
                            setPassword();
                            checkPwd(); 
                        case 'pwd_check':
                            setPwd_check();
                            checkPwd();
                    }
                    
                })
            });    
            
                    
            })
            function checkPwd(){
                    if(password != pwd_check && pwd_check.length > 0){
                        setError_pwd("les mots de passe ne correspondent pas !");
                        sendable = false;
                    }
                    else if(pwd_check.length > 0){
                        setError_pwd("les mots de passe correspondent  !");
                        sendable = true;
                    }
                }
            const checkEmail = (email) => {
                return String(email)
                    .toLowerCase()
                    .match(
                    /[a-zA-Z0-9]*@[a-zA-Z0-9]*\.(fr|com|org)/
                    );
                };
            
            
        
        
        function create_account(){
            console.log(sendable)
            if(sendable==true){
                console.log(name_, surname, email, pwd_check, password, birth, pseudo, ip)
                fetch('/create_account.php', {method: 'POST', headers: {'Accept': 'application/json','Content-Type': 'application/json'}, body:JSON.stringify({"name": name_, "surname": surname, "birth": birth, "ip": ip, "pseudo": pseudo, "email": email, "password": password})})
                .then(e=>{return e.text()})
                .then(r=>{console.log(r)})
            }
        }
    </script>
</body>
</html>