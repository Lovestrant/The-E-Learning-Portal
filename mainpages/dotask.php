<?php 
    session_start();

    //code to submit task/assignment
  
    if(isset($_POST['FinishTask'])) {

      include_once('../db.php');
      $id = $_SESSION['unit_id'];
           // $id = $_POST['hiddenid'];
    
            $sql="SELECT * FROM unitstable where id='$id'";

            $data= mysqli_query($con,$sql);
            $queryResults= mysqli_num_rows($data);
            
            
            if($queryResults >0) {
                while($row = mysqli_fetch_assoc($data)) {
                
                    //getting the session variables and database rows
                    $unittitle = $row['unittitle'];
                    $tasktitle = $_SESSION['tasktitle'];
                    $unitId = $row['unitId'];
                    $department = $row['unitdepartment'];
                    $year = $row['year'];
                    $regNo = $_SESSION['regNo'];
                    $studentname = $_SESSION['fullname'];
                    $teachername = $_SESSION['teachername'];


                //getting form values from student

                  $choice1 = $_POST['choice1'];
                  $choice2 = $_POST['choice2'];
                  $choice3 = $_POST['choice3'];
                  $choice4 = $_POST['choice4'];
                  $choice5 = $_POST['choice5'];
                  $choice6 = $_POST['choice6'];
                 $qustionId = $_POST['hiddenid'];

                  $answer = $row['answer'];

                  $sql = "INSERT INTO donework(unitdepartment, unittitle, year,tasktitle,unitId,teachername,choice1,choice2,choice3,choice4,choice5,choice6,qustionId)
                            VALUES ('$department', '$unittitle','$year','$tasktitle','$unitId','$teachername','$choice1','$choice2','$choice3','$choice4','$choice5','$choice6','$qustionId')";
                            $res = mysqli_query($con,$sql);
                            

                            if($res ==1){
                                echo "<script>alert('Task Submitted')</script>";
                                echo "<script>location.replace('../mainpages/dotask.php?tasktitle=$tasktitle');</script>";
                            }



    }
  }
}



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

<!--Js Links-->

