<?php
// Function to validate URL
function validateUrl($url) {
    // Check if the URL is valid
    if (filter_var($url, FILTER_VALIDATE_URL) === FALSE) {
        return false;
    }
    // Ensure the URL is using HTTP or HTTPS
    if (parse_url($url, PHP_URL_SCHEME) !== 'http' && parse_url($url, PHP_URL_SCHEME) !== 'https') {
        return false;
    }
    return true;
}

// Get the file URL from the query parameter
$fileUrl = isset($_GET['file']) ? $_GET['file'] : '';

if (!$fileUrl || !validateUrl($fileUrl)) {
    die('Invalid file URL.');
}

// Set the appropriate headers for file download
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . basename($fileUrl) . '"');

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $fileUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Optional: This can be removed for production

$response = curl_exec($ch);

if(curl_errno($ch)) {
    // Handle error
    die('Error: ' . curl_error($ch));
}

curl_close($ch);

if ($response) {
    echo $response;
} else {
    die('Failed to download file.');
}
