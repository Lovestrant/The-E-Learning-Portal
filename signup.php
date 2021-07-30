<?php
session_start();

//initializing input values
$fullname = $password = $passwordconfirm = $regNo = $index =$department =$joinyear = '';

$errors = array("Err" => "", "passwordErr" => "", "success" => "");

include_once('db.php');


if(isset($_POST['submit'])){

    $fullname = mysqli_real_escape_string($con, $_POST['fullname']);
    $index = mysqli_real_escape_string($con, $_POST['index']);
    $regNo = mysqli_real_escape_string($con, $_POST['regNo']);
    $department = mysqli_real_escape_string($con, $_POST['department']);
    $joinyear = mysqli_real_escape_string($con, $_POST['joinyear']);
   
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $passwordconfirm = mysqli_real_escape_string($con, $_POST['passwordconfirm']);
   
     
     if($password != $passwordconfirm){
         $errors['passwordErr'] = "Password with their confirmations does not match";
      
     }elseif(empty($fullname) || empty($index)|| empty($regNo)||empty($password) || empty($passwordconfirm)){

        $errors['Err'] = "Fill all the fields.";
     }else{

        $sql1="SELECT * FROM authentication where regnumber = '$regNo' Limit 1";
    
		$result= mysqli_query($con,$sql1);
		$queryResults= mysqli_num_rows($result);
		
		
        if($queryResults) {

            $errors['passwordErr'] = "A user with same Registration number already exist.";
           // echo"<script>alert('A user with same phone number already exist. Try again with a different number.')</script>"; 
        }else{
           $password1 = md5($password);//encryption of password
           
            $sql = "INSERT INTO authentication (fullname, regnumber,indexnumber, password, department, joinyear) VALUES ('$fullname', '$regNo','$index','$password1','$department','$joinyear')";
		    $res = mysqli_query($con,$sql);
		
	
		if($res ==1){

        //set session variables
        $_SESSION['fullname'] = "$fullname";
        $_SESSION['department'] = "$department";
        $_SESSION['joinyear'] = "$joinyear";
        $_SESSION['regNo'] = "$regNo";

        $errors['success'] = "Registration successful. You are now logged in.";
		
            echo "<script>location.replace('mainpages/home.php')</script>";
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
<link rel="stylesheet" type="text/css" href="css/index.css">

     <!--bootstrap links-->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>


<!-- google icons link-->
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">


<script>
function adminLogin() {
    location.replace("home.php");
}

</script>


</head>
<body>
<div class = "container" id="headerbody">
<div class = "row">
    <div class="col-sm-4">
        <p id="topparagraph">Create An Account:</p>
    </div>
    <div class="col-sm-4">
        <form action="signup.php" method="post">

            <div><h5 style="color: red;"><?php echo $errors['Err']; ?></h5></div>

            <input  class="reginput" type="text" name = "fullname" placeholder ="Enter Full Name" value="<?php echo $fullname;?>"> <br><br>
            <input class="reginput" type="text" name ="regNo" placeholder="Enter your Registration Number"value="<?php echo $regNo;?>" ><br><br>
            <input  class="passinput" type="text" name = "index" placeholder ="Index number" value="<?php echo $index;?>"> <br><br>
            <input  class="passinput" type="text" name = "department" placeholder ="Department" value="<?php echo $department;?>"> <br><br>
            <input  class="passinput" type="text" name = "joinyear" placeholder ="Admission Year" value="<?php echo $joinyear;?>"> <br><br>
            
            <input  class="passinput" type="password" name = "password" placeholder ="Set password" value="<?php echo $password;?>"> <br><br>
            <input  class="passinput" type="password" name = "passwordconfirm" placeholder ="Repeat password" value="<?php echo $passwordconfirm;?>"> <br><br>
           
            <div><h3 style="color: red;"><?php echo $errors['passwordErr']; ?></h3></div>
            <div><h3 style="color: green;"><?php echo $errors['success']; ?></h3></div>

            <button name="submit" title="sign Up" >Sign Up</button>

        </form>
    </div>

    <div class="col-sm-4" id ="bottomdiv">
         
        <a id="reset" href="index.php"> Go back to login page.</a>
        
    </div>
</div>


</div>
    




</body>
</html>