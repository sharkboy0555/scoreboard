<?php

// Load existing settings if available
$settingsFile = '/home/fpp/media/plugins/scoreboard-plugin/settings.json';
$settings = [];
if (file_exists($settingsFile)) {
    $settings = json_decode(file_get_contents($settingsFile), true);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $settings['machine'] = $_POST['machine'] ?? '';
    $settings['order'] = $_POST['order'] ?? '';
    $settings['part'] = $_POST['part'] ?? '';
    $settings['currentQty'] = $_POST['currentQty'] ?? '';
    $settings['orderQty'] = $_POST['orderQty'] ?? '';
    $settings['setupTime'] = $_POST['setupTime'] ?? '';
    $settings['setupGoal'] = $_POST['setupGoal'] ?? '';

    // Save settings
    file_put_contents($settingsFile, json_encode($settings));

    // Example of sending a test message to the matrix (replace this with your real command/script)
    $msg = "Machine: {$settings['machine']} | Order: {$settings['order']} | Qty: {$settings['currentQty']}/{$settings['orderQty']}";
    exec("/home/fpp/media/plugins/scoreboard-plugin/scripts/send_to_matrix.sh '" . escapeshellarg($msg) . "'");

    echo "<div style='color: green;'>Settings saved and message sent to matrix.</div>";
}

?>

<h2>Scoreboard Configuration</h2>
<form method="POST">
    <label>Machine #: <input name="machine" value="<?= htmlspecialchars($settings['machine'] ?? '') ?>" /></label><br>
    <label>Order #: <input name="order" value="<?= htmlspecialchars($settings['order'] ?? '') ?>" /></label><br>
    <label>Part #: <input name="part" value="<?= htmlspecialchars($settings['part'] ?? '') ?>" /></label><br>
    <label>Current Qty: <input name="currentQty" value="<?= htmlspecialchars($settings['currentQty'] ?? '') ?>" /></label><br>
    <label>Order Qty: <input name="orderQty" value="<?= htmlspecialchars($settings['orderQty'] ?? '') ?>" /></label><br>
    <label>Current Setup Time: <input name="setupTime" value="<?= htmlspecialchars($settings['setupTime'] ?? '') ?>" /></label><br>
    <label>Setup Time Goal: <input name="setupGoal" value="<?= htmlspecialchars($settings['setupGoal'] ?? '') ?>" /></label><br>
    <button type="submit">Save and Send Test</button>
</form>
