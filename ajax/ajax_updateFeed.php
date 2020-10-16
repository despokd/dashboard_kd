<?php
require '/phpClasses/feedDashboard.php';
require '/sensitiveData.php';
require '/libraries/rss-php/feed.php';


try {
    echo (new feedDashboard())->updateFeed($_REQUEST["feedType"]);
} catch (FeedException $e) {
}
