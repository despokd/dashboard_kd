<?php

/**
 * Dashboard start page
 */

error_reporting(-1);

require "phpClasses/shortcut.php";

//list of links for shortcuts
$shortcuts = [];
$shortcuts[0] = ['Netflix', 'https://www.netflix.com/browse', './img/logos/netflix.png', ''];
$shortcuts[1] = ['Prime', 'https://www.amazon.de/Prime-Video/b?ie=UTF8&node=3279204031', './img/logos/prime.png', ''];
$shortcuts[2] = ['Disney+', 'https://www.disneyplus.com/de-de/', './img/logos/disneyPlus.png', ''];
$shortcuts[3] = ['YouTube', 'https://www.youtube.com/', './img/logos/youTube.png', ''];

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