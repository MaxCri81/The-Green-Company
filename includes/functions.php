<?php
// For security, required PHP files should "die" if SAFE_TO_RUN is not defined
if (!defined('SAFE_TO_RUN')) {
    // Prevent direct execution - show a warning instead
    die(basename(__FILE__)  . ' cannot be executed directly!');
}

require 'db.php';

function _x($variable){
    return htmlspecialchars($variable);
}

function _e($variable, $key = null){
    if (is_array($variable) and $key != null) {
        if (!empty($variable[$key])) {
            echo _x($variable[$key]);
        }
    } else {
        echo _x($variable);
    }
}

function select_all_query($table_name){
    global $connection;
    global $tables;
    
    # Check if $table_name is a valid table name
    if (in_array($table_name, $tables)) {
        $query = "SELECT * FROM $table_name"; 
        $result = mysqli_query($connection,$query);

        if(!$result){
            die('Query failed'.mysqli_error());}
        
        return $result;
    }
}

function select_by_id($table_name,$field,$argument){
    global $connection;
    global $tables;

     # Check if $table_name is a valid table name
    if (in_array($table_name, $tables)) {
        $query = "SELECT * FROM $table_name ";
        $query.= "WHERE $field = ?";

        // Prepare statement using SQL command
        if (!($stmt = $connection->prepare($query))) {
            die("Error preparing statement ($query): $connection->error");
        }

        // Bind parameters for SELECT statement ('s' for each column, $query for each column )
        if (!$stmt->bind_param('s', $argument)) {
            die("Error binding statement ($query): $stmt->error");
        }

        // Execute statement and get result
        if ($stmt->execute()) {
            $result = $stmt->get_result();
        } else {
            die("Error executing statement ($connection): $stmt->error");
        }

        if (!$result) {
            die("Error obtaining result ($connection): $stmt->error");
        }
        return $result;
    }
}

function update_category($argument, $condition){
    global $connection;

    $query = "UPDATE topics SET title = ? WHERE id = ?"; #category
    
    // Prepare statement using SQL command
    if (!($stmt = $connection->prepare($query))) {
        die("Error preparing statement ($query): $connection->error");
    }

    // Bind parameters for UPDATE statement ('s' for each column plus 's' for id)
    if (!$stmt->bind_param('ss', $argument, $condition)) {
        die("Error binding statement ($query): $stmt->error");
    }

    // Execute statement and count inserted/updated rows
    if ($stmt->execute()) {
        $result = $stmt->affected_rows;
    } else {
        die("Error executing statement ($query): $stmt->error");
    }

}

function update_head($argument1, $argument2, $argument3, $condition){
    global $connection;

    $query = "UPDATE post_head SET head = ?, sub_head = ?, img = ? WHERE id_topics = ?"; #head
    
    // Prepare statement using SQL command
    if (!($stmt = $connection->prepare($query))) {
        die("Error preparing statement ($query): $connection->error");
    }

    // Bind parameters for UPDATE statement ('s' for each column plus 's' for id)
    if (!$stmt->bind_param('ssss', $argument1, $argument2, $argument3, $condition)) {
        die("Error binding statement ($query): $stmt->error");
    }

    // Execute statement and count inserted/updated rows
    if ($stmt->execute()) {
        $result = $stmt->affected_rows;
    } else {
        die("Error executing statement ($query): $stmt->error");
    }

}

function update_topic($argument1, $argument2, $condition){
    global $connection;

    $query = "UPDATE post_topic SET title = ?, paragraph = ? WHERE id = ?"; 
        
    // Prepare statement using SQL command
    if (!($stmt = $connection->prepare($query))) {
        die("Error preparing statement ($query): $connection->error");
    }

    // Bind parameters for UPDATE statement ('s' for each column plus 's' for id)
    if (!$stmt->bind_param('sss', $argument1, $argument2, $condition)) {
        die("Error binding statement ($query): $stmt->error");
    }

    // Execute statement and count inserted/updated rows
    if ($stmt->execute()) {
        $result = $stmt->affected_rows;
    } else {
        die("Error executing statement ($query): $stmt->error");
    }
}

