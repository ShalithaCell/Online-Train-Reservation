<?php
    include 'AES.php';
    include 'customMailSender.php';
    include '../../Model/user.php';
    include '../../Model/EmailContent.php';
    include 'crud.php';
    include '../../View/sessionWorker.php';
    include 'ChromePhp.php';


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

    //begin <system methods>

    function generateRandomString() {
        $length = 15;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    //end <system methods>

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

        //ChromePhp::log(EncryptDataForBackend($password));

        //to Json
        $jsonResult = json_encode($result, JSON_PRETTY_PRINT);

        echo $jsonResult;

    }

    function getUserByEmail($email){
        $objCRUD = new crud();  // crud operation object

        $result = $objCRUD->getUserByEmail($email);


        //to Json
        $jsonResult = json_encode($result, JSON_PRETTY_PRINT);

        ChromePhp::log($jsonResult);
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


    //begin <user management>

    function resetPassword($email){
        $objCRUD = new crud();  // crud operation object

        $result = $objCRUD->getUserByEmail($email);

        $token = generateRandomString();

        $objCRUD->updateTokenRecords($result["UserID"], '1', $token);


        sendResetPaswordMail($result["Email"], $result["FirstName"], $token);

    }

    function sendResetPaswordMail($ReceverAddress, $ReceverName, $tokenNo){
        try{
            global $configs;



            $objMail = new customMailSender();
            $objMailContent = new EmailContent();

            //read template
            $fileContent = file_get_contents("../../resources/EmailTemplates/resetPassword.txt");



            $objMailContent->setReceverAddress($ReceverAddress);
            $objMailContent->setReceverName($ReceverName);
            $objMailContent->setSiteURL($configs['sitehomepage']);
            $objMailContent->setRedirectURL($configs['siteurl'].'reset.php?token='.$tokenNo);
            $objMailContent->setSubject("BOOKit User Account Password Reset");



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

    function resetUserPasswordByToken($token, $password){
        $objCRUD = new crud();  // crud operation object
    
        $result = $objCRUD->updateUserPassword($token, $password);
    
        return true;
    }


    //end <user management>


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

    function getStationsForAdminPanel(){
        $objCRUD = new crud();  // crud operation object

        $result = $objCRUD->getAllStations();

        //to Json
        $jsonResult = json_encode($result, JSON_PRETTY_PRINT);

        echo $jsonResult;
    }

    function addNewStation($objStaion){
        $objCRUD = new crud();  // crud operation object

        $jsonObj = json_decode($objStaion);   //decode json

        //ChromePhp::log($jsonObj);

        $objCRUD->addNewStation($jsonObj->station, $jsonObj->Description, $jsonObj->Distance );

        echo 'true';
    }

    function getStation($stationID){
        $objCRUD = new crud();  // crud operation object

        //ChromePhp::log($jsonObj);

        $result = $objCRUD->getStationByID($stationID);

        $jsonResult = json_encode($result, JSON_PRETTY_PRINT);

        echo $jsonResult;
    }

    function updateStation($station){
        $objCRUD = new crud();  // crud operation object

        $obj = json_decode($station);   //decode json

        //ChromePhp::log($jsonObj);

        $objCRUD->UpdateStation($obj->stationid, $obj->station, $obj->Description, $obj->Distance);

        echo 'true';
    }

    function removeStation($stationID){
        $objCRUD = new crud();  // crud operation object

        //ChromePhp::log($jsonObj);

        $objCRUD->RemoveStation($stationID);

        echo 'true';
    }

    function addNewTrain($trainDetails){
        $objCRUD = new crud();  // crud operation object
        $result = $objCRUD->insertNewTrain($trainDetails);

        //ChromePhp::log($jsonResult);

        //ChromePhp::log($jsonResult["train"][0]["name"]);



        //ChromePhp::log($result);
        echo $result;
    }

    function updateTrain($trainDetails,$trainID){
        $objCRUD = new crud();  // crud operation object
        $result = $objCRUD->UpdateTrain($trainDetails, $trainID);

        //ChromePhp::log($jsonResult);

        //ChromePhp::log($jsonResult["train"][0]["name"]);



        //ChromePhp::log($result);
        echo $result;
    }

    function getTrainByID($trainID){

        $objCRUD = new crud();  // crud operation object

        //ChromePhp::log($jsonObj);

        $result = $objCRUD->getTrainByID($trainID);

        $jsonResult = json_encode($result, JSON_PRETTY_PRINT);


        echo $jsonResult;
    }


    function getTrainClassesByTrainID($trainID){
        $objCRUD = new crud();  // crud operation object

        $result = $objCRUD->getTrainClassByID($trainID);

        //to Json
        $jsonResult = json_encode($result, JSON_PRETTY_PRINT);

        echo $jsonResult;
    }

    function getTrainScheduleByTrainID($trainID){
        $objCRUD = new crud();  // crud operation object

        $result = $objCRUD->getTrainScheduleByTrainID($trainID);

        //to Json
        $jsonResult = json_encode($result, JSON_PRETTY_PRINT);

        echo $jsonResult;
    }

    function removeTrain($trainID){
        $objCRUD = new crud();  // crud operation object

        $result = $objCRUD->removeTrain($trainID);

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


    //begin <fetch strain search page>

    function getTrainSchedule($objParams){
        $obj = json_decode($objParams);

        $objCRUD = new crud();  // crud operation object

        $result = $objCRUD->getTrainDetails($obj->From, $obj->To);

        $jsonResult = json_encode($result, JSON_PRETTY_PRINT);

        echo $jsonResult;
    }

    function getTrainClassesPrices($objParams){
            $obj = json_decode($objParams);

            $objCRUD = new crud();  // crud operation object

            $result = $objCRUD->getTrainClassesWithPrices($obj->From, $obj->To, $obj->train);

            $jsonResult = json_encode($result, JSON_PRETTY_PRINT);

            echo $jsonResult;
        }

    //end <fetch strain search page>



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
        getUsersForAdmin();
    }

    if(isset($_GET['trainListForAdminPanel'])){
        getTrainListForAdminPanel();
    }

    if(isset($_GET['getUserByEmail'])){
        getUserByEmail($_GET['getUserByEmail']);
    }

    if(isset($_GET['getUserByID'])){
        getUserByID($_GET['getUserByID']);
    }

    if(isset($_GET['getRoles'])){
        getRoles($_GET['getRoles']);
    }

    if(isset($_POST['updateUserByAdmin'])){
        updateUserByAdmin($_POST['updateUserByAdmin']);
    }

    if(isset($_GET['getActiveActiveClasses'])){
        getActiveActiveClasses($_GET['getActiveActiveClasses']);
    }

    if(isset($_POST['PasswordReset'])){
        resetPassword($_POST['PasswordReset']);
    }

    if(isset($_GET['getAllStations'])){
        getStationsForAdminPanel();
    }

    if(isset($_GET['saveStaion'])){
        addNewStation($_GET['saveStaion']);
    }

    if(isset($_GET['getStation'])){
        getStation($_GET['getStation']);
    }

    if(isset($_GET['updateStation'])){
        updateStation($_GET['updateStation']);
    }

    if(isset($_GET['removeStation'])){
        removeStation($_GET['removeStation']);
    }

    if(isset($_GET['addNewTrain'])){
        addNewTrain($_GET['addNewTrain']);
    }

    if(isset($_GET['getTrainByID'])){
        getTrainByID($_GET['getTrainByID']);
    }

    if(isset($_GET['getTrainClassByID'])){
        getTrainClassesByTrainID($_GET['getTrainClassByID']);
    }

    if(isset($_GET['getTrainSheduleByID'])){
        getTrainScheduleByTrainID($_GET['getTrainSheduleByID']);
    }

    if(isset($_GET['updateTrin']) && isset($_GET['TrainID'])){
        updateTrain($_GET['updateTrin'], $_GET['TrainID']);
    }

    if(isset($_GET['removeTrain'])){
        removeTrain($_GET['removeTrain']);
    }

    if(isset($_GET['getTrainSheduleByRefine'])){
        getTrainSchedule($_GET['getTrainSheduleByRefine']);
    }

    if(isset($_GET['getTrainSheduleClasPrice'])){
        getTrainClassesPrices($_GET['getTrainSheduleClasPrice']);
    }


//end <fetch each ajax calls>

?>