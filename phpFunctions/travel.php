<?php
/**
 * Get information bus & tram
 *
 * @author Kilian Domaratius
 */

//get required files for empty content
require_once "feed.php";

/**
 * Create feed content for travel
 *
 * @author Kilian Domaratius
 *
 * @param   string  $travelClient
 * @return  string
 */
function createTravelFeed ($travelClient) {
    $htmlOutput = "";

    switch ($travelClient) {
        case "dvb":
            $htmlOutput .= createTravelNews($travelClient, "twitter", "DVBAG");
            $htmlOutput .= createTravelDepartures($travelClient); //TODO
            break;
        default:
            //client not available
            $htmlOutput .= emptyFeed("Feed for $travelClient not available");
    }

    return $htmlOutput;
}


/**
 * Creates news field for travel client
 * Uses twitter profiles
 *
 * @author Kilian Domaratius
 *
 * @param string $travelClient
 * @param string $newsClient
 * @param string $newsClientProfile
 * @return string
 */
function createTravelNews ($travelClient, $newsClient, $newsClientProfile = "") {
    $htmlOutput = "";

    //start DIV container for news
    $htmlOutput .= "<div class='feed-content'>";
    $htmlOutput .= "<h4 class='feed-contentHeading'>News</h4>";

    switch ($newsClient) {
        case "twitter":
            $htmlOutput .= "<a class='twitter-timeline' 
                                href='https://twitter.com/$newsClientProfile?ref_src=twsrc%5Etfw' 
                                data-chrome='nofooter noborders transparent'
                                data-height='250'></a> 
                            <script async src='https://platform.twitter.com/widgets.js' charset='utf-8'></script>";
            break;
        default:
            //client not available
            $htmlOutput .= emptyFeed("News for $travelClient not available", true);
    }

    //end DIV container for news
    $htmlOutput .= "</div>";

    return $htmlOutput;
}


/**
 * Creates departure field for travel client
 * Uses APIs
 *
 * @author Kilian Domaratius
 *
 * @param   string  $travelClient
 * @return  string
 */
function createTravelDepartures ($travelClient) {
    $htmlOutput = "";

    //start DIV container for departures
    $htmlOutput .= "<div class='feed-content'>";
    $htmlOutput .= "<h4 class='feed-contentHeading'>Departures</h4>";

    switch ($travelClient) {
        case "dvb":
            //TODO DVB API
            $htmlOutput .= emptyFeed("Departure for DVB not available", true);
            break;
        default:
            //client not available
            $htmlOutput .= emptyFeed("Departure for $travelClient not available", true);
    }

    //end DIV container for departures
    $htmlOutput .= "</div>";

    return $htmlOutput;
}