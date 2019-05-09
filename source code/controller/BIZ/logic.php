<?php
    include 'AES.php';
    include 'customMailSender.php';
    include '../../Model/user.php';
    include '../../Model/EmailContent.php';
    include 'crud.php';
    include '../../View/sessionWorker.php';

    session_start();

    $configs = include('../../Config/settings.php');

    //begin <Encryption method>
    function EncryptData($Data){

        global $configs;

        $imputKey = $configs['vector'];
        $blockSize = 256;
        $aes = new AES($Data, $imputKey, $blockSize);

        $enc = $aes->encrypt();



        echo $enc;

    }

    function EncryptDataForBackend($Data){

        global $configs;

        $imputKey = $configs['vector'];
        $blockSize = 256;
        $aes = new AES($Data, $imputKey, $blockSize);

        $enc = $aes->encrypt();



        return $enc;

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

    //end <Encryption method>

    //begin <user registration methods>
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
            $objMailContent->setRedirectURL($configs['siteurl'].'login.php?varificationMail='.$ReceverAddress);
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

    function checkIfAdmin(){
        if(isset($_SESSION)){
            if($_SESSION['RoleID'] == '3' || $_SESSION['RoleID'] == '4'){
                echo true;
            }else{
                echo false;
            }
        }else{
            echo false;
        }
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

    function verificationAccount($email){
        $objCRUD = new crud();  // crud operation object

        $result = $objCRUD->verificationAccountByEmail($email);

        echo  $result;
    }

    function AuthenticateUserLogin($email, $password){
        $objCRUD = new crud();  // crud operation object

        $result = $objCRUD->authenticateUserLogin($email, EncryptDataForBackend($password));


        //to Json
        $jsonResult = json_encode($result, JSON_PRETTY_PRINT);

        echo $jsonResult;

    }

    function getUserByEmail($email){
        $objCRUD = new crud();  // crud operation object

        $result = $objCRUD->getUserByEmail($email);


        //to Json
        $jsonResult = json_encode($result, JSON_PRETTY_PRINT);

        echo $jsonResult;
    }

    function getUserByID($userID){
        $objCRUD = new crud();  // crud operation object

        $result = $objCRUD->getUserByID($userID);


        //to Json
        $jsonResult = json_encode($result, JSON_PRETTY_PRINT);

        echo $jsonResult;
    }


    //end <user registration methods>

    //begin <admin panel methods

    function getUsersForAdmin(){
        $objCRUD = new crud();  // crud operation object

        $result = $objCRUD->getUserListForAdminPanel();

        //to Json
        $jsonResult = json_encode($result, JSON_PRETTY_PRINT);

        echo $jsonResult;

    }

    function getRoles($RoleID){
        $objCRUD = new crud();  // crud operation object

        $result = $objCRUD->getAllRoles($RoleID);

        //to Json
        $jsonResult = json_encode($result, JSON_PRETTY_PRINT);

        echo $jsonResult;
    }

    function getTrainListForAdminPanel(){
        $objCRUD = new crud();  // crud operation object

        $result = $objCRUD->getTrainListForAdminPanel();

        //to Json
        $jsonResult = json_encode($result, JSON_PRETTY_PRINT);

        echo $jsonResult;
    }


    //end <admin panel methods>

    function checkEmailIsExixts($Email){
        $objCRUD = new crud();  // crud operation object

        echo $objCRUD->checkMailIsExists($Email);
    }

    function updateUserByAdmin($userObject){
        $user = json_decode($userObject);   //decode json

        $objUser = new user(); // user object

        //set user details
        $objUser->setUserName($user->UserID);
        $objUser->setFirstName($user->FirstName);
        $objUser->setLastName($user->LastName);
        $objUser->setRoleID($user->Role);
        $objUser->setPhone($user->Phone);
        $objUser->setDOB($user->DOB);
        $objUser->setGender($user->Gender);
        $objUser->setIsActive($user->isActive);

        $objCRUD = new crud();  // crud operation object

        $result = $objCRUD->updateUserByAdmin($objUser);

        echo  $result["result"];
    }

    function getActiveActiveClasses(){
        $objCRUD = new crud();  // crud operation object

        $result = $objCRUD->getAllActiveClasses();

        //to Json
        $jsonResult = json_encode($result, JSON_PRETTY_PRINT);

        echo $jsonResult;
    }


    //begin <fetch each ajax calls>

    if(isset($_GET['ifAdmin'])){
        //echo $_POST['EncryptData'];
        checkIfAdmin();
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

    if(isset($_POST['verificationEmail'])){
        //echo $_POST['EncryptData'];
        verificationAccount($_POST['verificationEmail']);
    }

    if(isset($_POST['AuthEmail']) && isset($_POST['AuthPassword'])){
        //echo $_POST['ReceverAddress'].$_POST['ReceverName'];
        AuthenticateUserLogin($_POST['AuthEmail'],$_POST['AuthPassword']);
    }

    if(isset($_GET['userList'])){
        //echo $_POST['EncryptData'];
        getUsersForAdmin();
    }

    if(isset($_GET['trainListForAdminPanel'])){
        //echo $_POST['EncryptData'];
        getTrainListForAdminPanel();
    }

    if(isset($_GET['getUserByEmail'])){
        //echo $_POST['EncryptData'];
        getUserByEmail($_GET['getUserByEmail']);
    }

    if(isset($_GET['getUserByID'])){
        //echo $_POST['EncryptData'];
        getUserByID($_GET['getUserByID']);
    }

    if(isset($_GET['getRoles'])){
        //echo $_POST['EncryptData'];
        getRoles($_GET['getRoles']);
    }

    if(isset($_POST['updateUserByAdmin'])){
        //echo $_POST['EncryptData'];
        updateUserByAdmin($_POST['updateUserByAdmin']);
    }

    if(isset($_GET['getActiveActiveClasses'])){
        //echo $_POST['EncryptData'];
        getActiveActiveClasses($_GET['getActiveActiveClasses']);
    }

    //end <fetch each ajax calls>

?>