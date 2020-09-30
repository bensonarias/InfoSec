<?php

if(!isset($_SESSION)) {
    session_start();
}

function logging($type, $message) {
    // Parse json file to array
    $logs = file_get_contents("log.json");

    echo $logs;

    if(!file_exists('log.json')) {
        file_put_contents('log.json','');
    }

    date_default_timezone_set('Asia/Manila');
   
    // Decode and convert it into an array
    $jsonArray = json_decode($logs, true);
    echo $jsonArray;
     $log_data = array(
        'visitor_session_id' => session_id(),
        'ip' => $_SERVER['REMOTE_ADDR'],
        'time' => date('m/d/y h:iA', time()),
        'type' => $type,
        'message' => $message
    );

    // Push the new log_data
    $jsonArray[] = $log_data;

    // Encode it to make it a json again
    $log_json = json_encode($log_data, true);
    $contents = "$log_json";

    file_put_contents('log.json', $contents);
}