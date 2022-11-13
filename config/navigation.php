<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Digital Library</a>
        </div>
        <ul class="nav navbar-nav">
            <li class="active"><a href="../PROJECT/user_home.php">Home</a></li>
            <li class="active"><a href="../PROJECT/add_document.php">Add Document</a></li>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Account Settings
                    <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="../PROJECT/profile/view_profile.php">View Profile</a></li>
                    <li><a href="../PROJECT/profile/update_account.php">Update Account Details</a></li>
                    <li><a href="../PROJECT/password/change_password.php">Change Password</a></li>
                </ul>
            </li>

        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['email'] ?></a></li>
            <li><a href="../PROJECT/login/logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
        </ul>
    </div>
</nav>