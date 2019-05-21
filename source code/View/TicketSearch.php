<?php
include "sessionWorker.php";



?>

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

        <!--style sheets for this page only-->
        <link rel="stylesheet" type="text/css" href="../Style/style-TicketSearch.css" />

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

        <!--Boostrap-->
        <link href="../ExternalResources/boostrap-select/bootstrap-select.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="../ExternalResources/boostrap-select/bootstrap-select.min.js"></script>

        <!--Toastr-->
        <script src="../ExternalResources/toastr/toastr.min.js"></script>
        <link rel="stylesheet" href="../ExternalResources/toastr/toastr.min.css" />

        <!--jquery-->
        <script src="../ExternalResources/jquery-redirect/jquery.redirect.js"></script>


        <!--Custom combo box plugins-->
<!--        <script src="../Script/custom-combo.js"></script>-->
<!--        <link rel="stylesheet" type="text/css" href="../Style/style-custom-combo.css" />-->

        <!--Herder js file-->
        <script src="../Script/Header.js"></script>

        <script>
                //Jquery function for load navigation to page
                $(function () {
                        $("#Header").html(getHeaderLG());
                        $("#footerID").html(getFooter());
                });

                $(document).ready(function () {

                        //-------------------------js methods-------------------------------------------

                        //initialize combo box
                        //initializeCombo();

                        //jquery ui calender
                        $('#txtDate').datepicker({
                                minDate: "0",
                                maxDate: "12/31/2019",
                                changeMonth: true,
                                changeYear: true,
                                showButtonPanel: true,
                                dateFormat: "m/d/yy"
                        });



                    //begin page functions
                    $.ajax({
                        url: '../Controller/BIZ/logic.php',
                        type: 'get',
                        data: { "getAllStations": "test"},
                        success: function(response) {
                            var result = (JSON.stringify(response));
                            var objResult =  JSON.parse(result);

                            var obj = jQuery.parseJSON(objResult);

                            $.each(obj, function (index, value) {
                                console.log(index);
                                $('.selectPikcerFrom').each(function () {

                                    if(value["StationID"]==getUrlVars()["from"]){
                                        $(this).append('<option value="' + value["StationID"]+ '" selected>' + value["Description"] + '</option>');
                                    }else{
                                        $(this).append('<option value="' + value["StationID"]+ '">' + value["Description"] + '</option>');
                                    }


                                });

                                $('.selectPikcerTo').each(function () {

                                    if(value["StationID"]==getUrlVars()["To"]){
                                        $(this).append('<option value="' + value["StationID"]+ '" selected>' + value["Description"] + '</option>');
                                    }else{
                                        $(this).append('<option value="' + value["StationID"]+ '">' + value["Description"] + '</option>');
                                    }
                                });

                            });

                            $('.selectpicker').selectpicker();
                            $('#txtDate').val(getUrlVars()["date"]);
                            getTrainDetails('0', '0');
                        }
                    });

                    //$('.selectpicker').selectpicker();

                    $('#btnSearch').click(function () {
                        var FROM = $('#searchDDLFrom').val();
                        var TO = $('#searchDDLTo').val();

                        if(FROM == '0' || TO == '0' || $('#txtDate').val() == ''){
                            toastr.warning('please fill all fields', 'warning');
                            return;
                        }
                        console.log(FROM);
                        getTrainDetails(FROM, TO);

                    });

                });

                function addNewReview(){
                        var review = $.trim($("#txtareaReview").val());
                        var reviewTitle = $.trim($("#txtareaTitle").val());

                        if(review == '' || reviewTitle == ''){
                                return;
                        }

                        var content = '<div class="ful-width review-parent form-inline-T font-Sego"> <div class="column-Review-left"> <div style="font-size: 4em;"> <i class="fas fa-user-tie"></i> </div><div> By <a href="" >John</a> </div></div><div class="column-Review-right"> <h2 id="review_1">'+reviewTitle+'</h2> <p> '+review+'</p></div></div>';

                        document.getElementById("div_review_parent").innerHTML = document.getElementById("div_review_parent").innerHTML + content;

                        $.trim($("#txtareaReview").val(''));
                        $.trim($("#txtareaTitle").val(''));
                }
                
                function viewReview(){
                                //content already created using test web pages
                                $.confirm({
                                        width : 50, 
                                        height:50,
                                        closeIcon: true,
                                        title: 'Reviews',
                                        content: '' +
                                        '<form action="" class="formName">' +
                                                        '<div style="font-size: 60%;" > <div id="div_review_parent"> <div class="ful-width review-parent form-inline-T font-Sego"> <div class="column-Review-left"> <div style="font-size: 4em;"> <i class="fas fa-user-tie"></i> </div><div> By <a href="" >John</a> </div></div><div class="column-Review-right"> <h2 id="review_1">My awesome review</h2> <p id="reviewDescription_1"> Train is good but was too much crowded due to wedding season and due to this no cleanliness was there and before blaming cleaning staff its the passengers who needs to take care for this. Groundnuts, plastics, paper, cups were thrown below the seat. </p></div></div><div class="ful-width review-parent form-inline-T font-Sego"> <div class="column-Review-left"> <div style="font-size: 4em;"> <i class="fas fa-user-tie"></i> </div><div> By <a href="" >John</a> </div></div><div class="column-Review-right"> <h2 id="review_1">My awesome review</h2> <p id="reviewDescription_1"> Train is good but was too much crowded due to wedding season and due to this no cleanliness was there and before blaming cleaning staff its the passengers who needs to take care for this. Groundnuts, plastics, paper, cups were thrown below the seat. </p></div></div></div><div class="ful-width review-add form-inline-T font-Sego"> <h2 style="text-align: left;color: gray; margin-left: 1%;">Add Review</h2> <br><textarea id="txtareaTitle" placeholder="Enter Review" cols="30" rows="1"></textarea> <textarea id="txtareaReview" placeholder="Enter Description" cols="30" rows="5"></textarea> <div class="ful-width btn-left"> <button id="btnAddReview" class="button-addReview" style="margin-left: 2%;" onclick="addNewReview()"><i class="fas fa-plus"></i> &nbsp;Add</button> </div></div></div>'+
                                        '</form>',
                                        buttons: {
                                                
                                                cancel: function () {
                                                //close
                                                },
                                        },
                                        onContentReady: function () {
                                                // bind to events
                                                var jc = this;
                                                this.$content.find('form').on('submit', function (e) {
                                                // if the user submits the form by pressing enter in the field.
                                                e.preventDefault();
                                                jc.$$formSubmit.trigger('click'); // reference the button and click it
                                                });
                                        }
                                });
                        }

                function RederectPayment(classID,payment){
                        event.preventDefault()
                        //location.href = "payment.html?class="+classID+"&payment=";

                        $.redirect("payment.html", {class: classID, payment: payment}, "POST", "_blank");
                }

                function getUrlVars()
                {
                        var vars = [], hash;
                        var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
                        for(var i = 0; i < hashes.length; i++)
                        {
                                hash = hashes[i].split('=');
                                vars.push(hash[0]);
                                vars[hash[0]] = hash[1];
                        }
                        return vars;
                }

                function getTrainDetails(DFrom, DTo) {

                        $('#divTrainList').html('');

                        var From = getUrlVars()["from"];
                        var to = getUrlVars()["To"];

                        if(DFrom != '0' && DTo != '0'){
                            From = DFrom;
                            to = DTo;
                        }

                        var data = {
                            From : From,
                            To : to
                        };



                        $.ajax({
                            url: '../Controller/BIZ/logic.php',
                            type: 'get',
                            data: { "getTrainSheduleByRefine": JSON.stringify(data)},
                            beforeSend: function(){

                            },
                            complete: function(){

                            },
                            success: function(response) {
                                //console.log(response);

                                var result = (JSON.stringify(response));
                                var objResult =  JSON.parse(result);

                                var obj = jQuery.parseJSON(objResult);

                                $.each(obj, function (index, value) {

                                    var trainID = value["TrainID"];
                                    var trainName = value["TrainName"];
                                    var trainCode = value["TrainCode"];
                                    var fromTime = value["FromTime"];
                                    var ToTime = value["ToTime"];
                                    var from = value["StationFrom"];
                                    var toStation = value["StationTo"];

                                    var data = {
                                        From : From,
                                        To : to,
                                        train : trainID
                                    };

                                    $.ajax({
                                        url: '../Controller/BIZ/logic.php',
                                        type: 'get',
                                        data: { "getTrainSheduleClasPrice": JSON.stringify(data)},
                                        beforeSend: function(){

                                        },
                                        complete: function(){

                                        },
                                        success: function(response) {
                                            //console.log(response);

                                            var result = (JSON.stringify(response));
                                            var objResult =  JSON.parse(result);

                                            var obj = jQuery.parseJSON(objResult);

                                            var containtChild = '';

                                            $.each(obj, function (index, value) {

                                                var classID = value["ClassID"];
                                                var payment = value["Price"];

                                                //console.log(payment);

                                                containtChild += '<fieldset class="margin-top-sm border-line-T">\n' +
                                                '                                                                        <legend class="legend-custom"><lable >'+value["Class"]+'</lable></legend>\n' +
                                                '                                                                        <div class="style-price"><label >$ '+value["Price"]+'</label></div>\n' +
                                                '                                                                        <div class="div-details form-inline-T">\n' +
                                                '                                                                                <label class="div-status-available">Available</label>\n' +
                                                '                                                                                <label class="div-status-remains">15 to Remaining(s)</label>\n' +
                                                '                                                                        </div>\n' +
                                                '                                                                        <div class="center-T">\n' +
                                                '                                                                                <button onclick="RederectPayment(' + classID + ',\''+ payment +'\')" class="button-sm" style="margin-left: 2%;">Book</button>\n' +
                                                '                                                                        </div>\n' +
                                                '                                                                </fieldset>\n';

                                            });

                                            //console.log(containtChild);


                                            var content = '<div class="row-T round-coner custom-style-list margin-top-sm trainBlock" trainID="'+trainID+'">\n' +
                                                '                                                        <div class="column-train-detail-general">\n' +
                                                '                                                                <i class="fas fa-subway medium-font-size-icon"></i> <br>\n' +
                                                '                                                                <label ><b>'+trainName+'</b></label> <br>\n' +
                                                '                                                                <label class="lable-train-type"><b>'+trainCode+'</b></label> <br>\n' +
                                                '                                                                <label onclick="viewReview()" class="reviews">Reviews(<label id="lblReview_train_1">15</label>)</label>\n' +
                                                '                                                        </div>\n' +
                                                '                                                        <div class="column-train-detail-general">\n' +
                                                '                                                                <label class="lable-cus">'+from+'</label> <br>\n' +
                                                '                                                                <label class="lable-cus-time">'+fromTime+'</label>\n' +
                                                '                                                        </div>\n' +
                                                '                                                        <div class="column-train-detail-general">\n' +
                                                '                                                                <label class="lable-cus">'+toStation+'</label> <br>\n' +
                                                '                                                                <label class="lable-cus-time">'+ToTime+'</label>\n' +
                                                '                                                        </div>\n' +
                                                '                                                        <div class="column-train-detail-large t_'+trainID+'">\n' +
                                                '                                                        </div>\n' +
                                                '                                                </div>';

                                            $('#divTrainList').append(content);
                                            $('.t_'+trainID).append(containtChild);

                                        }
                                    });



                                });



                            }
                        });

                }


        </script>

        <title>BOOkit-Ticket Search</title>
