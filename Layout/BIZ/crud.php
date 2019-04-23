<?php

require "../../Config/config.php";
class crud
{
    function addNewUser($objUser){

        global $conn;

        $sql_query = "CALL SP_ADD_NEW_USER('".$objUser->getFirstName()."',
                                                '".$objUser->getLastName()."',
                                                '".$objUser->getRoleID()."',
                                                '".$objUser->getEmail()."',
                                                '".$objUser->getGender()."',
                                                '".$objUser->getPhone()."',
                                                '".$objUser->getDOB()."',
                                                '".$objUser->getPassword()."')";

        $result = mysqli_query($conn, $sql_query) or die("Query fail: " . mysqli_error());

        //loop the result set
        /*while ($row = mysqli_fetch_array($result)){
            echo $row[0] . " - " . + $row[1];
        }*/

        echo  $result;
    }
}