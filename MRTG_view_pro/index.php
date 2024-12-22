<?php
// Set the directory to scan
$directory = "./html_files"; // Replace with the path to your directory

// Function to extract IP address prefix from filename
function extractIpAddress($filename) {
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
    if (is_dir($directory . '/' . $file) || pathinfo($file, PATHINFO_EXTENSION) !== 'html') {
        continue;
    }

    $ipAddress = extractIpAddress($file);
    if ($ipAddress) {
        $ipGroups[$ipAddress][] = $file;
    }
}

// Generate the HTML output
?>
<!DOCTYPE html>
<html>
<head>
    <title>Network Device</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #4CAF50;
            color: white;
            padding: 1em;
            text-align: center;
        }
        main {
            padding: 20px;
            max-width: 800px;
            margin: 20px auto;
            background: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        h2 {
            color: #4CAF50;
            border-bottom: 2px solid #4CAF50;
            padding-bottom: 5px;
        }
        ul {
            list-style: none;
            padding: 0;
        }
        li {
            margin: 5px 0;
        }
        a {
            color: #007BFF;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<header>
    <h1>Network Device list</h1>
</header>
<main>
    <?php foreach ($ipGroups as $ipAddress => $files): ?>
        <section>
            <h2>IP: <?= htmlspecialchars($ipAddress) ?></h2>
            <ul>
                <?php foreach ($files as $file): ?>
                    <li>
                        <a href="<?= htmlspecialchars($directory . '/' . $file) ?>">
                            <?= htmlspecialchars($file) ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </section>
    <?php endforeach; ?>
</main>
</body>
</html>
