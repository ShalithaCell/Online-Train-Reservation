<?php
include "sessionWorker.php";



?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" type="image/x-icon" href="../resources/favicon-train.ico" />

    <!--FontAwesome plugins-->
    <link rel="stylesheet" type="text/css" href="../fontawesome/css/all.css" />
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css" />
   
    <!--general custom styles plugin-->
    <link rel="stylesheet" type="text/css" href="../Style/style-custom.css" />
    <link rel="stylesheet" type="text/css" href="../Style/style-custom-nav.css" />

    <!--flickity plugin-->
    <link rel="stylesheet" type="text/css" href="../ExternalResources/flickity/flickity.css" />
    <script src="../ExternalResources/flickity/flickity.js"></script>

       <!--page related style-->
    <link rel="stylesheet" type="text/css" href="../Style/style-home.css" />
    

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

    <!--Toastr-->
    <script src="../ExternalResources/toastr/toastr.min.js"></script>
    <link rel="stylesheet" href="../ExternalResources/toastr/toastr.min.css" />

    <!--Boostrap-->
    <link href="../ExternalResources/boostrap-select/bootstrap-select.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="../ExternalResources/boostrap-select/bootstrap-select.min.js"></script>

    <script>
        //Jquery function for load navigation to page
        $(function () {
            $("#Header").html(getHeaderLG());
            $("#footerID").html(getFooter());
        });

        $(document).ready(function () {

            //-------------------------js methods-------------------------------------------

            $('#txtDate').datepicker({
                minDate: 0,
                maxDate: 0,
                changeMonth: true,
                changeYear: true,
                showButtonPanel: true,
                dateFormat: "m/d/yy"
            });


            $('.btn-light').each(function () {
                $(this).addClass('bg-color-white-t');
            })


            $.ajax({
                url: '../Controller/BIZ/logic.php',
                type: 'get',
                data: { "getAllStations": "test"},
                success: function(response) {
                    var result = (JSON.stringify(response));
                    var objResult =  JSON.parse(result);

                    var obj = jQuery.parseJSON(objResult);

                    $.each(obj, function (index, value) {
                        $('.selectpicker').each(function () {

                            $(this).append('<option value="' + value["StationID"]+ '">' + value["Description"] + '</option>');
                        })

                    });
                }
            });

            $('.selectpicker').selectpicker();


        });

        
        function getSearch() {
            var from = $('#searchDDLFrom').val();
            var To = $('#searchDDLTo').val();

            var date = $('#txtDate').val();

            if(from == '0' || To == '0' || date == ''){
                toastr.warning('please fill all fields', 'warning');
                return;
            }

            window.location.href = "TicketSearch.php?from="+from+"&To="+To+"&date="+date;
        }
        

        

    </script>


    <title>BOOkit-Home</title>
</head>

<body>
    <!--Navigation Bar -->
    <div id="Header"></div>

    <!--Page Content -->
    <div style="height:100%">

        <div class="row child-block-style-T mt-3 search-box-margin">
            <div class="col-4">
                <div class="col-md-12 ">
                <p class="half-font">
                    BOOKit Trains 24x7 Helpline <br />
                    011-1234567
                </p>
                </div>
                <div class="col-md-12 cus-block-1">
                <div class="mt-5">
                    <label class="text-primary cus-font-weight">Your Ticket Search Ends Here</label>

                    <div class="row">
                    <div class="custom-control custom-radio ml-3">
                        <input type="radio" class="custom-control-input" id="defaultGroupExample1" name="groupOfDefaultRadios" checked>
                        <label class="custom-control-label" for="defaultGroupExample1">Book Ticket</label>
                    </div>

                    <!-- Group of default radios - option 2 -->
                    <div class="custom-control custom-radio ml-3">
                        <input type="radio" class="custom-control-input" id="defaultGroupExample2" name="groupOfDefaultRadios" >
                        <label class="custom-control-label" for="defaultGroupExample2">Check PNR</label>
                    </div>
                    </div>
                </div>
                </div>

            </div>
            <div class="col-4">
                <div>
                    <h4>Hassle Free Train Tickets Booking</h4>
                    <ul class="ul-cus">
                        <li>Zero service charge</li>
                        <li>Easy cancellation and refund</li>
                        <li>No hidden charges</li>
                    </ul>

                </div>
            </div>
            <div class="col-4">
                <img id="imgTrain" src="../resources/Train.png" class="img-responsive" />
            </div>

            <div class="row col-md-12 cus-block-1 ml-2">
                <div class="row">
                    <div class="md-form">
                        <div class="row-fluid">
                            <select class="selectpicker bg-color-white-t" id="searchDDLFrom" data-live-search="true">
                                <option value="0">Select</option>
                            </select>

                        </div>
                    </div>
                    <div class="md-form ml-2">
                        <button class="btn"><i class="fas fa-exchange-alt"></i></button>
                    </div>
                    <div class="md-form">
                        <div class="row-fluid">
                            <select class="selectpicker bg-color-white-t" id="searchDDLTo" data-live-search="true">
                                <option value="0">Select</option>
                            </select>

                        </div>
                    </div>
                    <div class="md-form">
                        <i class="fa fa-diamond prefix"></i>
                        <input type="text" id="txtDate" class="form-control">
                        <label for="form2" class="">Date</label>
                    </div>
                    <div class="md-form ml-3">
                        <button type="button" onclick="getSearch();" class="btn btn-success">Search</button>

                    </div>
                </div>
            </div>
        </div>

