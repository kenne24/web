<?php
require_once "config.php";
session_start();

$title = $firstname = $lastname = $status = $dob = $personalemail = $cellnumber = $street = $city = $district = "";

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

//get information about user used to prefill form
$sql = "SELECT * FROM profile INNER JOIN users ON profile.username = users.username WHERE profile.username = ?";
if($stmt = mysqli_prepare($mysqli, $sql)) {

    //bind parameters to insert query with information
    mysqli_stmt_bind_param($stmt, "s", $param_username);
    $param_username = $_SESSION["username"];

    //attempt query execution
    if (mysqli_stmt_execute($stmt)) {
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        //get necessary info from results retrieved
        $title = $row["title"];
        $firstname = $row["firstname"];
        $lastname = $row["lastname"];
        $status = $row["active"];
        $dob = $row["dob"];
        $personalemail = $row["personalemail"];
        $cell = $row["phone"];
        $street = $row["street"];
        $city = $row["city"];
        $district = $row["district"];
    }
    else{
        echo "An error occurred: \n" . mysqli_stmt_error($stmt);
    }
}
else{
    echo "Invalid query: " . mysqli_stmt_error($stmt);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="Bootstrap, Landing page, Template, Registration, Landing">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Profile</title>

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/line-icons.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/owl.theme.default.css">
    <link rel="stylesheet" href="assets/css/slicknav.min.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</head>
<body>

<header id="home" class="hero-area">

    <nav class="navbar navbar-expand-lg fixed-top scrolling-navbar">
        <div class="container">
            <div class="theme-header clearfix">

                <div class="navbar-header">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-navbar" aria-controls="main-navbar" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        <span class="lni-menu"></span>
                        <span class="lni-menu"></span>
                        <span class="lni-menu"></span>
                    </button>
                    <a href="index-2.html" class="navbar-brand"><img src="assets/img/logo.png" alt=""></a>
                </div>
                <div class="collapse navbar-collapse" id="main-navbar">
                    <ul class="navbar-nav mr-auto w-100 justify-content-end">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Home
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="index-2.html">Home 1</a></li>
                                <li><a class="dropdown-item" href="index-3.html">Home 2</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Pages
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="about.html">About</a></li>
                                <li><a class="dropdown-item" href="job-page.html">Job Page</a></li>
                                <li><a class="dropdown-item" href="job-details.html">Job Details</a></li>
                                <li><a class="dropdown-item" href="resume.html">Resume Page</a></li>
                                <li><a class="dropdown-item" href="privacy-policy.html">Privacy Policy</a></li>
                                <li><a class="dropdown-item" href="faq.html">FAQ</a></li>
                                <li><a class="dropdown-item" href="pricing.html">Pricing Tables</a></li>
                                <li><a class="dropdown-item" href="contact.html">Contact</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Candidates
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="browse-jobs.html">Browse Jobs</a></li>
                                <li><a class="dropdown-item" href="browse-categories.html">Browse Categories</a></li>
                                <li><a class="dropdown-item" href="add-resume.html">Add Resume</a></li>
                                <li><a class="dropdown-item" href="manage-resumes.html">Manage Resumes</a></li>
                                <li><a class="dropdown-item" href="job-alerts.html">Job Alerts</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Employers
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="post-job.html">Add Job</a></li>
                                <li><a class="dropdown-item" href="manage-jobs.html">Manage Jobs</a></li>
                                <li><a class="dropdown-item" href="manage-applications.html">Manage Applications</a></li>
                                <li><a class="dropdown-item" href="browse-resumes.html">Browse Resumes</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Blog
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="blog.html">Blog - Right Sidebar</a></li>
                                <li><a class="dropdown-item" href="blog-left-sidebar.html">Blog - Left Sidebar</a></li>
                                <li><a class="dropdown-item" href="blog-full-width.html"> Blog full width</a></li>
                                <li><a class="dropdown-item" href="single-post.html">Blog Single Post</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact.html">
                                Contact
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="login.html">Sign In</a>
                        </li>
                        <li class="button-group">
                            <a href="post-job.html" class="button btn btn-common">Post a Job</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="mobile-menu" data-logo="assets/img/logo-mobile.png"></div>
    </nav>

</header>


<div class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="inner-header">
                    <h3>Update Your Profile</h3>
                </div>
            </div>
        </div>
    </div>
</div>


<section id="content" class="section-padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-8 col-xs-12">
                <div class="page-login-form box">
                    <h3>
                        Update Your Profile, <?php echo $_SESSION["username"]; ?>
                    </h3>
                    <fieldset id="editable" disabled>
                    <form id="update-profile" action="update_profile_action.php" method="post" class="login-form">
                        <label class="styled-select">
                            <select name="title">
                                <option value="Mr">Mr</option>
                                <option value="Ms">Ms</option>
                                <option value="Mrs">Mrs</option>
                                <option value="Dr">Dr</option>
                            </select>
                        </label>
                        <div class="form-group">
                            <div class="input-icon">
                                <i class="lni-user"></i>
                                <input type="text" class="form-control" name="firstname" placeholder="First Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-icon">
                                <i class="lni-user"></i>
                                <input type="text" class="form-control" name="lastname" placeholder="Last Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="styled-select">
                                <select name="status">
                                    <option value="0">Not Active</option>
                                    <option value="1">Active</option>
                                </select>
                            </label>
                        </div>
                        <div class="form-group">
                            <div class="input-icon">
                                <i style="z-index: 1001;" class="lni-calendar"></i>
                                <input style="z-index: 1000; position: relative;" type="text" id="datepicker" class="form-control" name="dateofbirth" placeholder="Date of Birth">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-icon">
                                <i class="lni-envelope"></i>
                                <input type="email" class="form-control" name="personalemail" placeholder="Personal Email">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-icon">
                                <i class="lni-phone"></i>
                                <input type="tel" class="form-control" name="cellnumber" placeholder="Cell Number">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-icon">
                                <i class="lni-home"></i>
                                <input type="text" class="form-control" name="street" placeholder="Street">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-icon">
                                <i class="lni-home"></i>
                                <input type="text" class="form-control" name="city" placeholder="Town/City">
                            </div>
                        </div>
                        <!--<div class="form-group">
                            <div class="input-icon">
                                <i class="lni-home"></i>
                                <input type="text" class="form-control" name="district" placeholder="District">
                            </div>
                        </div>-->
                        <div class="form-group">
                            <label class="styled-select">
                                <select name="district">
                                    <option value="0">Choose District</option>
                                    <option value="1">Corozal</option>
                                    <option value="2">OrangeWalk</option>
                                    <option value="3">Belize</option>
                                    <option value="4">Cayo</option>
                                    <option value="5">StannCreek</option>
                                    <option value="6">Toledo</option>
                                </select>
                            </label>
                        </div>
                    </fieldset>
                        <input id="update-button" type="button" class="btn btn-common log-btn" value="Update">
                        <!--<button id="update-button" onclick="confirmUpdate();" class="btn btn-common log-btn">Update</button>-->
                    </form>
                </div>
            </div>
            <!-- side column to have edit button-->
            <div class="offset-lg-2 col-lg-2 col-md-4 col-xs-4">
                <button id="edit-button" class="btn btn-common">Edit</button>
            </div>
        </div>
    </div>
</section>


<!--<footer>

    <section class="footer-Content">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-xs-12">
                    <div class="widget">
                        <div class="footer-logo"><img src="assets/img/logo-footer.png" alt=""></div>
                        <div class="textwidget">
                            <p>Sed consequat sapien faus quam bibendum convallis quis in nulla. Pellentesque volutpat odio eget diam cursus semper.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-4 col-xs-12">
                    <div class="widget">
                        <h3 class="block-title">Quick Links</h3>
                        <ul class="menu">
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Support</a></li>
                            <li><a href="#">License</a></li>
                            <li><a href="#">Contact</a></li>
                        </ul>
                        <ul class="menu">
                            <li><a href="#">Terms & Conditions</a></li>
                            <li><a href="#">Privacy</a></li>
                            <li><a href="#">Refferal Terms</a></li>
                            <li><a href="#">Product License</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-xs-12">
                    <div class="widget">
                        <h3 class="block-title">Subscribe Now</h3>
                        <p>Sed consequat sapien faus quam bibendum convallis.</p>
                        <form method="post" id="subscribe-form" name="subscribe-form" class="validate">
                            <div class="form-group is-empty">
                                <input type="email" value="" name="Email" class="form-control" id="EMAIL" placeholder="Enter Email..." required="">
                                <button type="submit" name="subscribe" id="subscribes" class="btn btn-common sub-btn"><i class="lni-envelope"></i></button>
                                <div class="clearfix"></div>
                            </div>
                        </form>
                        <ul class="mt-3 footer-social">
                            <li><a class="facebook" href="#"><i class="lni-facebook-filled"></i></a></li>
                            <li><a class="twitter" href="#"><i class="lni-twitter-filled"></i></a></li>
                            <li><a class="linkedin" href="#"><i class="lni-linkedin-fill"></i></a></li>
                            <li><a class="google-plus" href="#"><i class="lni-google-plus"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <div id="copyright">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="site-info text-center">
                        <p>Designed and Developed by <a href="https://uideck.com/" rel="nofollow">UIdeck</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</footer>-->


<a href="#" class="back-to-top">
    <i class="lni-arrow-up"></i>
</a>

<div id="preloader">
    <div class="loader" id="loader-1"></div>
</div>


<script src="assets/js/jquery-min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<!--<script src="assets/js/color-switcher.js"></script>-->
<script src="assets/js/owl.carousel.min.js"></script>
<script src="assets/js/jquery.slicknav.js"></script>
<script src="assets/js/jquery.counterup.min.js"></script>
<script src="assets/js/waypoints.min.js"></script>
<script src="assets/js/form-validator.min.js"></script>
<script src="assets/js/contact-form-script.js"></script>
<script src="assets/js/main.js"></script>
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!--//date picker functionality -->
<script>
    //user can select date and month
    //has to be 16 at least 16 years of age
    $(function(){
        $("#datepicker").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: "yy-mm-dd",
            maxDate: "-192M"
        });
    });
