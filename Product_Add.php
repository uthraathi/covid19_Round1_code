<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Go_Menu.php';
session_start();
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>e-Shopping - Product Add</title>
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
               $('#prod_others').hide();
               $('#Prod_Cat').change(function(){
                   var Prod_Cat = $('#Prod_Cat').val();
                    if(Prod_Cat !== "Select")
                    {   
                        $.ajax
                        ({          
                            type: "GET",
                            url: "get_prodname.php",
                            data:'Prod_Cat='+Prod_Cat,
                            success: function(data)
                            {
                                $("#prod_list").empty();
                                $("#prod_list").append(data);
                            }
                        });
                    }
                    else
                    {
                        alert("Select Product Category");
                        $('#Prod_Cat').focus();
                    }
               });
               //$('#Prod_Name').change(function(){
               $(document).on('change', '#Prod_Name', function(){
                   var Prod_Name = $('#Prod_Name').val();
                    if(Prod_Name !== "Select" && Prod_Name === "Others")
                    {   
                        $('#prod_others').show();
                    } 
                    else if (Prod_Name === "Select")
                    {
                        alert("Select Product Name");
                        $('#Prod_Name').focus();
                        $('#prod_others').hide();
                        $('#prod_others').val("");
                    }
                    else
                    {$('#prod_others').hide();
                        $('#prod_others').val("");}
               });
               $('#is_essential').change(function(){
                   var is_essential = $('#is_essential').val();
                    if(is_essential !== "Y")
                    {  
                        $('.Limit').hide();
                    }
                    else
                    {
                        $('.Limit').show();
                    }
               });
                $("#Prod_Price_From").keypress(function (e) {
                //if the letter is not digit then display error and don't type anything
                if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                   //display error message
                   $('#Price_Err').empty();
                   $("#Price_Err").append('<span style="color:red;">enter digit only</span>');
                          return false;
               }
               else
               {$('#Price_Err').empty();}
              });
              $("#Prod_Price_To").keypress(function (e) {
                //if the letter is not digit then display error and don't type anything
                if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                   //display error message
                   $('#Price_Err').empty();
                   $("#Price_Err").append('<span style="color:red;">enter digit only</span>');
                          return false;
               }
               else
               {$('#Price_Err').empty();}
              });
              $("#Lim_NF").keypress(function (e) {
                //if the letter is not digit then display error and don't type anything
                if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                   //display error message
                   $('#limit_err').empty();
                   $("#limit_err").append('<span style="color:red;">enter digit only</span>');
                          return false;
               }
               else
               {$('#limit_err').empty();}
              });
              $("#Lim_JF").keypress(function (e) {
                //if the letter is not digit then display error and don't type anything
                if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                   //display error message
                   $('#limit_err').empty();
                   $("#limit_err").append('<span style="color:red;">enter digit only</span>');
                          return false;
               }
               else
               {$('#limit_err').empty();}
              });
              $("#Lim_SP").keypress(function (e) {
                //if the letter is not digit then display error and don't type anything
                if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                   //display error message
                   $('#limit_err').empty();
                   $("#limit_err").append('<span style="color:red;">enter digit only</span>');
                          return false;
               }
               else
               {$('#limit_err').empty();}
              });
               $('#Product_Add').click(function() {
                var Category  = $.trim($('#Prod_Cat').val());
                var Name = $.trim($('#Prod_Name').val());
                var Others = $.trim($('#prod_others').val());
                var Price_From = $.trim($('#Prod_Price_From').val());
                var Price_To = $.trim($('#Prod_Price_To').val());
                var is_essential = $.trim($('#is_essential').val());
                var Lim_NF = $.trim($('#Lim_NF').val());
                var Lim_JF = $.trim($('#Lim_JF').val());
                var Lim_SP = $.trim($('#Lim_SP').val());
                if(Category === 'Select')
                    {
                        $('#cat_err').empty();
                        $('#cat_err').append('<span style="color:red;">Select Product Category</span>');
                    }
                    else
                    {
                        $('#cat_err').empty();
                       
                        if(Name === 'Select')
                        {
                            $('#name_err').empty();
                            $('#name_err').append('<span style="color:red;">Seelct Product Name</span>');
                        }
                        else if (Name !== 'Select' && Name === "Others" && Others === '')
                        {
                            $('#name_err').empty();
                            $('#others_err').empty();
                            $('#others_err').append('<span style="color:red;">Type Product Name</span>');   
                        }
                        else
                        {
                            $('#name_err').empty();
                            $('#others_err').empty();
                            if(Price_From === '')
                            {
                                $('#Price_Err').empty();
                                $('#Price_Err').append('<span style="color:red;">Enter Price From</span>');
                            }
                            else
                            {
                                $('#Price_Err').empty();
                                if(Price_To === '')
                                {
                                    $('#Price_Err').empty();
                                    $('#Price_Err').append('<span style="color:red;">Enter Price To</span>');
                                }
                               else
                                {
                                    $('#Price_Err').empty();
                                    if(is_essential === 'Y' && Lim_NF === '')
                                    {
                                        $('#limit_err').empty();
                                        $('#limit_err').append('<span style="color:red;">Enter Nuclear Family Limit</span>');
                                    }
                                    else if(is_essential === 'Y' && Lim_JF === '')
                                    {
                                        $('#limit_err').empty();
                                        $('#limit_err').append('<span style="color:red;">Enter Join Family Limit</span>');
                                    }
                                    else if(is_essential === 'Y' && Lim_SP === '')
                                    {
                                        $('#limit_err').empty();
                                        $('#limit_err').append('<span style="color:red;">Enter Single Person Limit</span>');
                                    }
                                    else
                                    {
                                        $('#limit_err').empty();
                                        if(Name === "Others")
                                            Name = Others;
                                        $.ajax({
                                                type: 'POST',
                                                url: 'post_product_add.php',
                                                data: { Category: Category, Name: Name ,Price_From: Price_From,Price_To:Price_To,Is_Essential:is_essential,Limit_NF:Lim_NF,Limit_JF:Lim_JF,Limit_SP:Lim_SP},
                                                success: function(response) {
                                                     var result = JSON.parse(response);
                                                     //alert(result.status);
                                                     if(result.status === "S")
                                                     {
                                                         alert(result.msg);
                                                         window.location.href="Product_Add.php";
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
        <div class="wrapper" style="margin:0 auto;" >
            <h2 style="color:#b5651d;">Product Add </h2>
            
 <p><span class="error">* required field</span></p>

            <table class="table">
                        <tr>
                            <td>Product Category<span class="error"> * </span></td>
                            <td style="width:65%;">
                                <select id="Prod_Cat" name="Prod_Cat">
                                    <option value="Select" selected="selected" >Select</option>
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
                            <td>Product Name<span class="error"> * </span></td>
                            <td id="prod_list">
                                
                            </td>
                            
                            <td id="name_err"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input type="text" id="prod_others" name="prod_others" class="form-control" placeholder="Type Product Name"></td>
                            <td id="others_err"></td>
                        </tr>
                        <tr>
                            <td>Price Range (per Kg)<span class="error"> * </span></td>
                            <td>
                                <input type="text" id="Prod_Price_From" name="Prod_Price_From" placeholder="From Price" class="form-control" style="width:30%;">  -
                                <input type="text" id="Prod_Price_To" name="Prod_Price_To" placeholder="To Price" class="form-control" style="width:30%;">
                            </td>
                            <td id="Price_Err"></td>
                        </tr>
                        <tr>
                            <td>Is comes under Essential Product Category?<span class="error"> * </span></td>
                            <td>
                                <select id="is_essential" name ="is_essential">
                                    
                                    <option value="Y" selected="selected">Yes</option>
                                    <option value="N">No</option>
                                </select>

                            </td>
                            <td id="essential_err"></td>
                        </tr>
                        <tr class="Limit">
                            <td>If Yes give maximum limit based on Family Type<span class="error"> * </span></td>
                            <td>
                                <input type="text" id="Lim_NF" name="Lim_NF" placeholder="For Nuclear Family" class="form-control" style="width:40%;"> <br>
                               
                                <input type="text" id="Lim_JF" name="Lim_JF" placeholder="For Join Family " class="form-control" style="width:40%;"><br>
                               
                                <input type="text" id="Lim_SP" name="Lim_SP" placeholder="For Single Person" class="form-control" style="width:40%;">

                            </td>
                            <td id="limit_err"></td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <input type="submit" id="Product_Add" name="Product_Add" class="btn btn-primary" value="Add Product" style="background:#b5651d;border:#b5651d;">
                            </td>
                        </tr>
            </table> 
      

        </div>    
    </body>
</html>
