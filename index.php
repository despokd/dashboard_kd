<?php

/**
 * Default redirect for "Dashboard"
 * Type "live" for default redirect, "offline" for landing page. Everything else causes reload.
 *
 * @author Kilian Domaratius
 *
 * @param   string  $status
 * @return  string  HTML output
 */
function redirectToDashboard ($status = "live") {
    $sleepSeconds = 10;
    $sleepMilliseconds = $sleepSeconds * 1000;
    $htmlOutput = "";

    //get status of dashboard
    if ( isset($_REQUEST["s"]) ) {
        $status = $_REQUEST["s"];
    }

    //redirect
    switch ($status) {
        case "live":
            //redirect to live dashboard
            header("Location: dashboard.php");
            break;

        case "offline":
            //redirect to debug page
            header("Location: debug.php");
            break;

    }

    //by default
    //TODO count/change seconds until reload
    // https://www.w3schools.com/howto/howto_js_countdown.asp
    sleep($sleepSeconds);
    $htmlOutput .= "<p>Something went wrong. Application reloads in <span id='sleepSeconds'>$sleepSeconds</span> seconds.</p>";
    $htmlOutput .= "<script>    setTimeout(function(){ location.reload(true); }, $sleepMilliseconds);  </script>";

    return $htmlOutput;
}

?>


<!DOCTYPE html>
<html lang="de">
<head>
    <title>Dashboard</title>
    <?php require "header.php"; ?>
</head>
<body>
    <?php redirectToDashboard("live"); ?>
</body>
</html>
