<?php
require_once "config.php";
session_start();
if(!isset($_SESSION['user_id']))
{
    header('location:index.php');
}
$Category = $_POST['Category'];
$Name = strtoupper($_POST['Name']);
$Price_From = $_POST['Price_From'];
$Price_To = $_POST['Price_To'];
$Is_Essential = $_POST['Is_Essential'];
$Limit_NF = $_POST['Limit_NF'];
$Limit_JF = $_POST['Limit_JF'];
$Limit_SP = $_POST['Limit_SP'];
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
$sql = "SELECT * FROM product_master WHERE PRODUCT_NAME = '$Name' and CATEGORY= '$Category'";
$result = mysqli_query($MyConnection, $sql);

 if (mysqli_num_rows($result) === 0) 
 {
     if ($Is_Essential === 'Y')
     {
        $sql = "INSERT INTO product_master(CATEGORY, PRODUCT_NAME, PRICE_RANGE_FROM, PRICE_RANGE_TO, IS_ESSENTIAL_PRODUCT, "
                . "MAXIMUM_LIMIT_NF, MAXIMUM_LIMIT_JF, MAXIMUM_LIMIT_SP, GOVT_OFF_ID) values ('$Category',"
                . "'$Name','$Price_From','$Price_To','$Is_Essential','$Limit_NF','$Limit_JF','$Limit_SP','$govt_off_id')";
     }
     else
     {
         $sql = "INSERT INTO product_master(CATEGORY, PRODUCT_NAME, PRICE_RANGE_FROM, PRICE_RANGE_TO, IS_ESSENTIAL_PRODUCT, "
                . " GOVT_OFF_ID) values ('$Category',"
                . "'$Name','$Price_From','$Price_To','$Is_Essential','$govt_off_id')";
     }
        if(mysqli_query($MyConnection, $sql))
        {
            $status = "S";
            $msg = "Product Successfully Added";
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
        $msg = "Product Already Exist";
 }
mysqli_close($MyConnection);
$arr = array('status' => $status, 
            'msg' => $msg); 
echo json_encode($arr);
?>
