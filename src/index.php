<?php
define("e0b3d458-b76e-40f5-b186-86ca96a4a578", "1");

include_once("google-analytics.php");

$type = $_GET["type"];

// Pageview
$path = $_GET["path"];
$title = $_GET["title"];

// Event
$category = $_GET["category"];
$action = $_GET["action"];
$label = $_GET["label"];
$value = $_GET["value"];

switch ($type) {
    case "page_view":
        sendPageView($path, $title);
    break;
    case "event":
        sendEvent($category, $action, $label, $value);
    break;
    default:
        echo "Only page_view and event are supported as type";
}

?>