<?php 
// Define a constant to permit each file we "require" to execute
// For security, required PHP files should "die" if SAFE_TO_RUN is not defined
define('SAFE_TO_RUN', true);
require 'includes/header.php'; 

$id = $_SESSION['id'];
$row = retrieve_all_data(select_by_id('users','id',$id));

#Edit User
if(isset($_POST['update'])) {

    //Password encryption
    $my_pass =  password_hash($_POST['password'], PASSWORD_BCRYPT, array('cost' => 10));
        
    $query = "UPDATE users SET username = ?, password = ?, firstname = ?, lastname = ?, email = ?, role = ? WHERE id = ?";

    // Prepare statement using SQL command
    if (!($stmt = $connection->prepare($query))) {
        die("Error preparing statement ($query): $connection->error");
    }

    // Bind parameters for UPDATE statement ('s' for each column plus 's' for id)
    if (!$stmt->bind_param('sssssss', $_POST['username'], $my_pass, $_POST['firstname'], $_POST['lastname'],
        $_POST['email'], $role, $id)) {
        die("Error binding statement ($query): $stmt->error");
    }

    // Execute statement and count inserted/updated rows
    if ($stmt->execute()) {
        $rows = $stmt->affected_rows;
    } else {
        die("Error executing statement ($query): $stmt->error");
    }

    if ($id and $rows == 0) {
        echo '<div class="report message always">
            Server message: Row with id=' . _x($id) . ' was not changed - either it does not exist or its values did not change
        </div>';
    }

    if (!$id and $rows == 0) {
        die("No row was inserted ($query)");
    }
    
    // insert_query2($query);
    header("Location: profile.php");
}
?>
<body>
    <div class="wrapper">
        <!-- Sidebar  -->
        <?php require 'includes/sidebar.php'; ?>

        <!-- Page Content  -->
        <div id="content">

            <?php require 'includes/navbar.php'; ?>

            <form action="" method="post" enctype="multipart/form-data">
                <!-- <div class="form-row">
                    <div class='form-group col-md-6'>
                        <select name="role" id="">
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        </select>
                    </div>
                </div>  -->
                <div class="form-row">
                    <div class='form-group col-md-6'>
                        <label for='firstname'>Firstname</label>
                        <input type="text" name='firstname' class="form-control" value="<?php print _e($row, 'firstname'); ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class='form-group col-md-6'>
                        <label for='lastname'>Lastname</label>
                        <input type="text" name='lastname' class="form-control" value="<?php print _e($row, 'lastname'); ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class='form-group col-md-6'>
                        <label for='email'>Email</label>
                        <input type="email" name='email' class="form-control" value="<?php print _e($row, 'email'); ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class='form-group col-md-6'>
                        <label for='username'>Username</label>
                        <input type="text" name='username' class="form-control" value="<?php print _e($row, 'username'); ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class='form-group col-md-6'>
                        <label for='password'>Password</label>
                        <input type="password" name='password' class="form-control" value="<?php print _e($row, 'password'); ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class='form-group col-md-6'>
                        <button class='btn btn-primary' name='update'>Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php require 'includes/footer.php' ?>
</body>
</html>