function update_img_link($argument1, $condition){
    global $connection;

    $query = "UPDATE post_img SET link_id_topic = ? WHERE id = ?"; 

    // Prepare statement using SQL command
    if (!($stmt = $connection->prepare($query))) {
        die("Error preparing statement ($query): $connection->error");
    }

    // Bind parameters for UPDATE statement ('s' for each column plus 's' for id)
    if (!$stmt->bind_param('ss', $argument1, $condition)) {
        die("Error binding statement ($query): $stmt->error");
    }

    // Execute statement and count inserted/updated rows
    if ($stmt->execute()) {
        $result = $stmt->affected_rows;
        print $result;
    } else {
        die("Error executing statement ($query): $stmt->error");
    }
}

function update_by($table_name, $field_name, $argument, $condition){
    global $connection;
    global $tables;
    global $fields;
    
    # Check if $table_name is a valid table name
    if (in_array($table_name, $tables)) {

        # Check if $field_name is a valid field name
        if(isset($fields[$field_name])){
            $query = "UPDATE $table_name SET $field_name = ? WHERE id = ?"; 

            // Prepare statement using SQL command
            if (!($stmt = $connection->prepare($query))) {
            
                die("Error preparing statement ($query): $connection->error");
            }

            // Bind parameters for UPDATE statement ('s' for each column plus 's' for id)
            if (!$stmt->bind_param('ss', $argument, $condition)) {
                die("Error binding statement ($query): $stmt->error");
            }

            // Execute statement and count inserted/updated rows
            if ($stmt->execute()) {
                $result = $stmt->affected_rows;
            } else {
                die("Error executing statement ($query): $stmt->error");
            }

        } else {
            die("Field not present");
        }  

    } else {
        die("Table not present");
    }

}

function cancel_img_link($argument1, $condition){
    global $connection;

    $query = "UPDATE post_img SET link_id_topic = ? WHERE link_id_topic = ?"; 
        
    // Prepare statement using SQL command
    if (!($stmt = $connection->prepare($query))) {
        die("Error preparing statement ($query): $connection->error");
    }

    // Bind parameters for UPDATE statement ('s' for each column plus 's' for id)
    if (!$stmt->bind_param('ss', $argument1, $condition)) {
        die("Error binding statement ($query): $stmt->error");
    }

    // Execute statement and count inserted/updated rows
    if ($stmt->execute()) {
        $result = $stmt->affected_rows;
    } else {
        die("Error executing statement ($query): $stmt->error");
    }
}

function retrieve_all_data($query){
      
    return mysqli_fetch_assoc($query);
}

function insert_query_old($table_name,$fields,$values){
    #take a table name and 2 arrays as arguments
    global $connection;
    
    # (array_values) take the value array and (implode) trasform the array value in string divided by comma 
    $query = "INSERT INTO " .$table_name ."(" .implode("," ,array_values($fields)). ") VALUES ('" .implode("','" , array_values($values)) ."')";
    print $query;
    $result = mysqli_query($connection,$query);

    if(!$result){
        die('Query failed'.mysqli_error());}
    
    return $connection->insert_id;
}

function insert_query($table_name,$argument,$value){
    global $connection;
    global $tables;

    # Check if $table_name is a valid table name
    if (in_array($table_name, $tables)) {
    
        $query = "INSERT INTO $table_name ($argument) VALUES (?)"; 

        // Prepare statement using SQL command
        if (!($stmt = $connection->prepare($query))) {
            die("Error preparing statement ($query): $connection->error");
        }

        // Bind parameters for UPDATE statement ('s' for each column plus 's' for id)
        if (!$stmt->bind_param('s', $value)) {
            die("Error binding statement ($query): $stmt->error");
        }

        // Execute statement and count inserted/updated rows
        if ($stmt->execute()) {
            $result = $stmt->affected_rows;
        } else {
            die("Error executing statement ($query): $stmt->error");
        }
        return $connection->insert_id;
    }
}

