<?php
require_once "config.php";
require_once 'IU_Menu.php';
session_start();
if(!isset($_SESSION['user_id']))
{
    header('location:index.php');
}
$SHOP_ID = (int)$_GET['Shop_ID'];
$user_id = $_SESSION['user_id'];
$db_SHOP_ID = "";
$db_order_id="";
$order_id="";
$status=$msg="";
//echo $Mobile ;
//define('DB_SERVER', 'localhost');
//define('DB_USERNAME', 'root');
//define('DB_PASSWORD', '');
//define('DB_NAME', 'eshopping');
///* Attempt to connect to MySQL database */
//$MyConnection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
$sql = "SELECT * FROM user_order WHERE USER_ID = '$user_id' and ORDER_STATUS= 1";
$result = mysqli_query($MyConnection, $sql);

 if (mysqli_num_rows($result) === 1) 
 {
     $row = mysqli_fetch_assoc($result);
     $db_SHOP_ID = (int)$row["SHOP_ID"];
     $db_order_id= (int)$row["ORDER_ID"];
     
      $sql = "update user_order set SHOP_ID = "
                
                . "'$SHOP_ID' where USER_ID = $user_id and ORDER_STATUS= 1";
        $result = mysqli_query($MyConnection, $sql);
        if($result && $db_SHOP_ID!== '' && $db_SHOP_ID !== $SHOP_ID)
        {
            $sql = "delete from user_ordered_product_list where "
                
                . "ORDER_ID  = $db_order_id ";
            $result = mysqli_query($MyConnection, $sql);
        }
}
 else 
 {
       $sql = "INSERT INTO user_order(USER_ID, SHOP_ID) "
                
                . "values ('$user_id','$SHOP_ID')";
       $result = mysqli_query($MyConnection, $sql);
        
  } 
  $sql = "SELECT * FROM user_order WHERE USER_ID = '$user_id' and ORDER_STATUS= 1";
  $result = mysqli_query($MyConnection, $sql);

 if (mysqli_num_rows($result) === 1) 
 {
     $row = mysqli_fetch_assoc($result);
   
     $order_id= (int)$row["ORDER_ID"];
}
 

?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>e-Shopping - Shop Product List</title>
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
                $('#Back').click(function() {
              window.location.href="IU_Shop_by_Category.php";
              });
                $('input[id$="Cart"]').click(function () 
                //            $('#Proceed').click(function () 
                {
                    //alert("Hi");
                    var vartr = $(this).closest('tr');
                    var product_id = vartr.find('input[id$="product_id"]').val();
                    var quantity = vartr.find('select[id$="quantity"]').val();
                    var order_id = "<?php echo $order_id ?>";
                    var SHOP_ID = "<?php echo $SHOP_ID ?>";
                    //alert( " product_id: "+quantity);
//                    alert("Shop ID: "+SHOP_ID + " product_id: "+product_id+ " order_id: " +order_id);
                    //windows.location.href= "View_Shop_Product.php?Shop_ID="+shop_id;
                    if(quantity !== "0")
                    {
                    $.ajax({
                        type: 'POST',
                        url: 'Post_Product_cart.php',
                        data: { product_id: product_id, order_id: order_id ,SHOP_ID: SHOP_ID,quantity:quantity},
                        success: function(response) {
                             var result = JSON.parse(response);
                             //alert(result.status);
                             if(result.status === "S")
                             {
                                 alert(result.msg);
                                 vartr.remove();
                             }
                             else
                             {
                                 alert(result.msg);
                            }
                        }
                    });
                }
                else
                {alert("select quantity");}
                });

                $('#Proceed_Checkout').click(function () 
                {
//                alert("hi");
                var order_id = "<?php echo $order_id ?>";
               window.location.href= "View_Order_Checkout.php?order_id="+order_id;
                });
            });
        </script>
    </head>
    <body>
        <input type="submit" class="btn btn-primary" id="Back" name="Back" value="Go Back" style="background:orangered;border:orangered;">
        <div class="wrapper" style="margin:0 auto;" >
            <h2 style="color:#b5651d;">Shop Product List</h2>
               <h4 style="color:#b5651d;">Order ID: <?php echo $order_id ?></h4> 
            
            <table class="table">
                <tr>
                    <td>S.No</td>
<!--                    <td>Order ID</td>-->
                    <td>Product Name</td>
                    <td>Price</td>
                    <td>Quantity</td>
                    <td>Action</td>
                    
                </tr>
                
                       
                <?php
//                define('DB_SERVER', 'localhost');
//                define('DB_USERNAME', 'root');
//                define('DB_PASSWORD', '');
//                define('DB_NAME', 'eshopping');

                /* Attempt to connect to MySQL database */
                $MyConnection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

                $sql = "SELECT sp.*,p.PRODUCT_NAME FROM product_master p, shop_product_list sp where SK_UNIQUE_ID = ".$SHOP_ID." and p.PRODUCT_ID=sp.PRODUCT_ID and sp.QUANTITY_AVAILABLE > 0 order by sp.PRODUCT_CATEGORY,sp.PRODUCT_ID";


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
                     <input type="hidden" id="obj[<?php echo $index1?>].product_id" name="obj[<?php echo $index1?>].product_id" value="<?php echo $row['PRODUCT_ID']?>" >
                    </td>
<!--                    <td><?php echo $order_id ?></td>-->
                    <td><?php echo $row['PRODUCT_NAME']?></td>
                    <td><?php echo $row['PRODUCT_PRICE']?></td>
                    <td>
                        <select id="obj[<?php echo $index1?>].quantity" name="obj[<?php echo $index1?>].quantity">
                            <?php
                            for($i=0; $i<=$row['QUANTITY_AVAILABLE']; $i++){
                                echo "<option value='".$i."'>" . $i . "</option>";
                            }
                            ?>
                        </select>
                    </td>
                    <td><input type="button" id="obj[<?php echo $index1?>].Cart" name="obj[<?php echo $index1?>].Cart" class="btn btn-primary" value="Add to Cart" style="background:orangered;border:orangered;"></td>
                </tr>

                     <?php  
                    }
                       
                }
                  
                            
                 mysqli_close($MyConnection);
                ?>
                                
                        
            </table> 
            <div><input type="button" id="Proceed_Checkout" name="Proceed_Checkout" class="btn btn-primary" value="Proceed to Checkout" style="background:green;border:green;float:right;"></div>
        </div>    
    </body>
    
</html>