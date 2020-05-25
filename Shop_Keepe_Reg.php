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
        <title>e-Shopping - Shop Keeper Add</title>
        <p style="float: right;font-size:20px;color: orchid;"><u>User Name</u>: <?php echo $_SESSION['User_Name']?><br><u>User Category</u>: <?php if ($_SESSION['user_category'] === "IU") echo "Individual User"; else if($_SESSION['user_category'] === "GO") echo "Government Official" ; else echo "Shop Keeper"; ?></p>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
        <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 700px; padding: 20px; }
        .error{color: #FF0000;}
        </style>
        <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>

            <script type="text/javascript">
            $(function()
            {
              $("#Pincode").keypress(function (e) {
                //if the letter is not digit then display error and don't type anything
                if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                   //display error message
                   $('#address_err').empty();
                   $("#address_err").append('<span style="color:red;">enter digit only</span>');
                          return false;
               }
               else
               {$('#address_err').empty();}
              });
              $("#Shop_Mobile").keypress(function (e) {
                //if the letter is not digit then display error and don't type anything
                if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                   //display error message
                   $('#mobile_err').empty();
                   $("#mobile_err").append('<span style="color:red;">enter digit only</span>');
                          return false;
               }
               else
               {$('#mobile_err').empty();}
              });
               $('#SK_Add').click(function() {
                var Category  = $.trim($('#Shop_cat').val());
                var Name = $.trim($('#Shop_Name').val());
                var Owner_Name = $.trim($('#Shop_OwnName').val());
                var Mobile = $.trim($('#Shop_Mobile').val());
                var Email = $.trim($('#Shop_Email').val());
                var GST = $.trim($('#Shop_TIN').val());
                var Reg_No = $.trim($('#Shop_Reg').val());
                var Build_No = $.trim($('#Build_No').val());
                var Street = $.trim($('#Street').val());
                var City = $.trim($('#City').val());
                var District = $.trim($('#District').val());
                var State = $.trim($('#State').val());
                var Pincode = $.trim($('#Pincode').val());
                var data = {Category:Category,Name:Name,Owner_Name:Owner_Name,Mobile:Mobile,Email:Email,GST:GST,Reg_No:Reg_No,Build_No:Build_No,Street:Street,
                City:City,District:District,State:State,Pincode:Pincode};
                if(Category === 'Select')
                    {
                        $('#cat_err').empty();
                        $('#cat_err').append('<span style="color:red;">Select Shop Category</span>');
                    }
                    else
                    {
                        $('#cat_err').empty();
                       
                        if(Name === '')
                        {
                            $('#name_err').empty();
                            $('#name_err').append('<span style="color:red;">Enter Shop Name</span>');
                        }
                        else
                        {
                            $('#name_err').empty();
                           
                            if(Owner_Name === '')
                            {
                                $('#Own_name_err').empty();
                                $('#Own_name_err').append('<span style="color:red;">Enter Owner Name</span>');
                            }
                            else
                            {
                                $('#Own_name_err').empty();
                                if(Mobile === '')
                                {
                                    $('#mobile_err').empty();
                                    $('#mobile_err').append('<span style="color:red;">Enter Mobile Number</span>');
                                }
                                else if (Mobile !== '' && Mobile.length < 10)
                                {
                                    $('#mobile_err').empty();
                                    $('#mobile_err').append('<span style="color:red;">Invalid Mobile Number</span>');   
                                }
                               else
                                {
                                    $('#mobile_err').empty();
                                    if(Email === '')
                                    {
                                        $('#email_err').empty();
                                        $('#email_err').append('<span style="color:red;">Enter Email ID</span>');
                                    }
                                    else if (Email !== '' && !(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(Email)))
                                
                                    {
                                        $('#email_err').empty();
                                        $('#email_err').append('<span style="color:red;">Invalid Email ID</span>');
                                    }
                                    else
                                    {
                                        $('#email_err').empty();
                                        if(GST === '')
                                        {
                                            $('#TIN_err').empty();
                                            $('#TIN_err').append('<span style="color:red;">Enter GST TIN Number</span>');
                                        }
                                        else
                                        {
                                            $('#TIN_err').empty();
                                            if(Reg_No === '')
                                            {
                                                $('#Reg_err').empty();
                                                $('#Reg_err').append('<span style="color:red;">Enter Registration Number</span>');
                                            }
                                            else
                                            {
                                                $('#Reg_err').empty();
                                                if(Build_No === '')
                                                {
                                                    $('#address_err').empty();
                                                    $('#address_err').append('<span style="color:red;">Enter Bulding No/ Apartment No/ Plot No</span>');
                                                }
                                                else
                                                {
                                                    $('#address_err').empty();
                                                    if(Street === '')
                                                    {
                                                        $('#address_err').empty();
                                                        $('#address_err').append('<span style="color:red;">Enter Street</span>');
                                                    }
                                                    else
                                                    {
                                                        $('#address_err').empty();
                                                        if(City === '')
                                                        {
                                                            $('#address_err').empty();
                                                            $('#address_err').append('<span style="color:red;">Enter City/ Village</span>');
                                                        }
                                                        else
                                                        {
                                                            $('#address_err').empty();
                                                            if(District === '')
                                                            {
                                                                $('#address_err').empty();
                                                                $('#address_err').append('<span style="color:red;">Enter District</span>');
                                                            }
                                                            else
                                                            {
                                                                $('#address_err').empty();
                                                                if(State === '')
                                                                {
                                                                    $('#address_err').empty();
                                                                    $('#address_err').append('<span style="color:red;">Enter State</span>');
                                                                }
                                                                else
                                                                {
                                                                    $('#address_err').empty();
                                                                    if(Pincode === '')
                                                                    {
                                                                        $('#address_err').empty();
                                                                        $('#address_err').append('<span style="color:red;">Enter Pincode</span>');
                                                                    }
                                                                    else if (Pincode !== '' && Pincode.length < 6)
                                                                    {
                                                                        $('#address_err').empty();
                                                                        $('#address_err').append('<span style="color:red;">Invalid Pincode</span>');   
                                                                    }
                                                                    else
                                                                    {
                                                                        $('#address_err').empty();
                                                                        $.ajax
                                                                        ({
                                                                            type: 'POST',
                                                                            url: 'post_SK_add.php',
                                                                            data: {Category:Category,Name:Name,Owner_Name:Owner_Name,Mobile:Mobile,Email:Email,GST:GST,Reg_No:Reg_No,Build_No:Build_No,Street:Street,City:City,District:District,State:State,Pincode:Pincode},
                                                                            success: function(response) {
                                                                                 var result = JSON.parse(response);
                                                                                 //alert(result.status);
                                                                                 if(result.status === "S")
                                                                                 {
                                                                                     alert(result.msg);
                                                                                     window.location.href="Shop_Keepe_Reg.php";
                                                                                 }
                                                                                 else
                                                                                 {
                                                                                     alert(result.msg);
                                                                                }
                                                                            }
                                                                        });
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                        
                                    }
                                }
                            }
                        }
                    }
                });
            });
            </script>
    </head>
    <body>
        <div class="wrapper" style="margin:0 auto;" >
            <h2 style="color:#b5651d;">Register Shop Keeper</h2>
 <p><span class="error">* required field</span></p>

            <table class="table">
                        <tr>
                            <td>Shop Category<span class="error"> * </span></td>
                            <td style="width:65%;">
                                <select id="Shop_cat" name="Shop_cat">
                                    <option value="Select" selected="selected">Select</option>
                                    <?php
                                    require_once "config.php";
//                                    define('DB_SERVER', 'localhost');
//                                    define('DB_USERNAME', 'root');
//                                    define('DB_PASSWORD', '');
//                                    define('DB_NAME', 'eshopping');
//
//                                    /* Attempt to connect to MySQL database */
//                                    $MyConnection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
                                    
                                    $sql = "SELECT category_name FROM product_category_master";
                                    
                                    
                                     $result = mysqli_query($MyConnection, $sql);

                                     if (mysqli_num_rows($result) > 0) 
                                     {
                                        while($row = mysqli_fetch_assoc($result)) 
                                        {
                                            echo "<option value='".$row['category_name']."'>" . $row['category_name'] . "</option>";
                                        }
                                     } 
                                     
                                     mysqli_close($MyConnection);
                                    ?>
                                </select>

                            </td>
                            <td id="cat_err"></td>
                        </tr>
                        <tr>
                            <td>Shop Name<span class="error"> * </span></td>
                            <td>
                                 <input type="text" id="Shop_Name" name="Shop_Name" class="form-control">
                            </td>
                            <td id="name_err"></td>
                        </tr>
                        <tr>
                            <td>Shop Owner Name<span class="error"> * </span></td>
                            <td>
                                 <input type="text" id="Shop_OwnName" name="Shop_OwnName" class="form-control">
                            </td>
                            <td id="Own_name_err"></td>
                        </tr>
                        <tr>
                            <td>Shop Mobile Number<span class="error"> * </span></td>
                            <td>
                                <input type="text" id="Shop_Mobile" name="Shop_Mobile" class="form-control" maxlength="10">
                            </td>
                            <td id="mobile_err"></td>
                        </tr>
                         <tr>
                            <td>Shop Email<span class="error"> * </span></td>
                            <td>
                                 <input type="text" id="Shop_Email" name="Shop_Email" class="form-control">
                            </td>
                            <td id="email_err"></td>
                        </tr>
                         <tr>
                            <td>Shop GST TIN Number<span class="error"> * </span></td>
                            <td>
                                 <input type="text" id="Shop_TIN" name="Shop_TIN" class="form-control">
                            </td>
                            <td id="TIN_err"></td>
                        </tr>
                        <tr>
                            <td>Shop Registration Number<span class="error"> * </span></td>
                            <td>
                                 <input type="text" id="Shop_Reg" name="Shop_Reg" class="form-control">
                            </td>
                            <td id="Reg_err"></td>
                        </tr>
                        <tr>
                            <td>Shop Address<span class="error"> * </span></td>
                            <td>
                                <input type="text" id="Build_No" name="Build_No" placeholder="Building No/ Apartment/ Plat No" class="form-control"> <br>
                               
                                <input type="text" id="Street" name="Street" placeholder="Street" class="form-control" ><br>
                               
                                <input type="text" id="City" name="City" placeholder="Village/ City" class="form-control" ><br>
                              <input type="text" id="District" name="District" placeholder="District" class="form-control" ><br>
                              <input type="text" id="State" name="State" placeholder="State" class="form-control" ><br>
                              <input type="text" id="Pincode" name="Pincode" placeholder="Pincode" class="form-control"  maxlength="6">

                            </td>
                            <td id="address_err"></td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <input type="submit" id="SK_Add" name="SK_Add" class="btn btn-primary" value="Register Shop keeper" style="background:#b5651d;border:#b5651d;">
                            </td>
                        </tr>
            </table> 
     
        </div>    
    </body>
</html>