<?php
    if(isset($_POST['Cancel'])){
        header('location:admin.php');
    }
    if(isset($_POST['update'])){
        $p1=$_POST['prdname'];
        $p2=$_POST['prdprice'];
        $dt = file_get_contents('data.json');
        $array = json_decode($dt,true);
        foreach($array as $ar => $s){
            if($s['name']==$_GET['id']){
                        $array[$ar]['name']=$p1;
                        $array[$ar]['prix']=$p2;
            }}
            $fdata = json_encode($array);
            if(file_put_contents('data.json',$fdata)){
            header('location:admin.php?updt');
            }  
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XjonSNow | Product Edit</title>
    <link rel="stylesheet" href="./CSS/edit.css" >
</head>
<body>
    <div class="container">
        <form action="" method="POST">
            <?php
                 $dt=file_get_contents('data.json');
                 $array = json_decode($dt,true);
                 foreach($array as $a){
                    if($a['name']==$_GET['id']){
                     echo("<img src=\"{$a['image']}\" > <h3>Product Name</h3>  <input name=\"prdname\" value=\"{$a['name']}\" >  
                     <h3>Product Price </h3>  <input name=\"prdprice\" value=\"{$a['prix']}\"  > <br>  <button  name=\"Cancel\" >Cancel</button> <button  name=\"update\" >Update</button>   ");
                    }
                 }

            ?>

        </form>
    </div>
</body>
</html>