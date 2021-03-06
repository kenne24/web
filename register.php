<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // store result
                $stmt->store_result();
                
                if($stmt->num_rows == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement

    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){

        //get variables from form
        $username = $_POST["username"];
        $firstname = $_POST["firstname"];
        $lastname = $_POST["lastname"];
        $title = $_POST["title"];
        $ubemail = $_POST["ubemail"];
        $personalemail = $_POST["personalemail"];


        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password, user_level, active, hash) VALUES (?,?,?,?,?)";

        if($stmt = $mysqli->prepare($sql)){
            $hash = md5(rand(0,1000)); //creates random code, used for verification email
            $userlevel = $_POST["account"];

            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("sssss", $param_username, $param_password, $param_user_level, $param_active, $param_hash);
            
            // Set parameters
            $username = $_POST["username"];
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_user_level = $userlevel;
            $param_active = "1";
            $param_hash = $hash;
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to login page
                header("location: login.php?msg=h&lev=".$userlevel);
                //send verification email
                $to = $ubemail;
                $subject = "Verify your Email";
                $message = wordwrap("Thank you for registering with us. Please click the link below to activate you account:
        localhost/web/verify.php?email=".$ubemail."&hash=".$hash."", 75);
                $headers = "From:noreply@localhost.com" . "\r\n";
                mail($to, $subject, $message, $headers);//send email

                //enter credentials into the profile table
                $sql = "INSERT INTO profile (username, firstname, lastname, title, ubemail, personalemail) VALUES (?,?,?,?,?,?)";

                if($stmt = $mysqli->prepare($sql)){
                    $stmt->bind_param("ssssss", $param_username, $param_firstname, $param_lastname, $param_title, $param_ubemail, $param_personalemail);

                    //set parameters
                    $param_username = $username;
                    $param_firstname = $firstname;
                    $param_lastname = $lastname;
                    $param_title = $title;
                    $param_ubemail = $ubemail;
                    $param_personalemail = $personalemail;
                    //attempt to execute prepared statement
                    if($stmt->execute()){

                    }
                    else{
                        echo "Error occured when inserting user profile";
                    }
                }

            } else{
                echo "Something went wrong. Please try again later.";
            }
        }

        // Close statement
        $stmt->close();
    }
    
    // Close connection
    $mysqli->close();
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
         <div class="form-group <?php echo (!empty($account)) ? 'has-error' : ''; ?>">
          <label>Account Type</label>
            <select id="account" name="account" class="form-control" value="<?php echo $account; ?>">
            <option value="2" > Student </option>
            <option value="1"> Lecturer </option>
            </select>
            </div>
            <div class="form-group">
                <input type="text" id="username" name="username" class="form-control" placeholder="Username">
                <span class="help-block"><?php echo $username_err; ?></span>
                <span id="username_err" style="display:none; color:#800000"> Field cannot be blank </span>
            </div>
            <div class="form-group">
            <label>Name</label>
            <table>
            <td width="23%">
            <select id="title" name="title" class="form-control" value="<?php echo $title; ?>">
                <option value="Mr"> Mr. </option>
                <option value="Ms" > Ms. </option>
                <option value="Mrs" > Mrs. </option>
                <option value="Dr" > Dr. </option>
            </select>
            </td>
            <td><input type="text" name="firstname" class="form-control" placeholder="First Name"></td>
            <td><input type="text" name="lastname" class="form-control" placeholder="Last Name"></td>
            </table>
            </div>
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Email</label>
                <input type="email" name="ubemail" class="form-control" value="<?php echo $username; ?>" placeholder="UB Email Address">
                <span id="email" style="display:none; color:#800000"> Invalid email address </span>
                <span id="UBemail" style="display:none; color:#800000"> Invalid UB email address </span>
            </div>
            <div class="form-group">
                <input type="email" name="personalemail" class="form-control" placeholder="Personal Email Address">
                <span id="email2" style="display:none; color:#800000"> Invalid email address </span>
            </div>
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
                <span id="password" style="display:none; color:#800000"> Passwords do not match </span>
            </div>
            <div class="form-group">
                <input type="submit" id="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>