<!--        <div class="search-block">-->
<!--            <div>-->
<!--                <div class="row font-Sego">-->
<!--                    <div class="column-T center-block-column">-->
<!--                        <p>-->
<!--                            BOOKit Trains 24x7 Helpline <br />-->
<!--                            011-1234567-->
<!--                        </p>-->
<!--                        <div style="background-color:white">-->
<!--                            <label class="master-blue-color txt1">Your Ticket Search Ends Here</label>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="column-T center-blick-column-second">-->
<!--                        <p style="padding-left: 22%;">-->
<!--                            Hassle Free Train Tickets Booking <br />-->
<!--                            - Zero service charge <br />-->
<!--                            - Easy cancellation and refund <br />-->
<!--                            - No hidden charges-->
<!--                        </p>-->
<!--                    </div>-->
<!--                    <div class="column-T">-->
<!--                        <img id="imgTrain" src="../resources/Train.png" style="padding-left: 22%;" />-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div>-->
<!--                <form action="">-->
<!--                    <div class="form-inline-T home-radio-block font-Sego">-->
<!--                            <label class="container-T">Book Ticket-->
<!--                                    <input type="radio" checked="checked" name="radio">-->
<!--                                    <span class="checkmark"></span>-->
<!--                            </label>-->
<!--                            &nbsp;&nbsp;&nbsp;&nbsp;-->
<!--                            <label class="container-T">Check PNR Status-->
<!--                                    <input type="radio" name="radio">-->
<!--                                    <span class="checkmark"></span>-->
<!--                            </label>-->
<!--                    </div>-->
<!--                    <div class="form-inline-T search-bar font-Sego">-->
<!--                        Text box From-->
<!--                        <div class="search-bar-item">-->
<!--                            <label for="txtTrainFrom">From</label>-->
<!--                            <input type="text" id="txtTrainFrom" name="txtbFrom">-->
<!--                        </div>-->
<!--                        <div>-->
<!--                                <button id="btnExchange" ><i class="fas fa-exchange-alt"></i></button>-->
<!--                        </div>-->
<!--                        Text box To-->
<!--                        <div class="search-bar-item" style="margin-left: 2%;">-->
<!--                                <label for="txtTrainTo">To</label>-->
<!--                                <input type="text" id="txtTrainTo" name="txtbTo">-->
<!--                            </div>-->
<!--                            <div class="search-bar-item calender" style="margin-left: 2%;">-->
<!--                                    <label for="dPicker">Date</label>-->
<!--                                    <input type="date" name="Date" id="dPicker">-->
<!--                            </div>-->
<!--                            <button class="button-T" id="TrainSearch" style="margin-left: 2%;">Search</button>-->
<!--                    </div>-->
<!--                    </div>-->
<!--                </form>-->
<!--            </div>-->

            <div class="container img-responsive">
                <img src="../resources/2019-03-10 13_56_41-Book Train, Bus & Flights_ Confirmtkt.com.png" class="img-responsive" style="width: 100% !important;">
            </div>

            <div class="container">
                <!-- Flickity HTML init -->
                <div class="carousel js-flickity">
                    <div class="carousel-cell">
                    <img src="../resources/2019-03-10_14-18-552.png" alt="orange tree" />
                    </div>
                    <div class="carousel-cell">
                    <img src="../resources/2019-03-10_14-28-2155.png" alt="submerged" />
                    </div>
                    <div class="carousel-cell">
                    <img src="../resources/2019-03-10_14-28-215521.png" alt="look-out" />
                    </div>
                    
                </div>
            </div>
            
        </div>


    <!--Footer -->
    <footer id="footerID"></footer>

    <!--cannot read property 'addeventlistener' of null mdb
- This is probably because the script is executed before the page loads. By placing the script at the bottom of the page, I circumvented the problem.
-->


</body>

<script src="../ExternalResources/MDB/js/mdb.min.js"></script>

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