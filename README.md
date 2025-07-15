# Scoreboard Plugin for Falcon Player (FPP)

## Description

Manufacturing scoreboard with simple bar gauges, controllable via Node-RED or direct API calls.

## Installation

1. Clone this repo or download as ZIP.
2. In Falcon Player, go to Plugin Manager.
3. Click **Install Plugin from Git URL**.
4. Enter the URL of this repository.
5. Install and enable the plugin.

## Usage

- Access the scoreboard UI at:  
  `http://<fpp-ip>/plugin/scoreboard`

- Update data by sending POST requests to:  
  `http://<fpp-ip>/plugin/scoreboard/api/update`  
  with JSON body containing any of the keys:  
  `machine, order, part, currentSetup, setupGoal, currentQty, orderQty, bphShift, bphStandard`

- Fetch current data via GET:  
  `http://<fpp-ip>/plugin/scoreboard/api/status`

## Example POST data

```json
{
  "machine": "M12",
  "order": "12345",
  "part": "ABC-987",
  "currentSetup": "00:10",
  "setupGoal": "00:15",
  "currentQty": 150,
  "orderQty": 500,
  "bphShift": 400,
  "bphStandard": 450
}
```
