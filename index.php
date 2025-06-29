<?php
// Allow debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Define a constant to permit each file we "require" to execute
// For security, required PHP files should "die" if SAFE_TO_RUN is not defined
define('SAFE_TO_RUN', true);

// Define _e and _x functions
require 'includes/functions.php';

//Starting Point
$id = starting_point(select_all_query('post_head'));

// navbar topic selection
if(isset($_POST['data'])){
  foreach ($_POST['data'] as $key => $value) {
    $id = $key;
  }
}

#whenever an image link is clicked
if(isset($_POST['linkID'])){
  $id = _x($_POST['linkID']);
}

if(isset($_POST['email'])){
  // check if the email is already in the database
  if(mysqli_num_rows(select_by_id('email', 'email', $_POST['email']))){
    print "<script type='text/javascript'>alert('Email already registered, try again!')</script>";
  } else {
    insert_query('email','email', $_POST['email']);
    print "<script type='text/javascript'>alert('Email successful registered!')</script>";
  }
  
}
// print $id;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="style.css" />
    <script defer src="script.js"></script>

    <!-- Bootstrap CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/6ec2d91498.js" crossorigin="anonymous"></script>
    
    <title>Pianeta Verde</title>

</head>
<body>
  <!--Navbar-->
  <?php include 'includes/navbar.php'; ?>

  <!--Header-->
  <?php show_header(select_by_id('post_head','id_topics',$id)); ?>

  <div class="py-3"></div>
 
  
  <!--Content-->
  <?php show_post_topic(select_by_id('post_topic','id_topics',$id)); ?>

  <div class="py-3"></div>
 
  <!--Footer-->
  <?php include 'includes/footer.php' ?>

  <!-- Carousel dipendencies -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
</body>
</html>