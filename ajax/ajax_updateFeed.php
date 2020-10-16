<?php
require_once '/phpClasses/feedDashboard.php';
require_once '/sensitiveData.php';
require_once '/libraries/rss-php/feed.php';

try {
    echo (new feedDashboard())->updateFeed($_REQUEST["feedType"]);
} catch (FeedException $e) {
}
