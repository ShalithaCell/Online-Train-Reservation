<?php

include '../Controller/BIZ/ChromePhp.php';
require '../Config/config.php';


//ChromePhp::log($token);

try{

    if(isset($_GET["token"])){
        global $conn;


        //perverting Query fail: Commands out of sync; you can't run this command now
        while($conn->more_results())
        {
            $conn->next_result();
            if($res = $conn->store_result())
            {
                $res->free();
            }
        }

        $token = $_GET["token"];

        $sql_query = "CALL SP_CHECK_RESET_TOKEN_VALIED('".$token."');";

        //echo $sql_query;

        $result = mysqli_query($conn, $sql_query) or die("Query fail: " . mysqli_error($conn));

        $row=mysqli_fetch_array($result,MYSQLI_ASSOC);

        ChromePhp::log($row);
    }
    else{
        header('Location: '.'login.php');
    }


}
catch(Exception $e) {
    echo 'Message: ' .$e->getMessage();
}

//chekc if token exixts or expired


//ChromePhp::log($result);
//ChromePhp::log($result["expired"]);

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
		<link rel="stylesheet" type="text/css" href="../Style/reset.css" />

		<script src="../Script/jquery-3.3.1.min.js"></script>


    <!--mdb-->
    <script src="../ExternalResources/MDB/js/popper.min.js"></script>
    <link href="../ExternalResources/MDB/css/mdb.min.css" rel="stylesheet">


    <!--Boostrap-->
    <link href="../ExternalResources/bootstrap-4.3.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="../ExternalResources/bootstrap-4.3.1/js/bootstrap.min.js"></script>

    <!--Jquery confirm-->
    <script src="../Script/jquery-confirm.min.js"></script>
    <link rel="stylesheet" href="../Style/jquery-confirm.min.css" />


    <!-- check token  validation-->
    <?php

    if($row != null){
        if($row["result"] == 'false'){?>

            <script>
                //Jquery function for load navigation to page
                $(function () {
                    $.confirm({
                        title: 'Ooops',
                        content: 'Cannot perform this operation because your password reset time is expired.' +
                            'please retry to reset password !',

                        type: 'blue',
                        columnClass: 'medium',
                        typeAnimated: true,
                        theme: 'supervan',
                        backgroundDismiss: function(){
                            window.location.href = 'login.php';
                            return true;
                        },
                        buttons: {
                            ok: {
                                text: 'ok',
                                btnClass: 'btn-green col-md-8',
                                action: function () {
                                    window.location.href = 'login.php';
                                }
                            }
                        }
                    });
                });


            </script>

        <?php }
    }

    ?>

        <script>
                //Jquery function for load navigation to page
                $(function () {

                });

                function  validate() {
                    var password = $('#inputPasswordNew').val();
                    var passwordConfirm = $('#inputPasswordNewVerify').val();

                    if(password == passwordConfirm){
                        return true;
                    }else{
                        $('.pass').each(function () {
                            $(this).addClass('border-color-error');
                        });

                        return false;
                    }
                }


        </script>

        <title>BOOkit-Reset Password</title>
</head>

<body>
        <!--Navigation Bar -->
        <div id="Header"></div>

        <!--Page Content -->
        <div class="content py-5 bg-light  ">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <span class="anchor" id="formChangePassword"></span>
                        <!-- form card change password -->
                        <div class="card card-outline-secondary">
                            <div class="card-header">
                                <h3 class="mb-0">Change Password</h3>
                            </div>
                            <div class="card-body">
                                <form class="form" method="post" action="../Controller/form/resetController.php" role="form" autocomplete="off" onsubmit="return validate();">

                                    <div class="form-group">
                                        <label for="inputPasswordNew">New Password</label>
                                        <input type="password" class="form-control pass" name="password" minlength="8" id="inputPasswordNew" required="">
                                        <span class="form-text small text-muted">
                                            The password must be 8-20 characters, and must <em>not</em> contain spaces.
                                        </span>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPasswordNewVerify">Verify</label>
                                        <input type="password" class="form-control pass" name="confirmPasswrd" minlength="8" id="inputPasswordNewVerify" required="">
                                        <span class="form-text small text-muted">
                                            To confirm, type the new password again.
                                        </span>
                                        <input type="hidden" name="token" value="<?php echo $token ?>" />
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success btn-lg float-right">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /form card change password -->

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