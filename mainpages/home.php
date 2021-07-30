<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School website</title>

<!--Css link-->
<link rel="stylesheet" type="text/css" href="../css/home.css">

     <!--bootstrap links-->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>



<!-- google icons link-->
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>



</head>
<body>
<div class = "container-fluid">
    <div class = "row">
    
        <div class="col-sm-12">
        <?php include_once('header.php'); ?>
        </div>
            
    
    </div>

    <div class="row">
<div class = "row" style="margin-left: 4%;">
    <p>Welcome <?php $fullname = $_SESSION['fullname']; echo "<label style='color: red;font-size: 20px;'> $fullname</label>"; ?></p>

    <p>Your Units Are:</p>

    </div>
    <?php

$department = $_SESSION['department'];
$year = $_SESSION['year'];

include_once('../db.php');
$sql="SELECT * FROM unitstable where unitdepartment='$department' and year = '$year'";

$data= mysqli_query($con,$sql);
$queryResults= mysqli_num_rows($data);




if($queryResults >0) {
    while($row = mysqli_fetch_assoc($data)) {


            echo "
            
            <div style='margin-bottom: 5%;'>
            <a href='task.php?unit_id=".$row['id']."'>
            <div style='text-transform: uppercase;color: green;margin-left:10%; text-align: centre;text-decoration: underline;margin-top: 4%;'>
            <h2>".$row['unitId']."</h2>
           
            <p>".$row['unittitle']."</p>
      
            </div>
            </a>
            </div>
            ";


        

    }
}



    ?>








    </div>

    <div class= "row">
        <div class="col-sm-12">
        <?php include_once('footer.php'); ?>
        </div>
      
    </div>
    

</body>
</html>