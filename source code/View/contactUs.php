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
    <link rel="shortcut icon" type="image/x-icon" href="../resources/favicon-train.ico" />
    <title>BOOkit-Contact Us</title>

    <link rel="stylesheet" type="text/css" href="../fontawesome/css/all.css" />
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css" />

    <link rel="stylesheet" type="text/css" href="../Style/style-custom.css" />
    <link rel="stylesheet" type="text/css" href="../Style/style-custom-nav.css" />


    <script src="../Script/jquery-3.3.1.min.js"></script>
    <script src="../Script/Header.js"></script>

    <!--mdb-->
    <script src="../ExternalResources/MDB/js/popper.min.js"></script>
    <link href="../ExternalResources/MDB/css/mdb.min.css" rel="stylesheet">


    <!--Boostrap-->
    <link href="../ExternalResources/bootstrap-4.3.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="../ExternalResources/bootstrap-4.3.1/js/bootstrap.min.js"></script>

    <link rel="stylesheet" type="text/css" href="../Style/style-contactUs.css" />

    <script>
        //Jquery function for load navigation to page
        $(function () {
            $("#Header").html(getHeaderLG());
            $("#footerID").html(getFooter());
        });

        function clickfunction()
        {

            
                var count= 0;

           
            {
                if($('#first').val().length == 0)
                {
                    $('#first').addClass( "frstbtn" );
                    count +=1;
                }
                else 
                {
                     $('#first').removeClass( "frstbtn" );
                     
                }
                                

                if($('#mail').val().length == 0)
                    {
                        $('#mail').addClass( "frstbtn" );   
                        count +=1;
                    }
                else
                {
                    $('#mail').removeClass( "frstbtn" );
                }


                if($('#phoneNo').val().length == 0)
                  {
                    $('#phoneNo').addClass( "frstbtn" );   
                    count +=1;
                  }
                else
                {
                    $('#phoneNo').removeClass( "frstbtn" );
                } 


                if($('#dropdown-font').val().length == 0)
                  {
                    $('#dropdown-font').addClass( "frstbtn" );
                    count +=1;   
                  }
                else
                {
                    $('#dropdown-font').removeClass( "frstbtn" );
                }


                if($('#msg').val().length == 0)
                  {
                    $('#msg').addClass( "frstbtn" );   
                    count +=1;
                  }  
                else
                {
                    $('#msg').removeClass( "frstbtn" );
                }
            
                
            }
                
            if(count > 0)
            {
                var data = {
                    FirstName : $('#first').val(),
                    Email : $('#mail').val(),
                    PhoneNum : $('#phoneNo').val(),
                    Country : $('#dropdown-font').val(),
                    Message : $('#msg').val()
                };
               
                     $.ajax({
                        type: 'get',
                        url: '../Controller/BIZ/logic.php',
                        data: data,
                        success: function(){
                            alert('It was a sucess');
                        }

                     });

                 }

        };

    </script>
</head>

<body>
    <!--Navigation Bar -->
    <div id="Header"></div>

    <div class="container contact-form">
        <div class="contact-image">
            <img src="../resources/traint.png" alt="train_2"/>
        </div>
        <form method="post">
            <h3>Drop Us a Message</h3>
           <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" id="first" name="txtName" class="form-control" placeholder="Your Name *" value="" />
                    </div>
                    <div class="form-group">
                        <input type="text" id="mail" name="txtEmail" class="form-control" placeholder="Your Email *" value="" />
                    </div>
                    <div class="form-group">
                        <input type="text" id= "phoneNo" name="txtPhone" class="form-control" placeholder="Your Phone Number *" value="" />
                    </div>
                    <label for="contact" id= "cntry">Country*</label>
                    <br/><br/>

                    <select name="dropdown-T" id="dropdown-font">
                        <option value="country">country 1</option>
                        <option value="country">country 2</option>
                        <option value="country">country 3</option>
                        <option value="country">country 4</option>
                        <option value="country">country 5</option>
                        <option value="country">country 6</option>
                        <option value="country">country 7</option>
                        <option value="country">country 8</option>

                    </select>
                </br></br>
                    <div class="form-group">
                        <input type="button" id="sbmit" name="btnSubmit" class="btnContact" value="Send Message" onclick="clickfunction()"/>
                        </div>

                     


                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <textarea name="txtMsg" id= "msg"class="form-control" placeholder="Your Message *" value= "" style="width: 100%; height: 150px;"></textarea>
                    </div>
                </div>
            </div>
        </form>
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
