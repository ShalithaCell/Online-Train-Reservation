<?php

session_start();

function setSession($userObject){

    $_SESSION = array();
    session_destroy();

    session_start();

    $user = json_decode($userObject);

    $_SESSION['UserID'] = $user->UserID;
    $_SESSION['RoleID'] = $user->RoleID;
    $_SESSION['FirstName'] = $user->FirstName;
    $_SESSION['LastName'] = $user->LastName;
    $_SESSION['Email'] = $user->Email;
    $_SESSION['GenderID'] = $user->Gender;
    $_SESSION['ContactNo'] = $user->ContactNo;
    $_SESSION['DOB'] = $user->DOB;

}

if(isset($_POST['setSession'])){
    setSession($_POST['setSession']);
}

?>
