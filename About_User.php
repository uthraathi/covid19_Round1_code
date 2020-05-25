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
        <title>e-Shopping - About User</title>
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
            <h2 style="color:#b5651d;">About User</h2>
 

            <table class="table">
               
                <?php
                require_once "config.php";
//                define('DB_SERVER', 'localhost');
//                define('DB_USERNAME', 'root');
//                define('DB_PASSWORD', '');
//                define('DB_NAME', 'eshopping');
//
//                /* Attempt to connect to MySQL database */
//                $MyConnection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

                $sql = "SELECT * from user_registration where user_id = ".$_SESSION['user_id']."";


                 $result = mysqli_query($MyConnection, $sql);

                 if (mysqli_num_rows($result) > 0) 
                 {
                    while($row = mysqli_fetch_assoc($result)) 
                    {
                        echo "<tr>";
                        echo "<td>User Name</td>";
                        echo "<td>". $row['user_name'] ."</td>";
                        echo "</tr>";
                        
                        echo "<tr>";
                        echo "<td>User Type</td>";
                        if($row['user_type'] === 'H')
                        {
                            echo "<td>Head of the Family</td>";
                        }
                        else
                        {
                            echo "<td>Member of the Family</td>";
                        }
                        echo "</tr>";
                        
                        echo "<tr>";
                        echo "<td>Mobile Number</td>";
                        echo "<td>". $row['mobile_number'] ."</td>";
                        echo "</tr>";
                        
                        echo "<tr>";
                        echo "<td>Email ID</td>";
                        echo "<td>". $row['email_id'] ."</td>";
                        echo "</tr>";
                        
                        echo "<tr>";
                        echo "<td>Ration card</td>";
                        echo "<td>". $row['rationcard'] ."</td>";
                        echo "</tr>";
                        
                        echo "<tr>";
                        echo "<td>Family Type</td>";
                        
                        if($row['family_type'] === 'NF')
                        {
                            echo "<td>Nuclear Family</td>";
                        }
                        else if($row['family_type'] === 'SP')
                        {
                            echo "<td>Single Person</td>";
                        }
                        else
                        {
                            echo "<td>Join Family</td>";
                        }
                        echo "</tr>";
                        
                        
                        echo "<tr>";
                        echo "<td>Address</td>";
                        echo "<td>". $row['BUILD_NO'] .", ".$row['STREET'].", \n". $row['CITY'].", \n". $row['DISTRICT'].", \n". $row['STATE']." - \n". $row['PINCODE']."</td>";
                        echo "</tr>";
                        
                        echo "<tr>";
                        echo "<td>Family Member Details</td>";
                        echo "<td>";
                 
                    }
                    $sql_family = "SELECT * from user_dependent where user_id = ".$_SESSION['user_id'].""; 
                    $result_family = mysqli_query($MyConnection, $sql_family);

                 if (mysqli_num_rows($result_family) > 0) 
                 {
                     
                    echo "<table class='table' style='width:70%'>";
                    echo "<tr>";
                        echo "<td>Name</td>";
                        echo "<td>Relationship</td>";
                        echo "<td>Is Reside is same Location</td>";
                        echo "</tr>";
                    while($row_family = mysqli_fetch_assoc($result_family)) 
                    {
                       
                        echo "<tr>";
                        echo "<td>".$row_family['FAMILY_MEMBER_NAME']."</td>";
                        echo "<td>". $row_family['RELATIONSHIP'] ."</td>";
                        if($row_family['IS_RESIDE_SAME_LOCATION'] === 'Y')
                        {
                            echo "<td>Yes</td>";
                        }
                        else
                        {
                            echo "<td>No</td>";
                        }
                        echo "</tr>";
                        echo "</tr>";
                         
                       
                    }
                    echo "<table>";
                } 
                echo "</td></tr>";
               
                }
                 

                 mysqli_close($MyConnection);
                ?>
                                
                        
            </table> 
     
        </div>    
    </body>
</html>
