<?php

    if(isset($_POST))
    {
        $name=$_POST['name'];
        $email=$_POST['email'];
        $password=$_POST['password'];
        $password_conf=$_POST['password_confirmation'];

        if(strlen($name)>=3)
        {
            $info_user['name']=$name;
        }else
        {
            echo "Mauvais nom\n";
        }
        if($email)
        {
            $regex = '/^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/';
            if(!preg_match($regex, $email))
            {
                echo "Mauvais email\n";
            }else
            {
                $info_user['email']=$email;
            }
        }
        if(strlen($password)>=4 && $password_conf==$password)
        {
           $info_user['password']=$password;
        }else
        {
            echo "Mauvais password\n";   
        }
      
            try{
                $conn = new PDO("mysql:host=localhost;dbname=boostrape;port=3306", 'root', 'Artemis');
                echo "Connexion Sucessful\n";
                $rq=$conn->prepare("SELECT * from users where email=:em");
                $rq->bindParam(':em', $info_user['email']);
                $rq->execute();
                $user=$rq->fetch();
                if($user)
                {
                    echo "L'utilisation existe deja\n";
                }
                else
                {
                    $created_at= date("y-m-d-H-i-s");
                    $hash=password_hash($info_user['password'], PASSWORD_DEFAULT);
                    $rq=$conn->prepare("INSERT into users(name, email, password, created_at) values(:nam, :email, :pass, :created_at)");
                    $rq->bindParam(':nam', $info_user['name']);
                    $rq->bindParam(':email', $info_user['email']);
                    $rq->bindParam(':pass', $hash);
                    $rq->bindParam(':created_at', $created_at);
                    if($rq->execute())
                    {
                        echo "User created\n";
                    }
                }


            }catch(PDOException $e)
            {
                echo "Failled Connexion ".$e->getMessage()."\n";
            }
        
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>
<body>
    <form action="" method="POST">
        <input type="text" name="name" placeholder="Name"><br><br>
        <input type="email" name="email" placeholder="Email"><br><br>
        <input type="password" name="password" placeholder="Password"><br><br>
        <input type="password" name="password_confirmation" placeholder="Password Confirmation"><br><br>
        <input type="submit" value="Submit">


    </form>
</body>
</html>


