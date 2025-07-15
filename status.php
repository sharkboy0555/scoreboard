<?php
// status.php - main config page for your scoreboard plugin

// Basic header
require_once('../../includes/fpp-plugin.php'); // include FPP plugin helpers (adjust path if needed)

$pluginName = 'scoreboard-plugin';
fpp_plugin_header("Scoreboard Configuration");

// You can build your HTML config interface here, for example:
?>

<h1>Scoreboard Configuration</h1>

<p>Configure your manufacturing scoreboard here.</p>

<form method="post" action="save_config.php">
  <label>Machine #:</label><br>
  <input type="text" name="machine" value=""><br><br>

  <label>Order #:</label><br>
  <input type="text" name="order" value=""><br><br>

  <label>Part #:</label><br>
  <input type="text" name="part" value=""><br><br>

  <!-- Add more input fields as you like -->

  <input type="submit" value="Save Configuration">
</form>

<?php

fpp_plugin_footer();
?>
