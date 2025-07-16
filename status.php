<?php
$settingsFile = '/home/fpp/media/plugins/scoreboard/settings.json';
$settings = [];

if (file_exists($settingsFile)) {
    $settings = json_decode(file_get_contents($settingsFile), true);
}

header('Content-Type: application/json');
echo json_encode([
    'status' => 'ok',
    'settings' => $settings
]);
?>
