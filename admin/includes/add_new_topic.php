<?php
if(isset($_POST['submit'])){
   
    $category = escape($_POST['category']);

    if($category){
        #Add Category in the database
        $topic_id = insert_query('topics','title', $category);

        $image_head = $_FILES['image_head']['name'];
        $image_head_temp = $_FILES['image_head']['tmp_name'];
        $img_arr_first_paragraph = $_FILES['first_paragraph']['name'];
        $img_arr_second_paragraph = $_FILES['second_paragraph']['name'];
        $img_temp_first_paragraph = $_FILES['first_paragraph']['tmp_name'];
        $img_temp_second_paragraph = $_FILES['second_paragraph']['tmp_name'];

        
        # Move temporary files into the image folder
        move_uploaded_file($image_head_temp,"../images/$image_head"); 

        insert_head($topic_id, escape($_POST['head']), escape($_POST['sub_head']), $image_head); # Head content

        $id1 = insert_topic($topic_id, escape($_POST['title1']), escape($_POST['paragraph1'])); # 1st content
        $id2 = insert_topic($topic_id, escape($_POST['title2']), escape($_POST['paragraph2'])); # 2nd content


        # Move temporary files into the image folder and add path into the database if any image has been uploaded
        if($img_arr_first_paragraph[0]){
            foreach ($img_arr_first_paragraph as $key => $value){
                move_uploaded_file($img_temp_first_paragraph[$key], "../images/$img_arr_first_paragraph[$key]");
                insert_img_topic($id1, $img_arr_first_paragraph[$key]); #img path
            }
        }

        if($img_arr_second_paragraph[0]){
            foreach ($img_arr_second_paragraph as $key => $value){
                move_uploaded_file($img_temp_second_paragraph[$key],"../images/$img_arr_second_paragraph[$key]");
                insert_img_topic($id2, $img_arr_second_paragraph[$key]); #img path         
            }
        }

    } else {
        print "This field should not be empty";
    }
    header("Location: table_links.php?id=$topic_id");
}
?>