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
        <title>e-Shopping - Add Family</title>
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
               $('.Dependent').hide();
               $('#is_reside').change(function(){
                   var is_reside = $('#is_reside').val();
                    if(is_reside !== "Y")
                    {  
                        $('.Dependent').show();
                       
                    }
                    else
                    {
                         $('.Dependent').hide();
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
              $("#Mobile").keypress(function (e) {
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
               $('#Family_Add').click(function() {
                var relationship  = $.trim($('#relationship').val());
                var Name = $.trim($('#Mem_Name').val());
                var is_reside = $.trim($('#is_reside').val());
                var Mobile = $.trim($('#Mobile').val());
                var Email = $.trim($('#email').val());
                var Build_No = $.trim($('#Build_No').val());
                var Street = $.trim($('#Street').val());
                var City = $.trim($('#City').val());
                var District = $.trim($('#District').val());
                var State = $.trim($('#State').val());
                var Pincode = $.trim($('#Pincode').val());
                if(relationship === 'Select')
                    {
                        $('#rel_err').empty();
                        $('#rel_err').append('<span style="color:red;">Select Relationship with member</span>');
                    }
                    else
                    {
                        $('#rel_err').empty();
                       
                        if(Name === '')
                        {
                            $('#name_Err').empty();
                            $('#name_Err').append('<span style="color:red;">Enter Name of the Member</span>');
                        }
                        else
                        {
                            $('#name_Err').empty();
                          
                            if(is_reside === 'N' && Mobile === '')
                            {
                                $('#mobile_err').empty();
                                $('#mobile_err').append('<span style="color:red;">Enter Mobile Number</span>');
                            }
                            else if (is_reside === 'N' && Mobile !== '' && Mobile.length < 10)
                                {
                                    $('#mobile_err').empty();
                                    $('#mobile_err').append('<span style="color:red;">Invalid Mobile Number</span>');   
                                }
                            else
                            {
                                $('#mobile_err').empty();
                                if(is_reside === 'N' && Email === '')
                                    {
                                        $('#email_err').empty();
                                        $('#email_err').append('<span style="color:red;">Enter Email ID</span>');
                                    }
                                    else if (is_reside === 'N' && Email !== '' && !(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(Email)))
                                
                                    {
                                        $('#email_err').empty();
                                        $('#email_err').append('<span style="color:red;">Invalid Email ID</span>');
                                    }
                                    else
                                    {
                                        $('#email_err').empty();
                                        if(is_reside === 'N' && Build_No === '')
                                                {
                                                    $('#address_err').empty();
                                                    $('#address_err').append('<span style="color:red;">Enter Bulding No/ Apartment No/ Plot No</span>');
                                                }
                                                else
                                                {
                                                    $('#address_err').empty();
                                                    if(is_reside === 'N' && Street === '')
                                                    {
                                                        $('#address_err').empty();
                                                        $('#address_err').append('<span style="color:red;">Enter Street</span>');
                                                    }
                                                    else
                                                    {
                                                        $('#address_err').empty();
                                                        if(is_reside === 'N' && City === '')
                                                        {
                                                            $('#address_err').empty();
                                                            $('#address_err').append('<span style="color:red;">Enter City/ Village</span>');
                                                        }
                                                        else
                                                        {
                                                            $('#address_err').empty();
                                                            if(is_reside === 'N' && District === '')
                                                            {
                                                                $('#address_err').empty();
                                                                $('#address_err').append('<span style="color:red;">Enter District</span>');
                                                            }
                                                            else
                                                            {
                                                                $('#address_err').empty();
                                                                if(is_reside === 'N' && State === '')
                                                                {
                                                                    $('#address_err').empty();
                                                                    $('#address_err').append('<span style="color:red;">Enter State</span>');
                                                                }
                                                                else
                                                                {
                                                                    $('#address_err').empty();
                                                                    if(is_reside === 'N' && Pincode === '')
                                                                    {
                                                                        $('#address_err').empty();
                                                                        $('#address_err').append('<span style="color:red;">Enter Pincode</span>');
                                                                    }
                                                                    else if (is_reside === 'N' && Pincode !== '' && Pincode.length < 6)
                                                                    {
                                                                        $('#address_err').empty();
                                                                        $('#address_err').append('<span style="color:red;">Invalid Pincode</span>');   
                                                                    }
                                                                    else
                                                                    {
                                                                        $('#address_err').empty();
//                                                                        alert("Name:"+Name+",Mobile:"+Mobile+",Email:"+Email+",relationship:"+relationship+",is_reside:"+is_reside+
//                                                                                   ", Build_No:"+Build_No+",Street:"+Street+", City:"+City+",District:"+District+",State:"+State+
//                                                                                   ",Pincode:"+Pincode);
                                                                        $.ajax
                                                                        ({
                                                                            type: 'POST',
                                                                            url: 'post_Family_add.php',
                                                                            data: { Name:Name,Mobile:Mobile,Email:Email,relationship:relationship,is_reside:is_reside,
                                                                                    Build_No:Build_No,Street:Street, City:City,District:District,State:State,
                                                                                    Pincode:Pincode},
                                                                            success: function(response) {
                                                                                 var result = JSON.parse(response);
                                                                                 //alert(result.status);
                                                                                 if(result.status === "S")
                                                                                 {
                                                                                     alert(result.msg);
                                                                                     window.location.href="Add_Family.php";
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
                    });
               });
            </script>
    </head>
    <body>
        <div class="wrapper" style="margin:0 auto;" >
            <h2 style="color:#b5651d;">Family Member Add</h2>
 <p><span class="error">* required field</span></p>

            <table class="table">
                        <tr>
                            <td>Relationship with member<span class="error"> * </span></td>
                            <td style="width:65%;">
                                <select id="relationship" name="relationship">
                                    <option value="Select" selected="selected" >Select</option>
                                    <option value="Self">Self</option>
                                    <option value="Wife">Wife</option>
                                   <option value="Husband">Husband</option>
                                   <option value="Daughter">Daughter</option>
                                   <option value="Son">Son</option>
                                   <option value="Mother">Mother</option>
                                   <option value="Father">Father</option>
                                   <option value="Brother">Brother</option>
                                   <option value="Sister">Sister</option>
                                   <option value="Uncle">Uncle</option>
                                   <option value="Aunt">Aunt</option>
                                   <option value="Nephew">Nephew</option>
                                   <option value="Niece">Niece</option>
                                   <option value="Mother-in-Law">Mother-in-Law</option>
                                   <option value="Father-in-Law">Father-in-Law</option>
                                   <option value="Sister-in-Law">Sister-in-Law</option>
                                   <option value="Brother-in-Law">Brother-in-Law</option>
                                   <option value="Grand Son">Grand Son</option>
                                   <option value="Grand Daughter">Grand Daughter</option>
                                </select>

                            </td>
                            <td id="rel_err"></td>
                        </tr>
                       
                        <tr>
                            <td>Name of the Member<span class="error"> * </span></td>
                            <td>
                                <input type="text" id="Mem_Name" name="Mem_Name" class="form-control">
                                
                            </td>
                            <td id="name_Err"></td>
                        </tr>
                        <tr>
                            <td>Is reside in same location with you?<span class="error"> * </span></td>
                            <td>
                                <select id="is_reside" name ="is_reside">
                                    
                                    <option value="Y" selected="selected">Yes</option>
                                    <option value="N">No</option>
                                </select>

                            </td>
                            <td id="reside_err"></td>
                        </tr>
                        <tr class="Dependent">
                            <td>Mobile Number of the Member<span class="error"> * </span></td>
                            <td>
                                <input type="text" id="Mobile" name="Mobile" maxlength="10" class="form-control" value="">
                            </td>
                            <td id="mobile_err"></td>
                        </tr>
                        <tr class="Dependent">
                            <td>Email ID<span class="error"> * </span></td>
                            <td>
                                 <input type="text" id="email" name="email" class="form-control" value="">
                            </td>
                            <td id="email_err"></td>
                        </tr>
                        <tr class="Dependent">
                            <td>Present Address<span class="error"> * </span></td>
                            <td>
                                <input type="text" id="Build_No" name="Build_No" placeholder="Building No/ Apartment/ Plat No" class="form-control" value=""> <br>
                               
                                <input type="text" id="Street" name="Street" placeholder="Street" class="form-control"  value=""><br>
                               
                                <input type="text" id="City" name="City" placeholder="Village/ City" class="form-control" value=""><br>
                              <input type="text" id="District" name="District" placeholder="District" class="form-control"  value=""><br>
                              <input type="text" id="State" name="State" placeholder="State" class="form-control"  value=""><br>
                              <input type="text" id="Pincode" name="Pincode" placeholder="Pincode" class="form-control" maxlength="6" value="">

                            </td>
                            <td id="address_err"></td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <input type="submit" id="Family_Add" name="Family_Add" class="btn btn-primary" value="Add Family Member" style="background:#b5651d;border:#b5651d;">
                            </td>
                        </tr>
            </table> 
      

        </div>    
    </body>
</html>
