<?php
    include 'AES.php';
    include 'customMailSender.php';
    include '../../Model/user.php';
    include '../../Model/EmailContent.php';
    include 'crud.php';

    $configs = include('../../Config/settings.php');



    function sendVerificationMail($ReceverAddress, $ReceverName){

        try{
            global $configs;



            $objMail = new customMailSender();
            $objMailContent = new EmailContent();

            //read template
            $fileContent = file_get_contents("../../resources/EmailTemplates/verifyemail.txt");



            $objMailContent->setReceverAddress($ReceverAddress);
            $objMailContent->setReceverName($ReceverName);
            $objMailContent->setSiteURL($configs['sitehomepage']);
            $objMailContent->setRedirectURL($configs['siteurl'].'login.html?varificationMail='.$ReceverAddress);
            $objMailContent->setSubject("BOOKit User Account Verification");



            //$fileContent = sprintf($fileContent,$objMailContent->getSiteURL(), $objMailContent->getReceverName(), $objMailContent->getRedirectURL(), $objMailContent->getSiteURL());

            $fileContent = sprintf($fileContent,"First", $objMailContent->getSiteURL(), "HomeURLSet", $objMailContent->getReceverName(), $objMailContent->getRedirectURL(), $objMailContent->getSiteURL(), "homeURL");



            $objMailContent->setBody($fileContent);

            $result = $objMail->sendMail($objMailContent);

            echo $result;
        }
        catch (Exception $exception){
            echo  $exception;
        }


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

    function checkEmailIsExixts($Email){
        $objCRUD = new crud();  // crud operation object

        echo $objCRUD->checkMailIsExists($Email);
    }


    if(isset($_POST['Registration'])){
        Register($_POST['Registration']);
    }

    if(isset($_POST['EncryptData'])){
        //echo $_POST['EncryptData'];
        EncryptData($_POST['EncryptData']);
    }

    if(isset($_POST['ReceverAddress']) && isset($_POST['ReceverName'])){
        //echo $_POST['ReceverAddress'].$_POST['ReceverName'];
        sendVerificationMail($_POST['ReceverAddress'],$_POST['ReceverName']);

    }

    if(isset($_POST['CheckEmailAddress'])){
        //echo $_POST['EncryptData'];
        checkEmailIsExixts($_POST['CheckEmailAddress']);
    }


?>