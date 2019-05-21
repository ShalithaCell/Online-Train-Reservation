<?php
include "sessionWorker.php";



?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" type="image/x-icon" href="../resources/favicon-train.ico" />

    <title>BOOkit-Register</title>

    <!--Fontawesome-->
    <link rel="stylesheet" type="text/css" href="../fontawesome/css/all.css" />
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css" />

    <!--Navigation bar and footer-->
    <link rel="stylesheet" type="text/css" href="../Style/style-custom.css" />
    <link rel="stylesheet" type="text/css" href="../Style/style-custom-nav.css" />
    <link rel="stylesheet" type="text/css" href="../Style/spinner.css" />

    <script src="../Script/jquery-3.3.1.min.js"></script>
    <script src="../ExternalResources/MDB/js/popper.min.js"></script>

    <link href="../ExternalResources/bootstrap-4.3.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="../ExternalResources/bootstrap-4.3.1/js/bootstrap.min.js"></script>
    <link href="../ExternalResources/DateTimePicker/bootstrap-datepicker.css" rel="stylesheet">
    <script src="../ExternalResources/DateTimePicker/bootstrap-datepicker.js"></script>



    <!--mdb-->
    <link href="../ExternalResources/MDB/css/mdb.min.css" rel="stylesheet">

    <!--style sheets for this page only-->
    <link href="../Style/Register.css" rel="stylesheet" type="text/css">

    <!--jquery UI-->
    <script src="../Script/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="../Style/jquery-ui.css" />

    <!--Jquery confirm-->
    <script src="../Script/jquery-confirm.min.js"></script>
    <link rel="stylesheet" href="../Style/jquery-confirm.min.css" />

    <!--moment js -->
    <script src="../Script/moment.js"></script>

    <!--Toastr-->
    <script src="../ExternalResources/toastr/toastr.min.js"></script>
    <link rel="stylesheet" href="../ExternalResources/toastr/toastr.min.css" />

    <!--Herder js file-->
    <script src="../Script/Header.js"></script>

    <!--register.js-->
    <script src="../Script/Register.js"></script>

    <script>
        //Jquery function for load navigation to page
        $(function () {
            $("#Header").html(getHeaderLG());
            $("#footerID").html(getFooter());s
        });

        $(document).ready(function () {

            //-------------------------js methods-------------------------------------------
            $('#loader').hide();

            //jquery ui calender
            $('#txtDate').datepicker({
                minDate: "0",
                maxDate: "12/31/2019",
                changeMonth: true,
                changeYear: true,
                showButtonPanel: true,
                dateFormat: "m/d/yy"
            });

            $('#myTabContent :text').on('input',function(){
                if($(this).val().length > 0)
                    $(this).removeClass('required');
                else
                    $(this).addClass('required');
            });

            $('#myTabContent :password').on('input',function(){
                if($(this).val().length > 0)
                    $(this).removeClass('required');
                else
                    $(this).addClass('required');

                passwordStrenth($(this));

            });

            $('#txtEmail_F').on('input',function(){

                if($(this).val().length > 0)
                    $(this).removeClass('required');
                else
                    $(this).addClass('required');

                //check mail is exixts
                if($(this).val().length > 0){

                    $.ajax({
                        url: '../Controller/BIZ/logic.php',
                        type: 'post',
                        data: { "CheckEmailAddress": $(this).val()},
                        success: function(response) {

                            if(response == '1'){
                                $('#txtEmail_F').siblings('.duplicate-mail').show();
                                $('#btnRegister_F').prop("disabled",true).addClass('disable-register');
                            }
                            else
                            {
                                $('#txtEmail_F').siblings('.duplicate-mail').hide();
                                $('#btnRegister_F').prop("disabled",false).removeClass('disable-register');
                            }


                        }
                    });



                    if(checkValiedEmailAddrss($(this).val())){
                        $(this).siblings('.invalied-mail').hide();
                    }else{
                        $(this).siblings('.invalied-mail').show();
                    }
                }

            });

            $('#txtEmail_P').on('input',function(e){
                if($(this).val().length > 0)
                    $(this).removeClass('required');
                else
                    $(this).addClass('required');

                //check mail is exixts
                if($(this).val().length > 0){

                    $.ajax({
                        url: '../Controller/BIZ/logic.php',
                        type: 'post',
                        data: { "CheckEmailAddress": $(this).val()},
                        success: function(response) {

                            if(response == '1'){
                                $('#txtEmail_P').siblings('.duplicate-mail').show();
                                $('#btnRegister_P').prop("disabled",true).addClass('disable-register');
                            }
                            else
                            {
                                $('#txtEmail_P').siblings('.duplicate-mail').hide();
                                $('#btnRegister_P').prop("disabled",false).removeClass('disable-register');
                            }
                        }
                    });



                    if(checkValiedEmailAddrss($(this).val())){
                        $(this).siblings('.invalied-mail').hide();
                    }else{
                        $(this).siblings('.invalied-mail').show();
                    }
                }

            });

        });

    </script>



