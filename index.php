<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
    </head>
    <body>

    <?php 
    if(!empty($_POST["name"]))
    
    echo "Hello " .$_POST["name"] ;

   else
    {
        ?>
        <form method="post" action="">
        <input type="text" name="name"><br>
        <input type="submit" value="submit">
        </form>
     <?php 
    }
?>
    </body>
</html>