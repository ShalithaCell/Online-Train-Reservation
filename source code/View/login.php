<?php
include "sessionWorker.php";
//session_start();

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="../resources/favicon-train.ico" />
    <title>BOOkit-Home</title>

    <link rel="stylesheet" type="text/css" href="../fontawesome/css/all.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">

    <link rel="stylesheet" type="text/css" href="../Style/style-custom.css">
    <link rel="stylesheet" type="text/css" href="../Style/style-custom-nav.css">


    <script src="../Script/jquery-3.3.1.min.js"></script>
    <script src="../Script/Header.js"></script>

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

        //Jquery function for load nevigation to page

        $(document).ready(function () {
            //hide warning messages
            $('#loader').hide();
            $('#spnPassWarning').hide();
            $('#spnReqWarning').hide();

            $('.txtPasswordReset').on("click",function(){
                $.confirm({
                    title: 'Forgot your password?',
                    content: 'Email address you use to log in to your account \n' +
                        'We\'ll send you an email with instructions to choose a new password.' +
                        '<div class="form-group input-group">\n' +
                        '          <input class="form-control reset-email" placeholder="Email" name="email" type="email" required="">\n' +
                        '        </div>',
                    type: 'blue',
                    columnClass: 'medium',
                    typeAnimated: true,
                    theme: 'supervan',
                    backgroundDismiss: true,
                    buttons: {
                        send: {
                            text: 'Send',
                            btnClass: 'btn-green col-md-8',
                            action: function () {

                                var email = $('.reset-email').val();

                                if(email.length == 0){
                                    $.alert('Please enter valied email address!');
                                    return false;
                                }else{
                                    if(!isEmail(email)){
                                        $.alert('Please enter valied email address!');
                                        return false;
                                    }
                                }


                                $.ajax({
                                    url: '../Controller/BIZ/logic.php',
                                    type: 'post',
                                    data: { "PasswordReset": email},
                                    beforeSend: function(){
                                        $('#loader').show();
                                    },
                                    complete: function(){
                                        $('#loader').hide();
                                    },
                                    success: function(response) {

                                        if(response == '1'){
                                            $.alert('Please check your inbox !');

                                        }else{
                                            alert(response);
                                        }

                                    }
                                });

                            }
                        }
                    }
                });
            });

        });

        $(document).on('keypress',function(e) {
            if(e.which == 13) {
                authenticateUser();
            }
        });

        function isEmail(email) {

            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;

            var valid = regex.test(email);

            if(valid){
                return true;
            }else {
                return  false;
            }

        }


        $(function () {
            $('#Header').html(getHeaderLG());
            $('#footerID').html(getFooter());

            var verificationMail = readQueryString()["varificationMail"];
            if(verificationMail != null){
                $.ajax({
                    url: '../Controller/BIZ/logic.php',
                    type: 'post',
                    data: { "verificationEmail": verificationMail},
                    success: function(response) {

                        if(response == 'true'){
                            displayVerificationMessage(verificationMail);
                        }

                    }
                });
            }

        });

        function displayVerificationMessage(email) {
            $.confirm({
                title: 'Congratulations!',
                content: 'Your BOOKit account is Verified.\nYou are now a verified Bookit user('+email+'). You can now book unlimited Train Tickets with Bookit account.Also you ' +
                    'eligible for our mass discount offers.stay tuned with us.\n',
                type: 'blue',
                columnClass: 'medium',
                typeAnimated: true,
                theme: 'supervan',
                buttons: {
                    ok: {
                        text: 'OK',
                        btnClass: 'btn-green',
                        action: function(){
                        }
                    }
                }
            });
        }


        function readQueryString() {
            var vars = [], hash;

            var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');

            for (var i = 0; i < hashes.length; i++) {

                hash = hashes[i].split('=');

                vars.push(hash[0]);

                vars[hash[0]] = hash[1];

            }
            return vars;
        }



        function setSessionData($email) {
            $.ajax({
                url: '../Controller/BIZ/logic.php',
                type: 'get',
                data: { "getUserByEmail": $email},
                success: function(response) {
                    var userObj = $.parseJSON(response);
                    //console.log(response);

                    if(userObj["FK_RoleID"] == "1" || userObj["FK_RoleID"] == "2"){


                        var data = {     // create object
                            UserID    : userObj["UserID"],
                            RoleID : userObj["FK_RoleID"],
                            FirstName :  userObj["FirstName"],
                            LastName : userObj["LastName"],
                            Email : userObj["Email"],
                            Gender : userObj["FK_GenderID"],
                            ContactNo : userObj["ContactNo"],
                            DOB : userObj["DOB"]

                        }

                        $.ajax({
                            url: 'sessionWorker.php',
                            type: 'post',
                            data: { "setSession": JSON.stringify(data)},
                            success: function(response) {
                                window.location.href = "adminPanel.php";

                            }
                        });

                    }else{
                        var data = {     // create object
                            UserID    : userObj["UserID"],
                            RoleID : userObj["FK_RoleID"],
                            FirstName :  userObj["FirstName"],
                            LastName : userObj["LastName"],
                            Email : userObj["Email"],
                            Gender : userObj["FK_GenderID"],
                            ContactNo : userObj["ContactNo"],
                            DOB : userObj["DOB"]

                        }

                        $.ajax({
                            url: 'sessionWorker.php',
                            type: 'post',
                            data: { "setSession": JSON.stringify(data)},
                            success: function(response) {
                                window.location.href = "Home.php";

                            }
                        });
                    }

                }
            });
        }

        function authenticateUser() {
            var email = $('#txtEmail').val();
            var password = $('#txtPassword').val();

            if(email.length == 0 || password.length == 0){
                $('#spnReqWarning').show();
                return;
            }

            var data = {     // create object
                AuthEmail    : email,
                AuthPassword    : password

            }


            $.ajax({
                url: '../Controller/BIZ/logic.php',
                type: 'post',
                data: data,
                success: function(response) {

                    //console.log(response);

                    var ss = $.parseJSON(response);
                    //alert(ss["auth"]);

                    if(ss["auth"] == 'true'){
                        //console.log(response);
                        $('#spnPassWarning').hide();
                        setSessionData(email);
                    }else{
                        $('#spnPassWarning').show();
                    }

                }
            });
        }






    </script>



