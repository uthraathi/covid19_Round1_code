<?php
require_once "config.php";
session_start();
if(!isset($_SESSION['user_id']))
{
    header('location:index.php');
}
$Mobile = $_POST['Mobile'];
$Name = strtoupper($_POST['Name']);
$Email = $_POST['Email'];
$relationship = $_POST['relationship'];
$is_reside = $_POST['is_reside'];
$Build_No = $_POST['Build_No'];
$Street = $_POST['Street'];
$City = $_POST['City'];
$District = $_POST['District'];
$State = $_POST['State'];
$Pincode = $_POST['Pincode'];
$head_id =$_SESSION['user_id'];
$status=$msg="";
//echo $Mobile ;
//define('DB_SERVER', 'localhost');
//define('DB_USERNAME', 'root');
//define('DB_PASSWORD', '');
//define('DB_NAME', 'eshopping');
// 
///* Attempt to connect to MySQL database */
//$MyConnection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// insert member into user dependent table

$sql = "SELECT * FROM user_dependent WHERE RELATIONSHIP = '$relationship' and FAMILY_MEMBER_NAME= '$Name' and user_id  = '$head_id'";
$result = mysqli_query($MyConnection, $sql);
//$status ="F";
//$msg = $Name;
//        
 if (mysqli_num_rows($result) === 0) 
 {
    $sql = "INSERT INTO user_dependent(USER_ID, FAMILY_MEMBER_NAME, RELATIONSHIP, IS_RESIDE_SAME_LOCATION) "
                . "values ('$head_id','$Name','$relationship','$is_reside')";
    
     
    if(mysqli_query($MyConnection, $sql))
        {
            // create login for different location memeber
            $sql_head = "SELECT * FROM user_registration WHERE user_id  = '$head_id'";
            $result_head = mysqli_query($MyConnection, $sql_head);

             if (mysqli_num_rows($result_head) > 0 && $is_reside === 'N') 
             {
                 $row = mysqli_fetch_assoc($result_head);
                 $sql_head = "INSERT INTO user_registration(user_name, mobile_number, email_id, rationcard, family_type, BUILD_NO, STREET, "
                            . "CITY, DISTRICT, STATE, PINCODE,head_id_if_dependent,user_type) "

                            . "values ('$Name','$Mobile','$Email','".$row['rationcard']."','".$row['family_type']."','$Build_No','$Street',"
                            . "'$City','$District','$State','$Pincode','$head_id','D')";
                 mysqli_query($MyConnection, $sql_head);
             }
            $status = "S";
            $msg = "Member Successfully Added";
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
        $msg = "Member Already Exist";
 }
mysqli_close($MyConnection);
$arr = array('status' => $status, 
            'msg' => $msg); 
echo json_encode($arr);
?>
