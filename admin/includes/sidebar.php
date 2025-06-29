<nav id="sidebar">
    <div class="sidebar-header">
        <h3>Pianeta Verde</h3>
    </div>

    <ul class="list-unstyled components">
        <p></p>
        <li class="active">
            <a href="dashboard.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
        </li>
        <li>
            <a href="#"><i class="fa fa-fw fa-bar-chart-o"></i> Charts</a>
        </li>
        <li>
            <a href="#tableSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-fw fa-table"></i> Tables</a>
            <ul class="collapse list-unstyled" id="tableSubmenu">
                <?php admin_form_categories(select_all_query('topics')); ?>
                <li>
                    <a href="newtable.php" class="">New</a>
                </li>
            </ul>
            
        </li>
        <li>
            <a href=""><i class="fa fa-fw fa-edit"></i> Forms</a>
        </li>
    </ul>

    <ul class="list-unstyled CTAs">
        <li>
            <a href="../index.php" class="download">Home</a>
        </li>
    </ul>
</nav>