<?php
// Pre: student_id is passed by post.
// Post: a session was started
//       how-question.php is used to display the first question in the contest.
//       The contest's end time is one hour from now.

// Create and check connection to the database
include("./global/database-info.php");
$conn = new mysqli($servername, $username, $password, $dbname);

if( $conn->connect_error ) {
    die("Connection failed: " . $conn->connect_error);
}

// session_start() must be called before _SESSION variables can be used.
if( session_id() == '' ) { // Session has not started
  session_start();
}

// Get the teacher ID from the login form.
if( isset($_POST["school_id"]) && !empty($_POST["school_id"]) ) {
  $_SESSION["school_id"] = $_POST["school_id"];
} else {
  die("Cannot login. School ID is empty.");
}

// Prevent SQL injection attacks by preparing the statement on the server then
// passing the student ID as a parameter.
$stmt = $conn->prepare('SELECT name, id, teacher_name, teacher_email FROM `Schools` WHERE school_id = ?');
$stmt->bind_param('s', $_SESSION["school_id"]);
$stmt->execute();
$stmt->bind_result($school_name, $_SESSION["school_row_id"], $_SESSION["teacher_name"], $_SESSION["teacher_email"]);
$stmt->fetch();
$stmt->close();
$school_id_exists = isset($school_name) && !empty($school_name);

$conn->close();

if( !$school_id_exists ) {
  // An error message will be displayed on the home page.
  include("./index.php");
} else {
  $_SESSION["school_name"] = $school_name;
  include("./school.php");
}

?>
