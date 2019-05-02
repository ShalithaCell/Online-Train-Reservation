
//load users
function LoadUserTable() {
    //$.fn.dataTable.moment('M/D/YYYY h:mm:ss A');
    table = $('#tblUsers').DataTable({
        "ajax": {
            "type": "GET",
            "url": "../Controller/BIZ/logic.php",
            "contentType": "application/json; charset=utf-8",
            "dataType": "json",
            data: { "userList": "test"},
            "beforeSend": function (request) {
                //$('#loader').show();
            },
            "dataSrc": function (json) {
                $('#loader').hide();
                var result = (JSON.stringify(json));
                console.log(result);
                return JSON.parse(result);
            },
            "fnDrawCallback": function (oSettings) {
                $('#loader').hide();
            },
        },
        "fixedHeader": {
            "header": true
        },
        "scrollY": "500px",
        "scrollCollapse": true,
        "deferRender": true,
        pageLength: 10,
        "order": [[0, "asc"]],
        columns: [
            { 'data': 'UserID'},
            { 'data': 'FirstName' },
            { 'data': 'LastName' },
            { 'data': 'Email' },
            { 'data': 'Role' },
            { 'data': 'Gender' },
            { 'data': 'Locked' },
            { 'data': 'Active' },
            { 'data': null, 'render': function (data, type, row) {
                    return '<button type= "button" class="btn btn-info btn-header" style="font-size: .5vw;" onclick="viewUser(' + data.UserID + ');"><i class="fas fa-eye" aria-hidden="true"></i> View</button>'
                }
            },
            { 'data': null, 'render': function (data, type, row) {
                    return '<button type= "button" class="btn btn-danger btn-header" style="font-size: .5vw;" onclick="viewUser(' + data.UserID + ');"><i class="fas fa-user-times" aria-hidden="true"></i> Remove</button>'
                }
            }
        ],

        dom: 'lrtip',
        initComplete: function () {
            $('#tblUsers').DataTable().columns.adjust();
        }
    });
}

//load trains
function LoadTrainTable() {
    //$.fn.dataTable.moment('M/D/YYYY h:mm:ss A');
    table = $('#tblTrains').DataTable({
        "ajax": {
            "type": "GET",
            "url": "../Controller/BIZ/logic.php",
            "contentType": "application/json; charset=utf-8",
            "dataType": "json",
            data: { "trainListForAdminPanel": "test"},
            "beforeSend": function (request) {
                //$('#loader').show();
            },
            "dataSrc": function (json) {
                $('#loader').hide();
                var result = (JSON.stringify(json));
                //console.log(result);
                return JSON.parse(result);
            },
            "fnDrawCallback": function (oSettings) {
                $('#loader').hide();
            },
        },
        "fixedHeader": {
            "header": true
        },
        "scrollY": "500px",
        "scrollCollapse": true,
        "deferRender": true,
        pageLength: 10,
        "order": [[0, "asc"]],
        columns: [
            { 'data': 'TrainID'},
            { 'data': 'TrainCode' },
            { 'data': 'TrainName' },
            { 'data': 'NoOfSeats' },
            { 'data': 'IsRegularRun' },
            { 'data': 'isActive' },
            { 'data': null, 'render': function (data, type, row) {
                    return '<button type= "button" class="btn btn-info btn-header" style="font-size: .5vw;" onclick="viewUser(' + data.TrainID + ');"><i class="fas fa-eye" aria-hidden="true"></i> Edit</button>'
                }
            },
            { 'data': null, 'render': function (data, type, row) {
                    return '<button type= "button" class="btn btn-danger btn-header" style="font-size: .5vw;" onclick="viewUser(' + data.TrainID + ');"><i class="fas fa-trash-alt" aria-hidden="true"></i> Remove</button>'
                }
            }
        ],

        dom: 'lrtip',
        initComplete: function () {
            $('#tblTrains').DataTable().columns.adjust();
        }
    });
}


function viewUser(userID) {

    var userObj = {
        userName : userID,
        UserID : userID
    }

    displayEditUserWindow(userObj);

}

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


