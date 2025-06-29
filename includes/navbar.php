<?php
// For security, required PHP files should "die" if SAFE_TO_RUN is not defined
if (!defined('SAFE_TO_RUN')) {
    // Prevent direct execution - show a warning instead
    die(basename(__FILE__)  . ' cannot be executed directly!');
}
?>

<nav class="navbar navbar-expand-sm navbar-light bg-light sticky-top py-0" id='user_navbar'>
    <div class="container-fluid">
        <div id="logo">
            <img src="logo1.jpg" alt="" class="logo">
        </div>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
       
            <!-- <ul class="navbar-nav" id="">
                <li class='nav-item front-nav'>
                    <a class='nav-link ' href='admin/index.php'>Admin</a>
                </li> -->
                <?php show_all_categories(select_all_query('topics'), $id); ?>  
            <!-- </ul> -->
       
    </div>
</nav>