<?php
require_once "config.php";
$FM_Type = $_POST['FM_Type'];
$Name = strtoupper($_POST['Name']);
$Ration_Card = $_POST['Ration_Card'];
$Mobile = $_POST['Mobile'];
$Email = $_POST['Email'];
$Build_No = $_POST['Build_No'];
$Street = $_POST['Street'];
$City = $_POST['City'];
$District = $_POST['District'];
$State = $_POST['State'];
$Pincode = $_POST['Pincode'];


$status=$msg="";
//echo $Mobile ;
//define('DB_SERVER', 'localhost');
//define('DB_USERNAME', 'root');
//define('DB_PASSWORD', '');
//define('DB_NAME', 'eshopping');
// 
///* Attempt to connect to MySQL database */
//$MyConnection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
$sql = "SELECT * FROM user_registration WHERE rationcard = '$Ration_Card' and user_type= 'H'";
$result = mysqli_query($MyConnection, $sql);

 if (mysqli_num_rows($result) === 0) 
 {
     
        $sql = "INSERT INTO user_registration(user_name, mobile_number, email_id, rationcard, family_type, BUILD_NO, STREET, "
                . "CITY, DISTRICT, STATE, PINCODE) "
                
                . "values ('$Name','$Mobile','$Email','$Ration_Card','$FM_Type','$Build_No','$Street',"
                . "'$City','$District','$State','$Pincode')";
     
        if(mysqli_query($MyConnection, $sql))
        {
            $sql = "SELECT * FROM user_registration WHERE rationcard = '$Ration_Card' and user_type= 'H'";
            $result = mysqli_query($MyConnection, $sql);
            $row = mysqli_fetch_assoc($result);
            $status = "S";
            $msg = "User Successfully Added"."\n"."Your Unique ID: ".$row['user_id']."\n"."Password: ".$Mobile;
        }
        else
        {
            $status = "F";
            $msg = "Error";
        }
     
 } 
 else 
 {
        $status = "F";
        $msg = "User Already Exist";
 }
mysqli_close($MyConnection);
$arr = array('status' => $status, 
            'msg' => $msg); 
echo json_encode($arr);
?>