function displayEditUserWindow(userObj) {
    $.confirm({
        theme: 'modern',
        columnClass: 'large',
        title: 'Modify user ('+ userObj.userName +')',
        content: '' +
            '<div class="row">'+
            '<div class="col-md-6">'+
            '<div class="form-group">' +
            '<label class="float-left">First name</label>' +
            '<input type="text" placeholder="First name" class="name form-control" id="txtUserFirstName" required />' +
            '<span class="text-danger req-field">please fill out this field</span>'+
            '</div>'+
            '<div class="form-group">' +
            '<label class="float-left">Role</label>' +
            '<select class="browser-default custom-select role" id="ddlRole">'+
            '<option selected>Select role</option>'+
            '</select>'+
            '<span class="text-danger req-field">please fill out this field</span>'+
            '</div>'+
            '<div class="form-group">' +
            '<label class="float-left">Gender</label></br>' +
            '<div class="row mt-3 ml-3">'+
            '<div class="custom-control custom-radio">'+
            '<input type="radio" class="custom-control-input rdoMale" id="rdoMale" name="groupOfDefaultRadios">'+
            '<label class="custom-control-label" for="defaultGroupExample1">Male</label>'+
            '</div>'+
            '<div class="custom-control custom-radio ml-3">\n' +
            '  <input type="radio" class="custom-control-input" id="rdoFemale" name="groupOfDefaultRadios" checked>' +
            '  <label class="custom-control-label" for="defaultGroupExample2">Female</label>' +
            '</div>'+
            '</div>'+
            '<div class="form-group mt-4">' +
            '<label class="float-left">Contact</label>' +
            '<input type="text" placeholder="Contact Number" class="form-control contact" id="txtUserConact" required />' +
            '<span class="text-danger req-field">please fill out this field</span>'+
            '</div>'+
            '</div>'+
            '</div>'+
            '<div class="col-md-6">'+
            '<div class="form-group">' +
            '<label class="float-left">Last name</label>' +
            '<input type="text" placeholder="Last name" class="form-control lastName" id="txtUserLastName" required />' +
            '<span class="text-danger req-field">please fill out this field</span>'+
            '</div>'+
            '<div class="form-group">' +
            '<label class="float-left">Email</label>' +
            '<input type="email" placeholder="Email" class="form-control" id="txtUserEmail" required disabled/>' +
            '<span class="text-danger req-field">please enter valid email address.</span>'+
            '</div>'+
            '<div class="form-group">' +
            '<label class="float-left">Date of Birth</label>' +
            '<input type="text" placeholder="Date Of Birth" class="form-control dob" id="txtUserDOB" required />' +
            '<span class="text-danger req-field">please fill out this field</span>'+
            '</div>'+
            '<div class="form-group">' +
            '<label class="float-left">Active</label>' +
            '<select class="browser-default custom-select active-T" id="ddlActive">'+
            '<option value="1" selected>Yes</option>'+
            '<option value="0">No</option>'+
            '</select>'+
            '</div>'+
            '</div>'+
            '</div>',
        buttons: {
            Save: {
                text: 'Save',
                btnClass: 'btn-blue',
                action: function () {
                    var firstname = this.$content.find('.name').val();
                    var lastname = this.$content.find('.lastName').val();
                    var role = this.$content.find('.role').val();
                    var gender;

                    if(this.$content.find('.rdoMale').prop('checked'))
                        gender = '1'; //male ID
                    else
                        gender = '2'; //female ID

                    var DOB = this.$content.find('.dob').val();
                    var contact = this.$content.find('.contact').val();
                    var active = this.$content.find('.active-T').val();

                    var errorCount = 0;

                    if(firstname.length <= 0){
                        errorCount++;
                        this.$content.find('.name').siblings('.req-field').show();
                    }else {
                        this.$content.find('.name').siblings('.req-field').hide();
                    }

                    if(lastname.length <= 0){
                        errorCount++;
                        this.$content.find('.lastName').siblings('.req-field').show();
                    }else {
                        this.$content.find('.lastName').siblings('.req-field').hide();
                    }

                    if(DOB.length <= 0){
                        errorCount++;
                        this.$content.find('.dob').siblings('.req-field').show();
                    }else {
                        this.$content.find('.dob').siblings('.req-field').hide();
                    }

                    if(contact.length <= 0){
                        errorCount++;
                        this.$content.find('.contact').siblings('.req-field').show();
                    }else {
                        this.$content.find('.contact').siblings('.req-field').hide();
                    }

                    if(errorCount > 0){
                        return false;
                    }

                    var userDataObject = {
                        UserID : userObj.UserID,
                        FirstName : firstname,
                        LastName : lastname,
                        Role : role,
                        Gender : gender,
                        DOB : DOB,
                        Phone : contact,
                        isActive : active
                    };

                    //updateing
                    $.ajax({
                        url: '../Controller/BIZ/logic.php',
                        type: 'post',
                        data: { "updateUserByAdmin": JSON.stringify(userDataObject)},
                        beforeSend: function(){

                        },
                        complete: function(){

                        },
                        success: function(response) {
                            if(response == 'true'){
                                toastr.success('user updated successfully.', 'successfully');
                                return true;
                            }
                            else{
                                toastr.error('Something went wrong.please try again', 'Error');
                                return  false;
                            }
                        }
                    });


                }
            },
            cancel: function () {
                //close
            },
        },
        contentLoaded: function(data, status, xhr){
            $('#loader').show();
        },
        onContentReady: function () {
            // bind to events
            $('#loader').hide();

            //hide all warning messages
            $('.req-field').each(function() {
                $(this).hide();
            });

            //date picker
            $('#txtUserDOB').datepicker({
                format: 'yyyy-mm-dd',
                showButtonPanel: true,
                changeMonth: true,
                changeYear: true,
                showOn: "button",
                minDate: new Date(1940, 10 - 1, 25),
                endDate: '0',
                yearRange: '1940:c',
                inline: true
            });

            //loadRoles

            $.ajax({
                url: '../Controller/BIZ/logic.php',
                type: 'get',
                data: { "getRoles": sessionStorage.getItem("RoleID")},
                success: function(response) {
                    //var result = (JSON.stringify(response));
                    //console.log(response);
                    $.each(JSON.parse(response), function (i, p) {
                        $('#ddlRole').append($('<option></option>').val(p.RoleID).html(p.Description));
                    });
                }
            });


            //load user data
            $.ajax({
                url: '../Controller/BIZ/logic.php',
                type: 'get',
                data: { "getUserByID": userObj.UserID},
                success: function(response) {
                    var userObj = $.parseJSON(response);
                    $('#txtUserFirstName').val(userObj["FirstName"]);
                    $('#txtUserLastName').val(userObj["LastName"]);
                    $('#txtUserLastName').val(userObj["LastName"]);
                    $('#ddlRole').val(userObj["FK_RoleID"]);
                    $('#txtUserEmail').val(userObj["Email"]);
                    $('#txtUserDOB').val(userObj["DOB"]);
                    $('#txtUserConact').val(userObj["ContactNo"]);
                    $('#ddlActive').val(userObj["isActive"]);

                    if(userObj["FK_GenderID"] == '1'){
                        $('#rdoMale').prop('checked', true);
                    }else{
                        $('#rdoFemale').prop('checked', true);
                    }

                }
            });


        }
    });
}