<?php

// session_start() must be called before _SESSION variables can be used.
if( session_id() == '' ) { // Session has not started
  session_start();
}

if( count($_SESSION["mc_questions"]) == 0 ) {
  // Create and check connection to the database
  include("./global/database-info.php");
  $conn = new mysqli($servername, $username, $password, $dbname);

  if( $conn->connect_error ) {
      die("Connection failed: " . $conn->connect_error);
  }

  // Load multiple choice questions from MySQL database
  if( $_SESSION["is_demo"] ) {
    $stmt = mysqli_query($conn, "SELECT * FROM DemoMCQuestions");
  } else {
    $stmt = mysqli_query($conn, "SELECT * FROM MCQuestions");
  }

  $_SESSION["mc_questions"] = array();
  $_SESSION["mc_option_a"] = array();
  $_SESSION["mc_option_b"] = array();
  $_SESSION["mc_option_c"] = array();
  $_SESSION["mc_option_d"] = array();
  $_SESSION["mc_option_e"] = array();

  while($row = mysqli_fetch_assoc($stmt)) {
  	array_push($_SESSION["mc_questions"], $row["question"]);
  	array_push($_SESSION["mc_option_a"], $row["option_a"]);
  	array_push($_SESSION["mc_option_b"], $row["option_b"]);
  	array_push($_SESSION["mc_option_c"], $row["option_c"]);
  	array_push($_SESSION["mc_option_d"], $row["option_d"]);
  	array_push($_SESSION["mc_option_e"], $row["option_e"]);
  }

  // Load free response questions
  if( $_SESSION["is_demo"] ) {
    $stmt = mysqli_query($conn, "SELECT question FROM DemoFRQuestions");
  } else {
    $stmt = mysqli_query($conn, "SELECT question FROM FRQuestions");
  }
  $_SESSION["fr_questions"] = array();

  while($row = mysqli_fetch_assoc($stmt)) {
  	array_push($_SESSION["fr_questions"], $row["question"]);
  }

  // Count rows of multiple choice questions
  $_SESSION["number_of_mc_questions"] = count($_SESSION["mc_questions"]);

  // Count rows of fill in the blank questions
  $_SESSION["number_of_fr_questions"] = count($_SESSION["fr_questions"]);

  // Get the total number of questions now to prevent having to calculate it on every page
  $_SESSION["total_number_of_questions"] = $_SESSION["number_of_mc_questions"] + $_SESSION["number_of_fr_questions"];
}
?>
