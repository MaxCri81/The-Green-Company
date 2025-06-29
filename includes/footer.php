<?php
// For security, required PHP files should "die" if SAFE_TO_RUN is not defined
if (!defined('SAFE_TO_RUN')) {
    // Prevent direct execution - show a warning instead
    die(basename(__FILE__)  . ' cannot be executed directly!');
}
?>

<footer class='bg-light py-3'>
    <div class="container">
        <div class="row py-2">
            <div  class="col-lg-6 pb-3">
                <a class="nav-link py-1" href="#">About</a>
                <a class="nav-link py-1" href="#">Services</a>
                <a class="nav-link py-1" href="#">Contact</a>
                <div class="py-3">
                    <span id="footer-icon" >
                        <a href=""><i class="fa-brands fa-linkedin"></i></a>
                        <a href=""><i class="fab fa-instagram"></i></a>
                        <a href=""><i class="fab fa-flickr"></i></a>
                    </span>
                </div>
            </div>
            <div class="col-lg-6 pb-3">
                <p class="lead">Sign Up Today</p>
                <p>Fill out to subscribe to our newsletter</p>

                <form action="index.php" method="post" id='footer_form'>
                    <div class="input-group">
                        <input name='email' type="email" class='' placeholder="Enter your Email"  required>
                        <span class="input-group-btn">
                            <button class="" name='submitEmail' type='submit'><i class="fa-solid fa-envelope"></i></button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <div class="row pt-3">
            <div class="col">
                <p>Copyright &copy; Pianeta Verde <?php print _e(date('Y')); ?></p>
            </div>
        </div>            
</footer>