<?php
$pluginName = "scoreboard-plugin";
include_once("../../config.php");
include_once("../../common.php");
include_once("functions.php");

echo "<div class='fppplugin'>\n";
echo "<h2>Scoreboard Control</h2>\n";
?>

<form id="scoreboard-form">
  <label>Machine #: <input type="text" name="machine"></label><br>
  <label>Order #: <input type="text" name="order"></label><br>
  <label>Part #: <input type="text" name="part"></label><br>
  <label>Current Setup Time: <input type="text" name="currentSetup"></label><br>
  <label>Setup Goal: <input type="text" name="setupGoal"></label><br>
  <label>Current Qty: <input type="number" name="currentQty"></label><br>
  <label>Order Qty: <input type="number" name="orderQty"></label><br>
  <label>BPH Shift: <input type="number" name="bphShift"></label><br>
  <label>BPH Standard: <input type="number" name="bphStandard"></label><br><br>

  <button type="button" onclick="submitScoreboard()">Send to Matrix</button>
</form>

<script>
function submitScoreboard() {
  const data = {};
  const form = document.getElementById('scoreboard-form');
  const inputs = form.querySelectorAll('input');
  inputs.forEach(input => {
    data[input.name] = input.value;
  });

  fetch('/plugin/scoreboard-plugin/api/update', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify(data)
  }).then(res => {
    if (res.ok) alert("Sent!");
    else alert("Failed to send.");
  });
}
</script>

<?php
echo "</div>\n";
?>
