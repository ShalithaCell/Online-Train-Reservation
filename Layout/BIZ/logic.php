<?php
    include 'AES.php';
    include 'customMailSender.php';
    include '../../Model/user.php';
    include 'crud.php';

    $configs = include('../../Config/settings.php');

    function sendMail($ReceverAddress){
        $objMail = new customMailSender();

        $result = $objMail->sendMail($ReceverAddress);

        echo $result;
    }

    function EncryptData($Data){

        global $configs;

        $imputKey = $configs['vector'];
        $blockSize = 256;
        $aes = new AES($Data, $imputKey, $blockSize);

        $enc = $aes->encrypt();



        echo $enc;

    }

    function DecryptData($Data){
        global $configs;

        $imputKey = $configs['vector'];
        $blockSize = 256;
        $aes = new AES($Data, $imputKey, $blockSize);

        $enc = $Data;
        $aes->setData($enc);
        $dec=$aes->decrypt();

        echo $dec;

    }

    function Register($userData){

        $user = json_decode($userData);   //decode json

        $objUser = new user(); // user object

        //set user details
        $objUser->setFirstName($user->FirstName);
        $objUser->setLastName($user->LastName);
        $objUser->setRoleID($user->Role);
        $objUser->setEmail($user->Email);
        $objUser->setPhone($user->Phone);
        $objUser->setDOB($user->DOB);
        $objUser->setPassword($user->Password);
        $objUser->setGender($user->Gender);

        $objCRUD = new crud();  // crud operation object

        $objCRUD->addNewUser($objUser);
    }


    if(isset($_POST['Registration'])){
        Register($_POST['Registration']);
    }

    if(isset($_POST['EncryptData'])){
        //echo $_POST['EncryptData'];
        EncryptData($_POST['EncryptData']);
    }

    if(isset($_POST['SendMail'])){
        //echo $_POST['EncryptData'];
        sendMail($_POST['SendMail']);

    }

?>