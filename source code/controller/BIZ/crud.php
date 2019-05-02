<?php

require "../../Config/config.php";
class crud
{
    function addNewUser($objUser){

        global $conn;

        $sql_query = "CALL SP_ADD_NEW_USER('". mysqli_real_escape_string($conn, $objUser->getFirstName()) ."',
                                                '". mysqli_real_escape_string($conn, $objUser->getLastName())."',
                                                '".$objUser->getRoleID()."',
                                                '".$objUser->getEmail()."',
                                                '".$objUser->getGender()."',
                                                '".$objUser->getPhone()."',
                                                '".$objUser->getDOB()."',
                                                '".$objUser->getPassword()."')";

        $result = mysqli_query($conn, $sql_query) or die("Query fail: " . mysqli_error());

        // Associative array
        $row=mysqli_fetch_array($result,MYSQLI_ASSOC);

        mysqli_close($conn);

        echo  $row["result"];
    }

    function checkMailIsExists($Email){
        global $conn;

        $sql_query = "CALL SP_CHECK_EMAIL_IS_EXIXTS('". mysqli_real_escape_string( $conn ,$Email) ."')";

        $result = mysqli_query($conn, $sql_query) or die("Query fail: " . mysqli_error());

        // Associative array
        $row=mysqli_fetch_array($result,MYSQLI_ASSOC);

        mysqli_close($conn);

        return  $row["result"];

    }

    function verificationAccountByEmail($email){
        global $conn;

        $sql_query = "CALL SP_VERIFICATION_ACCOUNT('". mysqli_real_escape_string( $conn ,$email) ."')";

        $result = mysqli_query($conn, $sql_query) or die("Query fail: " . mysqli_error());

        // Associative array
        $row=mysqli_fetch_array($result,MYSQLI_ASSOC);

        mysqli_close($conn);

        return  $row["result"];

    }

    function  authenticateUserLogin($email, $password){
        global $conn;

        $sql_query = "CALL SP_CHECK_USER_LOGIN('". mysqli_real_escape_string( $conn ,$email) ."','". mysqli_real_escape_string( $conn ,$password) ."')";

        $result = mysqli_query($conn, $sql_query) or die("Query fail: " . mysqli_error());

        // Associative array
        $row=mysqli_fetch_array($result,MYSQLI_ASSOC);

        return $row;

    }

    function getUserByEmail($email){
        global $conn;


        $sql_query = "CALL SP_GET_USER_BY_EMAIL('". mysqli_real_escape_string( $conn ,$email) ."')";


        $result = mysqli_query($conn, $sql_query);

        // Associative array
        $row=mysqli_fetch_array($result,MYSQLI_ASSOC);

        return $row;

    }

    function getUserByID($userID){
        global $conn;


        $sql_query = "CALL GET_USER_BY_ID('". mysqli_real_escape_string( $conn ,$userID) ."')";


        $result = mysqli_query($conn, $sql_query);

        // Associative array
        $row=mysqli_fetch_array($result,MYSQLI_ASSOC);

        return $row;

    }

    function  getUserListForAdminPanel(){
        global $conn;


        $sql_query = "CALL SP_GET_USERS_FOR_ADMIN_VIEW()";


        $result = mysqli_query($conn, $sql_query);


        $array = array();

        while ($row = mysqli_fetch_assoc($result))
        {
            array_push($array, $row);
        }

        // Associative array
        //$row=mysqli_fetch_array($result,MYSQLI_ASSOC);

        return $array;
    }

    function  getAllRoles($currentUserRoleID){
        global $conn;


        $sql_query = "CALL SP_GET_ALL_ROLES('".$currentUserRoleID."')";


        $result = mysqli_query($conn, $sql_query);


        $array = array();

        while ($row = mysqli_fetch_assoc($result))
        {
            array_push($array, $row);
        }

        // Associative array
        //$row=mysqli_fetch_array($result,MYSQLI_ASSOC);

        return $array;
    }

    function updateUserByAdmin($objUser){
        global $conn;
        $sql_query = "CALL SP_UPDATE_USER_BY_ADMIN('". mysqli_real_escape_string($conn, $objUser->getUserName()) ."',
                    '". mysqli_real_escape_string($conn, $objUser->getRoleID()) ."',
                    '". mysqli_real_escape_string($conn, $objUser->getFirstName()) ."',
                    '". mysqli_real_escape_string($conn, $objUser->getLastName()) ."',
                    '". mysqli_real_escape_string($conn, $objUser->getGender()) ."',
                    '". mysqli_real_escape_string($conn, $objUser->getPhone()) ."',
                    '". mysqli_real_escape_string($conn, $objUser->getDOB()) ."',
                    '". mysqli_real_escape_string($conn, $objUser->getIsActive()) ."')";

        $result = mysqli_query($conn, $sql_query);
        $row=mysqli_fetch_array($result,MYSQLI_ASSOC);

        return $row;
    }

}