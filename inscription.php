<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $nom=$_POST["name"];
    $password=$_POST["password"];
    $email=$_POST["email"];
    $password_confirmation=$_POST["password_confirmation"];
    $user=[];
    if($_POST["valider"]){
    if(strlen($nom)>= 4 )
    {
        $user["name"]=$nom;
    }
    else{echo "veuiller saisis un nom valide";}
    if($password === $password_confirmation)
    {
        $user["password"]=$password;
    }
    else{echo "erreur au niveau du password ou password confirme";}
       $regex="^[a-zA-Z0-9]+@[a-zA-Z0-9-]+\.[a-zA-Z.]+$";
    if(preg_match($regex,$email))
    {
        $user["email"]=$email;
    }
    else{echo "veuiller saisis un email valide";}  
    }
    if(count($user)==3){
        try{
            $conn =new PDO("mysql:host=localhost;dbname=boostrap;port3306","root","Artemis");
            echo"connect succesful\n";
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $code->prepare("SELECT * from users WHERE email=:truc");
            $code->bindparam(":truc", $user["email"]);
            $code->execute();
            $user=$code->fetch();

        }










    }
    else{ ?>
            <form  method="post">
             <h3>veuillez remplir le formulaire</h3><br>
             name<input type="text" name="name" placeholder="name"><br>
             email<input type="email" name="email" placeholder="email"><br>
            password<input type="password" name="password" placeholder="password"><br>
            password<input type="password" placeholder="password_confirmation"><br>
             <input type="submit" value="valider" name="valider">
            </form>
            <?php
        }?>
</body>
</html>