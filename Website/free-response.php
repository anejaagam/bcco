<!-- Pre: questions.php has been included already
          A session has been started.

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
    <?php function committed_answer($question_to_display) {
      if( array_key_exists($question_to_display, $_SESSION["committed_answers"]) ) {
        echo $_SESSION["committed_answers"][$question_to_display];
      }
    } ?>

    <div class="row contest-row">
        <div class="col-sm-6 offset-3 contest-box">
            <?php echo $_SESSION["fr_questions"][$question_to_display - $_SESSION["number_of_mc_questions"]]?>
            <form action="https://www.bcco-inovaca.org/commit-question" method="post">
              <input style="width:100%;" type="text" name="answer" value="<?php committed_answer($question_to_display) ?>">

              <input type="hidden" name="question" value="<?php echo $question_to_display ?>">

              <?php include("./global/contest-navigation-buttons.php") ?>
              <?php include("./global/contest-navigation-squares.php") ?>
            </form>

            <p class="text-center col-sm-12">Free Response Question: <?php echo $question_display_number - $_SESSION["number_of_mc_questions"]?>/<?php echo $_SESSION["number_of_fr_questions"] ?></p>
        </div>
    </div>
    <!-- End Contest Area -->

</body>

<?php echo file_get_contents("./global/footer.html");
      include("./global/countdown.php"); ?>

</html>
