<?php
// Get the file URL from the query parameter
$fileUrl = $_GET['file'];

// Set the appropriate headers for file download
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . basename($fileUrl) . '"');

// Output the raw file content
echo file_get_contents($fileUrl);
