<?php
session_start();

require "assets/includes/functions";
require INCLUDES_DIR . "db.php";

if(isset($_SESSION['loggedin'] && $_SESSION['loggedin'] == true){
  header();
}

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["username"], $_POST["password"])){

  // Check to make sure csrf token is the same token
  if(!hash_equals($_SESSION["csrf_token"], $_POST["csrf_token"])) {
    $_SESSION["error"]["message"] = "Invalid token!";
    exit();
  }

  $username = test_input($_POST["username"]);
  $password = test_input($_POST["password"]);

  if(empty($username)){
    $username_err = "Please enter your username";
  } else {
    $sql = "SELECT id, username, email, password, token, verified FROM users WHERE username = :username";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":username", $username, PDO::PARAM_STR);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if($user){
      if(password_verify($password, $user["password"])){
        $_SESSION["loggedin"] = true;
        $_SESSION["id"] = $user["id"];
        $_SESSION["username"] = $user["username"];
        $_SESSION["email"] = $user["email"];
        $_SESSION["token"] = $user["token"];
        $_SESSION["verified"] = $user["verified"];
        $_SESSION["success"]["message"] = "You are now logged in!";

        header("location: account.php");
      } else {
        $password_err = "The username/password you entered is not valid";
      }
    } else {
      $username_err = "The username/password you entered is not valid";
    }
  }
}

require INCLUDES_DIR . "header.php";
require INCLUDES_DIR . "navbar.php";
?>
  <div class="container">
    <div class="row d-flex justify-content-center">
      <div class="col-lg-6 col-sm-12">
        <div class="card">
          <div class="card-body">
            <h2 class="card-title text-center">User Login</h2>
            <hr>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id="login_form">
              <div class="mb-3">
                <label for="username" class="form-label">Username:</label>
                <input type="text" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" name="username" id="username" value="<?php echo (!empty($username)) ? $username : '';?>" required="">
                <?php echo (!empty($username_err)) ? "<span class='invalid-feedback form-text'>$username_err</span>" : ""; ?>
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" name="password" id="password" required="">
                <?php echo (!empty($password_err)) ? "<span class='invalid-feedback form-text'>$password_err</span>" : ""; ?>
              </div>
              <div class="mb-3">
                <input type="submit" class="btn btn-primary float-end" value="Login">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php require INCLUDES_DIR . "footer.php"; ?>
