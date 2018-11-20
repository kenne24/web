<?php
/**
 * Created by PhpStorm.
 * User: rapha
 * Date: 17/11/2018
 * Time: 00:20
 */

?>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>Register</title>
</head>

<body>
    <div id="wrap">
        <?php
            require_once "config.php";
            if (isset($_GET["email"]) && isset($_GET["hash"]) ) {
                $ubemailemail = $_GET["email"];
                $hash = $_GET["hash"];

                //had email in $sql query but in different table so removed, hash should work the same
                $sql = "SELECT hash, active FROM users WHERE hash=" . $hash . " AND verificationstatus = '0'";

                if (mysqli_stmt_execute($stmt)) {
                    $result = mysqli_query($link, $sql);
                    $rows = mysqli_num_rows($result);
                    echo $rows;

                    if($rows > 0){
                        //there is a match, set the account to be active
                        mysqli_query($link, "UPDATE users SET active='1' WHERE hash=".$hash." AND active='0'" ) or die(mysqli_error($link));
                        header("location: login.php");
                    }
                    else{
                        //invalid url or account has already been activated
                        echo "The url is either invalid or the account has already been activated.";
                    }
                }
                else{
                    echo "Invalid approach, please use link sent to your email provided";
                }
            }
        ?>
    </div>
</body>

</html>