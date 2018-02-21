<?php
// Pre: student_id is passed by post.
// Post: a session was started
//       how-question.php is used to display the first question in the contest.
//       The test's end time is one hour from now.

// Create and check connection to the database
include("./global/database-info.php");
try {
  $conn = new mysqli($servername, $username, $password, $dbname);
} catch( Exception $e ) {
  die("Connection failed: " . $e->getMessage());
}

// session_start() must be called before _SESSION variables can be used.
if( session_id() == '' ) { // Session has not started
  session_start();
}

// Get the student ID from the login form.
if( isset($_POST["student_id"]) && !empty($_POST["student_id"]) ) {
  $_SESSION["student_id"] = $_POST["student_id"];
} else {
  die("Cannot begin the test. Student ID is empty.");
}

// Prevent SQL injection attacks by preparing the statement on the server then
// passing the student ID as a parameter.
$stmt = $conn->prepare('SELECT first_name, last_name, end_time, school_id, id FROM Students WHERE student_id = ?');
$stmt->bind_param('s', $_SESSION["student_id"]);
$stmt->execute();
$stmt->bind_result($first_name, $last_name, $end_time, $school_id, $_SESSION["student_row_id"]);
$stmt->fetch();
$stmt->close();
$student_id_exists = isset($first_name) && !empty($first_name);

if( !$student_id_exists ) {
  include("./index.php");
  exit();
} else {
  $_SESSION["student_name"] = $first_name . " " . $last_name;

  // The default value of end_time is 0.
  // end_time will be empty if a test session has not been started
  // for this student.
  if( $end_time != 0 ) {
    $_SESSION["end_time"] = $end_time;
  } else {
    // It is possible another student used this computer before
    // causing the SESSION variable to be set.
    $_SESSION["end_time"] = 0;
  }

  // Get the student's school name from the database
  // A school ID is used to make it easy to update the school name without having
  // to modify all the students' rows.
  $stmt_2 = $conn->prepare('SELECT name FROM Schools WHERE school_id = ?');
  $stmt_2->bind_param('s', $school_id);
  $stmt_2->execute();
  $stmt_2->bind_result($school_name);
  $stmt_2->fetch();
  $stmt_2->close();

  $_SESSION["school_name"] = $school_name;

  if( !isset($_SESSION["end_time"]) || $_SESSION["end_time"] == 0 ) {
    // Start the test timer. It is stored in the database in case the student
    // tries to log out and log in again to get more time. It is stored in
    // a session variable to reduce the number of database queries.
    $start_time = time();
    $one_hour_in_seconds = 1 * 60 * 60;
    $_SESSION["end_time"] = $start_time + $one_hour_in_seconds;

    $stmt_3 = $conn->prepare('UPDATE Students SET end_time = ? WHERE id = ?');
    $stmt_3->bind_param('ss', $_SESSION["end_time"], $_SESSION["student_row_id"]);
    $stmt_3->execute();
    $stmt_3->close();
  } else {
    // Do not allow the student to log in if they ran out of time on
    // their test.
    $current_time = time();

    if( $current_time > $_SESSION["end_time"] ) {
      die("Cannot begin the test. An hour has elapsed since your first login.");
    }
  }
}

// The student's answers will be committed to the database when they are done.
$_SESSION["committed_answers"] = array();

include("./show-question.php");
?>
