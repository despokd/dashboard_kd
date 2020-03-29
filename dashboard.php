<?php
/**
 * Dashboard start page
 */

//load require function files
require_once "phpFunctions/feed.php";

//list of links for shortcuts
$shortcuts = [];
//TODO get $shortcuts from database
$shortcuts[] = ["Netflix", "netflix://", "https://assets.nflxext.com/us/ffe/siteui/common/icons/nficon2016.ico"];
$shortcuts[] = ["Prime", "https://www.amazon.de/Prime-Video/b?ie=UTF8&node=3279204031", "https://pbs.twimg.com/profile_images/1176422051432861696/_FpLxtU-_400x400.png"];
$shortcuts[] = ["Youtube", "https://www.youtube.com/", "https://s.ytimg.com/yts/img/favicon_144-vfliLAfaB.png"];
$shortcuts[] = ["ToDo", "https://to-do.microsoft.com/tasks/myday", "https://to-do-cdn.microsoft.com/webapp/41d71b1f269fe3d9faed2c1b171f85c4b109d01bac89805a9903f99c50af1150/touch-icon-180x180.png"];

//list of feeds
$feeds = [];
//TODO get $feeds from database
$feeds[] = ["travel", "Travel"];
$feeds[] = ["news", "News"];
$feeds[] = ["weather", "Weather"];
//$feeds[] = ["tasks", "Tasks"];
//$feeds[] = ["calendar", "Calendar"];

?>


<!DOCTYPE html>
<html lang="de">
<head>
    <!-- TODO get time (zone) from user -->
    <title>My Dashboard</title>
    <?php require_once "header.php"; ?>
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
                    <div class="row justify-content-end">
                        <?php
                        foreach ($shortcuts as $shortcut) {
                            echo createShortcut($shortcut[0], $shortcut[1], $shortcut[2]);
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
                //TODO set sorting and/or database
                try {
                    echo createFeeds($feeds);
                } catch (FeedException $e) {
                }
            ?>
        </div>
    </div>

    <?php require_once "footer.php"; ?>

</body>
</html>


<?php

/**
 * Creates DIV container for shortcuts
 *
 * @author Kilian Domaratius
 *
 * @param   string  $name
 * @param   string  $link
 * @param   string  $iconPath
 * @return  string
 */
function createShortcut ($name, $link, $iconPath = "") {
    $htmlOutput = "";

    $htmlOutput .= "<a class='shortcut-link' href='$link' target='_blank'>";
        $htmlOutput .= "<div class='shortcut col'>";
            $htmlOutput .= "<div class='shortcut-icon no-darkmode' style='background-image: url($iconPath);'></div>";
            $htmlOutput .= "<span class='shortcut-name'>$name</span>";
        $htmlOutput .= "</div>";
    $htmlOutput .= "</a>";

    return $htmlOutput;
}



