<?php
require_once "config.php";
session_start();

$result = $output = "";
$name = $department = "";
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

if( isset($_POST["search"]) || isset($_POST["dept"]) ){
    $name = trim('%{$_POST["search"]}%');
    $department = trim($_POST["dept"]);
    $sql = "";

        $sql = "SELECT * FROM profile p INNER JOIN users u ON p.username = u.username INNER JOIN faculties f ON p.faculty = f.facultyid INNER JOIN departments d ON p.department = d.departmentid WHERE (p.department = '" . $_POST["dept"] . "') OR p.firstname LIKE '%" . $_POST["search"] . "%' OR p.lastname LIKE '%" . $_POST["search"] . "%'";

        if($stmt = mysqli_prepare($mysqli, $sql)) {

        //bind parameters to insert query with information
        //attempt query execution
        if (mysqli_stmt_execute($stmt)) {
            $result = $stmt->get_result(); //get result of query
            //create table with headers
            if($result->num_rows > 0){
                $output .="<h5 align='center'>Lecturers</h5>";
                $output .="<table class='table'>
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Faculty</th>
                                <th>Department</th>
                                <th>View Profile</th>
                                <th>View Resume</th>
                            </tr>";

                //enter data into table
                while($row = $result->fetch_assoc()){
                    if($row["searchable"] == 1){
                        //if their profile is active, display the data
                        $output .= "<tr>
                                        <td>".$row["firstname"]."</td>
                                        <td>".$row["lastname"]."</td>
                                        <td>".$row["facultyname"]."</td>
                                        <td>".$row["departmentname"]."</td>
                                        <td>Link to Profile here</td>
                                        <td>Link to Resume here</td>
                                    </tr>";
                    }
                }
                echo $output;
            }
            else{
                echo "No Lecturer found";
            }

        }
        else{
            echo "An error occurred: \n" . mysqli_stmt_error($stmt);
        }
    }
    else{
        echo "Invalid query, failed to prepare: \n" . mysqli_stmt_error($stmt);
    }
}
?>