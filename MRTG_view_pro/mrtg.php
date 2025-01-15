<?php
// Created by @Dyadav
// Updated : 15-01-2025 
$directory = "mrtg_data/";

function extractIpAddress($filename) {
    if (preg_match('/^(\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3})/', $filename, $matches)) {
        return $matches[1];
    }
    return null;
}

$files = scandir($directory);
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

function extractInterfaceName($filename) {
    if (preg_match('/_(.+)\.html$/', $filename, $matches)) {
        return $matches[1];
    }
    return null;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Network Device</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #18376C;
            color: white;
            padding: 5px;
            text-align: center;
        }

        main {
            padding: 20px;
            max-width: 1000px;
            margin: 20px auto;
            background: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h1 {
            text-align: center;
            color: white;
            font-size: 22px;
        }

        section {
            margin-bottom: 20px;
        }

        h2 {
            color: rgb(32, 71, 138);
            cursor: pointer;
            margin-bottom: 10px;
            font-size: 17px;
        }

        h2 img {
            width: 20px;
            height: 20px;
            margin-right: 10px;
        }

        .link-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            gap: 10px;
            list-style: none;
            padding: 0;
            display: none; /* Initially hide all details */
        }

        li {
            font-size: 13px;
        }

        a {
            color: rgb(32, 71, 138);
            text-decoration: none;
            display: flex;
            align-items: center;
        }

        a img {
            width: 15px;
            height: 15px;
            margin-right: 8px;
        }

        a:hover {
            font-weight: bold;
        }
    </style>
</head>
<body>
<header>
    <h1>Network Device List</h1>
</header>

<main>
    <?php foreach ($ipGroups as $ipAddress => $files): ?>
        <section>
            <h2 onclick="toggleDetails('details-<?= htmlspecialchars($ipAddress) ?>')">
                + <?= htmlspecialchars($ipAddress) ?>
            </h2>
            <ul id="details-<?= htmlspecialchars($ipAddress) ?>" class="link-grid">
                <?php foreach ($files as $file): ?>
                    <li>
                        <a href="<?= htmlspecialchars($directory . '/' . $file) ?>" target="_blank">
                            <img src="<?= $directory ?>/inteface.png" alt="Interface"> 
                            <?= htmlspecialchars(extractInterfaceName($file)); ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </section>
    <?php endforeach; ?>
</main>

<script>
    let currentlyVisible = null;

    function toggleDetails(id) {
        const current = document.getElementById(id);

        if (currentlyVisible && currentlyVisible !== current) {
            currentlyVisible.style.display = "none";
        }
        if (current.style.display === "block") {
            current.style.display = "none";
            currentlyVisible = null;
        } else {
            current.style.display = "grid";
            currentlyVisible = current;
        }
    }
</script>

</body>
</html>
