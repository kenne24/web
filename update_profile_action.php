<?php
session_start();

require_once "config.php";

//get info from form
$title = $_POST["title"];
$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$status = $_POST["status"];
$dateofbirth = $_POST["dateofbirth"];
$personalemail = $_POST["personalemail"];
$cellnumber = $_POST["cellnumber"];
$street = $_POST["street"];
$city = $_POST["city"];
$district = $_POST["district"];

// Prepare an insert statement
$sql = "UPDATE profile SET firstname = ?, lastname = ?, title = ?, dob = ?, personalemail = ?, phone = ?, district = ?, city = ?, street = ? WHERE username = ?";

if($stmt = $mysqli->prepare($sql)){

    // Bind variables to the prepared statement as parameters
    $stmt->bind_param("ssssssssss",$param_firstname, $param_lastname, $param_title, $param_dateofbirth, $param_personalemail, $param_phone, $param_district, $param_city, $param_street, $param_username);

    // bind parameters
    $param_firstname = $firstname;
    $param_lastname = $lastname;
    $param_title = $title;
    $param_dateofbirth = $dateofbirth;
    $param_personalemail = $personalemail;
    $param_phone = $cellnumber;
    $param_street = $street;
    $param_city = $city;
    $param_district = $district;
    $param_username = $_SESSION["username"];
    // Attempt to execute the prepared statement to update profile information
    if($stmt->execute()){
        //if executed, redirect to welcome.php (welcome page)
        header("location: welcome.php");
        //update the active flag if changed in the users table
        $sql = "UPDATE users SET active = ? WHERE username = ?";

        if($stmt = $mysqli->prepare($sql)){
            $stmt->bind_param("ss", $param_status, $param_username);

            //set parameters
            $param_status = $status;
            $param_username = $_SESSION["username"];
            //attempt to execute prepared statement
            if($stmt->execute()){

            }
            else{
                echo "Error occured when updating status";
            }
        }

    } else{
        echo "Something went wrong. Please try again later.";
    }
}

// Close statement
$stmt->close();

// Close connection
$mysqli->close();