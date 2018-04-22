<?php
function pick_square_class($question_to_display, $square_question) {
  if( $question_to_display == $square_question ) {
    return " current";
  } else if( array_key_exists($square_question, $_SESSION["committed_answers"]) ) {
    // Value is not set if an answer was not picked.
    return " complete";
  }
}

if( !isset($_POST["is_editing"]) ) {

  echo('
  <!-- Navigation Squares -->
  <div class="text-center">
    <!-- Line of Navigation Squares -->
    <input type="submit" name="jump_to" value="0" class="nav-square' . pick_square_class($question_to_display, 0) . '">
    <input type="submit" name="jump_to" value="1" class="nav-square' . pick_square_class($question_to_display, 1) . '">
    <input type="submit" name="jump_to" value="2" class="nav-square' . pick_square_class($question_to_display, 2) . '">
    <input type="submit" name="jump_to" value="3" class="nav-square' . pick_square_class($question_to_display, 3) . '">
    <input type="submit" name="jump_to" value="4" class="nav-square' . pick_square_class($question_to_display, 4) . '">
    <input type="submit" name="jump_to" value="5" class="nav-square' . pick_square_class($question_to_display, 5) . '">
    <input type="submit" name="jump_to" value="6" class="nav-square' . pick_square_class($question_to_display, 6) . '">
    <input type="submit" name="jump_to" value="7" class="nav-square' . pick_square_class($question_to_display, 7) . '">
    <input type="submit" name="jump_to" value="8" class="nav-square' . pick_square_class($question_to_display, 8) . '">
    <input type="submit" name="jump_to" value="9" class="nav-square' . pick_square_class($question_to_display, 9) . '">
    <input type="submit" name="jump_to" value="10" class="nav-square' . pick_square_class($question_to_display, 10) . '">
    <input type="submit" name="jump_to" value="11" class="nav-square' . pick_square_class($question_to_display, 11) . '">
    <input type="submit" name="jump_to" value="12" class="nav-square' . pick_square_class($question_to_display, 12) . '">
    <input type="submit" name="jump_to" value="13" class="nav-square' . pick_square_class($question_to_display, 13) . '">
    <input type="submit" name="jump_to" value="14" class="nav-square' . pick_square_class($question_to_display, 14) . '">

    <input type="submit" name="jump_to" value="15" style="margin-left:14px;" class="nav-square frq' . pick_square_class($question_to_display, 15) . '">
    <input type="submit" name="jump_to" value="16" class="nav-square frq' . pick_square_class($question_to_display, 16) . '">
    <input type="submit" name="jump_to" value="17" class="nav-square frq' . pick_square_class($question_to_display, 17) . '">

    <input type="submit" name="jump_to" value="18" style="margin-left:14px;" class="nav-square frq' . pick_square_class($question_to_display, 18) . '">
    <input type="submit" name="jump_to" value="19" class="nav-square frq' . pick_square_class($question_to_display, 19) . '">
    <input type="submit" name="jump_to" value="20" class="nav-square frq' . pick_square_class($question_to_display, 20) . '">

    <input type="submit" name="jump_to" value="21" style="margin-left:14px;" class="nav-square frq' . pick_square_class($question_to_display, 21) . '">
    <input type="submit" name="jump_to" value="22" class="nav-square frq' . pick_square_class($question_to_display, 22) . '">
    <input type="submit" name="jump_to" value="23" class="nav-square frq' . pick_square_class($question_to_display, 23) . '">
    <!-- End Line of Navigation Squares -->

  </div>
  <!-- End Navigation Squares -->
  ');
}