</head>

<body>
    <!--Navigation Bar -->
    <div id="Header"></div>

    <!--Page Content -->
    <div style="height:100%">
        <div class="container register">

            <div class="row">
                <div class="col-md-3 register-left">
                    <i class="fas fa-subway font-lg-T"></i>
                    <h3>Welcome.</h3>
                    <input type="submit" name="" value="Login" /><br />
                </div>
                <div class="col-md-9 register-right">
                    <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="Free-tab" data-toggle="tab" href="#home" role="tab"
                                aria-controls="free" aria-selected="true">Free</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="premium-tab" data-toggle="tab" href="#profile" role="tab"
                                aria-controls="premium" aria-selected="false">Premium</a>
                        </li>
                    </ul>

                    <div class="tab-content" id="myTabContent">
                        
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <h3 class="register-heading">Register as Free Member</h3>
                            <div class="row register-form">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input id="txtFirstName_F" type="text" class="form-control"
                                            placeholder="First Name *" value="" />

                                    </div>
                                    <div class="form-group">
                                        <input id="txtPhone_F" type="text" minlength="10" maxlength="10"
                                               name="txtEmpPhone" class="form-control" placeholder="Phone Number *"
                                               value="" />
                                    </div>
                                    <div class="form-group input-group">
                                        <input id="txtPassword_F" type="password" class="form-control"
                                            placeholder="Password *" value="" />
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="txtPasswordStrenth_F"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input id="txtEmail_F" type="email" class="form-control" placeholder="Email *"
                                               value="" />
                                        <span class="warning-red-message invalied-mail" id="spnInvalied_F" style="display: none">Invalied Email Address.</span>
                                        <span class="warning-red-message duplicate-mail" id="spnDuplicate_F" style="display: none">This email address is already connected with BOOKit.</span>
                                    </div>


                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">

                                        <input id="txtLastName_F" type="text" class="form-control"
                                               placeholder="Last Name *" value="" />
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group date" data-provide="datepicker">
                                            <input type="text" class="form-control" id="txtDOB_F"
                                                   placeholder="Choose Date Of Birth *">
                                            <div class="input-group-addon">
                                                <span class="glyphicon glyphicon-th"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input id="txtConfirmPassword_F" type="password" class="form-control"
                                            placeholder="Confirm Password *" value="" />
                                    </div>

                                    <div class="form-group">
                                        <div class="radio-inline pad" id="rdoGenderFree">
                                            <input class="item-space" type="radio" name="optradio" value="1" checked>Male
                                            <input class="item-space" type="radio" name="optradio" value="2">Female
                                            <input class="item-space" type="radio" name="optradio" value="3">Other
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <input type="button" id="btnRegister_F" class="btnRegister" value="Register" onclick="Register()"/>
                                    </div>

                                </div>
                            </div>
                        </div>
                        
                        <div class="tab-pane fade show" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <h3 class="register-heading">Register as Premium Member</h3>
                            <div class="row register-form">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input id="txtFirstName_P" type="text" class="form-control"
                                            placeholder="First Name *" value="" />
                                    </div>
                                    <div class="form-group">
                                        <input id="txtPhone_P" type="text" minlength="10" maxlength="10"
                                               name="txtEmpPhone" class="form-control" placeholder="Phone Number *"
                                               value="" />
                                    </div>
                                    <div class="form-group input-group">
                                        <input id="txtPassword_P" type="password" class="form-control"
                                            placeholder="Password *" value="" />
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="txtPasswordStrenth_P"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input id="txtEmail_P" type="email" class="form-control" placeholder="Email *"
                                               value="" />
                                        <span class="warning-red-message invalied-mail" id="spnInvalied_P" style="display: none">Invalied Email Address.</span>
                                        <span class="warning-red-message duplicate-mail" id="spnDuplicate_P" style="display: none">This email address is already connected with BOOKit.</span>
                                    </div>


                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input id="txtLastName_P" type="text" class="form-control"
                                               placeholder="Last Name *" value="" />
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group date" data-provide="datepicker">
                                            <input type="text" class="form-control" id="txtDOB_P"
                                                   placeholder="Choose Date Of Birth *">
                                            <div class="input-group-addon">
                                                <span class="glyphicon glyphicon-th"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input id="txtConfirmPassword_P" type="password" class="form-control"
                                            placeholder="Confirm Password *" value="" />
                                    </div>

                                    <div class="form-group">
                                        <div class="radio-inline pad" id="rdoGenderPremium">
                                            <input class="item-space" type="radio" name="optradioP" checked>Male
                                            <input class="item-space" type="radio" name="optradioP">Female
                                            <input class="item-space" type="radio" name="optradioP">Other
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <input type="submit" id="btnRegister_P" class="btnRegister" value="Register" onclick="Register()"/>
                                    </div>
                                </div>
                            </div>
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


    <!--Footer -->
    <footer id="footerID"></footer>

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