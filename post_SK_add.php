<?php
require_once "config.php";
session_start();
if(!isset($_SESSION['user_id']))
{
    header('location:index.php');
}
$Category = $_POST['Category'];
$Name = strtoupper($_POST['Name']);
$Owner_Name = $_POST['Owner_Name'];
$Mobile = $_POST['Mobile'];
$Email = $_POST['Email'];
$GST = $_POST['GST'];
$Reg_No = $_POST['Reg_No'];
$Build_No = $_POST['Build_No'];
$Street = $_POST['Street'];
$City = $_POST['City'];
$District = $_POST['District'];
$State = $_POST['State'];
$Pincode = $_POST['Pincode'];

$govt_off_id =$_SESSION['user_id'];
$status=$msg="";
//echo $Mobile ;
//define('DB_SERVER', 'localhost');
//define('DB_USERNAME', 'root');
//define('DB_PASSWORD', '');
//define('DB_NAME', 'eshopping');
// 
///* Attempt to connect to MySQL database */
//$MyConnection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
$sql = "SELECT * FROM shop_keeper_registration WHERE SHOP_CATEGORY = '$Category' and SHOP_PINCODE= '$Pincode' and SHOP_REG_NUMBER= '$Reg_No'";
$result = mysqli_query($MyConnection, $sql);

 if (mysqli_num_rows($result) === 0) 
 {
     
        $sql = "INSERT INTO shop_keeper_registration(SHOP_CATEGORY,shop_name, SHOP_OWNER_NAME,SHOP_REG_NUMBER, SHOP_GST_TIN_NUM, SHOP_MOBILE_NUMBER, "
                . "SHOP_EMAIL_ID, SHOP_BUILD_NO, SHOP_STREET, SHOP_CITY, SHOP_DISTRICT, SHOP_STATE, SHOP_PINCODE, GOVT_OFF_ID)  "
                . "values ('$Category','$Name','$Owner_Name','$Reg_No','$GST','$Mobile','$Email','$Build_No','$Street','$City','$District',"
                . "'$State','$Pincode','$govt_off_id')";
     
        if(mysqli_query($MyConnection, $sql))
        {
            $status = "S";
            $msg = "Shop Successfully Added";
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
        $msg = "Shop Already Exist";
 }
mysqli_close($MyConnection);
$arr = array('status' => $status, 
            'msg' => $msg); 
echo json_encode($arr);
?>
