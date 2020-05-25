<?php
require_once "config.php";
//define('DB_SERVER', 'localhost');
//define('DB_USERNAME', 'root');
//define('DB_PASSWORD', '');
//define('DB_NAME', 'eshopping');
$list = "<select id='Prod_Price' name='Prod_Price'> <option value='Select'>Select</option>";
/* Attempt to connect to MySQL database */
//$MyConnection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if(!empty($_GET['Prod_ID'])) 
{
        $Prod_ID = $_GET["Prod_ID"];           
	$sql ="SELECT PRICE_RANGE_FROM,PRICE_RANGE_TO FROM product_master WHERE PRODUCT_ID  = '$Prod_ID'";
	$result = mysqli_query($MyConnection, $sql);
        if (mysqli_num_rows($result) > 0) 
        { 
           $row = mysqli_fetch_assoc($result);
           $first = (int)$row['PRICE_RANGE_FROM'];
           $last = (int)$row['PRICE_RANGE_TO'];
           if ($first === $last)
           {
               $list = $list. "<option value='".$first."'>" . $first . "</option>";
           }
           else
           {
               for ($i= $first ; $i <= $last ; $i++)
               {
                   $list = $list. "<option value='".$i."'>" . $i . "</option>";
               }
           }
          
           
           $list = $list."</select>";
        } 
         mysqli_close($MyConnection);
}
echo $list;
?>