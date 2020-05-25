<?php
session_start();
if(!isset($_SESSION['user_id']))
{
    header('location:index.php');
}
$Category = $_POST['Category'];
$ID = $_POST['ID'];
$Price = $_POST['Price'];
$Quantity = $_POST['Quantity'];

$SK_id =$_SESSION['user_id'];
$status=$msg="";
//echo $Mobile ;
//define('DB_SERVER', 'localhost');
//define('DB_USERNAME', 'root');
//define('DB_PASSWORD', '');
//define('DB_NAME', 'eshopping');
// 
///* Attempt to connect to MySQL database */
//$MyConnection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
$sql = "SELECT * FROM shop_product_list WHERE PRODUCT_ID  = '$ID' and SK_UNIQUE_ID= '$SK_id'";
$result = mysqli_query($MyConnection, $sql);

 if (mysqli_num_rows($result) === 0) 
 {
     
        $sql = "insert into shop_product_list(SK_UNIQUE_ID,PRODUCT_ID,PRODUCT_CATEGORY,QUANTITY_AVAILABLE,PRODUCT_PRICE) values "
                . "('$SK_id','$ID','$Category','$Quantity','$Price')";
     
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
