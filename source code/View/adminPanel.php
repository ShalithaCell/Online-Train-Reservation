<?php
include "sessionWorker.php";
//session_start();

//echo "<script type='text/javascript'>alert(".$_SESSION['RoleID'].");</script>";
//echo '<script>console.log('.$_SESSION['RoleID'].')</script>';
if(isset($_SESSION['RoleID'])){
    if($_SESSION['RoleID'] == '1' || $_SESSION['RoleID'] == '2'){

    }else {
        header("Location: home.php");
    }
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
    <title>BOOkit-Admin Panel</title>

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

    <!--Toastr-->
    <script src="../ExternalResources/toastr/toastr.min.js"></script>
    <link rel="stylesheet" href="../ExternalResources/toastr/toastr.min.css" />


    <script src="../Script/adminPanel.js"></script>

    <script>

        $(function () {
            $('#Header').html(getHeaderLG());
            $('#footerID').html(getFooter());
            $('#loader').hide();

            //check id logged as admin
            /*$.ajax({
                url: '../Controller/BIZ/logic.php',
                type: 'get',
                data: { "ifAdmin": "test"},
                success: function(response) {

                    if(response != true){
                        window.location.replace("login.php");
                    }
                }
            });*/

            //get roleId logged user
            /*if(sessionStorage.getItem("RoleID")== null){
                //redirect to login page
                window.location.replace("login.php");
            }else{
                if(sessionStorage.getItem("RoleID") == '3' || sessionStorage.getItem("RoleID") == '4'){ //site users
                    window.location.replace("Home.php");
                }
            }*/

        });

        $(document).ready(function () {
            LoadUserTable();
            LoadTrainTable();
            LoadStationTable();

            $('.cls-users').click(function(){
                setTimeout(function(){
                    // enable click after 1 second
                    $('#tblUsers').DataTable().ajax.reload();
                },200); // 1 second delay

            });

            $('.cls-trains').click(function(){
                setTimeout(function(){
                    // enable click after 1 second
                    $('#tblTrains').DataTable().ajax.reload();
                },200); // 1 second delay

            });

            $('.cls-station').click(function(){
                setTimeout(function(){
                    // enable click after 1 second
                    $('#tblStations').DataTable().ajax.reload();
                },200); // 1 second delay

            });


        });

        function trainPageRequired() {

            var success = true;

            var trainName = $('#txtTrainName').val();
            var trainCode = $('#txtTrainCode').val();
            var trainDescription = $('#txtDescription').val();

            if(trainName.length == 0){
                $('#txtTrainName').siblings('.req-field').show();
                success =  false;
            }else{
                $('#txtTrainName').siblings('.req-field').hide();
            }

            if(trainCode.length == 0){
                $('#txtTrainCode').siblings('.req-field').show();
                success =  false;
            }else{
                $('#txtTrainCode').siblings('.req-field').hide();
            }

            if(trainDescription.length == 0){
                $('#descReq').show();
                success =  false;
            }else{
                $('#descReq').hide();
            }

            return success;

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
                        <a class="nav-item nav-link active cls-users" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true"><i class="fas fa-users font-md-T ml-2"></i> &nbsp; </br>Users</a>
                        <a class="nav-item nav-link cls-trains" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false"><i class="fas fa-train font-md-T ml-2"></i> &nbsp; </br>Trains</a>
                        <a class="nav-item nav-link cls-station" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false"><i class="fas fa-warehouse font-md-T ml-2"></i> &nbsp; </br>Stations</a>
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
                        <div class="row">
                            <div class="card w-100 mb-3">
                                <div class="card-header text-muted">
                                    List of Trains
                                    <button type="button" class="btn btn-default margin-80-T" onclick="AddNewTrain()">New Train</button>
                                </div>
                                <div class="card-body">
                                    <table class="table" id="tblTrains">
                                        <thead class="black white-text">
                                        <tr>
                                            <th scope="col">TrainID</th>
                                            <th scope="col">Train Code</th>
                                            <th scope="col">Train Name</th>
                                            <th scope="col"># of Seats</th>
                                            <th scope="col">Regular Running</th>
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
                    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                        <div class="row">
                            <div class="card w-100 mb-3">
                                <div class="card-header text-muted">
                                    List of Stations
                                    <button type="button" class="btn btn-default margin-70-T" onclick="addNewStation()">New Station</button>
                                </div>
                                <div class="card-body">
                                    <table class="table" id="tblStations">
                                        <thead class="black white-text">
                                        <tr>
                                            <th scope="col">StationID</th>
                                            <th scope="col">Station Name</th>
                                            <th scope="col">Distance From Main Station</th>
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