</body>
<style>

.error-message {
background-color: #fce4e4;
}

</style>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"
integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous">
</script>
<script>

// Returns the email address sent if email is valid
function isValidEmailAddress( emailAddress ) {
    let pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i); //Creates regular expression to match valiables
    return pattern.test( emailAddress ); //If strings match returns email address
}

//Returns Boolean to check if email is a valid UB email
function validUBEmailAddress( email )
{
    let validate = email.split("@").pop(); // Gets all values @ in email address
    
    if ( isValidEmailAddress( email ) && ( validate === "ubstudents.edu.bz" || validate === "ub.edu.bz" ) ) //Checks it against these domain names
    {
        return true; // return true if it has these domains
    }
    else {
        
        return false; //Other wise return false
    }
}

 $( document ).ready( function() { //Waits until all elements on page are loaded before firing jquery

  $("#account").focus(); // Sets focus to drop down on page load
                     
   $("#username").on("blur", function(){
        
      if ($(this).val() === "")
      {
         $("#username_err").show(); //Show error
         $(this).addClass("error-message"); //Add error class
         $("#submit").prop("disabled",true); //Disable submit button
                     
      }
        else {
        $("#username_err").hide(); //Hide error
        $(this).removeClass("error-message"); //Remove error class
        $("#submit").prop("disabled",false); //Enable error class
      }
   });

 //Checks if confirm password and password match
 $( "input[name='confirm_password']" ).on("keyup", function (){
    
       if ( $("input[name='confirm_password']").val() != $("input[name='password']").val() ) //Check if passwords match
        {
               $("#password").show(); //Show error
               $(this).addClass("error-message"); //Add error class
               $("#submit").prop("disabled",true); //Disable sumbit button
         }
        else {
               $("#password").hide(); //Hide error
               $(this).removeClass("error-message"); //Remove error class
               $("#submit").prop("disabled",false); //Enable submit button
        }
    });

 $( "input[name='ubemail']" ).on("keyup", function (){ // Checks if email address is valid address
                                  
  let email = validUBEmailAddress ( $("input[name='ubemail']").val() ); //Passes UB email to function
                                 
   if ( email == false ) // if function returns false
     {
         $("#UBemail").show(); //Show error
         $(this).addClass("error-message"); //Add error class
         $("#submit").prop("disabled",true); //Disable submit button
     }
        else {
         $("#UBemail").hide(); //Else keep error hidden
         $(this).removeClass("error-message"); //Remove error class
         $("#submit").prop("disabled",false); // Enable submit button
     }
 });
                     
 $( "input[name='personalemail']" ).on("keyup", function (){ //Checks is email address is valid address
                                                     
    let email = $("input[name='personalemail']").val(); //Gets personal email
                                                     
     if ( isValidEmailAddress(email) ) // if function returns email
     {
         $("#email2").hide(); //Keep error hidden
         $(this).removeClass("error-message"); //Remove error class
         $("#submit").prop("disabled",false); // Enable submit button
     }
        else {
         $("#email2").show(); //Else show error
         $(this).addClass("error-message"); //Add error class
         $("#submit").prop("disabled",true); //Disable submit button
        }
});

/** $( "input[name='ubemail']" ).on("blur", function (){ // Checks if email address is valid UB address
                                 
    let email = validUBEmailAddress ( $("input[name='ubemail']").val() ); //Passes UB email to function
                                 
     if ( email == false ) // if function returns false
     {
         $("#UBemail").show(); //Show error
         $(this).addClass("error-message"); //Add error class
         $("#submit").prop("disabled",true); //Disable submit button
     }
       else {
        $("#UBemail").hide(); //Else keep error hidden
        $(this).removeClass("error-message"); //Remove error class
        $("#submit").prop("disabled",false); // Enable submit button
     }
}); **/
                    
}); //End of document ready

</script>
</html>
