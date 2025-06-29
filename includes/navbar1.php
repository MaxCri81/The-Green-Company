<div class="navbar navbar-expand-sm navbar-light bg-light "  id='user_navbar'>
    <div class="container">
        <div id="logo">
            <!-- <a class="navbar-brand" href="#">The Green Company</a> -->
            <img src="logo1.jpg" alt="" class="logo">
            <!-- <p>FOR A HEALTHY ENVIROMENT</p> -->
        </div>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav" id="">

                <?php show_all_categories(select_all_query('topics')); ?>  
            </ul>
        </div>
    </div>
</div>