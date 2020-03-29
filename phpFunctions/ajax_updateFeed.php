<?php

//load require function files
require_once "feed.php";
require_once "calendar.php";
require_once "music.php";
require_once "news.php";
require_once "tasks.php";
require_once "travel.php";
require_once "wallpaper.php";
require_once "weather.php";
require_once "../libraries/rss-php/feed.php";
include "../sensitveData.php";

//feed type
$feedType = $_REQUEST["feedType"];

//get feed content
try {
    echo updateFeed($feedType);
} catch (FeedException $e) {
}


/**
 * Calls right functions foreach feed
 *
 * @param $feedType
 * @return string
 * @throws FeedException
 */
function updateFeed($feedType) {
    $htmlOutput = "";
    global $weatherApiKey;

    //call functions
    switch ($feedType) {
        case "calendar":
            //TODO call function calendar
            $htmlOutput .= emptyFeed();
            break;
        case "news":
            //TODO onetime function writing
            $htmlOutput .= createNewsFeed("tagesschau");
            $htmlOutput .= createNewsFeed("heise");
            break;
        case "tasks":
            //TODO call function tasks
            $htmlOutput .= emptyFeed();
            break;
        case "travel":
            $htmlOutput .= createTravelFeed("dvb");
            break;
        case "weather":
            $htmlOutput .= createWeatherFeed($weatherApiKey,"Dresden", "en", true, true, true);
            break;
        default:
            //wrong feed type
            $htmlOutput .= emptyFeed();
            $htmlOutput .= "<script> console.log('Feed type $feedType not available'); </script>";
    }

    return $htmlOutput;
}