function insert_head($value1, $value2, $value3, $value4){
    global $connection;
    
    $query = "INSERT INTO post_head (id_topics, head, sub_head, img) VALUES (?,?,?,?)"; 

    // Prepare statement using SQL command
    if (!($stmt = $connection->prepare($query))) {
        die("Error preparing statement ($query): $connection->error");
    }

    // Bind parameters for UPDATE statement ('s' for each column plus 's' for id)
    if (!$stmt->bind_param('ssss', $value1, $value2, $value3, $value4)) {
        die("Error binding statement ($query): $stmt->error");
    }

    // Execute statement and count inserted/updated rows
    if ($stmt->execute()) {
        $result = $stmt->affected_rows;
    } else {
        die("Error executing statement ($query): $stmt->error");
    }
    return $connection->insert_id;
}

function insert_topic($value1, $value2, $value3){
    global $connection;
    
    $query = "INSERT INTO post_topic (id_topics, title, paragraph) VALUES (?,?,?)"; 

    // Prepare statement using SQL command
    if (!($stmt = $connection->prepare($query))) {
        die("Error preparing statement ($query): $connection->error");
    }

    // Bind parameters for UPDATE statement ('s' for each column plus 's' for id)
    if (!$stmt->bind_param('sss', $value1, $value2, $value3)) {
        die("Error binding statement ($query): $stmt->error");
    }

    // Execute statement and count inserted/updated rows
    if ($stmt->execute()) {
        $result = $stmt->affected_rows;
    } else {
        die("Error executing statement ($query): $stmt->error");
    }
    return $connection->insert_id;
}

function insert_img_topic($value1, $value2){
    global $connection;
    
    $query = "INSERT INTO post_img (id_topics, paragraph_img) VALUES (?,?)"; 

    // Prepare statement using SQL command
    if (!($stmt = $connection->prepare($query))) {
        die("Error preparing statement ($query): $connection->error");
    }

    // Bind parameters for UPDATE statement ('s' for each column plus 's' for id)
    if (!$stmt->bind_param('ss', $value1, $value2)) {
        die("Error binding statement ($query): $stmt->error");
    }

    // Execute statement and count inserted/updated rows
    if ($stmt->execute()) {
        $result = $stmt->affected_rows;
    } else {
        die("Error executing statement ($query): $stmt->error");
    }
    return $connection->insert_id;
}

function update_topic_img($table_name, $argument1, $argument2, $value1, $value2){
    global $connection;
    global $tables;

    # Check if $table_name is a valid table name
    if (in_array($table_name, $tables)) {
    
        $query = "INSERT INTO $table_name ($argument1, $argument2) VALUES (?,?)"; 

        // Prepare statement using SQL command
        if (!($stmt = $connection->prepare($query))) {
            die("Error preparing statement ($query): $connection->error");
        }

        // Bind parameters for UPDATE statement ('s' for each column plus 's' for id)
        if (!$stmt->bind_param('ss', $value1, $value2)) {
            die("Error binding statement ($query): $stmt->error");
        }

        // Execute statement and count inserted/updated rows
        if ($stmt->execute()) {
            $result = $stmt->affected_rows;
        } else {
            die("Error executing statement ($query): $stmt->error");
        }        
        return $connection->insert_id;
    }
}

function insert_query2($query){
    global $connection; 

    $result = mysqli_query($connection,$query);

    if(!$result){
        die('Query failed'.mysqli_error());}

}

