<?php 
// Define a constant to permit each file we "require" to execute
// For security, required PHP files should "die" if SAFE_TO_RUN is not defined
define('SAFE_TO_RUN', true);

require 'includes/header.php';

if(isset($_GET['deleteIMG'])){
    // split the GET string received (divided by /) into an array of 2 strings
    // $topicAndId = explode("/", $_GET['deleteIMG']);
    $topicAndId = explode("/", _x($_GET['deleteIMG']));
    print_r($topicAndId);/****** to continue***********/
    return;
    
    // table selection
    $id = _x($topicAndId[0]);
    $id_topic = _x($topicAndId[1]);

    //remove the images saved in the database for that paragraph
    delete_query('post_img','id_topics',$id);
    // Convert to $_Post
    header("Location: table_links.php?id=$id_topic");
}

//modify to $_Post
if(isset($_GET['id'])){
    // table selection
    $id_topic = _x($_GET['id']);
    require 'includes/edit_topic.php';
}

//Sidebar selection link
if(isset($_POST['data'])){
    foreach ($_POST['data'] as $key => $value) {
        $id_topic = $key;
    }
}

if(isset($_POST['update'])){
    $id_topic = $_POST['hidden_topic_id'];
    require 'includes/edit_topic.php';
}

?>

<body>
    <div class="wrapper">
        <!-- Sidebar  -->
        <?php include 'includes/sidebar.php'; ?>

        <!-- Page Content  -->
        <div id="content"> 
            <?php include 'includes/navbar.php'; ?>
            
            <form action="" method="post" enctype='multipart/form-data'>        
                <!--Category-->
                <?php admin_category(select_by_id('topics','id',$id_topic)) ?>

                <!--Header-->
                <?php show_admin_header(select_by_id('post_head','id_topics',$id_topic)); ?>
                
                <hr class="hr py-3">

                <!--Content-->
                <?php show_admin_post_topic(select_by_id('post_topic','id_topics',$id_topic)); ?>
                
                <div class="form-group">
                    <input class='btn btn-primary' type="submit" name="update" value='Update'>
                    <!-- ask the user before deleting -->
                    <?php print"
                    <a onClick=\"javascript: return confirm('Are you sure you want to delete?'); \" href='tables.php?delete=$id_topic' class='btn btn-danger'>Delete</a>"; ?>
                </div>
            </form>           

        </div>
    </div>

    <?php include 'includes/footer.php' ?>
</body>

</html>







