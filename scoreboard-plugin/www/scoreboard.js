function updateBar(id, value, max=100) {
  const bar = document.getElementById(id);
  if (!bar) return;
  const pct = Math.min(100, (value / max) * 100);
  bar.innerHTML = `<div style="width:${pct}%;"></div>`;
}

function fetchData() {
  fetch('/api/status')
    .then(res => res.json())
    .then(data => {
      document.getElementById('machine').textContent = data.machine;
      document.getElementById('order').textContent = data.order;
      document.getElementById('part').textContent = data.part;
      document.getElementById('currentSetup').textContent = data.currentSetup;
      document.getElementById('setupGoal').textContent = data.setupGoal;
      document.getElementById('currentQty').textContent = data.currentQty;
      document.getElementById('orderQty').textContent = data.orderQty;
      updateBar('bphShiftBar', data.bphShift, 1000);
      updateBar('bphStandardBar', data.bphStandard, 1000);
    })
    .catch(console.error);
}

setInterval(fetchData, 2000);
window.onload = fetchData;
