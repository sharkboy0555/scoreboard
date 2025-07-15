#!/usr/bin/env python3
import fppplugin
import json
from flask import request

class ScoreboardPlugin(fppplugin.FPPPlugin):
    def __init__(self):
        super(ScoreboardPlugin, self).__init__("scoreboard-plugin")
        self.scoreboard_data = {
            "machine": "",
            "order": "",
            "part": "",
            "currentSetup": "00:00",
            "setupGoal": "00:00",
            "currentQty": 0,
            "orderQty": 0,
            "bphShift": 0,
            "bphStandard": 0
        }

    def onStart(self):
        self.log.info("Scoreboard plugin started")
        self.registerHttpEndpoint("/api/update", self.update_data, methods=['POST'])
        self.registerHttpEndpoint("/api/status", self.get_data, methods=['GET'])
        return True

    def update_data(self):
        try:
            new_data = request.get_json(force=True)
            if not new_data:
                return ("No JSON data received", 400)
            self.scoreboard_data.update(new_data)
            self.log.info(f"Updated scoreboard data: {self.scoreboard_data}")
            return ("OK", 200)
        except Exception as e:
            self.log.error(f"Error updating data: {str(e)}")
            return (f"Error: {str(e)}", 400)

    def get_data(self):
        return (json.dumps(self.scoreboard_data), 200)

if __name__ == "__main__":
    plugin = ScoreboardPlugin()
    plugin.run()
