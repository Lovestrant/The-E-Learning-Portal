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
   
    <p>Sub-topics:</p>

    </div>

    <div class= "row">
    <?php 
   



    if($_SESSION['regNo']){



        include_once('../db.php');
           $id = $_GET['unit_id'];
           // $id = $_POST['hiddenid'];
    
            $sql="SELECT * FROM unitstable where id='$id'";

            $data= mysqli_query($con,$sql);
            $queryResults= mysqli_num_rows($data);
            
            
            if($queryResults >0) {
                while($row = mysqli_fetch_assoc($data)) {
                
                    //getting the session variables and database rows
                    $unittitle = $row['unittitle'];
                    $unitId = $row['unitId'];
                    $department = $row['unitdepartment'];
                    $year = $row['year'];

                    $studentname = $_SESSION['fullname'];
                                 
                   // $sql2="SELECT unittitle, teachername, COUNT(*) FROM tasktable GROUP BY unittitle  WHERE unittitle = '$unittitle' and unitdepartment = '$department'";

                  //setting session
                  
                  $_SESSION['unit_id'] = $id;
                 

                   $sql2="SELECT * FROM tasktable WHERE unittitle = '$unittitle' and unitdepartment = '$department' and year = '$year' ORDER BY ID DESC";

                   $data2= mysqli_query($con,$sql2);
                   $queryResults2= mysqli_num_rows($data2);
                   
                   
                   
                   
                           if($queryResults2 >0) {
                              while($row = mysqli_fetch_assoc($data2)) {
                   
                                //setting teacher name to session

                                $_SESSION['teachername'] = $row['teachername'];
                                $_SESSION['tasktitle'] = $row['tasktitle'];
                                $_SESSION['question'] = $row['question'];


                                       echo "
                                       
                                       <div style='margin-bottom: 5%;'>
                                       <a href='dotask.php?tasktitle=".$row['tasktitle']."'>
                                       <div style='text-transform: uppercase;color: green;margin-left:10%; text-align:centre;
                                       text-decoration: underline;margin-top: 4%;margin-bottom: 4%;'>
                                       <h2>".$row['tasktitle']."</h2>
                                       </a>
                                       <p>By ".$row['teachername']."</p>
                                   
                               
                                       </div>
                                       
                                       </div>
                                       ";
                   
                   
                                   
                   
                             }
                           }
                   

                
                
                
                }
            }
        
    }else{
        echo "<script>alert('Your Session has expired.You need to login again')</script>";
        echo "<script>location.replace('../index.php')</script>";
    }

    ?>                


    
    </div>


    </div>

    <div class= "row">
        <div class="col-sm-12">
        <?php include_once('footer.php'); ?>
        </div>
      
    </div>
    

</body>
</html>