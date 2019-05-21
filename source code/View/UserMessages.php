<?php
include "sessionWorker.php";



?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="../resources/favicon-train.ico" />
    <title>BOOkit-Message</title>

    <link rel="stylesheet" type="text/css" href="../fontawesome/css/all.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">

    <link rel="stylesheet" type="text/css" href="../Style/style-custom.css">
    <link rel="stylesheet" type="text/css" href="../Style/style-custom-nav.css">


    <script src="../Script/jquery-3.3.1.min.js"></script>

    <!--mdb-->
    <script src="../ExternalResources/MDB/js/popper.min.js"></script>
    <link href="../ExternalResources/MDB/css/mdb.min.css" rel="stylesheet">


    <!--Boostrap-->
    <link href="../ExternalResources/bootstrap-4.3.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="../ExternalResources/bootstrap-4.3.1/js/bootstrap.min.js"></script>


    <!--Jquery confirm-->
    <script src="../Script/jquery-confirm.min.js"></script>
    <link rel="stylesheet" href="../Style/jquery-confirm.min.css" />

    <script src="../Script/login.js"></script>
    <link rel="stylesheet" type="text/css" href="../Style/style-login.css"  >

    <link rel="stylesheet" type="text/css" href="../Style/spinner.css" />

    <script>


        $(document).ready(function () {

            if(getUrlVars()["type"] == "reset"){
                passwordResetMessage();
            }else{
                window.location.href = "home.php";
            }
        });

        function getUrlVars()
        {
            var vars = [], hash;
            var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
            for(var i = 0; i < hashes.length; i++)
            {
                hash = hashes[i].split('=');
                vars.push(hash[0]);
                vars[hash[0]] = hash[1];
            }
            return vars;
        }

        function passwordResetMessage() {
            $.confirm({
                title: 'Your password has been reset successfully!',
                content: '\n',
                type: 'blue',
                columnClass: 'medium',
                typeAnimated: true,
                theme: 'supervan',
                backgroundDismiss: function(){
                    window.location.href = 'login.php';
                    return true;
                },
                buttons: {
                    send: {
                        text: 'Log in',
                        btnClass: 'btn-green col-md-8',
                        action: function () {
                            window.location.href = "login.php";
                        }
                    }
                }
            });
        }
    </script>



</head>

<body>

<!--cannot read property 'addeventlistener' of null mdb
- This is probably because the script is executed before the page loads. By placing the script at the bottom of the page, I circumvented the problem.
-->
<script src="../ExternalResources/MDB/js/mdb.min.js"></script>

</body>

<?php
if(isset($_SESSION)){
if(session_status() != PHP_SESSION_NONE){

if(!isset($_SESSION['UserID'])){
    ?> <script type="text/javascript">setTimeout(hideAdminPanel, 500)</script> <?php
}
}else{
if($_SESSION['RoleID'] == '1' || $_SESSION['RoleID'] == '2'){
?> <script type="text/javascript">setTimeout(showAdminPanel, 500)</script> <?php
}else{
?> <script type="text/javascript">setTimeout(hideAdminPanel, 500)</script> <?php
}

}
}else{
?> <script type="text/javascript">setTimeout(hideAdminPanel, 500)</script> <?php
}


?>

</html>
