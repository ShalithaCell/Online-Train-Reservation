<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" type="image/x-icon" href="../resources/favicon-train.ico" />

    <!--Fontawesome-->
    <link rel="stylesheet" type="text/css" href="../fontawesome/css/all.css" />
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css" />

    <!--Navigation bar and footer-->
    <link rel="stylesheet" type="text/css" href="../Style/style-custom.css" />
    <link rel="stylesheet" type="text/css" href="../Style/style-custom-nav.css" />
    <link rel="stylesheet" type="text/css" href="../Style/spinner.css" />

    <script src="../Script/jquery-3.3.1.min.js"></script>
    <link href="../ExternalResources/bootstrap-4.3.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="../ExternalResources/bootstrap-4.3.1/js/bootstrap.min.js"></script>
    <link href="../ExternalResources/DateTimePicker/bootstrap-datepicker.css" rel="stylesheet">
    <script src="../ExternalResources/DateTimePicker/bootstrap-datepicker.js"></script>

    <title>BOOkit-Payment</title>

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


    <!--Herder js file-->
    <script src="../Script/Header.js"></script>

    <script>
        //Jquery function for load navigation to page
        $(function () {
            $("#Header").html(getHeaderMD());
            $("#footerID").html(getFooter());
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

            $('#myTabContent :text').on('input',function(e){
                if($(this).val().length > 0)
                    $(this).removeClass('required');
                else
                    $(this).addClass('required');
            });

            $('#txtEmail_F').on('input',function(e){
                if($(this).val().length > 0)
                    $(this).removeClass('required');
                else
                    $(this).addClass('required');
            });

            $('#txtEmail_P').on('input',function(e){
                if($(this).val().length > 0)
                    $(this).removeClass('required');
                else
                    $(this).addClass('required');
            });

        });

        function checkrequiredFields(type){
            var count = 0;

            if(type == 'F'){
                if($('#txtFirstName_F').val().length == 0){
                    $('#txtFirstName_F').addClass('required');
                    count++;
                }

                if($('#txtLastName_F').val().length == 0){
                    $('#txtLastName_F').addClass('required');
                    count++;
                }

                if($('#txtPassword_F').val().length == 0){
                    $('#txtPassword_F').addClass('required');
                    count++;
                }

                if($('#txtDOB_F').val().length == 0){
                    $('#txtDOB_F').addClass('required');
                    count++;
                }

                if($('#txtEmail_F').val().length == 0){
                    $('#txtEmail_F').addClass('required');
                    count++;
                }

                if($('#txtPhone_F').val().length == 0){
                    $('#txtPhone_F').addClass('required');
                    count++;
                }

                if($('#txtConfirmPassword_F').val().length == 0){
                    $('#txtConfirmPassword_F').addClass('required');
                    count++;
                }
            } else{
                if($('#txtFirstName_P').val().length == 0){
                    $('#txtFirstName_P').addClass('required');
                    count++;
                }

                if($('#txtLastName_P').val().length == 0){
                    $('#txtLastName_P').addClass('required');
                    count++;
                }

                if($('#txtPassword_P').val().length == 0){
                    $('#txtPassword_P').addClass('required');
                    count++;
                }

                if($('#txtDOB_P').val().length == 0){
                    $('#txtDOB_P').addClass('required');
                    count++;
                }

                if($('#txtEmail_P').val().length == 0){
                    $('#txtEmail_P').addClass('required');
                    count++;
                }

                if($('#txtPhone_P').val().length == 0){
                    $('#txtPhone_P').addClass('required');
                    count++;
                }

                if($('#txtConfirmPassword_P').val().length == 0){
                    $('#txtConfirmPassword_P').addClass('required');
                    count++;
                }
            }

            if(count == 0){
                Register();
            }


        }


        /*function sendmail() {
            $.ajax({
                url: 'BIZ/logic.php',
                type: 'post',
                data: { "SendMail": $('#txtEmail_F').val()},
                beforeSend: function(){
                    $('#loader').show();
                },
                complete: function(){
                    $('#loader').hide();
                },
                success: function(response) {
                    alert(response);
                }
            });
        }*/

        function Register(){


            //get user role
            var isUserRoleFree = $('#Free-tab').attr('aria-selected');

            //user object
            var objUser = new Object();

            if(isUserRoleFree){
                objUser.Role = 2;
                objUser.FirstName = $('#txtFirstName_F').val();
                objUser.LastName = $('#txtLastName_F').val();
                objUser.Email = $('#txtEmail_F').val();
                objUser.Phone = $('#txtPhone_F').val();



                objUser.DOB = moment($('#txtDOB_F').val()).format('YYYY-MM-DD');
                var gender = $('#rdoGenderFree input:radio:checked').val();
                objUser.Gender = gender;

                $.ajax({
                    url: 'BIZ/logic.php',
                    type: 'post',
                    data: { "EncryptData": $('#txtPassword_F').val()},
                    success: function(response) {
                        objUser.Password = response;
                        //alert(response);

                        $.ajax({
                            url: 'BIZ/logic.php',
                            type: 'post',
                            data: { "Registration": JSON.stringify(objUser)},
                            success: function(response) {
                                console.log(response);
                                alert(response); }
                        });
                    }
                });





            }else {
                objUser.Role = 2;
                objUser.FirstName = $('#txtFirstName_P').val();
                objUser.LastName = $('#txtLastName_P').val();
                objUser.Email = $('#txtEmail_P').val();
                objUser.Phone = $('#txtPhone_P').val();
                objUser.DOB = $('#txtDOB_P').val();

                var gender = $('#rdoGenderPremium input:radio:checked').val();
                objUser.Gender = gender;


                $.ajax({
                    url: 'BIZ/logic.php',
                    type: 'post',
                    data: { "EncryptData": $('#txtPassword_P').val()},
                    success: function(response) {
                        objUser.Password = response;
                        //alert(response);

                        $.ajax({
                            url: 'BIZ/logic.php',
                            type: 'post',
                            data: { "Registration": JSON.stringify(objUser)},
                            success: function(response) {
                                console.log(response);
                                alert(response); }
                        });
                    }
                });


            }

        }

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
                                        <input id="txtLastName_F" type="text" class="form-control"
                                            placeholder="Last Name *" value="" />
                                    </div>
                                    <div class="form-group">
                                        <input id="txtPassword_F" type="password" class="form-control"
                                            placeholder="Password *" value="" />
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


                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input id="txtEmail_F" type="email" class="form-control" placeholder="Email *"
                                            value="" />
                                    </div>
                                    <div class="form-group">
                                        <input id="txtPhone_F" type="text" minlength="10" maxlength="10"
                                            name="txtEmpPhone" class="form-control" placeholder="Phone Number *"
                                            value="" />
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
                                        <input type="button" id="btnRegister_F" class="btnRegister" value="Register" onclick="checkrequiredFields('F')"/>
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
                                        <input id="txtLastName_P" type="text" class="form-control"
                                            placeholder="Last Name *" value="" />
                                    </div>
                                    <div class="form-group">
                                        <input id="txtPassword_P" type="password" class="form-control"
                                            placeholder="Password *" value="" />
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


                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input id="txtEmail_P" type="email" class="form-control" placeholder="Email *"
                                            value="" />
                                    </div>
                                    <div class="form-group">
                                        <input id="txtPhone_P" type="text" minlength="10" maxlength="10"
                                            name="txtEmpPhone" class="form-control" placeholder="Phone Number *"
                                            value="" />
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
                                        <input type="submit" id="btnRegister_P" class="btnRegister" value="Register" onclick="checkrequiredFields('P')"/>
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
</body>

</html>