function delete_query($table_name,$field,$value){
    global $connection;
    global $tables;
    
    # Check if $table_name is a valid table name
    if (in_array($table_name, $tables)) {

        $query = "DELETE FROM $table_name WHERE $field = ?";

        // Prepare statement using SQL command
        if (!($stmt = $connection->prepare($query))) {
            die("Error preparing statement ($query): $connection->error");
        }

        // Bind parameters for UPDATE statement ('s' for each column plus 's' for id)
        if (!$stmt->bind_param('s', $value)) {
            die("Error binding statement ($query): $stmt->error");
        }

        // Execute statement and count inserted/updated rows
        if ($stmt->execute()) {
            $rows = $stmt->affected_rows;
        } else {
            die("Error executing statement ($query): $stmt->error");
        }

        if ($value and $rows == 0) {
            echo '<div class="report message always">
                Server message: Row with id=' . _x($value) . ' was not changed - either it does not exist or its values did not change
            </div>';
        }

        if (!$value and $rows == 0) {
            die("No row was inserted ($query)");
        }
    }
}

function show_all_categories($query, $topic_id=false){
    ?>
    <form method="post" enctype='multipart/form-data' class="collapse navbar-collapse justify-content-end form_categories" id="navbarNav">
            <?php
            while($row = mysqli_fetch_assoc($query)){
                $id = _x($row['id']);
                $title = _x($row['title']);
            
                ?>
                <div class=''>
                    <?php 
                    if($topic_id == $id){
                        ?>
                        <input class="pb-2 selected" type="submit" name="data[<?php echo $id; ?>]" value="<?php echo $title; ?>">
                        <?php
                    } else {
                        ?>
                        <input class="pb-2" type="submit" name="data[<?php echo $id; ?>]" value="<?php echo $title; ?>">
                        <?php
                    }
                    ?>
                    
                    
                </div>
                <?php
            }  
            ?>
            <div class='px-3'></div>
    </form>  
    <?php
} 

/*****************************************/
function admin_form_categories($query){
    ?>
    
    <!-- modify to post method  -->
    <form method="post" enctype='multipart/form-data' id="sidebar" action="table_links.php">
        <?php
        while($row = mysqli_fetch_assoc($query)){
            $id = _x($row['id']);
            $title = _x($row['title']);
            ?>
            <!-- <li>
                <a href='table_links.php?id=<?php _e($row, 'id'); ?>'><?php _e($row, 'title'); ?></a>
            </li> -->
            <?php
            ?>
            <div class=''>
                <input class="" type="submit" name="data[<?php echo $id; ?>]" value="<?php echo $title; ?>">
            </div>
        <?php
        }
    ?>
    </form>  
    <?php
}

function admin_category($query){
    $row = mysqli_fetch_assoc($query);
    ?>
    <div class='form-row'>
        <div class='form-group col-md-6'>
            <label for='category'>Category</label>
            <input class='form-control' type='text 'name='category' value='<?php _e($row, 'title'); ?>'</input>
            <input class='' type='hidden' name='hidden_topic_id' value='<?php _e($row, 'id'); ?>'</input>
        </div>
    </div>
   <?php
}

function show_header($query){
    $row = mysqli_fetch_assoc($query);
    ?>
    <div id='home-section' class='d-flex align-items-center' style='background-image: url(images/<?php _e($row, 'img'); ?>)'>
        <div class='container'>
            <div class='row align-items-center mt-5'>
                <div class='col-lg-8 text-white'>
                    <h1 class=''><?php _e($row, 'head'); ?></h1>
                </div>
                <div class='col-lg-4 text-white'>
                    <p><?php _e($row, 'sub_head'); ?></p>
                </div>
            </div>
        </div>
    </div>
    <?php
    
}

function show_admin_header($query){
    $row = mysqli_fetch_assoc($query);
    if($row) {
        $img = $row['img'];
        
        ?>
        <p class='mt-3'>Image Head</p>
        <input id='head_file' type='file' class='mb-2' name='image_head'>
        <output id='output_file_head'>
            <div class='image'>
        <?php
        if($img){
            ?>
            <img src='../images/<?php _e($row, 'img'); ?>' class=''>
            <?php
        }
            ?>
            </div>
        </output>
        <div class='form-row mt-5'>
            <div class='form-group col-md-6'>
                <label for='head'>Head</label>
                <textarea class='form-control' name='head' rows='8'><?php _e($row, 'head'); ?></textarea>
            </div>
            <div class='form-group col-md-6 pb-4'>
                <label for='sub_head'>Sub Head</label>
                <textarea class='form-control' name='sub_head' rows='8'><?php _e($row, 'sub_head'); ?></textarea>
            </div>
        </div>
        <?php
    }
}


