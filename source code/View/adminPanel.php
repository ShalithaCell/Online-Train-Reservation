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

    <link href="../ExternalResources/DateTimePicker/bootstrap-datepicker.css" rel="stylesheet">
    <script src="../ExternalResources/DateTimePicker/bootstrap-datepicker.js"></script>



    <!--Jquery confirm-->
    <script src="../Script/jquery-confirm.min.js"></script>
    <link rel="stylesheet" href="../Style/jquery-confirm.min.css" />

    <link rel="stylesheet" type="text/css" href="../Style/style-admin.css"  >

    <!--Jquery datatable-->
    <script src="../ExternalResources/datatables/datatables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../ExternalResources/datatables/datatables.min.css" />

    <script>

        $(function () {
            $('#Header').html(getHeaderLG());
            $('#footerID').html(getFooter());
            $('#loader').hide();
        });

        $(document).ready(function () {
            LoadUserTable();
        });


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
                    '<input type="radio" class="custom-control-input" id="rdoMale" name="groupOfDefaultRadios">'+
                    '<label class="custom-control-label" for="defaultGroupExample1">Male</label>'+
                    '</div>'+
                    '<div class="custom-control custom-radio ml-3">\n' +
                    '  <input type="radio" class="custom-control-input" id="rdoFemale" name="groupOfDefaultRadios" checked>' +
                    '  <label class="custom-control-label" for="defaultGroupExample2">Female</label>' +
                    '</div>'+
                    '</div>'+
                    '<div class="form-group mt-4">' +
                    '<label class="float-left">Contact</label>' +
                    '<input type="text" placeholder="Contact Number" class="form-control" id="txtUserConact" required />' +
                    '<span class="text-danger req-field">please fill out this field</span>'+
                    '</div>'+
                    '</div>'+
                    '</div>'+
                    '<div class="col-md-6">'+
                    '<div class="form-group">' +
                    '<label class="float-left">Last name</label>' +
                    '<input type="text" placeholder="Last name" class="form-control" id="txtUserLastName" required />' +
                    '<span class="text-danger req-field">please fill out this field</span>'+
                    '</div>'+
                    '<div class="form-group">' +
                    '<label class="float-left">Email</label>' +
                    '<input type="email" placeholder="Email" class="form-control" id="txtUserEmail" required disabled/>' +
                    '<span class="text-danger req-field">please enter valid email address.</span>'+
                    '</div>'+
                    '<div class="form-group">' +
                    '<label class="float-left">Date of Birth</label>' +
                    '<input type="text" placeholder="Date Of Birth" class="form-control" id="txtUserDOB" required />' +
                    '<span class="text-danger req-field">please fill out this field</span>'+
                    '</div>'+
                    '<div class="form-group">' +
                    '<label class="float-left">Active</label>' +
                        '<select class="browser-default custom-select" id="ddlActive">'+
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
                            var name = this.$content.find('.name').val();
                            if(!name){
                                $.alert('provide a valid name');
                                return false;
                            }
                            $.alert('Your name is ' + name);
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
                        dateFormat: 'yyyy-mm-dd',
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




    </script>



</head>
<body>

<!--Navigation Bar -->
<div id='Header'>
</div>

<!-- Tabs -->
<div class="mt-3 mb-3">
<section id="tabs">
    <div class="container">
        <h6 class="section-title h1">Admin Panel</h6>
        <div class="row">
            <div class=" w-100">
                <nav>
                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true"><i class="fas fa-users font-md-T ml-2"></i> &nbsp; </br>Users</a>
                        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false"><i class="fas fa-train font-md-T ml-2"></i> &nbsp; </br>Trains</a>
                        <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false"><i class="fas fa-users font-md-T ml-2"></i> &nbsp; </br>Users</a>
                        <a class="nav-item nav-link" id="nav-about-tab" data-toggle="tab" href="#nav-about" role="tab" aria-controls="nav-about" aria-selected="false"><i class="fas fa-users font-md-T ml-2"></i> &nbsp; </br>Users</a>
                    </div>
                </nav>
                <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div class="row">


                            <div class="card w-100 mb-3">
                                <div class="card-header text-muted">
                                    List of Users
                                </div>
                                <div class="card-body">
                                    <table class="table" id="tblUsers">
                                        <thead class="black white-text">
                                        <tr>
                                            <th scope="col">UserID</th>
                                            <th scope="col">First name</th>
                                            <th scope="col">Last name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Role</th>
                                            <th scope="col">Gender</th>
                                            <th scope="col">Locked</th>
                                            <th scope="col">Active</th>
                                            <th scope="col" class="no-sort">Edit</th>
                                            <th scope="col" class="no-sort">Remove</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>

                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        Et et consectetur ipsum labore excepteur est proident excepteur ad velit occaecat qui minim occaecat veniam. Fugiat veniam incididunt anim aliqua enim pariatur veniam sunt est aute sit dolor anim. Velit non irure adipisicing aliqua ullamco irure incididunt irure non esse consectetur nostrud minim non minim occaecat. Amet duis do nisi duis veniam non est eiusmod tempor incididunt tempor dolor ipsum in qui sit. Exercitation mollit sit culpa nisi culpa non adipisicing reprehenderit do dolore. Duis reprehenderit occaecat anim ullamco ad duis occaecat ex.
                    </div>
                    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                        Et et consectetur ipsum labore excepteur est proident excepteur ad velit occaecat qui minim occaecat veniam. Fugiat veniam incididunt anim aliqua enim pariatur veniam sunt est aute sit dolor anim. Velit non irure adipisicing aliqua ullamco irure incididunt irure non esse consectetur nostrud minim non minim occaecat. Amet duis do nisi duis veniam non est eiusmod tempor incididunt tempor dolor ipsum in qui sit. Exercitation mollit sit culpa nisi culpa non adipisicing reprehenderit do dolore. Duis reprehenderit occaecat anim ullamco ad duis occaecat ex.
                    </div>
                    <div class="tab-pane fade" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">
                        Et et consectetur ipsum labore excepteur est proident excepteur ad velit occaecat qui minim occaecat veniam. Fugiat veniam incididunt anim aliqua enim pariatur veniam sunt est aute sit dolor anim. Velit non irure adipisicing aliqua ullamco irure incididunt irure non esse consectetur nostrud minim non minim occaecat. Amet duis do nisi duis veniam non est eiusmod tempor incididunt tempor dolor ipsum in qui sit. Exercitation mollit sit culpa nisi culpa non adipisicing reprehenderit do dolore. Duis reprehenderit occaecat anim ullamco ad duis occaecat ex.
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<!-- ./Tabs -->
</div>

<div class="showbox" id="loader">
    <div class="loader-new">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
        </svg>
    </div>
</div>

<footer id="footerID">

</footer>
<!--cannot read property 'addeventlistener' of null mdb
- This is probably because the script is executed before the page loads. By placing the script at the bottom of the page, I circumvented the problem.
-->
<script src="../ExternalResources/MDB/js/mdb.min.js"></script>

</body>

</html>