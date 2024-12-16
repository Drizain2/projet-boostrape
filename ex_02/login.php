<?php

    if(isset($_POST))
    {
        $email=$_POST['email'];
        $password=$_POST['password'];

        $conn = new PDO("mysql:host=localhost;dbname=boostrap;port=3306", 'root', '564256');
                
        $rq=$conn->prepare("SELECT * from users where email =:em");
        $rq->bindParam(':em', $email);
        $rq->execute();
        $user=$rq->fetch();
        if($user)
        {
            if(password_verify($password, $user['password']))
            {
                session_start();
                $_SESSION['name']=$user['name'];
                header('location: index.php');

            }
            else{
                echo "Information de connexion incorrecte\n";
            }
        }
        else{
        echo "Information de connexion incorrecte\n";}
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form action="" method="POST">
        <input type="email" name="email" placeholder="Email"><br><br>
        <input type="password" name="password" placeholder="Password"><br><br>
        <input type="submit" value="Submit" >
    </form>
</body>
</html>

