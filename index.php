<?php
session_start();

require "assets/includes/functions";
require INCLUDES_DIR . "db.php";

if(isset($_SESSION['loggedin'] && $_SESSION['loggedin'] == true){

}

require INCLUDES_DIR . "header.php";
require INCLUDES_DIR . "navbar.php";
?>
<div class="container">
  <div class="row d-flex justify-content-center">
    <div class="col-lg-6 col-sm-12">

    </div>
  </div>
</div>
<?php require INCLUDES_DIR . "footer.php"; ?>