</head>

<body>
        <!--Navigation Bar -->
        <div id="Header"></div>

        <!--Page Content -->
        <div style="height:100%">

                        <!--Search bar -->
                        <div class="row-T">
                                <div class="column-general round-coner font-Sego form-inline-T"
                                        style="background-color:#3F51D4;">
                                        <div >
                                            <div class="row-fluid">
                                                <label class="color-white">From</label><br>
                                                <select class="selectpicker selectPikcerFrom" id="searchDDLFrom" data-live-search="true">
                                                    <option value="0">Select</option>
                                                </select>

                                            </div>
                                        </div>
                                        <div>
                                                <button id="btnExchange"><i class="fas fa-exchange-alt"></i></button>
                                        </div>
                                        <div >
                                            <div class="row-fluid">
                                                <label class="color-white">To</label><br>
                                                <select class="selectpicker selectPikcerTo" id="searchDDLTo" data-live-search="true">
                                                    <option value="0">Select</option>
                                                </select>

                                            </div>
                                        </div>
                                        <div class="div-custom margin-left-custom">
                                                <label for="txtDate" class="color-white">Date</label>
                                                <input type="text" id="txtDate" name="txtbDate">
                                        </div>
                                        <div class="div-custom margin-left-custom">
                                                <button class="button-search" id="btnSearch" style="margin-left: 2%;">Search</button>
                                        </div>
                                </div>
                        </div>

                <div>
                        <!--Filter box-->
                        <div class="row-T">
                                <div class="column-first round-coner font-Sego"
                                        style="background-color:white; border-style:ridge;padding-bottom: 2% ">
                                        <h2>Refine Results</h2>
                                        <hr>
                                        <h3>Class</h3>
                                        <form action="">
                                                <div class="form-group">
                                                <select class="browser-default custom-select role" id="ddlClass">
                                                        <option selected>Select class</option>
                                                        </select>
                                                </div>
                                                <div id="grpAvailable">
                                                        <h3>Availability</h3>
                                                        <label class="container-T">All
                                                                <input type="radio" checked="checked"
                                                                        name="grpAvailable">
                                                                <span class="checkmark"></span>
                                                        </label>

                                                        <label class="container-T">Available
                                                                <input type="radio" name="grpAvailable">
                                                                <span class="checkmark"></span>
                                                        </label>
                                                </div>

                                                <div id="grpJType">
                                                        <h3>Journey Type</h3>
                                                        <label class="container-T">Casual
                                                                <input type="radio" checked="checked" name="grpJType">
                                                                <span class="checkmark"></span>
                                                        </label>

                                                        <label class="container-T">Tour
                                                                <input type="radio" name="grpJType">
                                                                <span class="checkmark"></span>
                                                        </label>
                                                </div>

                                                <h3>No of Passengers</h3>
                                                <input type="text" id="txtNoOfPassengers" placeholder="Enter No">
                                        </form>
                                </div>
                                <div class="column-two round-coner font-Sego" style="background-color:#EEEEEE;">
                                        <div class="form-inline-T">
                                                        <div class="row-T ful-width">
                                                <div class="column-A">
                                                        <h3>Train Name</h3>
                                                </div>
                                                <div class="column-B">
                                                                <h3>Departure</h3>
                                                </div>
                                                <div class="column-C">
                                                                <h3>Destination Time</h3>
                                                </div>
                                                <div class="column-D">
                                                                <h3>Class,Availability &amp; Fare</h3>
                                                </div>
                                        </div>
                                        </div>
                                        <hr style="margin-top: -2%;">

                                        <div id="divTrainList">


                                        </div>
                                </div>
                        </div>
                </div>

        </div>

        <!--Footer -->
        <footer id="footerID"></footer>
</body>

</html>