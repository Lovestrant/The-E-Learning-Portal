<?php 
    session_start();


    //initializing errors array
    $errors = array("error" => "", "success" => "", "choices" => "");
    //initializing title variable
    $answerspace = '';
  

    if($_SESSION['username']){
    if (isset($_POST['submit'])) {

  

            include_once('../db.php');
           // $id = $_GET['unit_id'];
            $id = $_POST['hiddenid'];
    
            $sql="SELECT * FROM unitstable where id='$id'";

            $data= mysqli_query($con,$sql);
            $queryResults= mysqli_num_rows($data);
            
            
            if($queryResults >0) {
                while($row = mysqli_fetch_assoc($data)) {
                
                    //getting the session variables and database rows
                    $unittitle = $row['unittitle'];
                    $unitId = $row['unitId'];
                    $unitdepartment = $row['unitdepartment'];
                    $year = $row['year'];
                    $teachername = $_SESSION['fullname'];

        
                    //Getting the input values
                    $tasktitle = $_POST['title'];
                    $question = $_POST['question'];
                    $choice1 = $_POST['choice1'];
                    $choice2 = $_POST['choice2'];
                    $choice3 = $_POST['choice3'];
                    $choice4 = $_POST['choice4'];
                    $choice5 = $_POST['choice5'];
                    $choice6 = $_POST['choice6'];
                    $answerspace = $_POST['answerspace'];
                   
             
                        if(empty($tasktitle) || empty($question)){
                            echo "<script>alert('Title and question fields cannot be empty')</script>";
                            echo "<script>location.replace('../administrator/createtask.php?unit_id=$id');</script>";
                          //  $errors['error'] = "Title and question fields cannot be empty";
                          }
                        if(!empty($answerspace)){
                            $imgurl = $_FILES['file']['name'];
                            $tmp = $_FILES['file']['tmp_name'];
                            move_uploaded_file($tmp,"../files/images/images".$imgurl);

                            $sql = "INSERT INTO tasktable(unitdepartment, unittitle, year,tasktitle,imgurl,question,unitId,teachername,choice1,choice2,choice3,choice4,choice5,choice6,answerspace)
                            VALUES ('$unitdepartment', '$unittitle','$year','$tasktitle','$imgurl','$question','$unitId','$teachername','','','','','','','$answerspace')";
                            $res1 = mysqli_query($con,$sql);
                            

                            if($res1 ==1){
                                echo "<script>alert('Posting success')</script>";
                                echo "<script>location.replace('../administrator/createtask.php?unit_id=$id');</script>";
                            }

                        }else{
                             if(empty($choice1) || empty($choice2)){
                            echo "<script>alert('Each choice question should have atleast two choices')</script>";
                            echo "<script>location.replace('../administrator/createtask.php?unit_id=$id');</script>";
                           // $errors['choices'] = "Each question should have atleast two choices";
                      
                        }else{
                                            
                            $imgurl = $_FILES['file']['name'];
                            $tmp = $_FILES['file']['tmp_name'];
                            move_uploaded_file($tmp,"../files/images/images".$imgurl);

                            $sql = "INSERT INTO tasktable(unitdepartment, unittitle, year,tasktitle,imgurl,question,unitId,teachername,choice1,choice2,choice3,choice4,choice5,choice6)
                            VALUES ('$unitdepartment', '$unittitle','$year','$tasktitle','$imgurl','$question','$unitId','$teachername','$choice1','$choice2','$choice3','$choice4','$choice5','$choice6')";
                            $res = mysqli_query($con,$sql);
                            

                            if($res ==1){
                                echo "<script>alert('Posting success')</script>";
                                echo "<script>location.replace('../administrator/createtask.php?unit_id=$id');</script>";
                            }
                    
                

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
    
<?php 
    //Code to Upload A doc File
    if (isset($_POST['upload'])) {
        //getting session variables and database variables

        
        include_once('../db.php');
        // $id = $_GET['unit_id'];
         $id = $_POST['hiddenid'];
 
         $sql="SELECT * FROM unitstable where id='$id'";

         $data= mysqli_query($con,$sql);
         $queryResults= mysqli_num_rows($data);
         
         
         if($queryResults >0) {
             while($row = mysqli_fetch_assoc($data)) {
             
                 //getting the session variables and database rows
                 $unittitle = $row['unittitle'];
                 $unitId = $row['unitId'];
                 $unitdepartment = $row['unitdepartment'];
                 $year = $row['year'];
                 $teachername = $_SESSION['fullname'];

     
                 //Getting the input values
                 $tasktitle = $_POST['titleDoc'];

                 if(empty($tasktitle) || empty($_FILES['file']['name'])){
                    echo "<script>alert('Title or file cannot be blank')</script>";
                    echo "<script>location.replace('../administrator/createtask.php?unit_id=$id');</script>";
                 }else{

                            $docurl = $_FILES['file']['name'];
                            $tmp = $_FILES['file']['tmp_name'];
                            move_uploaded_file($tmp,"../files/docs/docs".$docurl);

                            $sql = "INSERT INTO tasktable(unitdepartment, unittitle, year,tasktitle,imgurl,question,unitId,teachername,choice1,choice2,choice3,choice4,choice5,choice6,docurl)
                            VALUES ('$unitdepartment', '$unittitle','$year','$tasktitle','','$question','$unitId','$teachername','','','','','','','$docurl')";
                            $res = mysqli_query($con,$sql);
                            

                            if($res ==1){
                                echo "<script>alert('Doc Posting success')</script>";
                                echo "<script>location.replace('../administrator/createtask.php?unit_id=$id');</script>";
                            }

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


<!-- google icons link-->
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>



</head>
<body>
<div class = "container-fluid">
    <div class = "row">
    
        <div class="col-sm-12">
        <?php include_once('../mainpages/header.php'); ?>
        </div>
            
    
    </div>

    <div class="row" id="myform" >
    <form action = "createtask.php" method ="post" enctype="multipart/form-data">
        <div class="col-sm-4">
        <input type="hidden" name= "hiddenid" value=<?php $id= $_GET['unit_id']; echo $id; ?>> <!-- Hidden input-->
    
        <label><a style="color:red;" href="teachers.php">Go to Home</a> </label>

        <h4 id="h4">Fill the details to generate A Choice Question:</h4>
        <input style="width: 50%; height: 30px;" type = "text" placeholder="Type The title here" name= "title">

        </div>

        <div class="col-sm-4">
        <p>Write the Question below</p>
            <textarea cols="94" rows="4" name="question" placeholder= "Type the question here"></textarea>
        </div>
        <div class="col-sm-4">
            <p>Type the choices below</p>
            <textarea cols="94" rows="2" name="choice1" placeholder= "Choice One here"></textarea><br><br>
            <textarea cols="94" rows="2" name="choice2" placeholder= "Choice Two here"></textarea><br><br>
            <textarea cols="94" rows="2" name="choice3" placeholder= "Choice Three here"></textarea><br><br>
            <textarea cols="94" rows="2" name="choice4" placeholder= "Choice Four here"></textarea><br><br>
            <textarea cols="94" rows="2" name="choice5" placeholder= "Choice Five here"></textarea><br><br>
            <textarea cols="94" rows="2" name="choice6" placeholder= "Choice six here"></textarea><br><br>
          
            <p>Check to add a space for answer instead of Choices</p>
            <input type ="checkbox" name="answerspace" value="answerspace"> Add answer space <br> <br>
            <label> Attach An Image If Necessary</label> <input type="file" accept="image/*" name="file"><br><br>
            
            <div><h3 style="color: red;"><?php echo $errors['error']; ?></h3></div>
            <div><h3 style="color: green;"><?php echo $errors['success']; ?></h3></div>
            
            <button name="submit" style="color:green;">Create A choice/Space Question</button> <br><br>
        </div>
    </form> <hr><hr>


    <form action = "createtask.php" method ="post" enctype="multipart/form-data">
    <input type="hidden" name= "hiddenid" value=<?php $id= $_GET['unit_id']; echo $id; ?>> <!-- Hidden input-->
        <div class="col-sm-12">
            <h4 id="h4">Fill this details below to generate a document questionaire</h4>
            <input style="width: 50%; height: 30px;" type = "text" placeholder="Type The title here" name= "titleDoc"><br><br>
            <label>Attach questionaire file: </label><input type="file" accept= "docx" name="file" ><br><br>
            <button name="upload" style="color:green;">Upload</button><br><br>
        </div>


    </form>



    </div>

    <div class= "row">
        <div class="col-sm-12">
        <?php include_once('../mainpages/footer.php'); ?>
        </div>
      
    </div>
    

</body>
</html>