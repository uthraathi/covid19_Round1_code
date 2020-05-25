<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
require_once "config.php";
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>e-Shopping - Login Page</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
        <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 450px; padding: 20px; }
        .error{color: #FF0000;}
        </style>
        <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
        <script type="text/javascript">
            $(function(){
                $("#Login").click(function () 
                {
                    var usr_category  = $.trim($('#usr_category').val());
                    var username = $.trim($('#username').val());
                    var password = $.trim($('#password').val());
                    //alert(usr_category);   cat_err   name_err     passwd_err
                    if(usr_category === "Select")
                    {
                        $('#cat_err').empty();
                        $('#cat_err').append('<span style="color:red;">Select User Category</span>');
                    }
                    else
                    {
                        $('#cat_err').empty();
                        if(username === '')
                        {
                            $('#name_err').empty();
                            $('#name_err').append('<span style="color:red;">Enter Username</span>');
                        }
                        else
                        {
                            $('#name_err').empty();
                            if(password === '')
                            {
                                $('#passwd_err').empty();
                                $('#passwd_err').append('<span style="color:red;">Enter Password</span>');
                            }
                            else
                            {
                                $('#passwd_err').empty();
                                $.ajax
                                ({
                                type: 'POST',
                                url: 'Check_Login.php',
                                data: { category: usr_category, username: username ,password: password},
                                success: function(response) {
                                     //alert(response);
                                     var result = JSON.parse(response);
                                     //alert(result.status);
                                     if(result.status === "S")
                                     {
                                         //alert(result.msg);
                                         if (usr_category === 'GO')
                                         {
                                         window.location.href="Product_Add.php";
                                         }
                                         else if (usr_category === 'SK')
                                         {
                                         window.location.href="addproduct_SK.php";
                                         }
                                         else
                                         {
                                             window.location.href="IU_Shop_by_Category.php";
                                         }
                                        
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

                });
            });
        </script>
    </head>
    <body>
        <div class="wrapper" style="margin:0 auto;" >
            <h2 style="color:#b5651d;">Login</h2>
            <p>Please fill in your credentials to login.</p>

            <table class="table">
                        <tr>
                            <td>User Category<span class="error"> * </span></td>
                            <td style="width:65%;">
                                 <select id="usr_category" name="usr_category" class="form-control">
                                        <option value="Select" selected="selected">Select</option>
                                        <option value="IU">Individual User</option>
                                        <option value="GO">Government Official</option>
                                        <option value="SK">Shop Keeper</option>
                                    </select>

                            </td>
                            <td id="cat_err"></td>
                        </tr>
                        <tr>
                            <td>User Unique ID<span class="error"> * </span></td>
                            <td style="width:65%;">
                                 <input type="text" id="username" name="username" class="form-control" >
                            </td>
                            <td id="name_err"></td>
                        </tr>
                        <tr>
                            <td>Password<span class="error"> * </span></td>
                            <td style="width:65%;">
                                 <input type="password" id="password" name="password" class="form-control">
                            </td>
                            <td id="passwd_err"></td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <input type="submit" id="Login" name="Login" class="btn btn-primary" value="Login" style="background:#b5651d;border:#b5651d;">
                            </td>
                        </tr>
            </table> 
         
            <p>New user click <a href="register.php">Sign up now</a> to register.</p>

        </div>    
    </body>
</html>
