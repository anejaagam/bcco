<script type="text/javascript">
var counter = <?php echo($_SESSION["end_time"] - time()) ?>;
var countdownElement = document.getElementById("countdown");
countdownElement.innerHTML = "You have " + Math.round(counter/60).toString() + " minutes left to write the contest.";
var id;

id = setInterval(function() {
    counter--;
    if( counter <= 0 ) {
        // End the contest
        document.forms[0].submit();
        clearInterval(id);
    } else if( counter%60 == 0 ) {
        countdownElement.innerHTML = "You have " + (counter/60).toString() + " minutes left to write the contest.";
    }
}, 1000);
</script>
