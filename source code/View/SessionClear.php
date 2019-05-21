<?php
include "sessionWorker.php";



function destroy(){
    $_SESSION = array();
    session_destroy();

    header("Location:login.php");
    exit();
}

if(isset($_POST["sessionOut"])){
    destroy();
}

?>
