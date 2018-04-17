<!-- Pre: questions.php has been included already and the variables
     $multiple_choice_questions, $_SESSION["total_number_of_questions"], and
     $question_to_display have been set.

     By design, this page will only be shown by calling show-question.php -->

<?php include("./contest-page-setup.php") ?>

<!DOCTYPE html>
<html>

<head>
    <?php echo file_get_contents("./global/head-tags.html") ?>

    <!-- Prevent this page from being indexed by search engines. -->
    <meta name="robots" content="noindex">
</head>

<body>
    <h1 class="title">BC Computing Olympiad 2018</h1>

    <!-- Student Info -->
    <p class="text-center student-info"><?php echo $_SESSION["student_name"] ?> | <?php echo $_SESSION["school_name"] ?></p>
    <!-- End Student Info -->

    <!-- Test Countdown, Updated with JS -->
    <p class="text-center" id="countdown">You have 60 minutes left to write the test.</p>
    <!-- End Test Countdown -->

    <!-- Contest Area -->
    <?php function should_be_checked($question_to_display, $question_letter) {
      if( array_key_exists($question_to_display, $_SESSION["committed_answers"]) &&
          $_SESSION["committed_answers"][$question_to_display] == $question_letter ) {
        echo "checked";
      }
    } ?>

    <div class="row contest-row">
        <div class="col-sm-6 offset-3 contest-box">
            <?php echo $_SESSION["mc_questions"][$question_to_display]?>
            <form action="https://www.bcco-inovaca.org/commit-question" method="post">
              <div class="radio">
                  <label>
                      <input type="radio" name="answer" value="A" <?php should_be_checked($question_to_display, "A") ?>>(A) <?php echo $_SESSION["mc_option_a"][$question_to_display]?></label>
              </div>
              <div class="radio">
                  <label>
                      <input type="radio" name="answer" value="B" <?php should_be_checked($question_to_display, "B") ?>>(B) <?php echo $_SESSION["mc_option_b"][$question_to_display]?></label>
              </div>
              <div class="radio">
                  <label>
                      <input type="radio" name="answer" value="C" <?php should_be_checked($question_to_display, "C") ?>>(C) <?php echo $_SESSION["mc_option_c"][$question_to_display]?></label>
              </div>
              <div class="radio">
                  <label>
                      <input type="radio" name="answer" value="D" <?php should_be_checked($question_to_display, "D") ?>>(D) <?php echo $_SESSION["mc_option_d"][$question_to_display]?></label>
              </div>
              <div class="radio">
                  <label>
                      <input type="radio" name="answer" value="E" <?php should_be_checked($question_to_display, "E") ?>>(E) <?php echo $_SESSION["mc_option_e"][$question_to_display]?></label>
              </div>

              <input type="hidden" name="question" value="<?php echo $question_to_display ?>">

              <?php include("./global/contest-navigation-buttons.php") ?>
              <?php include("./global/contest-navigation-squares.php") ?>
            </form>

            <p class="text-center col-sm-12">Multiple Choice Question: <?php echo $question_display_number ?>/<?php echo $_SESSION["number_of_mc_questions"] ?></p>
        </div>
    </div>
    <!-- End Contest Area -->

</body>

<?php echo file_get_contents("./global/footer.html");
      include("./global/countdown.php"); ?>

</html>
