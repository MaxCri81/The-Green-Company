<?php
if (!defined('SAFE_TO_RUN')) {
    // Prevent direct execution - show a warning instead
    die(basename(__FILE__)  . ' cannot be executed directly!');
}

//Retrieve data for the selected id
//modify to $_Post
// $id_topics = _x($_GET['id']);
// print "xxxxxxxx ".$id_topics;
if(isset($_POST['data'])){
    foreach ($_POST['data'] as $key => $value) {
        $id_topic = $key;
    }
}

$row_category = mysqli_fetch_assoc(select_by_id('topics', 'id', $id_topic)); #category
$row_head = mysqli_fetch_assoc(select_by_id('post_head', 'id_topics', $id_topic)); #head
$row_query = select_by_id('post_topic', 'id_topics', $id_topic); #topic
$image_head = $row_head['img'];

$query = select_by_id('post_topic', 'id_topics', $id_topic);

//Edit Post
if(isset($_POST['update'])) {
    $category = escape($_POST['category']);
    $head = escape($_POST['head']);
    $sub_head = escape($_POST['sub_head']);
      
    //check if you selected an image and update the link with the data otherwise the link is going to be the old one coming from the initial database query $image = $row['post_image'];
    if($_FILES['image_head']['name']){
        $image_head = $_FILES['image_head']['name'];
    } 
    
    $image_temp = $_FILES['image_head']['tmp_name'];
   
    move_uploaded_file($image_temp,"../images/$image_head"); //default function to move temporary image, selected from the form, to a folder.

    #update_category($category, $id_topics);
    update_by('topics', 'title', $category, $id_topic);
    update_head($head, $sub_head, $image_head, $id_topic);
   
    $count = 1;
    #updating post topics
    while($row = mysqli_fetch_assoc($row_query)){
        $id = $row['id'];
        $title = escape($_POST["title{$id}"]);
        $paragraph = escape($_POST["paragraph{$id}"]);

        update_topic($title, $paragraph, $id);
        $img_arr = $_FILES["paragraph{$count}"]['name'];
        $img_arr_tmp = $_FILES["paragraph{$count}"]['tmp_name'];

        if($img_arr[0]){

            //check for deleting old links
            delete_query('post_img','id_topics',$id);

            foreach($img_arr as $key => $value){
                move_uploaded_file($img_arr_tmp[$key], "../images/$img_arr[$key]"); 
                update_topic_img('post_img', 'id_topics', 'paragraph_img', $id, $img_arr[$key]);
            }
        }

        #Save image links to the img table
        #at the moment there are 2 img_ids array, one for each paragraph
        #and 2 link(s) array
        if(isset($_POST["img_ids{$count}"])){ 
            $length = sizeof($_POST["img_ids{$count}"]);
        
            for ($i=0; $i < $length; $i++) { 
                $id = $_POST["img_ids{$count}"][$i];
                $category = $_POST["link{$count}"][$i];
                //check if the input text for the img link is not empty
                if($category){
                    //check if the category is already present in the database
                    $img_link_query = select_by_id('topics', 'title', $category);
                    $row_link_query = mysqli_fetch_assoc($img_link_query);
                    if(mysqli_num_rows($img_link_query)){
                        //topic present in the database
                        #update_img_link($row_link_query['id'], $id); #update img table with the id of the topic created
                        update_by('post_img', 'link_id_topic', $row_link_query['id'], $id); #update img table with the id of the topic created
                    } else {
                        // new topic
                        $topic_id = insert_query('topics','title', $category); #create a new topic
                        insert_head($topic_id, "", "", ""); #add head with empty fields wich refers to the topic created
                        #update_img_link($topic_id, $id); #update img table with the id of the topic created
                        update_by('post_img', 'link_id_topic', $topic_id, $id); #update img table with the id of the topic created
                        insert_topic($topic_id, "", ""); # empty content
                        insert_topic($topic_id, "", ""); # empty content
                    }
                }
            } 
        }    
        $count++;
    }
    //Convert to $_post
    #header("Location: table_links.php?id=$id_topics");
}

?>