<?php

session_start();

function test(){
    $_SESSION['UserID'] = "sdfsdf";
    $_SESSION['RoleID'] = "3";

    echo true;
}

if(isset($_POST['setsettion'])){
    //echo $_POST['EncryptData'];
    test();
}

?>
