<?php
/**
 * Landing page
 * If dashboards is on debug
 */

$sleepSeconds = 10;
$sleepMilliseconds = $sleepSeconds * 1000;

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <title>Dashboard (offline)</title>
    <?php require "header.php"; ?>
</head>
<body>
    <p>Dashboard is offline. Please try later.<br>Application will reload after <span id='sleepSeconds'><?php echo $sleepSeconds; ?></span> seconds.</p>
    <!-- TODO count/change seconds until reload
        https://www.w3schools.com/howto/howto_js_countdown.asp  -->
    <script>    setTimeout(function(){ location.href = "index.php"; }, <?php echo $sleepMilliseconds; ?>);  </script>
</body>
</html>

