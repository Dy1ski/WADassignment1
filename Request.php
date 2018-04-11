<!DOCTYPE html>

<html>
<title>REQUEST</title>
<body>
  <style type="text/css">
    div, body{
      border-style:solid;
      text-align:center;
    }
    h2{
      text-align:center;
    }
  </style>
  <h2>Shipping Request</h2>
    <form>
      <div>
        <h3>Welcome Customer</h3>
        <h4>Item Information: </h4>
          <h5>Todays date</h5>
          <span ></span>
               
          </p>
          <label>Description: </br><input type="text" name="ITDes"></label></br>
          <label>Weight:
              <select name="weight" placeholder="Select Weight">
                <option value="">Select Weight</option>
                <option value="0.5">0.5kg</option>
                <option value="1">1kg</option>
                <option value="2">2kg</option>
                <option value="3">3kg</option> 
                <option value="4">4kg</option>
                <option value="5">5kg</option>
                <option value="6">6kg</option>
                <option value="7">7kg</option>
                <option value="8">8kg</option>
                <option value="9">9kg</option>
                <option value="10">10kg</option>
                <option value="11">11kg+</option>
              </select> </br></label> 
      </div>
      <div>
        <h4>Pick-up Information: </h4>
          <label>Address: </br><input type="text" name="pAddress"></label></br>
          <label>Suburb: </br><input type="text"  name="pSub"></label></br>
          <label>Postcode: </br><input type="text" name="pCode"></label></br>
          <label>Preferred Date: </br><input type="date" id="today" name="pDate"></label></br>    
          <label>Preferred Time: </br><input type="time" name="pTime"></label>
                <script>
                    let today = new Date().toISOString().substr(0, 10);
                    document.querySelector("#today").value = today;    
                </script>
      </div>
      <div>
        <h4>Delivery Information: </h4>
          <label>Receiver Name: </br><input type="text" name="rName"></label></br>
          <label>Address: </br><input type="text"  name="rAddress"></label></br>
          <label>Suburb: </br><input type="text" name="rSub"></label></br>
          <label>Postcode: </br><input type="text" name="rCode"></label></br>
          <label>State:
            <select name="rState">
              <option value="">Select State</option>  
              <option value="ACT">ACT</option>
              <option value="VIC">VIC</option>
              <option value="NSW">NSW</option>
              <option value="TAS">TAS</option>
              <option value="QLD">QLD</option>
              <option value="WA">WA</option>
              <option value="SA">SA</option>
              </select>
          </label></br>
        </br><input type="submit">
        </div>
    </form>  
   
</body>

<?php
session_start(); //created to signal session variable start
ini_set('display_errors',0);
ini_set('error_reporting',0);
//Connect Database
$dbconn = mysqli_connect('feenix-mariadb.swin.edu.au', 's100589350', '241095', 's100589350_db') or die('Failed to Connect');

    if((isset($_GET["ITDes"]) && !empty($_GET["ITDes"]) && (isset($_GET["weight"]) && !empty($_GET["weight"]) && (isset($_GET["pAddress"]) && !empty($_GET["pAddress"])&& (isset($_GET["pSub"]) && !empty($_GET["pSub"])&& (isset($_GET["pCode"]) && !empty($_GET["pCode"])&& (isset($_GET["pDate"]) && !empty($_GET["pDate"])&& (isset($_GET["pTime"]) && !empty($_GET["pTime"])&& (isset($_GET["rName"]) && !empty($_GET["rName"])&& (isset($_GET["rAddress"]) && !empty($_GET["rAddress"])&& (isset($_GET["rSub"]) && !empty($_GET["rSub"])&& (isset($_GET["rCode"]) && !empty($_GET["rCode"])&& (isset($_GET["rState"]) && !empty($_GET["rState"]))))))))))))))
       {
//Variables
        $descript = $_GET["ITDes"];
        $weight = $_GET["weight"];
        $padd = $_GET["pAddress"];
        $psub = $_GET["pSub"];
        $pcode = $_GET["pCode"];
        $pdate = $_GET["pDate"];
        $ptime = $_GET["pTime"];
        $rname = $_GET["rName"];
        $radd = $_GET["rAddress"];
        $rsub = $_GET["rSub"];
        $rcode = $_GET["rCode"];
        $rstate = $_GET["rState"];
        $rdate = date("dd/mm/yyyy");
        $cID = $_SESSION['cusID'];
        
//sqlDB Varibles        
        $sqlInsert = "INSERT INTO `request_data`(`orderID`, `cusID_FK`, `orderDate`, `description`, `Weight`, `paddress`, `psuburb`, `pcode`, `pdate`, `ptime`, `rname`, `raddress`, `rsuburb`, `rcode`, `rstate`) VALUES ('','$cID','$rdate','$descript','$weight','$padd','$psub','$pcode','$pdate','$ptime','$rname','$radd','$rsub','$rcode','$rstate');";
        
        //$orderID = "SELECT "
        
 //Insert data into database
    //Data Validation        
    if((isset($_GET['pAddress']) && !empty($_GET['pAddress']) && (isset($_GET['rAddress'])&& !empty($_GET['rAddress']))))      
    {
        $sqlQuery = mysqli_query($dbconn, $sqlInsert) or die("THIS FAILED22");
        
        if($sqlQuery)
        {
            echo "Your Shipping request has been successful, a confirmation email has been sent";
        }
        
    }
        //Shipping Costs
        
        
//Emailing Request Confimation
        else
        {echo"test";}
        
//Email Protocol
        $orderstring = "SELECT orderID FROM request_data where cusID_FK ='$cID' AND paddress = '$pAdd' AND pdate = '$pdate' AND ptime = '$ptime' AND pcode ='$pcode' AND raddress = '$rname';";
        $orderquery = mysqli_query($dbconn, $orderstring )or die("THIS FAILED 11");
        $orderid = mysqli_fetch_assoc($orderQuery);                           
        $toquery = mysqli_query($dbconn, " SELECT cusemail FROM user_data WHERE cusID ='$cID';")or die("THIS FAILED33");;
        $toresult =  mysqli_fetch_assoc($toquery);
        $to = "".$toresult['cusemail'] ."" ;
                                
        $subject = "Shipping Order".$orderid["orderID"] ."";
        $message = '';
            echo"Thank you for using ShipOnline! Your request number is " .$orderid["orderID"] . " The cost is ".$cost ." We will pick-up the item at " .$pTime ." on " .$pDate .". ";
        mail($to, $subject, $message,"-r 100589350@student.swin.edu.au" );
       
    //postage cost    
        
    }
       else
       {
        echo "Please Ensure all fields are filled in";
       }
?>


</html>