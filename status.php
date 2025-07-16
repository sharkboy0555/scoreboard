<?php
header("Content-Type: application/json");

$settingsFile = '/home/fpp/media/plugins/scoreboard/settings.json';

if (file_exists($settingsFile)) {
    $json = file_get_contents($settingsFile);
    echo $json;
} else {
    echo json_encode(["status" => "ok", "settings" => []]);
}
?>
