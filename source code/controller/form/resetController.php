<?php

include '../BIZ/logic.php';



function resetuserPassword($token,$password,$confirmPassword){

    $encryptedPassoword = EncryptDataForBackend($token);

    echo $encryptedPassoword;

}

if(isset($_POST["token"]) && isset($_POST["password"]) && isset($_POST["confirmPasswrd"]))
    resetuserPassword($_POST["token"], $_POST["password"],$_POST["confirmPasswrd"]);
?>
