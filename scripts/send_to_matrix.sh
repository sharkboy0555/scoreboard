#!/bin/bash
# send_to_matrix.sh
# Usage: ./send_to_matrix.sh "<overlay_model>" "<message>"

MODEL="1"  # Replace with your Pixel Overlay Model name
BLOCK_MODE=1        # 1=normal, 2=transparent, 3=transparent RGB

MSG=$(echo "$2" | sed "s/'//g")  # sanitize

# 1. Clear existing overlay
curl -s -X POST "http://localhost:32322/overlays/model/${MODEL}/clear"

# 2. Enable (or overlay) the model
curl -s -X PUT -H "Content-Type: application/json" \
  -d '{"state":'"${BLOCK_MODE}"'}' \
  "http://localhost:32322/overlays/model/${MODEL}/state"

# 3. Send text
curl -s -X PUT -H "Content-Type: application/json" \
  -d '{"Message":"'"${MSG}"'","Color":"#FFFFFF","Font":"Helvetica","Size":14,"Position":"R2L","PPS":32,"AntiAlias":true}' \
  "http://localhost:32322/overlays/model/${MODEL}/text"
