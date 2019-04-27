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
}