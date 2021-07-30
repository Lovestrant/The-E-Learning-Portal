
<?php
//Register Unit Code

//initialize inputs 
$unitdepartment =  $unittitle =  $unitId =  $year = '';
//errors

$error = array('existingUnitErr' => '', 'success'=> '');

include('../db.php');
if(isset($_POST['regUnit'])){

    $unitdepartment = mysqli_real_escape_string($con, $_POST['unitdepartment']);
   
    $unittitle = mysqli_real_escape_string($con, $_POST['unittitle']);
    $unitId =  mysqli_real_escape_string($con, $_POST['unitId']);
    $year =  mysqli_real_escape_string($con, $_POST['year']);
   
if(empty($unitdepartment) || empty($unittitle) || empty($unitId) || empty($year)) {
    $errors['existingUnitErr'] = "Fill All Fields.";
} else{
    $sql1="SELECT * FROM unitstable where  unitId = '$unitId' and year = '$year' Limit 1";
    
		$result= mysqli_query($con,$sql1);
		$queryResults= mysqli_num_rows($result);
		
		
        if($queryResults) {
            $errors['existingUnitErr'] = "A unit with same ID and same Year is already Registered.";
           // echo"<script>alert('A unit with same ID and same Year is already Registered.')</script>"; 
        }else{
           
            $sql = "INSERT INTO unitstable (unitdepartment, unittitle, unitId, year) VALUES ('$unitdepartment', '$unittitle','$unitId','$year')";
		    $res = mysqli_query($con,$sql);
		
        
		if($res ==1){
            $errors['success'] = "Unit Registration successful.";
			//echo "<script>alert('Unit Registration successful.')</script>";
            //echo "<script>location.replace('developer.php')</script>";
        
           }
    }  
    

}

        
     

}
?>

<?php
//Register Admin Code

//initialize inputs 
$fullname =  $username =  $password =  $passwordconfirm = $department ='';
//errors

$errors = array('error' => '', 'successReg'=> '');

include('../db.php');
if(isset($_POST['reg'])){

    $fullname = mysqli_real_escape_string($con, $_POST['fullname']);
    $department = mysqli_real_escape_string($con, $_POST['department']);
    $username = mysqli_real_escape_string($con, $_POST['username']);
   
    $password =  mysqli_real_escape_string($con, $_POST['password']);
    $passwordconfirm =  mysqli_real_escape_string($con, $_POST['passwordconfirm']);


    if($password != $passwordconfirm){
        $errors['error'] = "Password with their confirmations does not match. Please try again.";
       // echo"<script>alert('Password with their confirmations does not match. Please try again.')</script>";
    }elseif($password === $passwordconfirm){
        $password1 = md5($password);//encryption of password
        $sql1="SELECT * FROM adminauthentication where  username = '$username' Limit 1";
    
		$result= mysqli_query($con,$sql1);
		$queryResults= mysqli_num_rows($result);
		
		
        if($queryResults) {
            $errors['error'] = "A user with same username already exist.<br> Try again with a different username.";
           // echo"<script>alert('A user with same username already exist. Try again with a different username.')</script>"; 
        }else{
            $password1 = md5($password);//encryption of password
            $sql = "INSERT INTO adminauthentication (fullname, username, password,department) VALUES ('$fullname', '$username','$password1','$department')";
		    $res = mysqli_query($con,$sql);
		
        
		if($res ==1){
            $errors['successReg'] = "Registration successful.";
			//echo "<script>alert('Registration successful.')</script>";
            //echo "<script>location.replace('developer.php')</script>";
        
           }
    }  
    
   }    

}
?>

<?php
//Reset Admin Details Code

//initialize inputs 
$username =  $password =  $passwordconfirm = '';
//errors

$errorReset = array('Err' => '', 'success'=> '');

include('../db.php');

