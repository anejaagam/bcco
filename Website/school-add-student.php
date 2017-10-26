<?php

// session_start() must be called before _SESSION variables can be used.
if( session_id() == '' ) { // Session has not started
  session_start();
}

?>

<!DOCTYPE html>
<html>

  <head>
      <?php echo file_get_contents("./global/head-tags.html") ?>
      <!-- Prevent this page from being indexed by search engines. -->
      <meta name="robots" content="noindex">
  </head>

  <body class="container">

      <h1 class="title">BC Computing Olympiad 2017</h1>
      <p class="text-center"><?php echo $_SESSION["school_name"] ?></p>

      <!-- Register A Student Form -->
      <h2 style="margin-top:32px;" class="text-center">Register A Student</h2>
      <form style="margin-left: 5%; margin-right: 5%;" action="https://www.bcco-inovaca.org/forms/add-student" method="post">
        <div class="form-group">
          <label>First Name:</label>
          <input class="form-control" type="text" placeholder="First Name" name="cf_first_name" required>
        </div>
        <div class="form-group">
          <label>Last Name:</label>
          <input class="form-control" type="text" placeholder="Last Name" name="cf_last_name" required>
        </div>
        <div class="form-group">
          <label>Grade:</label>
          <input class="form-control" type="number" placeholder="Grade" name="cf_grade" required>
        </div>
        <div class="form-group">
          <input style="margin-top:10px; cursor: pointer;" type="submit" value="Register" class="form-control">
        </div>
      </form>
      <!-- End Form -->

      <!-- Cancel Button -->
      <a href="https://www.bcco-inovaca.org/school" style="text-decoration: none;">
        <button class="btn btn-default" style="margin: 0 auto; display: block; cursor: pointer;">Cancel</button>
      </a>
      <!-- End Cancel Button -->

  </body>

</html>
