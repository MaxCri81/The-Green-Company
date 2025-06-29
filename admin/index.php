<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Define a constant to permit each file we "require" to execute
// For security, required PHP files should "die" if SAFE_TO_RUN is not defined
define('SAFE_TO_RUN', true);

require 'includes/header.php';
?>

<body>
    <div class="wrapper">
        <!-- Sidebar  -->
        <?php include 'includes/sidebar.php'; ?>

        <!-- Page Content  -->
        <div id="content">

            <?php include 'includes/navbar.php'; ?>
            

            <h2></h2>
            <p></p>

            <div class="line"></div>

            <h2></h2>
            <p></p>

        </div>
    </div>

    <?php include 'includes/footer.php' ?>
</body>

</html>