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

    <!--Toastr-->
    <script src="../ExternalResources/toastr/toastr.min.js"></script>
    <link rel="stylesheet" href="../ExternalResources/toastr/toastr.min.css" />

    <script src="../Script/adminPanel.js"></script>

    <script>

        $(function () {
            $('#Header').html(getHeaderLG());
            $('#footerID').html(getFooter());
            $('#loader').hide();

            //get roleId logged user
            if(sessionStorage.getItem("RoleID")== null){
                //redirect to login page
                window.location.replace("login.php");
            }else{
                if(sessionStorage.getItem("RoleID") == '3' || sessionStorage.getItem("RoleID") == '4'){ //site users
                    window.location.replace("Home.php");
                }
            }

        });

        $(document).ready(function () {
            LoadUserTable();
        });

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
                        <div class="row">
                            <div class="card w-100 mb-3">
                                <div class="card-header text-muted">
                                    List of Trains
                                </div>
                                <div class="card-body">
                                    <table class="table" id="tblTrains">
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