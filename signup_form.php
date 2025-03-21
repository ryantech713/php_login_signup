<?php

// Start session
session_start();

// Require Composer Autoload file
require "vendor/autoload.php";

// Require PHP Functions
require "assets/includes/functions.php";

// Require Database Connection file
require_once INCLUDES_DIR . "db.php";

// Set csrf_token if not already set
if(empty($_SESSION["csrf_token"])) {
    generateCSRFToken();
}

// If User is logged in redirect to account page
if(isset($_SESSION["loggedin"])) {
    header("location: account.php");
}
// If the signup form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST") {

    // Set empty variables
    $username = $email = $password = $confirm = "";
    $username_err = $email_err = $password_err = $confirm_err = $form_err = "";

    // Check to make sure csrf token is the same token
    if(!hash_equals($_SESSION["csrf_token"], $_POST["csrf_token"])) {
        $_SESSION["error"]["message"] = "Invalid token!";
        exit();
    }
    // Validate username
    $username = test_input($_POST["username"]);
    if(empty($username)) {
        $username_err = "Please enter a username";
    } elseif(!preg_match("/^[A-Za-z0-9-_]+$/", $username)) {
        $username_err = "Username can only contain letters, numbers, dashes and underscores";
    } elseif($username == "admin") {
        $username_err = "Username Restricted";
    }
    // Validate Email Address
    $email = test_input($_POST["email"]);
    if(empty($email)) {
        $email_err = "Please enter your Email Address";
    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_err = "Invalid Email Address";
    }
    // Validate Password
    $password = test_input($_POST["password"]);
    if(empty($password)) {
        $password_err = "Please enter a password for your account";
    } elseif(strlen($password) < 12) {
        $password_err = "Password must be at least 12 characters";
    }
    // Validate Confirm
    $confirm = test_input($_POST["confirm"]);
    if(empty($confirm)) {
        $confirm_err = "Please enter your password again to confirm";
    } elseif($confirm != $password) {
        $confirm_err = "Passwords do not match";
    }
    // If no errors, submit form
    if(empty($username_err) && empty($email_err) && empty($password_err) && empty($confirm_err) && empty($form_err)) {
      $token = md5(uniqid(rand(), true));
        // Store insert query
        $sql = "INSERT INTO users(username, email, password, token, verified) VALUES(?, ?, ?, ? , 0)";
        if($stmt = $pdo->prepare($sql)) {
            $stmt->bindParam("ssss", $username, $email, $password, $token);
            if($stmt->execute()) {
              require INCLUDES_DIR . "smtp.php";
              $email_template = getEmailTemplate(INCLUDES_DIR . "templates/new_user_email.html");

            }
        }
    }
}
// Include Page header and navbar
require INCLUDES_DIR . "header.php";
require INCLUDES_DIR . "navbar.php";
?>
<section>
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-6 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">User Sign Up</h2>
                    </div>
                    <div class="card-body">
                        <form method="post" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" id="signup_form">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username:</label>
                                <input type="text" class="form-control <?php echo(!empty($username_err)) ? 'is-invalid' : ''; ?>" name="username" id="username" required="">
                                <span id="response"></span>
                                <p class="form-text text-danger"><?php echo (!empty($username_err)) ? $username_err : ''; ?></p>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address:</label>
                                <input type="email" class="form-control <?php echo(!empty($email_err)) ? 'is-invalid' : ''; ?>" name="email" id="email" required="">
                                <p class="form-text text-danger"><?php echo (!empty($email_err)) ? $email_err : ''; ?></p>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password:</label>
                                <input type="password" class="form-control <?php echo(!empty($password_err)) ? 'is-invalid' : ''; ?>" name="password" id="password" required="">
                                <p class="form-text text-danger"><?php echo (!empty($password_err)) ? $password_err : ''; ?></p>
                            </div>
                            <div class="mb-3">
                                <label for="confirm" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control <?php echo(!empty($confirm_err)) ? 'is-invalid' : ''; ?>" name="confirm" id="confirm" required="">
                                <p class="form-text text-danger"><?php echo (!empty($confirm_err)) ? $confirm_err : ''; ?></p>
                            </div>
                            <div class="mb-3">
                                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                                <input type="hidden" name="token" value="<?php echo $token; ?>"
                                <input type="submit" class="btn btn-primary float-end" value="Sign Up">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php require INCLUDES_DIR . "footer.php"; ?>
