<?php
require_once('../../includes/fpp-plugin.php');

fpp_plugin_header("Scoreboard Configuration");
?>

<style>
  label { display: inline-block; width: 150px; margin-top: 8px; }
  input { margin-bottom: 8px; }
</style>

<h2>Scoreboard Configuration</h2>

<form id="scoreboardForm">
  <label>Machine #:</label>
  <input type="text" id="machine"><br>

  <label>Order #:</label>
  <input type="text" id="order"><br>

  <label>Part #:</label>
  <input type="text" id="part"><br>

  <label>Current Setup Time:</label>
  <input type="text" id="currentSetup" placeholder="00:00"><br>

  <label>Setup Time Goal:</label>
  <input type="text" id="setupGoal" placeholder="00:00"><br>

  <label>Current Qty:</label>
  <input type="number" id="currentQty"><br>

  <label>Order Qty:</label>
  <input type="number" id="orderQty"><br>

  <label>BPH Shift:</label>
  <input type="number" id="bphShift"><br>

  <label>BPH Standard:</label>
  <input type="number" id="bphStandard"><br>

  <button type="button" onclick="sendData()">Update Scoreboard</button>
</form>

<div id="response" style="margin-top:10px; font-weight:bold;"></div>

<script>
function sendData() {
  const data = {
    machine: document.getElementById('machine').value,
    order: document.getElementById('order').value,
    part: document.getElementById('part').value,
    currentSetup: document.getElementById('currentSetup').value,
    setupGoal: document.getElementById('setupGoal').value,
    currentQty: parseInt(document.getElementById('currentQty').value) || 0,
    orderQty: parseInt(document.getElementById('orderQty').value) || 0,
    bphShift: parseInt(document.getElementById('bphShift').value) || 0,
    bphStandard: parseInt(document.getElementById('bphStandard').value) || 0
  };

  fetch('api/update', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify(data)
  })
  .then(response => response.text())
  .then(text => {
    document.getElementById('response').textContent = "Update response: " + text;
  })
  .catch(err => {
    document.getElementById('response').textContent = "Error updating scoreboard: " + err;
  });
}

// Optionally: Load current values on page load
window.onload = function() {
  fetch('api/status')
    .then(response => response.json())
    .then(data => {
      document.getElementById('machine').value = data.machine;
      document.getElementById('order').value = data.order;
      document.getElementById('part').value = data.part;
      document.getElementById('currentSetup').value = data.currentSetup;
      document.getElementById('setupGoal').value = data.setupGoal;
      document.getElementById('currentQty').value = data.currentQty;
      document.getElementById('orderQty').value = data.orderQty;
      document.getElementById('bphShift').value = data.bphShift;
      document.getElementById('bphStandard').value = data.bphStandard;
    })
    .catch(() => {
      // no initial data found or error
    });
};
</script>

<?php
fpp_plugin_footer();
?>
