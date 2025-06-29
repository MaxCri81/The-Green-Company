<?php 
define('SAFE_TO_RUN', true);
require 'includes/header.php';

// Delete
if(isset($_GET['delete'])){

    $id_topics = $_GET['delete'];
    //select all the paragraphs associated with that post  
    $query = select_by_id('post_topic','id_topics',$id_topics);

    while($row = mysqli_fetch_assoc($query)){
        $id = $row['id'];
        delete_query('post_img','id_topics',$id);
    }

    delete_query('topics','id',$id_topics);
    delete_query('post_head','id_topics',$id_topics);
    delete_query('post_topic','id_topics',$id_topics);

    //select all the img links associated with that category 
    $query = select_by_id('post_img','link_id_topic',$id_topics);

    while($row = mysqli_fetch_assoc($query)){
        cancel_img_link(0, $id_topics);
    }
    header('Location: tables.php');
}

?>

<body>
    <div class="wrapper">
        <!-- Sidebar  -->
        <?php include 'includes/sidebar.php'; ?>

        <!-- Page Content  -->
        <div id="content">            
            <?php include 'includes/navbar.php'; ?>
        </div>
    </div>

    <?php include 'includes/footer.php' ?>
</body>

</html>