<script src= "../js/dotask.js"></script>

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
   
    <p>Your Task:</p>
    

    </div>

    <div class= "row">
    <form action='dotask.php' method='POST' enctype='multipart/form-data'>  
  
    <?php 
   



    if($_SESSION['regNo']){



        include_once('../db.php');
           $id = $_SESSION['unit_id'];
           // $id = $_POST['hiddenid'];
    
            $sql="SELECT * FROM unitstable where id='$id'";

            $data= mysqli_query($con,$sql);
            $queryResults= mysqli_num_rows($data);
            
            
            if($queryResults >0) {
                while($row = mysqli_fetch_assoc($data)) {
                
                    //getting the session variables and database rows
                    $unittitle = $row['unittitle'];
                    $tasktitle = $_GET['tasktitle'];
                    $unitId = $row['unitId'];
                    $department = $row['unitdepartment'];
                    $year = $row['year'];

                    $studentname = $_SESSION['fullname'];
                                 
                 

                   $sql2="SELECT * FROM tasktable WHERE unittitle = '$unittitle' and unitdepartment = '$department' and year = '$year' and tasktitle = '$tasktitle'";

                   $data2= mysqli_query($con,$sql2);
                   $queryResults2= mysqli_num_rows($data2);
                   
                   
                   
                   
                    if($queryResults2 >0) {
                              while($row = mysqli_fetch_assoc($data2)) {
                                $postid = $row['id'];
                   
                              if(($row['imgurl']) && (!$row['answerspace'])  && (!$row['docurl']))   {

                                echo "
                               

                                <div style='margin-bottom: 5%;'>
                               
                                <div style='text-transform: uppercase;color: green;margin-left:10%; text-align:centre;
                                margin-top: 4%;margin-bottom: 4%;'>

                                <input type='hidden' name= 'hiddenid' value= '<?php echo '$postid'; ?>'>
                                <img src='../files/images/images".$row['imgurl']."' style = 'width: 30%; height:auto;'>
                                <h2>".$row['question']."</h2>

                                <ol>
                                <p><input type='checkbox' id='checkbox' value='choice1' name= 'choice1'> ".$row['choice1']."</p>
                                <p> <input type='checkbox'id='checkbox' value='choice2' name= 'choice2'> ".$row['choice2']."</p>
                                <p> <input type='checkbox'id='checkbox' value='choice3' name= 'choice3'> ".$row['choice3']."</p>
                                <p> <input type='checkbox'id='checkbox' value='choice4' name= 'choice4'> ".$row['choice4']."</p>
                                <p> <input type='checkbox'id='checkbox' value='choice5' name= 'choice5'> ".$row['choice5']."</p>
                                <p> <input type='checkbox'id='checkbox' value='choice6' name= 'choice6'> ".$row['choice6']."</p>
                                </ol>
                               
                                </div>
                                
                        
                                ";

                              }elseif(($row['docurl'])  && (!$row['answerspace'])  && (!$row['imgurl']))  {

                              echo "
                                       
                                <div style='margin-bottom: 5%;'>
                               
                                <div style='text-transform: uppercase;color: green;margin-left:10%; text-align:centre;
                                margin-top: 4%;margin-bottom: 4%;'>

                                <input type='hidden' name= 'hiddenid' value= '<?php echo '$postid'; ?>'>
                                <i class='file'>
                                <iframe src='../files/docs/docs".$row['docurl']."' style = 'width: auto; height:auto;'></iframe>
                                </i>
                                <h2>".$row['tasktitle']."</h2>

      
                                
                               
                                </div>
                                
                                </div>
                               
                        
                                ";
                              }elseif(($row['docurl']) && ($row['imgurl']) && (!$row['answerspace']) ){
                                echo "
                           
                                <div style='margin-bottom: 5%;'>
                                <input type='hidden' name= 'hiddenid' value= '<?php echo '$postid'; ?>'>
                                <div style='text-transform: uppercase;color: green;margin-left:10%; text-align:centre;
                                margin-top: 4%;margin-bottom: 4%;'>

                               
                                <img src='../files/images/images".$row['imgurl']."' style = 'width: 30%; height:auto;'>
                                <h2>".$row['question']."</h2>

                                <ol>
                                <p><input type='checkbox' id='checkbox' value='choice1' name= 'choice1'> ".$row['choice1']."</p>
                                <p> <input type='checkbox'id='checkbox' value='choice2' name= 'choice2'> ".$row['choice2']."</p>
                                <p> <input type='checkbox'id='checkbox' value='choice3' name= 'choice3'> ".$row['choice3']."</p>
                                <p> <input type='checkbox'id='checkbox' value='choice4' name= 'choice4'> ".$row['choice4']."</p>
                                <p> <input type='checkbox'id='checkbox' value='choice5' name= 'choice5'> ".$row['choice5']."</p>
                                <p> <input type='checkbox'id='checkbox' value='choice6' name= 'choice6'> ".$row['choice6']."</p>
                                </ol>
                               
                                </div>
                                
                                </div>
                               
                             
                                ";

                                echo "
                                       
                                <div style='margin-bottom: 5%;'>
                               
                                <div style='text-transform: uppercase;color: green;margin-left:10%; text-align:centre;
                                margin-top: 4%;margin-bottom: 4%;'>

                                <input type='hidden' name= 'hiddenid' value= '<?php echo '$postid'; ?>'>
                                <i class='file'>
                                <iframe src='../files/docs/docs".$row['docurl']."' style = 'width: auto; height:auto;'></iframe>
                                </i>
                                <h2>".$row['tasktitle']."</h2>

      
                                
                               
                                </div>
                                
                                </div>
                               
                        
                                ";


                              } elseif(($row['answerspace']) && (!$row['imgurl'])) {
                                echo "
                               
                                <div style='margin-bottom: 5%;'>
                               
                                <div style='text-transform: uppercase;color: green;margin-left:10%; text-align:centre;
                                margin-top: 4%;margin-bottom: 4%;'>

                                <input type='hidden' name= 'hiddenid' value= '<?php echo '$postid'; ?>'>
                               
                                <h2>".$row['question']."</h2>

                                <textarea style='width: 70%; height: 10%;'id='textarea' name='answer' placeholder='Type answer here'></textarea>
                                
                               </form>
                                </div>
                                
                                </div>
                               
                              
                                ";


                              } elseif(($row['answerspace']) && ($row['docurl'])) {
                                echo "
                           
                                <div style='margin-bottom: 5%;'>
                               
                                <div style='text-transform: uppercase;color: green;margin-left:10%; text-align:centre;
                                margin-top: 4%;margin-bottom: 4%;'>

                                <input type='hidden' name= 'hiddenid' value= '<?php echo '$postid'; ?>'>
                               
                                <h2>".$row['question']."</h2>

                                <textarea style='width: 70%; height: 10%;'id='textarea' name='answer' placeholder='Type answer here'></textarea>
                                
                               </form>
                                </div>
                                
                                </div>
                               

                                ";

                                //doc display Code
                                echo "
                                       
                                <div style='margin-bottom: 5%;'>
                               
                                <div style='text-transform: uppercase;color: green;margin-left:10%; text-align:centre;
                                margin-top: 4%;margin-bottom: 4%;'>

                                <input type='hidden' name= 'hiddenid' value=<?php echo $id; ?>
                                <i class='file'>
                                <iframe src='../files/docs/docs".$row['docurl']."' style = 'width: auto; height:auto;'></iframe>
                                </i>
                                <h2>".$row['tasktitle']."</h2>

      
                                
                               
                                </div>
                                
                                </div>
                               
                        
                                ";



                              }elseif(($row['answerspace']) && ($row['imgurl']) && ($row['docurl'])) {
                                echo "
                                    
                                <div style='margin-bottom: 5%;'>
                               
                                <div style='text-transform: uppercase;color: green;margin-left:10%; text-align:centre;
                                margin-top: 4%;margin-bottom: 4%;'>

                                <input type='hidden' name= 'hiddenid' value= '<?php echo '$postid'; ?>'>
                                <img src='../files/images/images".$row['imgurl']."' style = 'width: 30%; height:auto;'>
                                <h2>".$row['question']."</h2>

                                <textarea style='width: 70%; height: 10%;'id='textarea' name='answer' placeholder='Type answer here'></textarea>
                                
                             
                                </div>
                                
                                </div>
                               
                           
                                ";

                                
                                 //doc display Code
                                 echo "
                                       
                                 <div style='margin-bottom: 5%;'>
                                
                                 <div style='text-transform: uppercase;color: green;margin-left:10%; text-align:centre;
                                 margin-top: 4%;margin-bottom: 4%;'>
 
                                 <input type='hidden' name= 'hiddenid' value= '<?php echo '$postid'; ?>'>
                                 <i class='file'>
                                 <iframe src='../files/docs/docs".$row['docurl']."' style = 'width: auto; height:auto;'></iframe>
                                 </i>
                                 <h2>".$row['tasktitle']."</h2>
 
       
                                 
                                
                                 </div>
                                 
                                 </div>
                                
                         
                                 ";

                               
                              }elseif(($row['answerspace']) && ($row['imgurl'])) {
                                echo "
                                      
                                <div style='margin-bottom: 5%;'>
                               
                                <div style='text-transform: uppercase;color: green;margin-left:10%; text-align:centre;
                                margin-top: 4%;margin-bottom: 4%;'>

                                <input type='hidden' name= 'hiddenid' value= '<?php echo '$postid'; ?>'>
                                <img src='../files/images/images".$row['imgurl']."' style = 'width: 30%; height:auto;'>
                                <h2>".$row['question']."</h2>

                                <textarea style='width: 70%; height: 10%;'id='textarea' name='answer' placeholder='Type answer here'></textarea>
                                
                            
                                </div>
                                
                                </div>
                               
                             
                                ";

                               
                               
                              }
                               else{
                                echo "
                                                 
                                <div style='margin-bottom: 5%;'>
                               
                                <div style='text-transform: uppercase;color: green;margin-left:10%; text-align:centre;
                                margin-top: 4%;margin-bottom: 4%;'>

                                <input type='hidden' name= 'hiddenid' value= <?php echo '$postid'; ?>>
                               
                                <h2>".$row['question']."</h2>
                                <ol>
                                <p><input type='checkbox' id='checkbox' value='choice1' name= 'choice1'> ".$row['choice1']."</p>
                                <p> <input type='checkbox'id='checkbox' value='choice2' name= 'choice2'> ".$row['choice2']."</p>
                                <p> <input type='checkbox'id='checkbox' value='choice3' name= 'choice3'> ".$row['choice3']."</p>
                                <p> <input type='checkbox'id='checkbox' value='choice4' name= 'choice4'> ".$row['choice4']."</p>
                                <p> <input type='checkbox'id='checkbox' value='choice5' name= 'choice5'> ".$row['choice5']."</p>
                                <p> <input type='checkbox'id='checkbox' value='choice6' name= 'choice6'> ".$row['choice6']."</p>
                                </ol>
                               
                                </div>
                                
                                </div>
                               
                              
                                ";


                              }      
                                       
                   
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
    <button name="FinishTask" style="margin-left: 50%;width:35%; padding: 1%;color:white;background-color:green; margin-bottom:1%;">Finish</button>
  </form> 


    </div>

    <div class= "row">
        <div class="col-sm-12">
        <?php include_once('footer.php'); ?>
        </div>
      
    </div>
    

</body>
</html>