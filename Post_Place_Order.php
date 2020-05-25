<?php
require_once "config.php";
date_default_timezone_set('Asia/Kolkata'); 
session_start();
if(!isset($_SESSION['user_id']))
{
    header('location:index.php');
}
$order_id = $_POST['order_id'];

$user_id =$_SESSION['user_id'];
$status=$msg="";
$current_date =  date('Y-m-d');
$current_time =  date('H:i');
$current_date_time = date("Y-m-d H:i");
// get shop details
$sql_s = "SELECT s.* FROM user_order u, shop_keeper_registration s WHERE u.ORDER_ID = '$order_id' and s.SK_UNIQUE_ID = u.SHOP_ID";
$result = mysqli_query($MyConnection, $sql_s);
$row = mysqli_fetch_assoc($result);
$Open_Time = date('H:i',strtotime($row['Open_Time']));
$Open_Time_H = date('H',strtotime($row['Open_Time']));
$Open_Time_M = date('i',strtotime($row['Open_Time']));
$Close_Time = date('H:i',strtotime($row['Close_Time']));
$Close_Time_H = date('H',strtotime($row['Close_Time']));
$Close_Time_M = date('i',strtotime($row['Close_Time']));
$No_of_Person = (int) $row['No_of_Person'];
$Service_Time = (int) $row['Service_Time']*60;
$count_person = "";
// get max deivery time
$sql_d = "SELECT MAX(delivery_time) AS delivery_time FROM user_order WHERE ORDER_STATUS > 1 AND ORDER_DATE = CURRENT_DATE()";
$result_d = mysqli_query($MyConnection, $sql_d);
$row_d = mysqli_fetch_assoc($result_d);
//$max_deliv_dt = date("Y-m-d h:i",$row_d['delivery_time']) ;
$max_deliv_dt = date('Y-m-d H:i',strtotime($row_d['delivery_time']));
//$status .= "F";
//$msg = "Delivery Time: ".$max_deliv_dt;
if ($max_deliv_dt != '')
 {
     // get person count
    $sql_c = "SELECT COUNT(*) AS CNT FROM user_order WHERE ORDER_STATUS > 1 AND ORDER_DATE = CURRENT_DATE()";
    $result_c = mysqli_query($MyConnection, $sql_c);
    $row_c = mysqli_fetch_assoc($result_c);
    $count_person = (int)$row_c['CNT'];
    if($count_person !== 0 && $count_person < $No_of_Person && $max_deliv_dt > $current_date_time)
    {
                $max_deliv_dt = $max_deliv_dt;
    }
    else if($count_person !== 0 && $count_person === $No_of_Person && $max_deliv_dt > $current_date_time)
    {
                $max_deliv_dt = date('Y-m-d H:i',strtotime($max_deliv_dt) + $Service_Time);
    }
    else
    {
        if ($current_date_time > $max_deliv_dt && date('H:i',strtotime($current_time) + $Service_Time) > $Close_Time)
        {
                $max_deliv_dt =  date('Y-m-d H:i',strtotime($current_date) + $Service_Time + (int)($Open_Time_H)*60*60 + (int)($Open_Time_M)*60 + 86400);
        }
        else
        {
                 $max_deliv_dt =  date('Y-m-d H:i',strtotime($current_date_time) + $Service_Time);
        }
    }
 }
else 
{
    if($current_time > $Open_Time && date('H:i',strtotime($current_time) + $Service_Time) < $Close_Time)
    {
        $max_deliv_dt = date('Y-m-d H:i',strtotime($current_date_time) + $Service_Time);

    }
    else if(date('h:i:s',strtotime($current_date_time)) < $Open_Time){
        $max_deliv_dt = date('Y-m-d H:i',strtotime($current_date) + $Service_Time + (int)($Open_Time_H)*60*60 + (int)($Open_Time_M)*60);

    }
    else {
         $max_deliv_dt = date('Y-m-d H:i',strtotime($current_date) + $Service_Time + (int)($Open_Time_H)*60*60 + (int)($Open_Time_M)*60 + 86400);
        

    }
}

//$sql = "update user_order set ORDER_STATUS = 2,ORDER_DATE = now(), delivery_time = now() WHERE ORDER_ID = '$order_id' and ORDER_STATUS = 1";
$sql = "update user_order set ORDER_STATUS = 2,ORDER_DATE = now(), delivery_time = '$max_deliv_dt' WHERE ORDER_ID = '$order_id' and ORDER_STATUS = 1";
if (mysqli_query($MyConnection, $sql)) 
 {
  
            $sql = "SELECT s.SK_UNIQUE_ID,p.PRODUCT_ID,s.QUANTITY_AVAILABLE,p.QUANTITY, (s.QUANTITY_AVAILABLE - p.QUANTITY) as current_qty FROM user_order u,user_ordered_product_list p,shop_product_list s WHERE u.ORDER_ID = '$order_id' and u.ORDER_ID = p.ORDER_ID and s.PRODUCT_ID = p.PRODUCT_ID and s.SK_UNIQUE_ID = u.SHOP_ID ";
            $result = mysqli_query($MyConnection, $sql);

             if (mysqli_num_rows($result) > 0) 
             {

                while($row = mysqli_fetch_assoc($result)) 
                {
                      $sql = "update shop_product_list set QUANTITY_AVAILABLE = '".$row['current_qty']."' where SK_UNIQUE_ID ='".$row['SK_UNIQUE_ID']."' and PRODUCT_ID = '".$row['PRODUCT_ID']."'";

                       mysqli_query($MyConnection, $sql);          
                }
            }
            $status = "S";
            $msg = "Order Placed Successfully";
        
     
 } 
 else {
            $status = "F";
            $msg = "Error";
}
mysqli_close($MyConnection);
$arr = array('status' => $status, 
            'msg' => $msg); 
echo json_encode($arr);
?>
