<?php

function generate_student_id() {
  // This may need to be updated with a contest to guarantee uniqueness.
  return uniqid();
}

$field_first_name = $_POST['cf_first_name'];
$field_last_name = $_POST['cf_last_name'];
$field_grade = $_POST['cf_grade'];

// Connect to the database and check the connection
include("../global/database-info.php");
$conn = new mysqli($servername, $username, $password, $dbname);

if( $conn->connect_error ) {
    die("Connection failed: " . $conn->connect_error);
}

// session_start() must be called before _SESSION variables can be used.
if( session_id() == '' ) { // Session has not started
  session_start();
}

$student_id = generate_student_id();

$stmt = $conn->prepare('INSERT INTO Students (`school_id`, `student_id`, `first_name`, `last_name`, `grade`) VALUES
                        (?, ?, ?, ?, ?)');
$stmt->bind_param('sssss', $_SESSION["school_id"], $student_id, $field_first_name, $field_last_name, $field_grade);
$stmt->execute();
$stmt->close();
?>

<script>
window.location.href = "https://www.bcco-inovaca.org/school";
</script>
