# S3 Bucket Setup for Direct Video Access

## Overview
This guide explains how to configure your S3 bucket to allow direct video access without signed URLs.

## Required S3 Bucket Configuration

### 1. Make Bucket Public for Read Access

You need to configure your S3 bucket to allow public read access for the video files.

#### Option A: Via AWS Console

1. Go to AWS S3 Console
2. Select your bucket
3. Go to "Permissions" tab
4. Edit "Block public access settings" and uncheck:
   - Block public access to buckets and objects granted through new access control lists (ACLs)
   - Block public access to buckets and objects granted through any access control lists (ACLs)

5. Edit "Bucket Policy" and add:

```json
{
    "Version": "2012-10-17",
    "Statement": [
        {
            "Sid": "PublicReadGetObject",
            "Effect": "Allow",
            "Principal": "*",
            "Action": "s3:GetObject",
            "Resource": "arn:aws:s3:::YOUR-BUCKET-NAME/recordings/*"
        }
    ]
}
```

Replace `YOUR-BUCKET-NAME` with your actual bucket name.

### 2. Configure CORS

#### Via AWS Console:

1. Go to your S3 bucket in AWS Console
2. Go to "Permissions" tab
3. Scroll down to "Cross-origin resource sharing (CORS)"
4. Click "Edit"
5. Paste the contents from `s3-cors-configuration.json`:

```json
[
    {
        "AllowedHeaders": ["*"],
        "AllowedMethods": ["GET", "HEAD"],
        "AllowedOrigins": ["*"],
        "ExposeHeaders": [
            "Content-Length",
            "Content-Type",
            "Content-Range",
            "ETag"
        ],
        "MaxAgeSeconds": 3600
    }
]
```

#### Via AWS CLI:

```bash
aws s3api put-bucket-cors --bucket YOUR-BUCKET-NAME --cors-configuration file://s3-cors-configuration.json
```

### 3. Set Content-Type for Video Files

Ensure your video files have the correct Content-Type header set:

#### For existing files:
```bash
aws s3 cp s3://YOUR-BUCKET-NAME/recordings/ s3://YOUR-BUCKET-NAME/recordings/ \
  --recursive \
  --metadata-directive REPLACE \
  --content-type video/mp4 \
  --acl public-read
```

#### For new uploads (in your upload script):
When uploading videos to S3, ensure you set:
- Content-Type: video/mp4
- ACL: public-read

### 4. Update Environment Variables

Make sure your `.env` file has the correct AWS configuration:

```env
AWS_ACCESS_KEY_ID=your-access-key
AWS_SECRET_ACCESS_KEY=your-secret-key
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=your-bucket-name
```

## Troubleshooting Video Playback Issues

### Common Issues and Solutions:

1. **CORS Error in Browser Console**
   - Solution: Verify CORS configuration is applied correctly
   - Check: `aws s3api get-bucket-cors --bucket YOUR-BUCKET-NAME`

2. **403 Forbidden Error**
   - Solution: Check bucket policy allows public read access
   - Verify the object ACL is set to public-read

3. **Video Not Playing but URL Works in Browser Tab**
   - This is typically a CORS issue
   - Ensure ExposeHeaders includes Content-Range for video seeking

4. **Content-Type Issues**
   - Verify files have correct Content-Type: `video/mp4`
   - Check: `aws s3api head-object --bucket YOUR-BUCKET-NAME --key recordings/path/to/video.mp4`

## Security Considerations

⚠️ **Warning**: This configuration makes your video files publicly accessible to anyone with the URL.

If you need to restrict access:
1. Consider using CloudFront with signed URLs instead
2. Implement IP restrictions in the bucket policy
3. Use AWS IAM roles for server-side access only

## Alternative: Using CloudFront

For better performance and caching, consider using CloudFront:

1. Create a CloudFront distribution
2. Set your S3 bucket as the origin
3. Configure CORS headers in CloudFront behaviors
4. Update your application to use CloudFront URLs instead of S3 URLs

Example CloudFront URL format:
```
https://d1234567890.cloudfront.net/recordings/{camera_id}/{recording_name}
```

## Testing

After configuration, test video playback:

1. Open browser developer console
2. Navigate to your application
3. Try to play a video
4. Check for any CORS or access errors in the console
5. Verify the video element's `crossorigin` attribute is set correctly