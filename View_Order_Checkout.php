<?php
require_once "config.php";
require_once 'IU_Menu.php';
session_start();
if(!isset($_SESSION['user_id']))
{
    header('location:index.php');
}
$order_id = (int)$_GET['order_id'];
$user_id = $_SESSION['user_id'];

$status=$msg="";
//echo $Mobile ;

//define('DB_SERVER', 'localhost');
//define('DB_USERNAME', 'root');
//define('DB_PASSWORD', '');
//define('DB_NAME', 'eshopping');
///* Attempt to connect to MySQL database */
//$MyConnection_get = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
$sql_get = "SELECT u.USER_ID,u.SHOP_ID,p.PRODUCT_ID,p.QUANTITY,s.PRODUCT_PRICE, (p.QUANTITY*s.PRODUCT_PRICE) as sub_total FROM user_ordered_product_list p, user_order u, shop_product_list s WHERE u.USER_ID = '$user_id' and u.ORDER_STATUS=1 and u.ORDER_ID = p.ORDER_ID and s.PRODUCT_ID = p.PRODUCT_ID and u.SHOP_ID=s.SK_UNIQUE_ID";
$result_get = mysqli_query($MyConnection, $sql_get);

 if (mysqli_num_rows($result_get) > 0) 
 {
    
    while($row_get = mysqli_fetch_assoc($result_get)) 
    {
          $sql_get = "update user_ordered_product_list set sub_total = '".$row_get['sub_total']."' where ORDER_ID ='$order_id' and PRODUCT_ID = '".$row_get['PRODUCT_ID']."'";

           mysqli_query($MyConnection, $sql_get);          
    }
}

?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>e-Shopping - Order Checkout</title>
        <p style="float: right;font-size:20px;color: orchid;"><u>User Name</u>: <?php echo $_SESSION['User_Name']?><br><u>User Category</u>: <?php if ($_SESSION['user_category'] === "IU") echo "Individual User"; else if($_SESSION['user_category'] === "GO") echo "Government Official" ; else echo "Shop Keeper"; ?></p>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
        <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 100%; padding: 20px; }
        .error{color: #FF0000;}
        </style>
        <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
        <script type="text/javascript">
            $(function(){
                $('#Place_Order').click(function () 
                {
                    //alert("Hi");
                    var order_id = "<?php echo $order_id ?>";
                    //alert("order id: "+order_id);
                    $.ajax({
                        type: 'POST',
                        url: 'Post_Place_Order.php',
                        data: {order_id:order_id },
                        success: function(response) {
                             var result = JSON.parse(response);
                             if(result.status === "S")
                             {
                                 alert(result.msg);
                                 window.location.href="IU_Order_Status.php";
                             }
                             else
                             {
                                 alert(result.msg);
                            }
                        }
                    });
                });
                
//                $('#Place_Order').click(function () 
//                {
//           alert("hi");
//
//  
//                    $.ajax({
//                        type: 'POST',
//                        url: 'Post_Place_Order.php',
//                        data: {order_id:order_id },
//                        success: function(response) {
//                             var result = JSON.parse(response);
//                             if(result.status === "S")
//                             {
//                                 alert(result.msg);
//                                 window.location.href="IU_Order_Status.php";
//                             }
//                             else
//                             {
//                                 alert(result.msg);
//                            }
//                        }
//                    });
//                )};
            });
        </script>
    </head>
    <body>
       
        <div class="wrapper" style="margin:0 auto;" >
            <h2 style="color:#b5651d;">Order Checkout</h2>
               <h4 style="color:#b5651d;">Order ID: <?php echo $order_id ?></h4> 
            
            <table class="table">
                <tr>
                    <td>S.No</td>
                    <td>Product Name</td>
                    <td>Price</td>
                    <td>Quantity</td>
                    <td>Sub Total</td>
                </tr>
                
                       
                <?php

                $MyConnection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

                $sql = "SELECT u.USER_ID,u.SHOP_ID,p.PRODUCT_ID,m.PRODUCT_NAME,p.QUANTITY,s.PRODUCT_PRICE, p.sub_total,p.QUANTITY FROM user_ordered_product_list p, user_order u, shop_product_list s,product_master m WHERE u.USER_ID = '$user_id' and u.ORDER_STATUS=1 and u.ORDER_ID = p.ORDER_ID and s.PRODUCT_ID = p.PRODUCT_ID and u.SHOP_ID=s.SK_UNIQUE_ID and m.PRODUCT_ID = s.PRODUCT_ID";


                 $result = mysqli_query($MyConnection, $sql);
                 $index1 = (int)0;
                 if (mysqli_num_rows($result) > 0) 
                 {
                     ?>
                     <?php 
                    while($row = mysqli_fetch_assoc($result)) 
                    {
                        $index1++;
                        ?> 
                <tr>
                    <td><?php echo $index1 ?>
                     
                    </td>

                    <td><?php echo $row['PRODUCT_NAME']?></td>
                    <td><?php echo $row['PRODUCT_PRICE']?></td>
                    <td><?php echo $row['QUANTITY']?></td>
                    <td><?php echo $row['sub_total']?></td>
                </tr>

                     <?php  
                    }
                       
                }
                $sql = "SELECT sum(sub_total) as total from user_ordered_product_list where ORDER_ID='$order_id'";
                $result = mysqli_query($MyConnection, $sql);  
                if (mysqli_num_rows($result) > 0) 
                 {
                    while($row = mysqli_fetch_assoc($result)) 
                    {
                        echo "<tr>";
                        echo "<td></td>";
                        echo "<td></td>";
                        echo "<td></td>";
                        echo "<td style='float:right;font-size:30px;'><b>". $row['total'] ."</b></td>";
                        echo "<td style='float:right;font-size:30px;'><b>Total</b></td>";
                        echo "</tr>";  
                    }
                 }
                
                 mysqli_close($MyConnection);
                ?>
             </table> 
     <div>
         <input type="button" id="Place_Order" name="Place_Order" class="btn btn-primary" value="Place Order" style="background:green;border:green;float:right;font-size:20px;">
     </div>
        </div>    
    </body>
    
</html>