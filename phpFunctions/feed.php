<?php
/**
 * Generate feeds
 */

/**
 * Creates empty feed containers
 * Content will be loading by ajax
 *
 * @param array $feedTypes
 * @return  string
 * @author Kilian Domaratius
 *
 */
function createFeeds ($feedTypes) {
    $htmlOutput = "";

    //check feed type
    foreach ($feedTypes as $feedType) {
        $htmlOutput .= startFeed($feedType[0], $feedType[1]);
        $htmlOutput .= "<div class='feed-content-load'></div>";
        $htmlOutput .= endFeed();
    }

    return $htmlOutput;
}


/**
 * Starts DIV container for a feed
 *
 * @author Kilian Domaratius
 *
 * @param   string  $type
 * @param   bool|string $name
 * @return  string
 */
function startFeed ($type, $name = false) {
    $htmlOutput = "";

    //if name is empty use type
    if (!$name) { $name = $type; }

    //create container
    $htmlOutput .= "<div id='feed-$type' class='col-12 col-md-6 col-lg-4 feed'>";
    $htmlOutput .= "<div id='feed-$type-head' class='feed-head d-flex align-items-baseline justify-content-between'>
                        <span class='feed-name'>$name</span>
                        <span class='feed-update' onclick='updateFeed(\"$type\")' title='Update $name'>
                            &nbsp;<span id='feed-$type-updateTime' class='feed-updateTime'>" . date("G:i") . "</span>
                            &nbsp;<i id='spinner-$type' class='fas fa-sync updateSpinner'></i>
                        </span>
                    </div>";
    $htmlOutput .= "<div id='feed-$type-inner' class='feed-inner'>";

    return $htmlOutput;
}


/**
 * Ends DIV container for a feed
 *
 * @author Kilian Domaratius
 *
 * @return  string
 */
function endFeed () {
    return "</div></div>";
}


/**
 * Creates empty feed content with default message
 *
 * @param string $message
 * @return string
 */
function emptyFeed($message = "Feed not available", $isContent = false) {
    $htmlOutput = "";

    //create content container
    if (!$isContent) $htmlOutput .= "<div class='feed-content feed-content-empty'>";

    //create message block for empty feed
    $htmlOutput .= "<div class='feed-empty '><i class='fas fa-heart-broken'></i></span><br><span class='feed-empty-text'>$message</span></div>";

    if (!$isContent) $htmlOutput .= "</div>";


    return $htmlOutput;
}