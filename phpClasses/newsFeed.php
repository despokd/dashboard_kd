<?php

/**
 * Class newsFeed
 * Get information about news
 */
class newsFeed extends feedDashboard
{
    /**
     * Create feed content for travel
     *
     * @author Kilian Domaratius
     *
     * @param   string  $newsClient
     * @throws  FeedException
     * @return  string
     */
    public function createNewsFeed ($newsClient) {
        $htmlOutput = "";

        //list of rss feeds
        $clients = [];
        $clients['tagesschau'] = array('Tagesschau', 'https://www.tagesschau.de/xml/rss2', 'rss');
        $clients['heise'] = array('Heise', 'https://www.heise.de/rss/heise.rdf', 'rss');
        $clients['heise-top'] = array('Heise Top News', 'http://www.heise.de/rss/heise-top-atom.xml', 'atom');
        $clients['zdnet'] = array('ZDNet', 'https://www.zdnet.de/feed/', 'rss');

        //start DIV container for news
        $htmlOutput .= "<div class='feed-content'>";
        $htmlOutput .= "<h4 class='feed-contentHeading'>" . $clients[$newsClient][0] . '</h4>';
        $htmlOutput .= "<div class='news-scroll'>";

        //get rss
        switch ($clients[$newsClient][2]) {
            case 'rss':
                //Standard RSS Feed
                $rss = Feed::loadRss($clients[$newsClient][1]);
                break;
            case 'atom':
                //TODO check functionality
                //Atom RSS Feed
                $rss = Feed::loadAtom($clients[$newsClient][1]);
                break;
            default:
                //not supported
                $htmlOutput .= $this->emptyFeed('RSS not supported', true);

                //end DIV container for news
                $htmlOutput .= '</div>';
                $htmlOutput .= '</div>';

                return $htmlOutput;

        }

        //check rss content
        if ( $rss->item === false ) {
            //no rss content
            $htmlOutput .= $this->emptyFeed('RSS not supported', true);
        }

        //create feed content
        foreach ($rss->item as $item) {
            /* all information
            $htmlOutput .= 'Title: '. $item->title;
            $htmlOutput .= 'Link: '. $item->link;
            $htmlOutput .= 'Timestamp: ' . $item->timestamp;
            $htmlOutput .= 'Description '. $item->description;
            $htmlOutput .= 'HTML encoded content: '. $item->{'content:encoded'} . "<br>";
            */

            $htmlOutput .= "
                        <div class='article'>
                            <a href='" . $item->link . "' target='_blank' title='Link to article: $item->title'>
                                <h5 class='article-title'>" . $item->title . "</h5>
                            </a>
                            <p class='article-description'>
                                " . $item->description . "
                                <br><a href='" . $item->link . "' target='_blank' title='Link to article'>Continue reading</a>
                            </p>
                        </div>
                        ";
        }

        //end DIV container for news
        $htmlOutput .= "</div>";
        $htmlOutput .= "</div>";

        return $htmlOutput;
    }
}