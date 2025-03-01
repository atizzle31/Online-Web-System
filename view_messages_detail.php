<?php
require_once("connection.php");
require_once("staff_files.php");

/**
 * @var PDO $dbh
 */

if (empty($_GET['contact_id'])) {
    header('Location: dashboard_mail.php');
    exit;
}

$stmt = $dbh->prepare("SELECT * FROM `contact_us` WHERE `contact_id` = :contact_id");
$stmt->execute(['contact_id' => $_GET['contact_id']]);

if ($stmt->rowCount() == 1 && $row = $stmt->fetchObject()) {
    ?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <title>Message From - <?= htmlspecialchars($row->firstName) ?> <?= htmlspecialchars($row->lastName) ?></title>
    </head>
    <body class="bg-body-tertiary">
    <div class="container mt-5">
        <h1>Message</h1>
        <table class="table table-bordered">
            <tr>
                <th>First Name</th>
                <td><?= htmlspecialchars($row->firstName) ?></td>
            </tr>
            <tr>
                <th>Last Name</th>
                <td><?= htmlspecialchars($row->lastName) ?></td>
            </tr>
            <tr>
                <th>Phone</th>
                <td><?= htmlspecialchars($row->phone) ?></td>
            </tr>
            <tr>
                <th>Message</th>
                <td><?= htmlspecialchars($row->message) ?></td>
            </tr>
        </table>
        <a href="dashboard_mail.php" class="btn btn-primary">Back to Messages</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>
    <?php
} else {
    header('Location: dashboard_mail.php');
    exit;
}
?>
