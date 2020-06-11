<?php
/**
 * Dashboard start page
 */

require "phpClasses/shortcut.php";

//list of links for shortcuts
$shortcuts = [];
$shortcuts[0] = ['Netflix', 'https://www.netflix.com/browse', 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/0f/Logo_Netflix.png/800px-Logo_Netflix.png',''];
$shortcuts[1] = ['Prime', 'https://www.amazon.de/Prime-Video/b?ie=UTF8&node=3279204031', 'https://pbs.twimg.com/profile_images/1176422051432861696/_FpLxtU-_400x400.png',''];
$shortcuts[2] = ['Disney+', 'https://www.disneyplus.com/de-de/', 'https://prod-static.disney-plus.net/eu-west-1/builds/12f05453babc380d51fabe3a018125ffb8cdbb66_1587566872913/images/logo.svg',''];
$shortcuts[3] = ['Youtube', 'https://www.youtube.com/', 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/09/YouTube_full-color_icon_%282017%29.svg/71px-YouTube_full-color_icon_%282017%29.svg.png',''];
$shortcuts[4] = ['ToDo', 'https://to-do.microsoft.com/tasks/myday', 'https://to-do-cdn.microsoft.com/webapp/41d71b1f269fe3d9faed2c1b171f85c4b109d01bac89805a9903f99c50af1150/touch-icon-180x180.png',''];

//list of feeds
$feeds = [];
$feeds[0] = ['travel', 'Travel'];
$feeds[1] = ['news', 'News'];
$feeds[2] = ['weather', 'Weather'];


?>


<!DOCTYPE html>
<html lang="de">
<head>
    <!-- TODO get time (zone) from user -->
    <title>My Dashboard</title>
    <?php require_once 'header.php'; ?>
</head>
<body>

    <div id="head" class="container">
        <div class="row">
            <div class="col-12 col-md-6">
                <div id="clockDate">
                    <div id="clockDiv"></div>
                    <div id="date-col">
                        <div id="dateDiv"></div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div id="linkDiv" class="container">
                    <div class="row justify-content-between">
                        <?php
                        foreach ($shortcuts as $shortcut) {
                            echo (new shortcut())->createShortcut($shortcut[0], $shortcut[1], $shortcut[2]);
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="feeds" class="container">
        <div class="row">
            <?php
                require 'phpClasses/feedDashboard.php';
                echo (new feedDashboard)->createFeeds($feeds);
            ?>
        </div>
    </div>

    <?php require_once "footer.php"; ?>

</body>
</html>

