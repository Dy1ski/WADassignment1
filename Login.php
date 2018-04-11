<!DOCTYPE html>

<html>
<title>OnlineShip</title>
<body>
  <style type="text/css">
    body{
      border-style:solid;
      text-align:center;
    }
  </style>
  <h1>Login-ShipOnline</h1>
    <form method="get">
      <label>
        </br>Customer Number:</br>
        <input type="text" name="CusNum"></label>
        </br>
      <label>
          </br>Password:</br>
            <input type="text" name="CusPass"></label>
            </br>
            </br>
      <input type="submit" value="Log in">
    </form>
  <p>New Customer?</p>
  <a href="https://mercury.swin.edu.au/cos30020/s100589350/Assignment1/Rego.php">Register Here</a></br></br>
  

  
</body>


<?php
session_start();

$dbconn = mysqli_connect('feenix-mariadb.swin.edu.au', 's100589350', '241095', 's100589350_db') or die('Failed to Connect');

//checking feilds for data

if((isset($_GET["CusNum"]) && !empty($_GET["CusNum"]) && (isset($_GET["CusPass"]) && !empty($_GET["CusPass"]))))
   {
    //setting the variables
    $cNum = $_GET["CusNum"];
    $cPass = $_GET["CusPass"];
    
    //password database lookup
    $sqlLogin = mysqli_query($dbconn, "SELECT * FROM user_data WHERE cusID = '$cNum' AND cuspass = '$cPass';");
    
   if(mysqli_num_rows($sqlLogin) === 1)
        {
        echo "Login Successful Please wait one moment";       
        sleep(4);
       $_SESSION['cusID'] = $cNum;
       header("Location: https://mercury.swin.edu.au/cos30020/s100589350/Assignment1/Request.php") or exit();
   }
    else   
    {
        echo "Password/Customer ID do not match record please try again";    
    }

   }
    else 
    {
    echo "";

    }



?>





</html>