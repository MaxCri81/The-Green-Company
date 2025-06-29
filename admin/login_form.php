<?php
// Define a constant to permit each file we "require" to execute
// For security, required PHP files should "die" if SAFE_TO_RUN is not defined
define('SAFE_TO_RUN', true);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="../style.css" />

    <!-- Bootstrap CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/6ec2d91498.js" crossorigin="anonymous"></script>
    
    <title>The Green Company</title>

</head>
<body>
    <!--Navbar-->
    <nav class="navbar navbar-expand-sm navbar-light bg-light sticky-top py-0" id='user_navbar'>
        <div class="container">
            <div id="logo">
                <img src="../logo1.jpg" alt="" class="logo">
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="col-lg-4 col-md-6">
            <h4>Admin Login</h4>
            <form action="includes/login.php" method="post">
                <div class="form-group py-2">
                    <input name="username" type="text" class="form-control" placeholder='Username'>
                </div>
                <div class="form-group py-2">
                    <input name="password" type="password" class="form-control" placeholder='Password'>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" name='login' type='submit'>Login<i class="fa-solid fa-right-to-bracket"></i></button>
                </div>
            </form>
        </div>
    </div>
   
</body>
</html>