</head>

<body>
    <!--Navigation Bar -->
    <div id='Header'>
    </div>

    <div>

        <div class="limiter">
            <div class="container-login100">
                <div class="wrap-login100">
                    <div class="login100-pic js-tilt" data-tilt>
                        <img src="../resources/user.png" alt="IMG">
                    </div>

                    <div class="login100-form validate-form">
					<span class="login100-form-title">
						Member Login
					</span>

                        <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                            <input class="input100" type="text" id="txtEmail" name="email" placeholder="Email">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
                        </div>

                        <div class="wrap-input100 validate-input" data-validate = "Password is required">
                            <input class="input100" type="password" id="txtPassword" name="pass" placeholder="Password">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
                        </div>
                        <span class="text-danger ml-3" id="spnPassWarning">Incorrect username or password</span>
                        <span class="text-danger ml-3" id="spnReqWarning">Fill all fields.</span>

                        <div class="container-login100-form-btn">
                            <button class="login100-form-btn" onclick="authenticateUser()">
                                Login
                            </button>
                        </div>

                        <div class="text-center p-t-12">
						<span class="txt1">
							Forgot
						</span>
                            <a class="txtPasswordReset" href="javascript:void(0)" >
                                Username / Password?
                            </a>
                        </div>

                        <div class="text-center p-t-136">
                            <a class="txt2" href="Register.php">
                                Create your Account
                                <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="showbox" id="loader">
            <div class="loader-new">
                <svg class="circular" viewBox="25 25 50 50">
                    <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
                </svg>
            </div>
        </div>
    </div>

    <footer id="footerID">

    </footer>
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