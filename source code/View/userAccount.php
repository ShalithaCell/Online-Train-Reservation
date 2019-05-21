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
	 
		 <script src="../Script/Header.js"></script>


		<title> BOOKit-User Account </title>


		<script>
			//Jquery function for load nevigation to page
		$(function () {
            $('#Header').html(getHeaderMD());
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

				$('button').click(function(e) {
					e.preventDefault();
					alert("This is a demo.\n :-)");
				});
			});

			function logout() {
                <?php
                    $_SESSION = array();
                    session_destroy();

                    header("login.php");

                ?>
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
                            <button type="button" class="btn btn-primary " onclick="logout()">Log out</button>
                            <button type="button" class="btn btn-primary ml-3" onclick="logout()">Log out</button>
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

						<h5 class="card-title">Special title treatment</h5>
						<p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
						<a href="#!" class="btn btn-primary">Go somewhere</a>
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

 </html>	