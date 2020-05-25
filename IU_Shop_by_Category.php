<?php
require_once 'IU_Menu.php';
session_start();
if(!isset($_SESSION['user_id']))
{
    header('location:index.php');
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>e-Shopping - Shop by Category</title>
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
                $('input[id$="Proceed"]').click(function () 
                //            $('#Proceed').click(function () 
                {
                    //alert("Hi");
                    var vartr = $(this).closest('tr');
                    var shop_id = vartr.find('input[id$="shop_id"]').val();
                    //alert("Shop ID: "+shop_id);
                    window.location.href= "View_Shop_Product.php?Shop_ID="+shop_id;
                    //window.location.href= "View_Shop_Product.php";
                });
            });
        </script>
    </head>
    <body>
        <div class="wrapper" style="margin:0 auto;" >
            <h2 style="color:#b5651d;">Shop by Category</h2>
 
            
            <table class="table">
                <tr>
                    <td>S.No</td>
                    <td>Category</td>
                    <td>Shop Name</td>
                    <td>Mobile Number</td>
                    <td>Email ID</td>
                    <td>Shop Address</td>
                    <td>Action</td>
                    
                    
                </tr>
                
                       
                <?php
                require_once "config.php";
//                define('DB_SERVER', 'localhost');
//                define('DB_USERNAME', 'root');
//                define('DB_PASSWORD', '');
//                define('DB_NAME', 'eshopping');
//
//                /* Attempt to connect to MySQL database */
//                $MyConnection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

                $sql = "SELECT * FROM shop_keeper_registration where SHOP_PINCODE = ".$_SESSION['PINCODE']." order by SHOP_CATEGORY,shop_name asc";


                 $result = mysqli_query($MyConnection, $sql);
                 $index = (int)0;
                 if (mysqli_num_rows($result) > 0) 
                 {
                     ?>
                     <?php 
                    while($row = mysqli_fetch_assoc($result)) 
                    {
                        $index++;
                        ?> 
                <tr>
                    <td><?php echo $index ?></td>
                    <td><?php echo $row['SHOP_CATEGORY']?>
                    <input type="hidden" id="obj[<?php echo $index?>].shop_id" name="obj[<?php echo $index?>].shop_id" value="<?php echo $row['SK_UNIQUE_ID']?>" >
                    
                    </td>
                    <td><?php echo $row['shop_name']?></td>
                    <td><?php echo $row['SHOP_MOBILE_NUMBER']?></td>
                    <td><?php echo $row['SHOP_EMAIL_ID']?></td>
                    <td><?php echo $row['SHOP_BUILD_NO'].", ".$row['SHOP_STREET'].", \n". $row['SHOP_CITY'].", \n". $row['SHOP_DISTRICT'].", \n". $row['SHOP_STATE']." - \n". $row['SHOP_PINCODE']?></td>
                    <td><input type="button" id="obj[<?php echo $index?>].Proceed" name="obj[<?php echo $index?>].Proceed" class="btn btn-primary" value="Click here to view product" style="background:#b5651d;border:#b5651d;"></td>
                </tr>
<!--                        $index++;
                        echo "<tr>";
                        echo "<td>". $index ."</td>";
                        echo "<td>". $row['SHOP_CATEGORY'] ."<input type='hidden' id='obj[".$index."].shop_id' name='obj[".$index."].shop_id' value='".$row['SK_UNIQUE_ID']."' ></td>";
                        echo "<td>". $row['shop_name'] ."</td>";
                        echo "<td>". $row['SHOP_MOBILE_NUMBER'] ."</td>";
                        echo "<td>". $row['SHOP_EMAIL_ID'] ."</td>";
                        echo "<td>". $row['SHOP_BUILD_NO'] .", ".$row['SHOP_STREET'].", \n". $row['SHOP_CITY'].", \n". $row['SHOP_DISTRICT'].", \n". $row['SHOP_STATE']." - \n". $row['SHOP_PINCODE']."</td>";
                        echo "<td><input type='button' id='obj[".$index."].Proceed' name='obj[".$index."].Proceed' class='btn btn-primary' value='Click here to view product' style='background:#b5651d;border:#b5651d;'></td>";
                        echo "</tr>";-->
                     <?php  
                    }
                       
                }
                  
                            
                 mysqli_close($MyConnection);
                ?>
                                
                        
            </table> 
     
        </div>    
    </body>
</html>