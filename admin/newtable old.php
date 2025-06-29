<?php include 'includes/header.php' ?>
<?php include 'includes/add_new_topic.php'; ?>  

<body>
    <div class="wrapper">
        <!-- Sidebar  -->
        <?php include 'includes/sidebar.php'; ?>

        <!-- Page Content  -->
        <div id="content">

            <?php include 'includes/navbar.php'; ?>
            
            <form action="" method="post" enctype="multipart/form-data">
                
                <!--Category-->
                <div class="form-row">
                    <div class='form-group col-md-6 pb-4'>
                        <label for='category'>Category</label>
                        <input type="text" name='category' class="form-control">
                    </div>
                </div>

                <!--Header-->
                <div class="form-row">
                    <div class='form-group col-md-6'>
                        <label for='head'>Head</label>
                        <textarea class='form-control summernote' name='head' rows='18'></textarea>
                    </div>
                    <div id='' class='form-group col-md-6 pb-3'>
                        <label for='sub_head'>Sub Head</label>
                        <textarea class='form-control summernote' name='sub_head' rows='8'></textarea>
                    </div>
                </div>
                <div class="form-row">
                    <div class='form-group col-md-4 mb-0'>
                        <label for='image_head'>Image Head</label>
                    </div>
                </div>
                <div class="form-row">
                    <div class='form-group col-md-12'>
                        <input type="file" name="image_head">
                    </div>
                </div>

                <hr class="hr py-2">

                <!--Content-->
                <div class="form-row">
                    <div class='form-group col-md-6'>
                        <label for='title1'>Title</label>
                        <textarea class='form-control summernote' name='title1' rows='8'></textarea>
                    </div>
                    <div class='form-group col-md-6 pb-2'>
                        <label for='paragraph1'>Paragraph</label>
                        <textarea class='form-control summernote' name='paragraph1' rows='8'></textarea>
                    </div>
                </div>
                <div class="form-row">
                    <div class='form-group col-md-4 mb-0'>
                        <label for='image1'>Image1</label>
                    </div>
                </div>
                <div class="form-row">
                    <div class='form-group col-md-12'>
                        <input type="file" name="image1">
                    </div>
                </div>
                <div class="form-row">
                    <div class='form-group col-md-12 mb-0'>
                        <label for='image2'>Image2</label>
                    </div>
                </div>
                <div class="form-row">
                    <div class='form-group col-md-12 '>
                        <input type="file" name="image2">
                    </div>
                </div>
                <div class="form-row">
                    <div class='form-group col-md-12 mb-0'>
                        <label for='image3'>Image3</label>
                    </div>
                </div>
                <div class="form-row">
                    <div class='form-group col-md-12 pb-3'>
                        <input type="file" name="image3">
                    </div>
                </div>
                <div class="form-row">
                    <div class='form-group col-md-6'>
                        <label for='title2'>Title</label>
                        <textarea class='form-control summernote' name='title2' rows='8'></textarea>
                    </div>
                    <div class='form-group col-md-6 pb-2'>
                        <label for='paragraph2'>Paragraph</label>
                        <textarea class='form-control summernote' name='paragraph2' rows='8'></textarea>
                    </div>
                </div>
                <div class="form-row">
                    <div class='form-group col-md-4 mb-0'>
                        <label for='image4'>Image4</label>
                    </div>
                </div>
                <div class="form-row">
                    <div class='form-group col-md-12'>
                        <input type="file" name="image4">
                    </div>
                </div>
                <div class="form-row">
                    <div class='form-group col-md-12 mb-0'>
                        <label for='image5'>Image5</label>
                    </div>
                </div>
                <div class="form-row">
                    <div class='form-group col-md-12 '>
                        <input type="file" name="image5">
                    </div>
                </div>
                <div class="form-row">
                    <div class='form-group col-md-12 mb-0'>
                        <label for='image6'>Image6</label>
                    </div>
                </div>
                <div class="form-row">
                    <div class='form-group col-md-12 pb-3'>
                        <input type="file" name="image6">
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