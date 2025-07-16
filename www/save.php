<?php
$settingsFile = '/home/fpp/media/plugins/scoreboard-plugin/settings.json';

$settings = [
    'machine' => $_POST['machine'] ?? '',
    'order' => $_POST['order'] ?? '',
    'part' => $_POST['part'] ?? '',
    'currentQty' => $_POST['currentQty'] ?? '',
    'orderQty' => $_POST['orderQty'] ?? '',
    'setupTime' => $_POST['setupTime'] ?? '',
    'setupGoal' => $_POST['setupGoal'] ?? ''
];

file_put_contents($settingsFile, json_encode($settings));

// Optional: Send to matrix
$msg = "Machine: {$settings['machine']} | Order: {$settings['order']} | Qty: {$settings['currentQty']}/{$settings['orderQty']}";
exec("/home/fpp/media/plugins/scoreboard-plugin/scripts/send_to_matrix.sh " . escapeshellarg($msg));

echo json_encode(['status' => 'saved']);
?>
