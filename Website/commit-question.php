<?php

// Post: a session has started.

require_once("./questions.php");

// session_start() must be called before _SESSION variables can be used.
if( session_id() == '' ) { // Session has not started
  session_start();
}

$question = $_POST["question"];
$answer = $_POST["answer"];

// Commit the answer if an answer was chosen
if( isset($answer) && !empty($answer) && isset($question) ) {
  if( $question < $number_of_multiple_choice_questions ) {
    // Protect against invalid inputs. This is only possible in MC questions because the
    // possibilities are limited then.
    if( $answer != "A" && $answer != "B" && $answer != "C" && $answer != "D" && $answer != "E" ) {
      die();
    }
  }

  $_SESSION["committed_answers"][$question] = $answer;
}

// Display a different question or end the contest depending on the time limit.
if( time() < $_SESSION["end_time"] ) {
  include("./show-question.php");
} else {
  include("./finish.php");
}

?>
