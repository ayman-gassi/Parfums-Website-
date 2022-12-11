<?php
    session_start();
    if(!array_key_exists('user',$_SESSION)){
        header('location:log.php?logout');
    }
    if(isset($_POST['submit'])){
        $prdname=$_POST['prdname'];
        $prdprice=$_POST['prdprice'];
        if($prdname=="" || $prdprice=="" || $_FILES['image']["size"]==0 ){
                header('location:admin.php?missing');
        }
        else{
            $image_type = exif_imagetype( $_FILES['image']["tmp_name"]);
            if (!$image_type) {
                header('location:admin.php?error');
            }
            else{
            move_uploaded_file(
                $_FILES['image']["tmp_name"],
            
               
                __DIR__ . "/pictures/" . $_FILES['image']["name"]
            );
            $dt = file_get_contents('data.json');
            $array = json_decode($dt,true);
            $data = array(
                'name' => $prdname,
                'image' => "pictures/".$_FILES['image']["name"],
                'prix' => $prdprice." DH"
            );
            $array[] = $data ; 
            $fdata = json_encode($array);
            if(file_put_contents('data.json',$fdata)){
                header('location:admin.php?Done');
                echo("<script>window.location.reload()</script>");
            }
        }}
    }
    if(isset($_POST['delete'])){
            $pt=$_POST['hack'];
            $dt = file_get_contents('data.json');
            $array = json_decode($dt,true);
            foreach($array as $s => $value){
                if($value['name'] == $pt){
                    unset($array[$s]);
                }
            }
            $final= json_encode($array);
            file_put_contents('data.json',$final);
            header('location:admin.php?ProductDeleted');
            
           
        }
    if(isset($_POST['edit'])){
        $pt=$_POST['hack'];
        header('location:./edit.php?id='.$pt);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Center</title>
    <link rel="stylesheet" href="./CSS/admin.css" >
</head>
<body>
<nav>
       
                <img src="./pictures/YANV3833.JPG" > <h2>Admin Center</h2> <a href="logout.php" >Logout</a>
       
</nav>
<div class="container">
   
    <div class="allprd">
        <h2>All Product</h2>
        <?php
                 $dt=file_get_contents('data.json');
                 $array = json_decode($dt,true);
                 foreach($array as $a){
                    
                     echo(" <form action=\"\" method=\"POST\" >  <div class=\"box\" > <img src=\"{$a['image']}\" >  <h5>{$a['name']}</h5>  <p>{$a['prix']}</p> <div class=\"change\"> <button name=\"edit\" ><img src=\"pictures/pen.png\" ></button> <button name=\"delete\" ><img src=\"pictures/interface.png\" ></button>  </div> </div>  <input name=\"hack\" value=\"{$a['name']}\" >  </form> ");
                 }
        ?>
    </div>
    <div class="addprd">
        <h2>Add Product</h2>
        <form method="POST" action=""  enctype="multipart/form-data">
               <input type="text"  placeholder="Enter The Product Name " name="prdname" ><br>
               <input type="number" placeholder="Enter The Product Price"  name="prdprice" ><br>
               <input type="file"  name="image" accept="image/*" ><br>
               <button type="submit"  name="submit" >ADD PRODUCT</button> 
                <?php
                    if(isset($_GET['missing'])){
                            echo("<div class=\"alert\" > Fill The Blanks </div>");
                    }
                    if(isset($_GET['error'])){
                        echo("<div class=\"alert\" > Upload a .png or .jpg or .svg </div>");
                }
                    if(isset($_GET['Done'])){
                        echo("<div class=\"alert1\" > Product Has been added </div>");
                    }
                    if(isset($_GET['updt'])){
                        echo("<div class=\"alert1\" > Product Updated </div>");
                    }
                ?>
        </form>
    </div>
   
</div>
</body>
</html>