</script>

<script>
    $(document).ready(function(){
        //transfer php variables to javascript variables
        let salutation = "<?php echo $title ?>";
        let firstname = "<?php echo $firstname ?>";
        let lastname = "<?php echo $lastname ?>";
        let status = "<?php echo $status ?>";
        let dob = "<?php echo $dob ?>";
        let email = "<?php echo $personalemail ?>";
        let cell = "<?php echo $cellnumber ?>";
        let street = "<?php echo $street ?>";
        let city = "<?php echo $city ?>";
        let district = "<?php echo $district ?>";
        console.log(salutation);console.log(firstname);console.log(lastname);
        console.log(status);console.log(dob);console.log(email);
        console.log(cell);console.log(street);console.log(city);
        console.log(district);

        //match title option with title of user
        $("select[name='title']").val(salutation);

        //match first and last name fields with user's info
        $("input[name='firstname']").val(firstname);
        $("input[name='lastname']").val(lastname);

        //match activation status option with user's status
        $("select[name='status']").val(status);

        //match date of birth
        $("input[name='dateofbirth']").val(dob);

        //match email, cellnumber, street, town
        $("input[name='personalemail']").val(email);
        $("input[name='cellnumber']").val(cell);
        $("input[name='street']").val(street);
        $("input[name='city']").val(city);

        //match district
        $("select[name='district']").val(district);
        //make edit button red by default (profile not editable)
        $("#edit-button").css("backgroundColor", "red");

        //toggle between editable and not editable when edit button clicked
       $("#edit-button").on("click", function(){
           let e = $("#editable").prop('disabled');
           if (e == false){
               $("#editable").prop('disabled', 'disabled');
               $(this).css("backgroundColor", "red");
           }
           else{
               $("#editable").prop('disabled', false);
               $(this).css("backgroundColor", "green");
           }
       });

    });


    //update button clicked
    $("#update-button").on("click", function(){
        /*swal({
           title: "Confirm",
           text: "Ensure the information provided is correct.\nDo you wish to update your profile?",
           icon: "info",
           buttons: true,
           closeOnClickOutside: false,
       });*/

        let answer = confirm("Do you want to submit?");
        if(answer){
            //submit the form to update user information
            $("#update-profile").submit();
        }
    });
</script>
</body>

</html>