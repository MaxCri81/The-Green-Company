<?php
// Define a constant to permit each file we "require" to execute
// For security, required PHP files should "die" if SAFE_TO_RUN is not defined
define('SAFE_TO_RUN', true);

require 'includes/header.php';
require 'includes/add_new_topic.php'; 

?>  

<body>
    <div class="wrapper">
        <!-- Sidebar  -->
        <?php require 'includes/sidebar.php'; ?>

        <!-- Page Content  -->
        <div id="content">

            <?php require 'includes/navbar.php'; ?>
            
            <form action="" method="post" enctype="multipart/form-data">
                
                <!--Category-->
                <div class="form-row">
                    <div class='form-group col-md-6'>
                        <label for='category'>Category</label>
                        <input type="text" name='category' class="form-control">
                    </div>
                </div>

                <!--Header-->
                <p class='mt-3'>Image Head</p>
                <input id='head_file' type='file' class='mb-2' name="image_head">
                <output id='output_file_head' class='output_file1'></output>
                
                <div class="form-row mt-5">
                    <div class='form-group col-md-6'>
                        <label for='head'>Head</label>
                        <textarea class='form-control summernote1' name='head' rows='8'></textarea>
                    </div>
                    <div id='' class='form-group col-md-6 pb-3'>
                        <label for='sub_head'>Sub Head</label>
                        <textarea class='form-control summernote1' name='sub_head' rows='8'></textarea>
                    </div>
                </div>

                <hr class="hr py-2">

                <!--Content-->
                <div class="form-row">
                    <div class='form-group col-md-4 mb-0'>
                        <label for='first_paragraph'>1 Section</label>
                    </div>
                </div>
                <div class="form-row">
                    <div class='form-group col-md-12'>
                        <input class='input_file mb-2' type="file" multiple="multiple" accept="image/jpeg, image/png, image/jpg, image/webp" name="first_paragraph[]">
                        <output class='output_file'></output>
                    </div>
                </div>
                <div class="form-row">
                    <div class='form-group col-md-6'>
                        <label for='title1'>Title</label>
                        <textarea class='form-control summernote1' name='title1' rows='8'></textarea>
                    </div>
                    <div class='form-group col-md-6 pb-2'>
                        <label for='paragraph1'>Paragraph</label>
                        <textarea class='form-control summernote1' name='paragraph1' rows='8'></textarea>
                    </div>
                </div>
                <div class="form-row">
                    <div class='form-group col-md-4 mb-0'>
                        <label for='second_paragraph'>2 Section</label>
                    </div>
                </div>
                <div class="form-row">
                    <div class='form-group col-md-12'>
                        <input class='input_file mb-2' type="file" multiple="multiple" accept="image/jpeg, image/png, image/jpg, image/webp" name="second_paragraph[]">
                        <output class='output_file'></output>
                    </div>
                </div>
                <div class="form-row">
                    <div class='form-group col-md-6'>
                        <label for='title2'>Title</label>
                        <textarea class='form-control summernote1' name='title2' rows='8'></textarea>
                    </div>
                    <div class='form-group col-md-6 pb-2'>
                        <label for='paragraph2'>Paragraph</label>
                        <textarea class='form-control summernote1' name='paragraph2' rows='8'></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <input class='btn btn-primary' type="submit" name="submit" value='Submit'>
                </div>
            </form>
            

        </div>
    </div>

    <?php include 'includes/footer.php' ?>

   

</body>

</html>