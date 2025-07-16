#!/usr/bin/env python3
import fppplugin
import json
from flask import request, jsonify

class ScoreboardPlugin(fppplugin.FPPPlugin):
    def __init__(self):
        super().__init__("scoreboard-plugin")
        self.data = {
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
        self.log.info("Starting Scoreboard Plugin")
        self.registerHttpEndpoint("/api/update", self.handle_update, methods=["POST"])
        self.registerHttpEndpoint("/api/status", self.handle_status, methods=["GET"])
        return True

    def handle_update(self):
        try:
            new_data = request.get_json(force=True)
            if not new_data:
                return ("Invalid JSON", 400)

            self.data.update(new_data)
            self.log.info(f"Updated scoreboard data: {self.data}")
            return ("OK", 200)
        except Exception as e:
            self.log.error(f"Update error: {str(e)}")
            return (f"Error: {str(e)}", 500)

    def handle_status(self):
        return (json.dumps(self.data), 200)

if __name__ == "__main__":
    plugin = ScoreboardPlugin()
    plugin.run()
