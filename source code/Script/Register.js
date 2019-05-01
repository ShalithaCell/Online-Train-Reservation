function checkValiedEmailAddrss(emailAddress) {
    var email = emailAddress;

    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;

    var valid = regex.test(email);

    if(valid){
        return true;
    }else {

        return  false;
    }
}

function isEmail(type) {

    var email = type == 'F' ? $('#txtEmail_F').val() : $('#txtEmail_P').val();

    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;

    var valid = regex.test(email);

    if(valid){
        return true;
    }else {
        if(type == 'F'){
            $('#txtEmail_F').addClass('required');
        }else{
            $('#txtEmail_P').addClass('required');
        }

        toastr.warning('please enter valid email address !');
        return  false;
    }

}

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
        return true;
    }else {
        toastr.warning('please fill in all required fields marked with an asterisk!');
        return  false;
    }

}

function checkPassword(type) {
    var isValid = false;

    if(type == 'F') {

        //check password Match
        if($('#txtPassword_F').val() === $('#txtConfirmPassword_F').val()){
            isValid = true;
        }else{
            $('#txtPassword_F').addClass('required');
            $('#txtConfirmPassword_F').addClass('required');

            toastr.warning('password does not match the confirm password!');
        }



    }else{

        //check password Match
        if($('#txtPassword_P').val() === $('#txtConfirmPassword_P').val()){
            isValid = true;
        }else {
            $('#txtPassword_P').addClass('required');
            $('#txtConfirmPassword_P').addClass('required');
            toastr.warning('password does not match the confirm password!');
        }
    }

    return isValid;
}

function passwordStrenth(textID) {

    textID = textID.attr('id');


    var strongRegex = new RegExp("^(?=.{8,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\\W).*$", "g");
    var mediumRegex = new RegExp("^(?=.{7,})(((?=.*[A-Z])(?=.*[a-z]))|((?=.*[A-Z])(?=.*[0-9]))|((?=.*[a-z])(?=.*[0-9]))).*$", "g");
    var enoughRegex = new RegExp("(?=.{6,}).*", "g");


    if (false == enoughRegex.test($('#'+textID).val())) {
        $('#'+textID).parent().find('.input-group-text').html('More Characters').removeClass().addClass('input-group-text').addClass('text-danger');
        $('#'+textID).parent().parent().parent().find('.btnRegister').prop("disabled",true).addClass('disable-register');
    } else if (strongRegex.test($('#'+textID).val())) {
        $('#'+textID).parent().find('.input-group-text').html('Strong!').removeClass().addClass('input-group-text').addClass('text-success');
        $('#'+textID).parent().parent().parent().find('.btnRegister').prop("disabled",false).removeClass('disable-register');
    } else if (mediumRegex.test($('#'+textID).val())) {
        $('#'+textID).parent().find('.input-group-text').html('Medium').removeClass().addClass('input-group-text').addClass('text-primary');
        $('#'+textID).parent().parent().parent().find('.btnRegister').prop("disabled",false).removeClass('disable-register');
    } else {
        $('#'+textID).parent().find('.input-group-text').html('Weak').removeClass().addClass('input-group-text').addClass('text-warning');
        $('#'+textID).parent().parent().parent().find('.btnRegister').prop("disabled",false).removeClass('disable-register');
    }

}


function checkPhone(type) {
    var valied = false;
    var isNumric = false;
    if(type == 'F'){
        if($('#txtPhone_F').val().length == 10){
            valied = true;
        }else{
            $('#txtPhone_F').addClass('required');
            toastr.warning('phone number must be 10 digits !');
            valied = false;
        }

        isNumric = $.isNumeric( $('#txtPhone_F').val() );

        if(!isNumric){
            $('#txtPhone_F').addClass('required');
            toastr.warning('phone number must be numeric !');
            valied = false;
        }

    }else{
        if($('#txtPhone_P').val().length == 10){
            valied = true;
        }else{
            $('#txtPhone_P').addClass('required');
            toastr.warning('phone number must be 10 digits !');
            valied = false;
        }

        isNumric = $.isNumeric( $('#txtPhone_P').val() );

        if(!isNumric){
            $('#txtPhone_P').addClass('required');
            toastr.warning('phone number must be numeric !');
            valied = false;
        }
    }

    return valied;
}




