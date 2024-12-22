<?php
// Set the directory to scan
$directory = "./html_files"; // Replace with the path to your directory

// Function to extract IP address prefix from filename
function extractIpAddress($filename) {
    // Regular expression to match an IP address at the beginning of the filename
    if (preg_match('/^(\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3})/', $filename, $matches)) {
        return $matches[1];
    }
    return null;
}

// Scan the directory for files
$files = scandir($directory);

// Initialize an array to group files by IP address
$ipGroups = [];

foreach ($files as $file) {
    // Skip directories and non-HTML files
    if (is_dir($directory . '/' . $file) || pathinfo($file, PATHINFO_EXTENSION) !== 'html') {
        continue;
    }

    // Extract the IP address from the filename
    $ipAddress = extractIpAddress($file);
    if ($ipAddress) {
        // Group the file under the corresponding IP address
        $ipGroups[$ipAddress][] = $file;
    }
}

// Generate the HTML output
echo "<!DOCTYPE html>
<html>
<head>
    <title>IP Grouped HTML Files</title>
</head>
<body>
<h1>Grouped HTML Files by IP Address</h1>";

foreach ($ipGroups as $ipAddress => $files) {
    echo "<h2>IP: $ipAddress</h2>";
    echo "<ul>";
    foreach ($files as $file) {
        $filePath = htmlspecialchars($directory . '/' . $file);
        $fileName = htmlspecialchars($file);
        echo "<li><a href='$filePath'>$fileName</a></li>";
    }
    echo "</ul>";
}

echo "</body>
</html>";
?>
