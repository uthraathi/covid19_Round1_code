<?php
require_once 'Go_Menu.php';
session_start();
if(!isset($_SESSION['user_id']))
{
    header('location:index.php');
}
$PINCODE=$_SESSION['PINCODE'];
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>e-Shopping - Shop Keeper List</title>
        <p style="float: right;font-size:20px;color: orchid;"><u>User Name</u>: <?php echo $_SESSION['User_Name']?><br><u>User Category</u>: <?php if ($_SESSION['user_category'] === "IU") echo "Individual User"; else if($_SESSION['user_category'] === "GO") echo "Government Official" ; else echo "Shop Keeper"; ?></p>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
        <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 100%; padding: 20px; }
        .error{color: #FF0000;}
        </style>
        
    </head>
    <body>
        <div class="wrapper" style="margin:0 auto;" >
            <h2 style="color:#b5651d;">Shop Keeper List</h2>
 

            <table class="table">
                <tr>
                    <td>S.No</td>
                    <td>Category</td>
                    <td>Shop ID</td>
                    <td>Shop Name</td>
                    <td>Shop Owner Name</td>
                    <td>Mobile Number</td>
                    <td>Email ID</td>
                    <td>Shop GST TIN</td>
                    <td>Registration Number</td>
                    <td>Entry Date</td>
                    <td>Shop Address</td>
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

                $sql = "SELECT * FROM shop_keeper_registration where SHOP_PINCODE = '$PINCODE' order by SHOP_PINCODE,SHOP_CATEGORY,shop_name asc";


                 $result = mysqli_query($MyConnection, $sql);
                 $index = (int)0;
                 if (mysqli_num_rows($result) > 0) 
                 {
                    while($row = mysqli_fetch_assoc($result)) 
                    {
                        $index++;
                        echo "<tr>";
                        echo "<td>". $index ."</td>";
                        echo "<td>". $row['SHOP_CATEGORY'] ."</td>";
                        echo "<td>". $row['SK_UNIQUE_ID'] ."</td>";
                        echo "<td>". $row['shop_name'] ."</td>";
                        echo "<td>". $row['SHOP_OWNER_NAME'] ."</td>";
                        echo "<td>". $row['SHOP_MOBILE_NUMBER'] ."</td>";
                        echo "<td>". $row['SHOP_EMAIL_ID'] ."</td>";
                        
                        echo "<td>". $row['SHOP_GST_TIN_NUM'] ."</td>";
                        echo "<td>". $row['SHOP_REG_NUMBER'] ."</td>";
                        echo "<td>". $row['ENTRY_DATE'] ."</td>";
                        echo "<td>". $row['SHOP_BUILD_NO'] .", ".$row['SHOP_STREET'].", \n". $row['SHOP_CITY'].", \n". $row['SHOP_DISTRICT'].", \n". $row['SHOP_STATE']." - \n". $row['SHOP_PINCODE']."</td>";
                        
                        echo "</tr>";
                    }
                        
                }
                  

                 mysqli_close($MyConnection);
                ?>
                                
                        
            </table> 
     
        </div>    
    </body>
</html>
