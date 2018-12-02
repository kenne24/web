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

if( isset($_POST["lecturername"]) || isset($_POST["department"]) ){
    $name = trim('%{$_POST["lecturername"]}%');
    $department = trim($_POST["department"]);

    $sql = "SELECT p.firstname, p.lastname, p.faculty, p.department, u.active, f.facultyname, d.departmentname FROM profile p INNER JOIN users u ON p.username = u.username INNER JOIN faculties f ON p.faculty = f.facultyid INNER JOIN departments d ON p.department = d.departmentid WHERE (p.department = ?) || (p.firstname OR p.lastname LIKE ?)";
    if($stmt = mysqli_prepare($mysqli, $sql)) {

        //bind parameters to insert query with information
        mysqli_stmt_bind_param($stmt, "ss", $param_department, $param_name);
        $param_department = $department;
        $param_name = $name;

        //attempt query execution
        if (mysqli_stmt_execute($stmt)) {
            $result = $stmt->get_result(); //get result of query
            $row = $result->fetch_assoc();
            //create table with headers
            if($result->num_rows > 0){
                $output .="<h4 align='center'>Search Results</h4>";
                $output .="<table class='table table-borderless table-striped thead-light'>
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Faculty</th>
                                <th>Department</th>
                                <th>View Profile</th>
                                <th>View Resume</th>
                            </tr>";

                //enter data into table
                while($row){
                    if($row["active"] == 1){
                        //if their profile is active, enter the data
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