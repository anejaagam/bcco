<?php

header("Location: https://www.bcco-inovaca.org/school");

if( !empty($_POST["teacher_name"]) && !empty($_POST["teacher_email"]) ) {
  include("../global/database-info.php");
  $conn = new mysqli($servername, $username, $password, $dbname);

  if( $conn->connect_error ) {
    die("Connection failed: " . $conn->connect_error);
  }

  // session_start() must be called before _SESSION variables can be used.
  if( session_id() == '' ) { // Session has not started
    session_start();
  }

  $stmt = $conn->prepare('UPDATE `Schools` SET `teacher_name` = ?, `teacher_email` = ? WHERE `school_id` = ?');
  $stmt->bind_param('sss', $_POST["teacher_name"], $_POST["teacher_email"], $_SESSION["school_id"]);
  $stmt->execute();
  $stmt->close();

  $_SESSION["teacher_name"] = $_POST["teacher_name"];
  $_SESSION["teacher_email"] = $_POST["teacher_email"];
}

?>
