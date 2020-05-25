<?php
require_once "config.php";
session_start();
if(!isset($_SESSION['user_id']))
{
    header('location:index.php');
}
$product_id = $_POST['product_id'];
$quantity= (int)$_POST['quantity'];
$order_id = $_POST['order_id'];
$SHOP_ID = $_POST['SHOP_ID'];
$user_id =$_SESSION['user_id'];
$FAMILY_TYPE = $_SESSION['FAMILY_TYPE'];
$LIMIT = (int)0;
$order_qty = (int)0;
$IS_ESSENTIAL_PRODUCT="";
$status=$msg="";
//echo $Mobile ;
//define('DB_SERVER', 'localhost');
//define('DB_USERNAME', 'root');
//define('DB_PASSWORD', '');
//define('DB_NAME', 'eshopping');
// 
///* Attempt to connect to MySQL database */
//$MyConnection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
$sql = "SELECT IS_ESSENTIAL_PRODUCT, MAXIMUM_LIMIT_NF,MAXIMUM_LIMIT_JF,MAXIMUM_LIMIT_SP FROM "
        . "product_master WHERE PRODUCT_ID = '$product_id'";
$result = mysqli_query($MyConnection, $sql);
if (mysqli_num_rows($result) >  0) 
 {
    while($row = mysqli_fetch_assoc($result))
    {
        $IS_ESSENTIAL_PRODUCT = $row['IS_ESSENTIAL_PRODUCT'];
        if($FAMILY_TYPE == 'NF')
        {
            $LIMIT = (int)$row['MAXIMUM_LIMIT_NF'];
        }
        else if($FAMILY_TYPE == 'JF')
        {
            $LIMIT = (int)$row['MAXIMUM_LIMIT_JF'];
        }
        else 
        {
            $LIMIT = (int)$row['MAXIMUM_LIMIT_SP'];
        }
    }
}
        if ($IS_ESSENTIAL_PRODUCT === 'Y' && $quantity > $LIMIT )
        {
            $status = "F";
            $msg = "Warning: Monthly Limit Exceeded:\n\n\n";
            $msg .= "You are exceeding the monthly purchase limit of quantity ".$LIMIT;
        }
        else 
        {
            $sql = "SELECT sum(QUANTITY) as qty FROM user_order u,user_ordered_product_list p WHERE YEAR(u.ORDER_DATE) = YEAR(now()) AND MONTH(u.ORDER_DATE) = month(now()) and u.ORDER_STATUS > 1 and u.ORDER_ID = p.ORDER_ID and p.PRODUCT_ID = '$product_id' and u.USER_ID = '$user_id'";
            $result = mysqli_query($MyConnection, $sql);
            if (mysqli_num_rows($result) >  0) 
            {
               while($row = mysqli_fetch_assoc($result))
               {
                   $order_qty = (int)$row['qty'];
                      
                       
               }
            }
            if($IS_ESSENTIAL_PRODUCT === 'Y' && ($quantity+$order_qty)> $LIMIT)
                   {
                       $status = "F";
                       $msg = "Warning: Monthly Limit Exceeded:\n\n\n";
                       $msg .= "You had already ordered quantity ".$order_qty. ". Now this selected quantity ".$quantity." exceeded the monthly puchase limit of quantity ".$LIMIT;
                   }
                   else
                    {
                        $sql = "SELECT * FROM user_ordered_product_list WHERE ORDER_ID = '$order_id' and PRODUCT_ID= '$product_id'";
                        $result = mysqli_query($MyConnection, $sql);

                         if (mysqli_num_rows($result) === 0) 
                         {

                                $sql = "INSERT INTO user_ordered_product_list(ORDER_ID,PRODUCT_ID,QUANTITY) "
                                        . "values ('$order_id','$product_id','$quantity')";

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
                              $sql = "update user_ordered_product_list set QUANTITY ='$quantity' where ORDER_ID = '$order_id' and PRODUCT_ID= '$product_id'";
                              if(mysqli_query($MyConnection, $sql))
                                {
                                    $status = "S";
                                    $msg = "Product Successfully Updated";
                                }
                                else
                                {
                                    $status = "F";
                                    $msg = "Error";
                                }
                        }  
                    } 

        }
mysqli_close($MyConnection);
$arr = array('status' => $status, 
            'msg' => $msg); 
echo json_encode($arr);
?>