function sendmail(address,name) {

    var data = {     // create object
        ReceverAddress    : address,
        ReceverName    : name

    }

    $.ajax({
        url: '../Controller/BIZ/logic.php',
        type: 'post',
        data: data,
        beforeSend: function(){
            $('#loader').show();
        },
        complete: function(){
            $('#loader').hide();
        },
        success: function(response) {
            console.log(response);
            displayAccountConfirmBox(address);

        }
    });
}

function Register(){



    //get user role
    var isUserRoleFree = $('#Free-tab').attr('aria-selected');

    var type = isUserRoleFree == 'true' ? 'F' : 'P';

    //validation
    if(!checkrequiredFields(type) || !checkPassword(type) || !isEmail(type) || !checkPhone(type)){
        return;
    }

    //check emailAddress duplicate


    //user object
    var objUser = new Object();

    if(isUserRoleFree){
        objUser.Role = 4;
        objUser.FirstName = $('#txtFirstName_F').val();
        objUser.LastName = $('#txtLastName_F').val();
        objUser.Email = $('#txtEmail_F').val();
        objUser.Phone = $('#txtPhone_F').val();



        objUser.DOB = moment($('#txtDOB_F').val()).format('YYYY-MM-DD');
        var gender = $('#rdoGenderFree input:radio:checked').val();
        objUser.Gender = gender;

        $.ajax({
            url: '../Controller/BIZ/logic.php',
            type: 'post',
            data: { "EncryptData": $('#txtPassword_F').val()},
            success: function(response) {
                objUser.Password = response;
                //alert(response);

                $.ajax({
                    url: '../Controller/BIZ/logic.php',
                    type: 'post',
                    data: { "Registration": JSON.stringify(objUser)},
                    beforeSend: function(){

                    },
                    complete: function(){

                    },
                    success: function(response) {
                        //console.log(response);
                        sendmail(objUser.Email,objUser.FirstName);
                        //alert(response);
                    }
                });
            }
        });





    }else {
        objUser.Role = 3;
        objUser.FirstName = $('#txtFirstName_P').val();
        objUser.LastName = $('#txtLastName_P').val();
        objUser.Email = $('#txtEmail_P').val();
        objUser.Phone = $('#txtPhone_P').val();
        objUser.DOB = $('#txtDOB_P').val();

        var gender = $('#rdoGenderPremium input:radio:checked').val();
        objUser.Gender = gender;


        $.ajax({
            url: '../Controller/BIZ/logic.php',
            type: 'post',
            data: { "EncryptData": $('#txtPassword_P').val()},
            success: function(response) {
                objUser.Password = response;
                //alert(response);

                $.ajax({
                    url: '../Controller/BIZ/logic.php',
                    type: 'post',
                    data: { "Registration": JSON.stringify(objUser)},
                    beforeSend: function(){

                    },
                    complete: function(){

                    },
                    success: function(response) {
                        sendmail(objUser.Email, objUser.FirstName);
                    }
                });
            }
        });


    }

}

function displayAccountConfirmBox(email, name) {

        var content = "<div class=\"container text-center\">\n" +
            "    <div class=\"row\">\n" +
            "\t\t<h3 style=\"color: rgb(24, 157, 14);\"> \Thank you for registering. Please verify your account.</h3>\n" +
            "        <h4 style=\"font-size: 14px; line-height: 22px;\">In order to reserve  train ticket, you must verify your account. An email has been sent to "+email+" .</h4>\n" +
            "\t</div>\n" +
            "</div>";

    $.confirm({
        title: 'Congratulation!',
        content: content,
        type: 'green',
        typeAnimated: true,
        columnClass: 'col-md-12',
        buttons: {
            Resend: {
                text: 'Resend verification Email',
                btnClass: 'btn-blue',
                action: function(){
                    sendmail(email,name);
                }
            },
            ok: {
                text: 'ok',
                btnClass: 'btn-green',
                action: function(){
                    //redirect to home
                }
            }
        }
    });
}