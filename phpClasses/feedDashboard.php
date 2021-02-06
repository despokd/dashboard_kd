<?php

require 'travelFeed.php';
require 'newsFeed.php';
require 'weatherFeed.php';

/**
 * Class feedDashboard
 * Generate feeds
 */
class feedDashboard {

    /**
     * Creates empty feed containers
     * Content will be loading by ajax
     *
     * @param array $feedTypes
     * @return  string
     * @author Kilian Domaratius
     *
     */
    public function createFeeds($feedTypes) {
        $htmlOutput = "";

        //check feed type
        foreach ($feedTypes as $feedType) {
            $htmlOutput .= $this->startFeed($feedType[0], $feedType[1]);
            $htmlOutput .= "<div class='feed-content-load'></div>";
            $htmlOutput .= $this->endFeed();
        }

        return $htmlOutput;
    }


    /**
     * Starts DIV container for a feed
     * @param $type
     * @param bool $name
     * @return string
     */
    protected function startFeed($type, $name = false) {
        $htmlOutput = "";

        //if name is empty use type
        if (!$name) {
            $name = $type;
        }

        //create container
        $htmlOutput .= "<div id='feed-$type' class='col-12 col-md-6 col-xl-4 feed'>";
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
     * @return string
     */
    protected function endFeed() {
        return "</div></div>";
    }


    /**
     * Creates empty feed content with default message
     *
     * @param string $message
     * @param bool $isContent
     * @return string
     */
    protected function emptyFeed($message = "Feed not available", $isContent = false) {
        $htmlOutput = "";

        //create content container
        if (!$isContent) {
            $htmlOutput .= "<div class='feed-content feed-content-empty'>";
        }

        //create message block for empty feed
        $htmlOutput .= "<div class='feed-empty '><i class='fas fa-heart-broken'></i></span><br><span class='feed-empty-text'>$message</span></div>";

        if (!$isContent) {
            $htmlOutput .= "</div>";
        }

        return $htmlOutput;
    }


    /**
     * Update a feed
     *
     * @param $feedType
     * @return string
     * @throws FeedException
     */
    public function updateFeed($feedType) {
        $htmlOutput = "";
        global $weatherApiKey;

        //call functions
        switch ($feedType) {
            case "calendar":
                //TODO call function calendar
                $htmlOutput .= $this->emptyFeed();
                break;
            case "news":
                //TODO onetime function writing
                $htmlOutput .= (new newsFeed())->createNewsFeed("tagesschau");
                //$htmlOutput .= (new newsFeed())->createNewsFeed("zdnet");
                break;
            case "tasks":
                //TODO call function tasks
                $htmlOutput .= $this->emptyFeed();
                break;
            case "travel":
                $htmlOutput .= (new travelFeed())->createTravelFeed();
                break;
            case "weather":
                $htmlOutput .= (new weatherFeed())->createWeatherFeed($weatherApiKey, "Dresden", "en", true, true, true);
                break;
            default:
                //wrong feed type
                $htmlOutput .= $this->emptyFeed();
                $htmlOutput .= "<script> console.log('Feed type $feedType not available'); </script>";
        }

        return $htmlOutput;
    }
}
