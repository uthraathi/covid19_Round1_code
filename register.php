<!--<select id="Category_list" name="Category_list" class="form-control">
<option value="Select" selected="selected">Select</option>
<?php
require_once "config.php";
$sql = mysqli_query($con, "SELECT * From product_category_master");
$row = mysqli_num_rows($sql);
while ($row = mysqli_fetch_array($sql)){
echo "<option value='". $row['category_id'] ."'>" .$row['category_name'] ."</option>" ;
}
?>
</select>-->

<?php
require_once "config.php";

?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>e-Shopping - Registration Page</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
        <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 700px; padding: 10px; }
        .error{color: #FF0000;}
        </style>
         <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>

            <script type="text/javascript">
            $(function(){
            $('.show_GO').hide();
            $('.show_IU').hide();
            $("#usr_category").change(function(){
                    var optionValue = $("#usr_category").val();
                    //alert(optionValue);
                    if(optionValue === 'GO')
                    {
                        $('.show_GO').show();
                        $('.show_IU').hide();
                    }
                    else if(optionValue === 'IU')
                    {
                        $('.show_GO').hide();
                        $('.show_IU').show();
                    }
                    else
                    {
                        $('.show_GO').hide();
                        $('.show_IU').hide();
                    }
            });
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
              $("#IU_Mobile").keypress(function (e) {
                //if the letter is not digit then display error and don't type anything
                if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                   //display error message
                   $('#iu_mobile_err').empty();
                   $("#iu_mobile_err").append('<span style="color:red;">enter digit only</span>');
                          return false;
               }
               else
               {$('#iu_mobile_err').empty();}
              });
            $('#iu_register').click(function() {
               
                var Name = $.trim($('#IU_Name').val());
                var FM_Type = $.trim($('#FM_Type').val());
                var Mobile = $.trim($('#IU_Mobile').val());
                var Email = $.trim($('#IU_email').val());
                var Ration_Card = $.trim($('#IU_Ration').val());
                var Build_No = $.trim($('#Build_No').val());
                var Street = $.trim($('#Street').val());
                var City = $.trim($('#City').val());
                var District = $.trim($('#District').val());
                var State = $.trim($('#State').val());
                var Pincode = $.trim($('#Pincode').val());
                var data = {Name:Name,FM_Type:FM_Type,Mobile:Mobile,Email:Email,Ration_Card:Ration_Card,Build_No:Build_No
                    ,Street:Street,City:City,District:District,State:State,Pincode:Pincode};
                                if(Name === '')
                    {
                        $('#iu_name_err').empty();
                        $('#iu_name_err').append('<span style="color:red;">Enter Name</span>');
                    }
                    else
                    {
                        $('#iu_name_err').empty();
                       
                        if(FM_Type === 'Select')
                        {
                            $('#iu_family_err').empty();
                            $('#iu_family_err').append('<span style="color:red;">Select Family Type</span>');
                        }
                        else
                        {
                            $('#iu_family_err').empty();
                           
                              
                                if(Mobile === '')
                                {
                                    $('#iu_mobile_err').empty();
                                    $('#iu_mobile_err').append('<span style="color:red;">Enter Mobile Number</span>');
                                }
                                else if (Mobile !== '' && Mobile.length < 10)
                                {
                                    $('#iu_mobile_err').empty();
                                    $('#iu_mobile_err').append('<span style="color:red;">Invalid Mobile Number</span>');   
                                }
                               else
                                {
                                    $('#iu_mobile_err').empty();
                                    if(Email === '')
                                    {
                                        $('#iu_email_err').empty();
                                        $('#iu_email_err').append('<span style="color:red;">Enter Email ID</span>');
                                    }
                                    else if (Email !== '' && !(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(Email)))
                                
                                    {
                                        $('#iu_email_err').empty();
                                        $('#iu_email_err').append('<span style="color:red;">Invalid Email ID</span>');
                                    }
                                    else
                                    {
                                        $('#iu_email_err').empty();
                                        if(Ration_Card === '')
                                        {
                                            $('#iu_ration_err').empty();
                                            $('#iu_ration_err').append('<span style="color:red;">Enter Ration Card Number</span>');
                                        }
                                        else
                                        {
                                            $('#iu_ration_err').empty();
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
                                                                            url: 'post_IU_add.php',
                                                                            data: { Name:Name,FM_Type:FM_Type,Mobile:Mobile,Email:Email,Ration_Card:Ration_Card,
                                                                                    Build_No:Build_No,Street:Street, City:City,District:District,State:State,
                                                                                    Pincode:Pincode},
                                                                            success: function(response) {
                                                                                 var result = JSON.parse(response);
                                                                                 //alert(result.status);
                                                                                 if(result.status === "S")
                                                                                 {
                                                                                     alert(result.msg);
                                                                                     window.location.href="index.php";
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
                });
                $("#GO_Pincode").keypress(function (e) {
                //if the letter is not digit then display error and don't type anything
                if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                   //display error message
                   $('#go_loc_err').empty();
                   $("#go_loc_err").append('<span style="color:red;">enter digit only</span>');
                          return false;
               }
               else
               {$('#go_loc_err').empty();}
              });
              $("#GO_Mobile").keypress(function (e) {
                //if the letter is not digit then display error and don't type anything
                if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                   //display error message
                   $('#go_mobile_err').empty();
                   $("#go_mobile_err").append('<span style="color:red;">enter digit only</span>');
                          return false;
               }
               else
               {$('#go_mobile_err').empty();}
              });
              
              $('#iu_Back').click(function() {
              window.location.href="index.php";
              });
              $('#Back').click(function() {
              window.location.href="index.php";
              });
               $('#register').click(function() {
                var GO_Name  = $.trim($('#GO_Name').val());
                var GO_Pincode = $.trim($('#GO_Pincode').val());
                var GO_Mobile = $.trim($('#GO_Mobile').val());
                var GO_email = $.trim($('#GO_email').val());
                var GO_Empid = $.trim($('#GO_Empid').val());
                if(GO_Name === '')
                    {
                        $('#go_name_err').empty();
                        $('#go_name_err').append('<span style="color:red;">Enter Name</span>');
                    }
                    else
                    {
                        $('#go_name_err').empty();
                        //alert(GO_Pincode);
                        if(GO_Pincode === '')
                        {
                            $('#go_loc_err').empty();
                            $('#go_loc_err').append('<span style="color:red;">Enter Pincode</span>');
                        }
                        else if (GO_Pincode !== '' && GO_Pincode.length < 6)
                        {
                            $('#go_loc_err').empty();
                            $('#go_loc_err').append('<span style="color:red;">Invalid Pincode</span>');   
                        }
                        else
                        {
                            $('#go_loc_err').empty();
                            if(GO_Mobile === '')
                            {
                                $('#go_mobile_err').empty();
                                $('#go_mobile_err').append('<span style="color:red;">Enter Mobile Number</span>');
                            }
                            else if (GO_Mobile !== '' && GO_Mobile.length < 10)
                            {
                                $('#go_mobile_err').empty();
                                $('#go_mobile_err').append('<span style="color:red;">Invalid Mobile Number</span>');   
                            }
                            else
                            {
                                $('#go_mobile_err').empty();
                                if(GO_email === '')
                                {
                                    $('#go_email_err').empty();
                                    $('#go_email_err').append('<span style="color:red;">Enter Email ID</span>');
                                }
                                else if (GO_email !== '' && !(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(GO_email)))
                                
                                {
                                    $('#go_email_err').empty();
                                    $('#go_email_err').append('<span style="color:red;">Invalid Email ID</span>');
                                }
                                else
                                {
                                    $('#go_email_err').empty();
                                    if(GO_Empid === '')
                                    {
                                        $('#go_empid_err').empty();
                                        $('#go_empid_err').append('<span style="color:red;">Enter Permanent Employee ID</span>');
                                    }
                                    else
                                    {
                                        $('#go_empid_err').empty();
                                        $.ajax({
                                                type: 'POST',
                                                url: 'process_GO_Reg.php',
                                                data: { Name: GO_Name, Pincode: GO_Pincode ,Mobile: GO_Mobile,Email:GO_email,Empid:GO_Empid},
                                                success: function(response) {
                                                     var result = JSON.parse(response);
                                                     //alert(result.status);
                                                     if(result.status === "S")
                                                     {
                                                         alert(result.msg);
                                                         window.location.href="index.php";
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
                    });
            });
            </script>


        
    </head>
    <body>
        
        <div class="wrapper" style="margin:0 auto;">
            <h2 style="color:#b5651d;">Registration Page</h2>
                    <label>User Category</label>
                    <select id="usr_category" name="usr_category" class="form-control">
                        <option value="Select" selected="selected">Select</option>
                        <option value="IU">Individual User</option>
                        <option value="GO">Government Official</option>

                    </select>
                </div>
        <div class="wrapper" style="margin:0 auto;">
                <div class="show_GO">
                    
                    <h4 style="color:#b5651d;">Government Official/ Nodal Incharge Registration</h4>
                    <p><span class="error">* required field</span></p>
                    <table class="table">
                        <tr>
                            <td>Name<span class="error"> * </span></td>
                            <td style="width:65%;">
                                 <input type="text" id="GO_Name" name="GO_Name" class="form-control">
                                 
                            </td>
                            <td id="go_name_err"></td>
                        </tr>
                        <tr>
                            <td>Nodal Incharge to which location<span class="error"> * </span></td>
                            <td>
                                <input type="text" id="GO_Pincode" name="GO_Pincode" placeholder="enter Pincode" maxlength="6" class="form-control">
                            </td>
                            <td id="go_loc_err"></td>
                        </tr>
                        <tr>
                            <td>Mobile Number<span class="error"> * </span></td>
                            <td>
                                <input type="text" id="GO_Mobile" name="GO_Mobile" maxlength="10" class="form-control">
                            </td>
                            <td id="go_mobile_err"></td>
                        </tr>
                        <tr>
                            <td>Email ID<span class="error"> * </span></td>
                            <td>
                                 <input type="text" id="GO_email" name="GO_email" class="form-control">
                            </td>
                            <td id="go_email_err"></td>
                        </tr>
                        <tr>
                            <td>Permanent Employee ID<span class="error"> * </span></td>
                            <td>
                                 <input type="text" id="GO_Empid" name="GO_Empid" class="form-control">
                            </td>
                            <td id="go_empid_err"></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <input type="submit" class="btn btn-primary" id="register" name="register" value="Register" style="background:#b5651d;border:#b5651d;">
                                <input type="submit" class="btn btn-primary" id="Back" name="Back" value="Back" style="background:#b5651d;border:#b5651d;">
                            </td>
                        </tr>
                    </table>
                </div> 
                <div class="show_IU">
                    <h4 style="color:#b5651d;">Individual User Registration</h4>
                    <p><span class="error">* required field</span></p>
                    <table class="table">
                        <tr>
                            <td>Name<span class="error"> * </span></td>
                            <td style="width:65%;">
                                 <input type="text" id="IU_Name" name="IU_Name" class="form-control">
                                 
                            </td>
                            <td id="iu_name_err"></td>
                        </tr>
                        <tr>
                            <td>Present Address<span class="error"> * </span></td>
                            <td>
                                <input type="text" id="Build_No" name="Build_No" placeholder="Building No/ Apartment/ Plat No" class="form-control"> <br>
                               
                                <input type="text" id="Street" name="Street" placeholder="Street" class="form-control" ><br>
                               
                                <input type="text" id="City" name="City" placeholder="Village/ City" class="form-control" ><br>
                              <input type="text" id="District" name="District" placeholder="District" class="form-control" ><br>
                              <input type="text" id="State" name="State" placeholder="State" class="form-control" ><br>
                              <input type="text" id="Pincode" name="Pincode" placeholder="Pincode" class="form-control" >

                            </td>
                            <td id="address_err"></td>
                        </tr>
                        <tr>
                            <td>Family Type<span class="error"> * </span></td>
                            <td>
                                 <select id="FM_Type" name="FM_Type" class="form-control">
                                    <option value="Select" selected="selected">Select</option>
                                    <option value="NF">Nuclear Family</option>
                                    <option value="JF">Join Family</option>
                                    <option value="SP">Single Person</option>
                                 </select>
                            </td>
                            <td id="iu_family_err"></td>
                        </tr>
                        <tr>
                            <td>Mobile Number<span class="error"> * </span></td>
                            <td>
                                <input type="text" id="IU_Mobile" name="IU_Mobile" maxlength="10" class="form-control">
                            </td>
                            <td id="iu_mobile_err"></td>
                        </tr>
                        <tr>
                            <td>Email ID<span class="error"> * </span></td>
                            <td>
                                 <input type="text" id="IU_email" name="IU_email" class="form-control">
                            </td>
                            <td id="iu_email_err"></td>
                        </tr>
                        <tr>
                            <td>Ration Card Number<span class="error"> * </span></td>
                            <td>
                                 <input type="text" id="IU_Ration" name="IU_Ration" class="form-control">
                            </td>
                            <td id="iu_ration_err"></td>
                        </tr>
<!--                        <tr>
                            <td>Add Family Details<span class="error"> * </span></td>
                            <td>
                                <table  class="table">
                                    <thead>
                                    <tr>
                                    <td>
                                        Name
                                    </td>
                                    <td>Relationship</td>
                                    <td>is Reside in same location?</td>
                                    <td>Action</td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <input type="text" id="FM_name" name="FM_name" placeholder="Name" class="form-control">
                                            </td>
                                            <td>
                                                <input type="text" id="FM_Relationship" name="FM_Relationship" placeholder="Relationship" class="form-control">
                                            </td>
                                            <td>
                                                <select id="is_reside" name ="is_reside">
                                    
                                                <option value="Y" selected="selected">Yes</option>
                                                <option value="N">No</option>
                                            </select>
                                            </td>
                                            <td><input type="button" class="btn btn-primary" id="Add_more" name="Add_more" value="+" style="background:#b5651d;border:#b5651d;"></td>
                                        </tr>
                                    </tbody>
                                </table>
                                
                                
                                
                            </td>
                        
                        </tr>-->
                        <tr>
                            <td colspan="2">
                                <input type="submit" class="btn btn-primary" id="iu_register" name="iu_register" value="Register" style="background:#b5651d;border:#b5651d;">
                                <input type="submit" class="btn btn-primary" id="iu_Back" name="iu_Back" value="Back" style="background:#b5651d;border:#b5651d;">
                            </td>
                        </tr>
                    </table>
                </div> 
            
        </div>    
    </body>
</html>