if(isset($_POST['update'])){

    
    $username= mysqli_real_escape_string($con, $_POST['username']);
    $password= mysqli_real_escape_string($con, $_POST['password']);
    $passwordconfirm = mysqli_real_escape_string($con, $_POST['passwordconfirm']);

    if(empty($username) || empty($password) || empty($passwordconfirm)) {
        $errorReset['Err'] = "All Fields are Required.";

    } else {

        if(!($password == $passwordconfirm)){
            $errorReset['Err'] = "Password doesn't match with its confirmation. Try again.";
           // echo "<script>alert('Password doesn't match with its confirmation. Try again.')</script>";
        
        }else{
          
            $sql1 = "SELECT * from adminauthentication where username = '$username' Limit 1";
            $result= mysqli_query($con,$sql1);
            $queryResults= mysqli_num_rows($result);
            
            
            if($queryResults) {
                $password1 = md5($password);//encryption of password
                $sql = "UPDATE adminauthentication set password = '$password1' where username= '$username'";
            $res = mysqli_query($con,$sql);
            
        
            if($res ==1){
                $errorReset['success'] = "Update successful.";
               // echo "<script>alert('Update successful.')</script>";
               // echo "<script>location.replace('developer.php')</script>";
            }
         }else{
            $errorReset['Err'] = "No user with those details in the system. Please try again. Ensure you fill your details correctly.";
               // echo"<script>alert('No user with those details in the system. Please try again. Ensure you fill your details correctly.')</script>"; 
               
    
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
<link rel="stylesheet" type="text/css" href="../css/developer.css">

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
<?php include_once("../mainpages/header.php"); ?>


<body class="developerbody">

<div class = "container-fluid" id="header">
   
    <div class="row" id = "numrow">
    <h3>Total registered users in the system:
<label style="color: red;">
<?php

include('../db.php');

  
    $sql2="SELECT * FROM authentication";
        
    $result= mysqli_query($con,$sql2);
    $queryResults= mysqli_num_rows($result);
    
    
    if($queryResults) {
    echo"$queryResults";
    }
  

?>

</label>
</h3>

<h3>Total registered admin users:
<label style="color: red;">
<?php



    include('../db.php');
    $sql2="SELECT * FROM adminauthentication";
        
    $result= mysqli_query($con,$sql2);
    $queryResults= mysqli_num_rows($result);
    
    
    if($queryResults) {
    echo"$queryResults";
    }
  

?>

</label>  <hr>
</h3>
    </div>

<div class = "row">

    <div class="col-sm-2">
        <p id="topparagraph">Create Admin Account:</p>
    </div>


    <div class="col-sm-2" id ="topform">
        <form action="developer.php" method="post">
            <input  class="reginput" type="text" name = "fullname" placeholder ="Enter Full Name" value="<?php echo $fullname?>"> <br><br>
            <input class="reginput" type="text" name ="username" placeholder="Enter Username" value="<?php echo $username?>"><br><br>
            <input class="reginput" type="text" name ="department" placeholder="Enter department" value="<?php echo $department?>"><br><br>
            <input  class="passinput" type="password" name = "password" placeholder ="Set password" value="<?php echo $password?>"> <br><br>
            <input  class="passinput" type="password" name = "passwordconfirm" placeholder ="Repeat password" value="<?php echo $passwordconfirm?>"> <br><br>
            
             <!--Displaying Errors -->
               <h3 style="color:green;"><?php echo $errors['successReg']; ?></h3>
               <h3 style="color: red;"><?php echo $errors['error']; ?></h3>
            <button name="reg" title="sign Up" >Sign Up Admin</button>

        </form>
    </div> <br>





<div id="bottomform"> 
<div class="col-sm-4">
        <p id="topparagraph">Reset Admin Password:</p>
    </div>
    <div class="col-sm-2">
        <form action="developer.php" method="post">
           
           
            <input  class="passinput" type="text" name = "username" placeholder ="Enter Username" value="<?php echo $username?>"> <br><br>
            <input  class="passinput" type="password" name = "password" placeholder ="Create new password" value="<?php echo $password?>"> <br><br>
            <input  class="passinput" type="password" name = "passwordconfirm" placeholder ="Repeat password" value="<?php echo $passwordconfirm?>"> <br><br>
            
            <div class="col-sm-2"> 

                <!--Displaying Errors -->
                <h3 style="color:green;"><?php echo $errorReset['success']; ?></h3>
               <h3 style="color: red;"><?php echo $errorReset['Err']; ?></h3>

                <button name="update" title="sign Up" >Update</button>
            </div>
        </form>
    </div>
</div>
<br> <hr>
   

</div>
<br><br>
<div class="container">
    <div clas="row">
        <div class="col-sm-4">
            <p id="topparagraph">Register Unit:</p>
            <form action = "developer.php" method="post">
            <input class="passinput"  type="text" name="unitId" placeholder ="Enter Unit Id" value="<?php echo $unitId?>"> <br><br>
                <input class="passinput"  type = "text" name="unittitle" placeholder = "Enter Unit title" value="<?php echo $unittitle?>"><br><br>
                <input class="passinput"  type="text" name="unitdepartment" placeholder ="Enter Department" value="<?php echo $unitdepartment?>"> <br><br>
                <input class="passinput"  type="number" name="year" placeholder = "Class Year" value="<?php echo $year?>"><br><br>
               <!--Displaying Errors -->
               <h3 style="color:green;"><?php echo $error['success']; ?></h3>
               <h3 style="color: red;"><?php echo $error['existingUnitErr']; ?></h3>

                <input type="submit" name = "regUnit">
            </form>
            
        </div>
    </div>
</div>

<div class="container-fluid" style="margin-left: -45px; padding-left: 0px;">
<?php include_once("../mainpages/footer.php"); ?>  
</div>

</body>
 
</html>


