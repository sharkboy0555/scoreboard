<?php
$settingsFile = '/home/fpp/media/plugins/scoreboard/settings.json';

$settings = [
    'machine' => $_POST['machine'] ?? '',
    'order' => $_POST['order'] ?? '',
    'part' => $_POST['part'] ?? '',
    'setup' => $_POST['setup'] ?? '',
    'goal' => $_POST['goal'] ?? '',
    'currentQty' => $_POST['currentQty'] ?? '',
    'orderQty' => $_POST['orderQty'] ?? '',
    'bphShift' => $_POST['bphShift'] ?? '',
    'bphStandard' => $_POST['bphStandard'] ?? ''
];

file_put_contents($settingsFile, json_encode($settings));

// Optionally trigger matrix redraw here (or handled via polling/renderFrame)
echo json_encode(['status' => 'saved']);
?>
