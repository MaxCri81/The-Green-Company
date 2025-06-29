<?php
// Define a constant to permit each file we "require" to execute
// For security, required PHP files should "die" if SAFE_TO_RUN is not defined
define('SAFE_TO_RUN', true);

require '../../includes/functions.php';
session_start();

if(isset($_POST['login'])){
    // $username = escape($_POST['username']);
    // $password = escape($_POST['password']);

    $username = $_POST['username'];
    $password = $_POST['password'];

    #check if the username match in the database
    $result_username = retrieve_all_data(select_by_id('users', 'username',  $username));

    #check if the password match with the ashed version in the database
    $result_password = password_verify($password, $result_username['password']);
    
    if($result_username && $result_password){
        #take data and store in the session for later use
        $_SESSION['id'] = $result_username['id'];
        $_SESSION['firstname'] = $result_username['firstname'];
        $_SESSION['lastname'] = $result_username['lastname'];
        $_SESSION['role'] = $result_username['role'];

        header("Location: ../index.php");
    } else {
        ?>
        <script>
        alert('Username or Password wrong, try again!');
        window.location.href='../login_form.php';
        </script>
       <?php
    }
}

?>