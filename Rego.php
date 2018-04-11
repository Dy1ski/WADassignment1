<!DOCTYPE html>

<html>
  <title>ShipOnline</title>
  <body>
      <style type="text/css">
    body{
      border-style:solid;
      text-align:center;
    }
  </style>
    
    <h2>Ship Online Registration</h2>
    <p>Please enter your details below</p>
      <form method="get">
        <label>Name:</br>
        <input type="text" name="CusName"></label></br>
        <label>Password:</br>
        <input type="text" name="CusPass"></label></br>
        <label>Confirm Password:</br>
        <input type="text" name="ConPass"></label></br>
        <label>Email Address:</br>
        <input type="text" name="CusEmail"></label></br>
        <label>Contact Phone:</br>
        <input type="text" name="CusPhone"></label></br></br>
        <input type="submit" value="Register"></br></br>
        </form>
    <p>Already registered?  <a href="https://mercury.swin.edu.au/cos30020/s100589350/Assignment1/Login.php">Login here</a></p>
  </body>

<?php
    session_start();
    ini_set('error_reporting',0);
    ini_set('display_errors',0);
    $dbconn = mysqli_connect('feenix-mariadb.swin.edu.au', 's100589350', '241095', 's100589350_db')
    or die('Failed to Connect');
//checking feilds for data

if((isset($_GET["CusName"]) && !empty($_GET["CusName"]))
    && (isset($_GET["CusPass"]) && !empty($_GET["CusPass"]))
    && (isset($_GET["ConPass"]) && !empty($_GET["ConPass"]))
    && (isset($_GET["CusEmail"]) && !empty($_GET["CusEmail"]))
    && (isset($_GET["CusPhone"]) && !empty($_GET["CusPhone"])))   
  //Variables being assigned  
{
    $cName = $_GET["CusName"];
    $cPass = $_GET["CusPass"];
    $confirm = $_GET["ConPass"];
    $cEmail = $_GET["CusEmail"];
    $cPhone = $_GET["CusPhone"];
    $emailCheck = mysqli_query($dbconn, "SELECT * FROM user_data WHERE cusemail = '$cEmail';");
    
//Checking Email Valid
   if(mysqli_num_rows($emailCheck) === 1)
  //If it matches 
   {
       sleep(2);
       header("Location: https://mercury.swin.edu.au/cos30020/s100589350/Assignment1/Login.php") or exit;
   }
 //check Passwords Match
    if((($cPass === $confirm) && (!empty($cPass))))
    //Adding Valid Email to table 
    {      
    $sqlString = "INSERT INTO user_data (cusID, cusname, cuspass, cusemail, cusphone) VALUES ('','$cName', '$cPass', '$cEmail', '$cPhone');";
    $sqlID = "SELECT cusID FROM user_data WHERE cusname='$cName' AND cusemail ='$cEmail' AND cusphone='$cPhone';"; 
    $sqlQuery = mysqli_query($dbconn, $sqlString) or die("ERROR: This task has failed");
    $cID = mysqli_query($dbconn, $sqlID) or die ("ERROR:FAILED TASK");
    $cv = mysqli_fetch_assoc($cID);//for selecting strings from table    
     //check the customer ID is created and then echo the message with array data   
        if($cID){
    echo "You have Successfully registered please wait one moment</br>";
        sleep(2);
    echo "</br>Dear ".$cName ." You have successfully registered to ship online, and your customer numer is <h3> ".$cv["cusID"] ."</h3> this will allow you to access the system. Please save this for future refrence";
    }
    //If the checks fail
  
    }
      else
    {
        echo"ERROR: Your Passwords do not match Please check them and try again";
    }
}
//Error message if a field isnt filled in
    else
    {
        echo $_SESSION["No Record"];
       echo "Check all Fields are filled in.";
    }
?>
</html>