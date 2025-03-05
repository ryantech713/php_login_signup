<nav class="navbar navbar-expand-lg fixed-top" id="navbarTop">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">PHP Login and Signup</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation" id="navbar-toggler">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar">
            <ul class="navbar-nav me-auto mb-2">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Contact Us</a>
                </li>
            </ul>
            <div class="d-flex">
                <!-- SHOW DROPDOWN IF USER IS LOGGED IN -->
                <?php
                if(isset($_SESSION["loggedin"])){
                ?>
                    <div class="dropdown" style="margin-right: 50px;">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle me-2"></i><?php echo $_SESSION["username"]; ?>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="account.php"><i class="bi bi-gear-fill me-2"></i>Account Settings</a></li>
                            <li><a class="dropdown-item" href="forgot_password.php"><i class="bi bi-question-circle me-2"></i>Forgot Password</a></li>
                            <li><a class="dropdown-item" href="logout.php"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
                        </ul>
                    </div>
                <!-- SHOW LOGIN AND SIGNUP BUTTONS IF USER IS NOT LOGGED IN -->
                <?php
                } else {
                ?>
                    <a class="btn btn-primary ms-md-2" href="signup_form.php">Signup</a>
                    <a class="btn btn-dark ms-md-2" href="login_form.php" >Login</a>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</nav>
<main>