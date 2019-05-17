<?php

include '../BIZ/logic.php';



function resetuserPassword($token,$password,$confirmPassword){

    $encryptedPassoword = EncryptDataForBackend($password);

    $result = resetUserPasswordByToken($token,$encryptedPassoword);

    if($result == true){
        header('Location: '.'../../View/UserMessages.php?type=reset');
    }

}

if(isset($_POST["token"]) && isset($_POST["password"]) && isset($_POST["confirmPasswrd"]))
    resetuserPassword($_POST["token"], $_POST["password"],$_POST["confirmPasswrd"]);
?>
