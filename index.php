<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parfumerie des reves | Home</title>
    <link rel="stylesheet" href="./CSS/index.css" >
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=La+Belle+Aurore&display=swap" rel="stylesheet">
</head>
<body>
    <nav>
        <div class="logo">
                <img src="./pictures/YANV3833.JPG" >
        </div>
        <div class="pages">
            <ul>
                <li class="h" ><a href="./index.php" >Home</a></li>
                <li><a href="./Contact.html" >Contact Us</a></li>
                <li><a href="./log.php" >Admin Zone</a></li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <?php
            $dt=file_get_contents('data.json');
            $array = json_decode($dt,true);
            foreach($array as $a){
                echo("<div class=\"box\" > <img src=\"{$a['image']}\" >  <h5>{$a['name']}</h5>  <p>{$a['prix']}</p>  </div>");
            }
        ?>
    </div>
</body>
</html>