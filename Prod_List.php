<?php
require_once 'Go_Menu.php';
session_start();
if(!isset($_SESSION['user_id']))
{
    header('location:index.php');
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>e-Shopping - Product List</title>
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
            <h2 style="color:#b5651d;">Product List</h2>
 

            <table class="table">
                <tr>
                    <td>S.No</td>
                    <td>Category</td>
                    <td>Product ID</td>
                    <td>Name</td>
                    <td>Price Range</td>
                    <td>Entry Date</td>
                    <td>comes under essential product?</td>
                    <td>Nuclear  Family Limit</td>
                    <td>Join  Family Limit</td>
                    <td>Single Person Limit</td>
                    
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

                $sql = "SELECT * FROM product_master where product_type = 'G' order by CATEGORY,PRODUCT_NAME asc";


                 $result = mysqli_query($MyConnection, $sql);
                 $index = (int)0;
                 if (mysqli_num_rows($result) > 0) 
                 {
                    while($row = mysqli_fetch_assoc($result)) 
                    {
                        $index++;
                        echo "<tr>";
                        echo "<td>". $index ."</td>";
                        echo "<td>". $row['CATEGORY'] ."</td>";
                        echo "<td>". $row['PRODUCT_ID'] ."</td>";
                        echo "<td>". $row['PRODUCT_NAME'] ."</td>";
                        echo "<td>". $row['PRICE_RANGE_FROM'] ." - ".$row['PRICE_RANGE_TO']."</td>";
                        echo "<td>". $row['ENTRY_DATE'] ."</td>";
                        if ($row['IS_ESSENTIAL_PRODUCT'] === 'Y')
                        {
                            echo "<td>Yes</td><td>". $row['MAXIMUM_LIMIT_NF'] ."</td><td>". $row['MAXIMUM_LIMIT_JF'] ."</td><td>". $row['MAXIMUM_LIMIT_SP'] ."</td>";
                        }
                        else
                        {
                            echo "<td>No</td><td></td><td></td><td></td>";
                        }
                        
                    }
                        echo "</tr>";
                }
                  

                 mysqli_close($MyConnection);
                ?>
                                
                        
            </table> 
     
        </div>    
    </body>
</html>
