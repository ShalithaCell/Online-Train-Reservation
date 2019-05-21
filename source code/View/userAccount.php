<?php
include "sessionWorker.php";
include "../Config/config.php";
//session_start();


if(session_status() != PHP_SESSION_NONE){

    if($_SESSION['UserID'] == null){
        header("Location: login.php");
    }

    //get data
    $sql_query = "CALL SP_GET_USER_WITH_DETAIL('". mysqli_real_escape_string( $conn ,$_SESSION['UserID']) ."')";


    $result = mysqli_query($conn, $sql_query);

    // Associative array
    $row=mysqli_fetch_array($result,MYSQLI_ASSOC);

    //echo $row["UserID"];


}else{
    header("Location: login.php");
}



?>

<!DOCTYPE html>
<html>
	<head>
			<meta charset="UTF-8">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<link rel="shortcut icon" type="image/x-icon" href="../resources/favicon-train.ico" />
		
			<link rel="stylesheet" type="text/css" href="../fontawesome/css/all.css">
			<link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
		
			<link rel="stylesheet" type="text/css" href="../Style/style-custom.css">
			<link rel="stylesheet" type="text/css" href="../Style/style-custom-nav.css">

		 <link rel="stylesheet" type="text/css" href="../Style/style-user_account.css" />
		 
		 <!--jquery-->
		 <script src="../Script/jquery-3.3.1.min.js"></script>

		<!--mdb-->
		<script src="../ExternalResources/MDB/js/popper.min.js"></script>
		<link href="../ExternalResources/MDB/css/mdb.min.css" rel="stylesheet">


		<!--Boostrap-->
		<link href="../ExternalResources/bootstrap-4.3.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
		<script src="../ExternalResources/bootstrap-4.3.1/js/bootstrap.min.js"></script>

		 <!--jquery UI-->
		 <script src="../Script/jquery-ui.min.js"></script>
		 <link rel="stylesheet" href="../Style/jquery-ui.css" />

        <!--Jquery confirm-->
        <script src="../Script/jquery-confirm.min.js"></script>
        <link rel="stylesheet" href="../Style/jquery-confirm.min.css" />

        <link href="../ExternalResources/DateTimePicker/bootstrap-datepicker.css" rel="stylesheet">
        <script src="../ExternalResources/DateTimePicker/bootstrap-datepicker.js"></script>

        <!--Toastr-->
        <script src="../ExternalResources/toastr/toastr.min.js"></script>
        <link rel="stylesheet" href="../ExternalResources/toastr/toastr.min.css" />
	 
		 <script src="../Script/Header.js"></script>


		<title> BOOKit-User Account </title>


		<script>
			//Jquery function for load nevigation to page
		$(function () {
            $('#Header').html(getHeaderLG());
            $('#footerID').html(getFooter());
        });

			$(document).ready(function() {
				var panels = $('.user-infos');
				var panelsButton = $('.dropdown-user');
				panels.hide();

				//Click dropdown
				panelsButton.click(function() {
					//get data-for attribute
					var dataFor = $(this).attr('data-for');
					var idFor = $(dataFor);

					//current button
					var currentButton = $(this);
					idFor.slideToggle(400, function() {
						//Completed slidetoggle
						if(idFor.is(':visible'))
						{
							currentButton.html('<i class="glyphicon glyphicon-chevron-up text-muted"></i>');
						}
						else
						{
							currentButton.html('<i class="glyphicon glyphicon-chevron-down text-muted"></i>');
						}
					})
				});


				$('[data-toggle="tooltip"]').tooltip();


			});


            
            function EditUser() {

			    console.log('sdsds');
                var userObj = {
                    userName : '<?php echo $row["FirstName"] ?>',
                    UserID : '<?php echo $row["UserID"] ?>'
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
                        '<div class="form-group " style="display: none;">' +
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
                                            location.reload();
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
                            data: { "getRoles": '<?php echo $row["FK_RoleID"] ?>'},
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
		<div id='Header'></div>

		<div style="height: 100%">
			<div class="col-md-12 mt-2 mb-2">
				<div class="card">
					<div class="card-header">
						My Account
                        <div class="form-inline margin-80-T">
                            <button type="button" class="btn btn-primary " onclick="EditUser()">Edit</button>
                            <form action="SessionClear.php" method="post">
                                <input type="hidden" name="sessionOut" value="1" />
                                <button type="submit" class="btn btn-primary ml-3">Log out</button>
                            </form>

                        </div>

					</div>
					<div class="card-body">
						<div class="text-center">
							<img src="../resources/user.png" class="rounded img-fluid" alt="user image">
						</div>

						<div>
							<table class="table table-user-information">
								<tbody>
								<tr>
									<td class="font-weight-bold">First aame :</td>
									<td><?php echo $row["FirstName"] ?></td>
								</tr>
								<tr>
									<td class="font-weight-bold">Last name :</td>
                                    <td><?php echo $row["LastName"] ?></td>
								</tr>

								<tr>
								<tr>
									<td class="font-weight-bold">Account Type</td>
                                    <td><?php echo $row["RoleDescription"] ?></td>
								</tr>
								<tr>
									<td class="font-weight-bold">Gender</td>
                                    <td><?php echo $row["GenderDescription"] ?></td>
								</tr>
								<tr>
									<td class="font-weight-bold">Email</td>

                                    <?php echo "<td><a href='mailto:".$row["Email"]."'>".$row["Email"]." </a></td>" ?>
								</tr>
								<tr>
									<td class="font-weight-bold">Date of Birth :</td>
                                    <td><?php echo $row["DOB"] ?></td>
								</tr>
								<tr>
									<td class="font-weight-bold">Phone Number</td>
                                    <td><?php echo $row["ContactNo"] ?></td>

								</tr>

								</tbody>
							</table>
						</div>


					</div>
				</div>
			</div>
		</div>

		<footer id="footerID">

		</footer></div>

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