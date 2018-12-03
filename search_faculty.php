<?php
require_once "config.php";
session_start();

$lecturer = $department = "";
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from preview.uideck.com/items/thehunt/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 08 Nov 2018 20:45:44 GMT -->
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="Bootstrap, Landing page, Template, Registration, Landing">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="author" content="Grayrids">
    <title>TheHunt - Bootstrap HTML5 Job Portal Template</title>


    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/line-icons.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/owl.theme.default.css">
    <link rel="stylesheet" href="assets/css/slicknav.min.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
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
                        <li class="nav-item dropdown active">
                            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Home
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item active" href="index-2.html">Home 1</a></li>
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

    <div class="container">
        <div class="row space-100">
            <div class="col-lg-7 col-md-12 col-xs-12">
                <div class="contents">
                    <h2>Search for Lecturer</h2>
                    <div class="job-search-form">
                        <div class="row">
                            <div class="col-lg-5 col-md-5 col-xs-12">
                                <div class="form-group">
                                    <input id="lecturername" name="lecturername" class="form-control" type="text" placeholder="All Lecturers">
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-5 col-xs-12">
                                <div class="form-group">
                                    <div class="search-category-container">
                                        <label class="styled-select">
                                            <select id="department" name="department">
                                                <option value="0">All Departments</option>
                                                <?php
                                                $sql = mysqli_query($mysqli, "SELECT * FROM departments");
                                                while($row = $sql->fetch_assoc()){
                                                    echo "<option value=".$row['departmentid'].">".$row['departmentname']."</option>";
                                                }
                                                ?>
                                            </select>
                                        </label>
                                    </div>
                                    <i class="lni-map-marker"></i>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-xs-12">
                                <button id="name-submit" type="submit" class="button">Search by Name<i class="lni-search"></i></button>
                            </div>
                            <div class="col-lg-2 col-md-2 col-xs-12">
                                <button id="department-submit" type="submit" class="button">Search by Department<i class="lni-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</header>

<div class="container" id="result">
</div>

<a href="#" class="back-to-top">
    <i class="lni-arrow-up"></i>
</a>

<script src="assets/js/jquery-min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/owl.carousel.min.js"></script>
<script src="assets/js/jquery.slicknav.js"></script>
<script src="assets/js/jquery.counterup.min.js"></script>
<script src="assets/js/waypoints.min.js"></script>
<script src="assets/js/form-validator.min.js"></script>
<script src="assets/js/contact-form-script.js"></script>
<script src="assets/js/main.js"></script>

<script>
    $(document).ready(function(){

        //search button clicked
        $("#department-submit").on("click", function(){
            let name = $("#lecturername").val();
            let department = $("#department").find('option:selected').val();
            //ajax request to search
            $.ajax({
                url: "search_faculty_deptaction.php?dept",
                method: "post",
                data:  {search:name, dept: department},
                dataType: "text",
                success: function(data)
                {
                    $("#result").html(data);
                }
            });
        });

        $("#name-submit").on("click", function(){
            let name = $("#lecturername").val();
            let department = $("#department").find('option:selected').val();
            //ajax request to search
            $.ajax({
                url: "search_faculty_nameaction.php?name",
                method: "post",
                data:  {search:name, dept: department},
                dataType: "text",
                success: function(data)
                {
                    $("#result").html(data);
                }
            });
        });
    });
</script>
</body>

</html>