function show_post_topic($query){
    // Percentage of the figure image in the grid. It depends on how many images
    // are present in the container hosting the figures
    $percentage = 80;
    while($row = mysqli_fetch_assoc($query)){
        $id = $row['id'];
        $grid_images = mysqli_num_rows(select_by_id('post_img','id_topics',$id));
        
        if($grid_images == 1)
        {
            $percentage = 40;
        } elseif ($grid_images == 3){
            
            $percentage = 80;
        } else {
            $percentage = 70;
        }
       ?>
        <section id='content'>
            <div class='container'>
                <div class='row '>
                    <div class='col'> 
                        <h1 class='display-4 pt-4'><?php _e($row, 'title'); ?></h1>
                        <p class='pt-4'><?php _e($row, 'paragraph'); ?></p>
                    </div>
                </div>
                <!-- calculate the width for the images grid 80 % and divide by 3. It adapt the margin of the images 
                accordingly to the images present in the database for that topic, see variable above $grid_images -->
                <div class='content' style="grid-template-columns: repeat(<?php print $grid_images; ?>, calc(<?php print $percentage; ?>% / <?php print $grid_images; ?>));">
                <!-- <div class='content'> -->
                <!-- <div class='content' style="grid-template-columns: repeat(4, calc(85% / 4));"> -->
                    <?php show_post_img(select_by_id('post_img','id_topics',$id)); ?>
                </div>
            </div>
        </section>

        <?php
    }  
}

function show_post_img($query,$admin=False, $count=0){
    $link = 1;
    while($row = mysqli_fetch_assoc($query)){
        //main page
        if(!$admin){
            // if there is a link on the image saved in the database, create an anchor tag
            if($row['link_id_topic']){
                ?>
                <form method="POST" id='img_form<?php print $link; ?>'>
                    <input type="hidden" name="linkID" value="<?php _e($row, 'link_id_topic'); ?>">
                    <figure>
                        <a href="#" onclick="imgLink(<?php print $link; ?>)"><img class='imgWithLink' src='images/<?php _e($row, 'paragraph_img'); ?>'></a>
                    </figure>
                </form>
               
                <?php
            } else {
                ?>
                <figure>
                    <img src='images/<?php _e($row, 'paragraph_img'); ?>' class=''>
                </figure>
                <?php
            }
        } else {
            //admin page
            ?>
            <div class='image'>
                <img src='../images/<?php _e($row, 'paragraph_img'); ?>' class=''>
                <input name="img_ids<?php print $count; ?>[]" type="hidden" value="<?php print $row['id']; ?>">
            </div>
            <?php
        }
        $link ++;
    }
    return mysqli_num_rows($query);  
}

