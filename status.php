<?php
include_once "../../common.php";
include_once "../../functions.php";
include_once "../../plugin.php";

$pluginName = "scoreboard-plugin";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Scoreboard Plugin</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        label {
            display: block;
            margin-top: 10px;
        }
        input {
            width: 300px;
            padding: 5px;
        }
        button {
            margin-top: 15px;
            padding: 10px;
        }
    </style>
</head>
<body>
    <h1>Scoreboard Plugin</h1>

    <form id="scoreboardForm">
        <label>Machine #: <input type="text" name="machine"></label>
        <label>Order #: <input type="text" name="order"></label>
        <label>Part #: <input type="text" name="part"></label>
        <label>Current Setup Time: <input type="text" name="currentSetup"></label>
        <label>Setup Time Goal: <input type="text" name="setupGoal"></label>
        <label>Current Qty: <input type="number" name="currentQty"></label>
        <label>Order Qty: <input type="number" name="orderQty"></label>
        <label>BPH Shift: <input type="number" name="bphShift"></label>
        <label>BPH Standard: <input type="number" name="bphStandard"></label>
        
        <button type="button" onclick="sendUpdate()">Send to Matrix</button>
    </form>

    <script>
        function loadCurrentData() {
            $.get('/plugin.php?plugin=scoreboard-plugin&page=api/status', function(data) {
                let json = JSON.parse(data);
                for (const key in json) {
                    if ($(`[name=${key}]`).length) {
                        $(`[name=${key}]`).val(json[key]);
                    }
                }
            });
        }

        function sendUpdate() {
            const formData = {};
            $('#scoreboardForm').serializeArray().forEach(e => formData[e.name] = e.value);
            
            $.ajax({
                url: '/plugin.php?plugin=scoreboard-plugin&page=api/update',
                method: 'POST',
                contentType: 'application/json',
                data: JSON.stringify(formData),
                success: function(res) {
                    alert("Updated successfully");
                },
                error: function(err) {
                    alert("Error sending data");
                }
            });
        }

        $(document).ready(loadCurrentData);
    </script>
</body>
</html>
