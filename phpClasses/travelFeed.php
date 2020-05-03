<?php

/**
 * Class travelFeed
 * Get information bus & tram
 */
class travelFeed extends feedDashboard
{
    private $default_travelClient = ['systemName'=>'dvb', 'fullName'=>'DVB AG','newsClient'=>'twitter', 'newsClientProfile' => 'DVBAG', 'departureClient'=>'dvb'];

    /**
     * Create feed content for travel
     *
     * @param bool | array $travelClient
     * @return  string
     * @author Kilian Domaratius
     *
     */
    public function createTravelFeed ($travelClient = false) {
        $htmlOutput = "";

        if ($travelClient === false) {
            $travelClient = $this->default_travelClient;
        }

        $htmlOutput .= $this->createTravelNews($travelClient['fullName'], $travelClient['newsClient'], $travelClient['newsClientProfile']);
        $htmlOutput .= $this->createTravelDepartures($travelClient['fullName'], $travelClient['departureClient']); //TODO DVB API

        return $htmlOutput;
    }


    /**
     * Creates news field for travel client
     * Uses twitter profiles
     *
     * @param $name
     * @param $client
     * @param string $clientProfile
     * @return string
     * @author Kilian Domaratius
     *
     */
    private function createTravelNews ($name, $client, $clientProfile = "") {
        $htmlOutput = "";

        //start DIV container for news
        $htmlOutput .= "<div class='feed-content'>";
        $htmlOutput .= "<h4 class='feed-contentHeading'>News</h4>";

        switch ($client) {
            case "twitter":
                $htmlOutput .= "<a class='twitter-timeline' 
                                href='https://twitter.com/$clientProfile?ref_src=twsrc%5Etfw' 
                                data-chrome='nofooter noborders transparent'
                                data-height='250'></a> 
                            <script async src='https://platform.twitter.com/widgets.js' charset='utf-8'></script>";
                break;
            default:
                //client not available
                $htmlOutput .= $this->emptyFeed("News for $name not available", true);
        }

        //end DIV container for news
        $htmlOutput .= "</div>";

        return $htmlOutput;
    }


    /**
     * Creates departure field for travel client
     * Uses APIs
     *
     * @param $name
     * @param $client
     * @return  string
     * @author Kilian Domaratius
     *
     */
    private function createTravelDepartures ($name, $client) {
        $htmlOutput = "";

        //start DIV container for departures
        $htmlOutput .= "<div class='feed-content'>";
        $htmlOutput .= "<h4 class='feed-contentHeading'>Departures</h4>";

        //use needed API
        switch ($client) {
            case "dvb":
                //TODO DVB API
                $htmlOutput .= $this->emptyFeed("Departure for $name not available", true);
                break;
            default:
                //client not available
                $htmlOutput .= $this->emptyFeed("Departure for $name not available", true);
        }

        //end DIV container for departures
        $htmlOutput .= "</div>";

        return $htmlOutput;
    }
}