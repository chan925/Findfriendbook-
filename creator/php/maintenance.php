<?php
// Secure this page to creator-only access.
// In a real application, this would be a robust authentication check.
session_start();
if (!isset($_SESSION['is_creator_logged_in']) || $_SESSION['is_creator_logged_in'] !== true) {
    // For this example, we'll simulate a login check.
    // To access this page, you would first need to go through `dev-auth.php`.
    // If not logged in, you can redirect to a login page or show an error.
    die('<h1>Access Denied</h1><p>You must be logged in as a creator to access this page.</p>');
}

// Define the path for our maintenance flag file within the creator data directory.
$maintenanceFlagFile = __DIR__ . '/../data/maintenance.flag';

$message = ''; // To store feedback message for the user

// --- Handle Form Submission ---
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'enable') {
            // Create the flag file to enable maintenance mode
            if (!file_exists($maintenanceFlagFile)) {
                touch($maintenanceFlagFile);
                $message = 'Maintenance mode has been enabled.';
            }
        } elseif ($_POST['action'] === 'disable') {
            // Delete the flag file to disable maintenance mode
            if (file_exists($maintenanceFlagFile)) {
                unlink($maintenanceFlagFile);
                $message = 'Maintenance mode has been disabled. The site is now live.';
            }
        }
    }
    // Redirect to the same page to prevent form resubmission on refresh
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

// --- Check Current Status ---
$isMaintenanceMode = file_exists($maintenanceFlagFile);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maintenance Mode Control</title>
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif; background-color: #f5f5f5; color: #333; margin: 40px; }
        .container { background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); max-width: 600px; margin: auto; }
        h1 { color: #1d1d1d; }
        .status { padding: 15px; border-radius: 5px; font-size: 1.1em; font-weight: bold; text-align: center; margin: 20px 0; }
        .status.on { background-color: #fffbe6; border: 1px solid #ffe58f; color: #d46b08; }
        .status.off { background-color: #f6ffed; border: 1px solid #b7eb8f; color: #389e0d; }
        .button { display: inline-block; padding: 12px 25px; font-size: 1em; color: #fff; border: none; border-radius: 5px; cursor: pointer; text-decoration: none; text-align: center; }
        .enable-btn { background-color: #faad14; }
        .enable-btn:hover { background-color: #d48806; }
        .disable-btn { background-color: #52c41a; }
        .disable-btn:hover { background-color: #389e0d; }
        .nav-link { display: block; margin-top: 25px; text-align: center; }
    </style>
</head>
<body>

    <div class="container">
        <h1>Maintenance Mode Control Panel</h1>
        
        <?php if ($isMaintenanceMode): ?>
            <div class="status on">
                CURRENT STATUS: Site is IN MAINTENANCE MODE.
            </div>
            <p>Only logged-in creators can browse the site. All other users will see the maintenance page.</p>
            <form method="POST" action="">
                <button type="submit" name="action" value="disable" class="button disable-btn">Disable Maintenance Mode</button>
            </form>
        <?php else: ?>
            <div class="status off">
                CURRENT STATUS: Site is LIVE.
            </div>
            <p>All users can access the site normally.</p>
            <form method="POST" action="">
                <button type="submit" name="action" value="enable" class="button enable-btn">Enable Maintenance Mode</button>
            </form>
        <?php endif; ?>

        <a href="../dev.html" class="nav-link">← Back to Creator Dev Panel</a>
    </div>

</body>
</html>
