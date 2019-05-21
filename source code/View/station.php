<?php
include "sessionWorker.php";



?>

<!DOCTYPE html>
<html>

<head>

    <!--character encoding for HTML document -->
    <meta charset="UTF-8" />
    <!--make the webpage responsive, relative to resolution -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!--linking the BOOKit train icon on top of the page -->
    <link rel="shortcut icon" type="image/x-icon" href="../resources/favicon-train.ico" />

    <title>BOOkit-Stations</title>

    <!--fontawesome icon using (css files) -->
    <link rel="stylesheet" type="text/css" href="../fontawesome/css/all.css" />
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css" />

    <!--linking custom.css and custon-navigation bar .css files -->
    <link rel="stylesheet" type="text/css" href="../Style/style-custom.css" />
    <link rel="stylesheet" type="text/css" href="../Style/style-custom-nav.css" />

    <!--linking station.css file -->
    <link rel="stylesheet" type="text/css" href="../Style/style-station.css" />

    <script src="../Script/jquery-3.3.1.min.js"></script>
    <script src="../Script/Header.js"></script>

    <!--Jquery datatable-->
    <script src="../ExternalResources/datatables/datatables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../ExternalResources/datatables/datatables.min.css" />

    <!--mdb-->
    <script src="../ExternalResources/MDB/js/popper.min.js"></script>
    <link href="../ExternalResources/MDB/css/mdb.min.css" rel="stylesheet">


    <!--Boostrap-->
    <link href="../ExternalResources/bootstrap-4.3.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="../ExternalResources/bootstrap-4.3.1/js/bootstrap.min.js"></script>

    <script>
        //Jquery function for load navigation to page
        $(function () {
            $("#Header").html(getHeaderLG());
            $("#footerID").html(getFooter());
        });

        //loding main atable content to station page
        $(document).ready(function () {
            stationMainTableLoading();
        });

        function stationMainTableLoading() {
            table = $('#main0').DataTable({
                "ajax": {
                    "type": "GET",
                    "url": "../Controller/BIZ/logic.php",
                    "contentType": "application/json; charset=utf-8",
                    "dataType": "json",
                    data: { "stationMainTable": "test"},
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
                    { 'data': 'TrainName'},
                    { 'data': 'TrainCode' },
                    { 'data': 'StationName' },
                    { 'data': 'FromTime' },
                ],

                dom: 'lrtip',
                initComplete: function () {
                    $('#main0').DataTable().columns.adjust();
                }
            });
        }

    </script>
</head>

<body>
    <!--Navigation Bar -->
    <div id="Header"></div>

    <!--Page Content -->
    <div style="height:100%">
    
        <input type="text" placeholder="Search here...." id="search-bar1" name="search-bar1">
        <br/><br/>
        <h1 id="h1-cus">Five Trains Run Via Colombo Fort Station</h1>
        <br/><br/><br/>

        <div class="tb-margin">
            <table class="table" id="main0">
                <thead class="black white-text">
                      <tr>
                        <th scope="col">Train Name</th>
                        <th scope="col">Code</th>
                        <th scope="col">Station Name</th>
                        <th scope="col">Arrives</th>

                        

                      </tr>
                </thead>
                <tbody>
                      
                </tbody>
            </table>

        </div>
    </div>
    <!--Footer -->
    <footer id="footerID"></footer>


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
