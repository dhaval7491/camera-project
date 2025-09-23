#!/bin/bash

# Test Recording API Script
# This script tests the recording API endpoint from the Janus server

# Configuration
API_URL="http://your-laravel-app.com/api/janus/recording/store"
API_TOKEN="your-secure-api-token-here-change-this"

# Test data
CAMERA_ID="23"
TIMESTAMP=$(date '+%Y-%m-%d %H:%M:%S')
S3_PATH="recordings/${CAMERA_ID}/$(date '+%Y/%m')/test_$(date '+%s').mp4"

echo "==========================================="
echo "Testing Recording API"
echo "==========================================="
echo "API URL: ${API_URL}"
echo "Camera ID: ${CAMERA_ID}"
echo "Timestamp: ${TIMESTAMP}"
echo "S3 Path: ${S3_PATH}"
echo "==========================================="

# Make the API call
response=$(curl -s -w "\n%{http_code}" -X POST "${API_URL}" \
  -H "Authorization: Bearer ${API_TOKEN}" \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d "{
    \"camera_id\": \"${CAMERA_ID}\",
    \"recording_timestamp\": \"${TIMESTAMP}\",
    \"recording_name\": \"${S3_PATH}\"
  }")

# Extract body and status code
body=$(echo "$response" | head -n -1)
status_code=$(echo "$response" | tail -n 1)

echo "Response Status: ${status_code}"
echo "Response Body:"
echo "${body}" | python -m json.tool 2>/dev/null || echo "${body}"

# Check if successful
if [ "$status_code" -eq 201 ] || [ "$status_code" -eq 200 ]; then
    echo "==========================================="
    echo "✅ SUCCESS: Recording API test passed!"
    echo "==========================================="
    exit 0
else
    echo "==========================================="
    echo "❌ FAILED: Recording API test failed!"
    echo "==========================================="
    exit 1
fi