<?php

require_once "config.php";
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>e-Shopping - test Page</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
        <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
        </style>
        <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>

        <script type="text/javascript">
            $(function(){
               $('#button').click(function() {
                var val1 = $('#text1').val();
                var val2 = $('#text2').val();
                $.ajax({
                    type: 'POST',
                    url: 'process_GO_Reg.php',
                    data: { text1: val1, text2: val2 },
                    success: function(response) {
                        $('#result').html(response);
                    }
                });
            });
            });
            </script>
    </head>
    <body>
        <div class="wrapper" style="margin:0 auto;" >
           <input type="text" id="text1"> +
            <input type="text" id="text2">
            <button id="button"> = </button>
            <div id="result"></div>
        </div>    
    </body>
</html>