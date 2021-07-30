<?php
session_start();

$regNo =$password =  '';
$errors = array("phonenumberErr" => "", "success" => "");

include_once('db.php');


if(isset($_POST['submit'])){
   
    $regNo = mysqli_real_escape_string($con, $_POST['regNo']);
    $password =  mysqli_real_escape_string($con, $_POST['password']);
    

    $password1 = md5($password); //encrypting password
    $sql1="SELECT * FROM authentication where  regnumber = '$regNo' and password= '$password1' LIMIT 1";
  
    $result= mysqli_query($con,$sql1);
    $queryResults= mysqli_num_rows($result);
    
    if($queryResults) {
        while($row = mysqli_fetch_assoc($result)) {

        //set session variables
        $_SESSION['fullname'] = $row['fullname'];
        $_SESSION['department'] = $row['department'];
        $_SESSION['year'] = $row['joinyear'];    
        $_SESSION['regNo'] = "$regNo";
    

        //taking user to main page
        $errors['success'] = "Login successful.";
    
        echo "<script>location.replace('mainpages/home.php')</script>";

        }
    }else{
        $errors['phonenumberErr'] = "Wrong combinations. Fill your details correctly.";
     
       
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
<link rel="stylesheet" type="text/css" href="css/index.css">

     <!--bootstrap links-->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>


<!-- google icons link-->
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">


<script>
function adminLogin() {
    location.replace("adminlogin.php");
}

</script>



</head>
<body>
<div class = "container" id="headerbody">
<div class = "row">
    <div class="col-sm-4">
        <p id="topparagraph">Login to E-learning:</p>
    </div>
    <div class="col-sm-4">
        <form action="index.php" method="post">
            <input class="reginput" type="text" name ="regNo" placeholder="Enter your Registration Number" value="<?php echo $regNo;?>"><br><br>
            <input  class="passinput" type="password" name = "password" placeholder ="Enter password" value="<?php echo $password;?>"> <br><br>
           
           <!--Error display-->
        <div><h5 style="color: red;"><?php echo $errors['phonenumberErr']; ?></h5></div>
        <div><h5 style="color: green;"><?php echo $errors['success']; ?></h5></div>
        
            <input type= "submit" name="submit" title="Login">

        </form>
    </div>

    <div class="col-sm-4" id ="bottomdiv">
         <a href="signup.php">Register</a><br>
        <a id="reset" href="reset.php">Forgot Password</a>
        
    </div>
</div>

<div class="row">
    <div class="col-sm-6" id="middiv">
    <p>If you are new to this platform, and looking for a better learning experience then you are in the right place
    <br> Because here you will find the resources that you require to learn fully.</p>
    </div>

    <div class="col-sm-6" id="lowerdiv">
        <button onClick = "adminLogin()">Login as Admin</button>

    </div>
</div>


</div>
    


    
</body>
</html>