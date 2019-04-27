<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>BOOkit-Error</title>

    <link rel="shortcut icon" type="image/x-icon" href="../resources/favicon-train.ico" />

    <!--Fontawesome-->
    <link rel="stylesheet" type="text/css" href="../fontawesome/css/all.css" />
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css" />

    <!--Navigation bar and footer-->
    <link rel="stylesheet" type="text/css" href="../Style/style-custom.css" />
    <link rel="stylesheet" type="text/css" href="../Style/style-custom-nav.css" />

    <!--mdb-->
    <script src="../ExternalResources/MDB/js/popper.min.js"></script>
    <link href="../ExternalResources/MDB/css/mdb.min.css" rel="stylesheet">

    <script src="../Script/jquery-3.3.1.min.js"></script>
    <link href="../ExternalResources/bootstrap-4.3.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="../ExternalResources/bootstrap-4.3.1/js/bootstrap.min.js"></script>

    <!--style sheets for this page only-->


    <!--jquery-->
    <script src="../Script/jquery-3.3.1.min.js"></script>
    <!--jquery UI-->
    <script src="../Script/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="../Style/jquery-ui.css" />

    <!--Jquery confirm-->
    <script src="../Script/jquery-confirm.min.js"></script>
    <link rel="stylesheet" href="../Style/jquery-confirm.min.css" />

    <!--Herder js file-->
    <script src="../Script/Header.js"></script>

    <script>
        //Jquery function for load navigation to page
        $(function () {
            $("#Header").html(getHeaderMD());
            $("#footerID").html(getFooter());
        });

        $(document).ready(function () {

            //-------------------------js methods-------------------------------------------

        });

    </script>


</head>
<body>
<!--Header -->
<div id="Header"></div>

<div style="height:100%">

    <div class="container">
        <div class="row">
        <div class="col-md-6">
            <div class="row mt-5 text-secondary">
            <h1>Oops !</h1>
            </div>
            <div class="row mt-3 text-secondary">
                <h3>Something went wrong</h3>
            </div>
            <div class="row mt-3 text-secondary">
                <h6>Brace yourself till we get the error fixed.</h6>
                <h6>You may also refresh the page or try again later</h6>
            </div>
            <div class="row mt-3 mb-5">
                <div class="container">
                    <h6 class="text-secondary">Here are some helpful links instead:</h6>
                    <div class="mt-2">
                        <a href="#"><i class="fas fa-home"></i> Home</a> <br>
                        <a href="#"><i class="fas fa-question-circle"></i> Help</a> <br>
                        <a href="#"><i class="fas fa-user-alt"></i> Account</a> <br>
                        <a href="#"><i class="fas fa-envelope"></i> Contact US</a> <br>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-6">
            <div class="container">
                <img src="../resources/erro-404-imagem.png" class="img-responsive" width="400" height="400">
            </div>
        </div>
        </div>
    </div>

</div>

<!--Footer -->
<footer id="footerID"></footer>

<!--cannot read property 'addeventlistener' of null mdb
- This is probably because the script is executed before the page loads. By placing the script at the bottom of the page, I circumvented the problem.
-->
<script src="../ExternalResources/MDB/js/mdb.min.js"></script>

</body>
</html>