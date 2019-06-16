<?php

include_once("config.php");
include_once("util.php");

if (!defined("e0b3d458-b76e-40f5-b186-86ca96a4a578")) {
    exit();
}

// Measurement protocol parameters etc:
// https://developers.google.com/analytics/devguides/collection/protocol/v1/devguide

function sendPageView($path, $view_title) {

    $data = array(
        "t" => "pageview", // hit_type
        "dp" => "/" . $path, // page
        "dt" => $view_title, // title
    );

    sendToGoogleAnalytics($data);
}

function sendEvent($category, $action, $label, $value) {

    $data = array(
        "t" => "pageview", // hit_type
        "ec" => $category,
        "ea" => $action,
        "el" => $label,
        "ev" => $value
    );

    sendToGoogleAnalytics($data);
}

function sendToGoogleAnalytics($data) {

    $url = "https://www.google-analytics.com/collect";

    $data_default = array(
        "v" => "1", // version
        "tid" => $GLOBALS["CONFIG"]["tracking_id"], // tracking_id
        "cid" => !$GLOBALS["CONFIG"]["anonymous_user"] ? MD5(get_ip_address()) : null, // client_id
        "uip" => !$GLOBALS["CONFIG"]["anonymous_ip"] ? get_ip_address() : null,
    );

    $data_merged = array_merge($data_default, $data);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data_merged));
    
    $mh = curl_multi_init();
    curl_multi_add_handle($mh, $ch);
    
    do {
        $status = curl_multi_exec($mh, $active);
        if ($active) {
            // Wait a short time for more activity
            curl_multi_select($mh);
        }
    } while ($active && $status == CURLM_OK);
    
    curl_multi_remove_handle($mh, $ch);
    curl_multi_close($mh);
}

?>