/******************************************** */
function show_admin_post_topic($query){
    $count = 1;
    $grid_images = 0;

    while($row = mysqli_fetch_assoc($query)){
        $id = $row['id'];
        ?>
        <div class='form-row'>
            <div class='form-group col-md-4 mb-0'>
                <label for='first_paragraph'>Section <?php print($count); ?></label>
            </div>
        </div>
        <div class='form-row'>
            <div class='form-group col-md-12'>
                <input class='input_file mb-2' type='file' multiple='multiple' accept='image/jpeg, image/png, image/jpg, image/webp' name='paragraph<?php print($count); ?>[]'>
                <output class='output_file mb-3'>
                    <?php 
                    // $grid_images = show_post_img(select_by_id('post_img','id_topics',$id),'../images/',True, $count);
                    $grid_images = show_post_img(select_by_id('post_img','id_topics',$id), True, $count);
                    ?>
                </output>
                <!-- modify to post method -->
                <a href='?deleteIMG=<?php _e($row, 'id'); ?>/<?php _e($row, 'id_topics'); ?>' class='btn btn-danger'>Delete Images</a>
            </div>
        </div>

        <!-- Image links -->
        <?php
        // retrieve from database any link associated with the image
        // and convert id to title to show up 
        $query_links = select_by_id('post_img','id_topics',$id);
        $x = 0;
        while($row_link = mysqli_fetch_assoc($query_links)){
            $link_id_topic = $row_link['link_id_topic'];
            if($link_id_topic){
                $row_topic = mysqli_fetch_assoc(select_by_id('topics','id',$link_id_topic));
            } else {
                $row_topic = "";
            }
        ?>
            <div class='form-row'>
                <!-- Topic selector -->
                <!-- To implement when you have refreshed Javascript -->
                <!-- <div class='form-group col-md-6'>
                    <?php #$topics_query = select_all_query('topics'); ?>
                    <label for="linkSelect">Select a Category</label>
                    <select class='form-control linkSelect' name='imgs_selector' onchange='linkSelect();'>
                        <?php
                        #show the selector with all the categories.
                        #while($row = mysqli_fetch_assoc($topics_query)){
                            #$id = $row['id'];
                            #$title = $row['title'];
                            #compare the category_id with the id_selected. if it's same, assign the value selected 
                            #if($link_id_topic == $id) {
                                #print "<option value='$id' selected>$title</option>";
                            #} else {
                                #print "<option value='$id'>$title</option>";
                            #}
                        #}
                        ?>
                        <option value='new'>Create a new option</option>
                    </select>
                </div> -->
                
                <!-- Input for the image link -->
                <div class='form-group col-md-6'>
                    <label for='link<?php print($count); ?>'>Image <?php print($x +1); ?> link</label>
                    <!-- if any img link is present in the database, create a button 
                    at the end of the input text, to link to it  -->
                    <?php if($link_id_topic){ ?>
                    <div class="input-group">
                        <input class='form-control' type='text' name='link<?php print($count);?>[]' value='<?php _e($row_topic, 'title'); ?>'</input>
                        <div class="input-group-append">
                            <!-- to modify to a post method -->
                            <a href='table_links.php?id=<?php print $link_id_topic;?>' class="input-group-text btn btn-primary">&rarr;</a>
                        </div>
                    </div>    
                    <?php 
                    } else {
                        ?>
                        <input class='form-control' type='text' name='link<?php print($count);?>[]' value='<?php _e($row_topic, 'title'); ?>'</input>
                        <?php
                    }
                    ?>
                </div>
                
            </div>
        <?php 
        $x++;
        } ?>

        <div class='form-row pt-3'>
            <div class='form-group col-md-6'>
                <label for='title<?php _e($row, 'id'); ?>'>Title</label>
                <textarea class='form-control' name='title<?php _e($row, 'id'); ?>' rows='8'><?php _e($row, 'title'); ?></textarea>
            </div>
            <div class='form-group col-md-6 pb-4'>
                <label for='paragraph<?php _e($row, 'id'); ?>'>Paragraph</label>
                <textarea class='form-control' name='paragraph<?php _e($row, 'id'); ?>' rows='8'><?php _e($row, 'paragraph'); ?></textarea>
            </div>
        </div>
        <?php
        $count++;
    }  
}

function starting_point($query){
    // take the first topic from post_head which will be shown as first page in the index page
    $row = mysqli_fetch_assoc($query);
    return _x($row['id_topics']);
}

function escape($string){
    global $connection; 
    return mysqli_real_escape_string($connection, trim(strip_tags($string)));
}

// function get_field_names($query){
//     // Get the field names
//     while($mysql_query_fields = mysqli_fetch_field($query)){
//         $mysql_fields[] = $mysql_query_fields->name;
//     }
//     return $mysql_fields;
// }
?>