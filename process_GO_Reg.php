<?php
require_once "config.php";
$Name = $_POST['Name'];
$Pincode = $_POST['Pincode'];
$Mobile = $_POST['Mobile'];
$Email = $_POST['Email'];
$Empid = $_POST['Empid'];
$status=$msg=$goid="";
//echo $Mobile ;
//define('DB_SERVER', 'localhost');
//define('DB_USERNAME', 'root');
//define('DB_PASSWORD', '');
//define('DB_NAME', 'eshopping');
// 
///* Attempt to connect to MySQL database */
//$MyConnection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

mysqli_query($MyConnection ,"SET @p1='".$Name."'");
mysqli_query($MyConnection ,"SET @p0='".$Pincode."'");
mysqli_query($MyConnection ,"SET @p2='".$Mobile."'");
mysqli_query($MyConnection ,"SET @p3='".$Email."'");
mysqli_query($MyConnection ,"SET @p4='".$Empid."'");

mysqli_query($MyConnection ,"SET @status='".$status."'");
mysqli_query($MyConnection ,"SET @msg='".$msg."'");
mysqli_query($MyConnection ,"SET @goid='".$goid."'");
mysqli_multi_query ($MyConnection, "CALL GOVT_OFF_REGISTER (@p0,@p1,@p2,@p3,@p4,@status, @msg, @goid)") OR DIE (mysqli_error($MyConnection));
$select = mysqli_query($MyConnection,'SELECT @status, @msg, @goid');
$result = mysqli_fetch_assoc($select);
$status  = $result['@status'];
$msg  = $result['@msg'];
$goid  = $result['@goid'];


//  require_once('./PHPMailer/PHPMailer.php');
//  require_once('./PHPMailer/Exction.php');
//  require_once('./PHPMailer/SMTP.php');
//  $mail = new PHPMailer;
//  $mail->IsSMTP();        //Sets Mailer to send message using SMTP
//  $mail->SMTPAuth = true;       //Sets SMTP authentication. Utilizes the Username and Password variables
//  $mail->SMTPSecure = 'ssl';       //Sets connection prefix. Options are "", "ssl" or "tls"
//  $mail->Host = 'smtp.gmail.com';  //Sets the SMTP hosts
//  $mail->Port = '465'; 
//  $mail->IsHTML();       //Sets message type to HTML 
//  $mail->Username = 'irhmssce@gmail.com';     //Sets SMTP username
//  $mail->Password = 'Mala@1968';     //Sets SMTP password
//  $mail->SetFrom("irhmssce@gmail.com") ;     //Sets the From email address for the message
//  $mail->Subject = 'e-Shopping Registration Details - Reg.';    //Sets the Subject of the message
//  $mail->Body = "Dear Sir/ Madam,"."\n"."Your Registration details regarding e- Shooping application".
//           "\n"."Your Unique ID: ".$goid."\n"."Password: ".$Mobile;    //An HTML or plain text message body
//  $mail->AddAddress($Email);//Adds a "To" address
//  if($mail->Send())        //Send an Email. Return true on success or false on error
//  {
//   $msg = $msg ." Registration details has been sent to your mail id";
//  }
  

$arr = array('status' => $status, 
            'msg' => $msg."\n"."Your Unique ID: ".$goid."\n"."Password: ".$Mobile, 
            'go_id' => $goid); 
echo json_encode($arr);
?>
