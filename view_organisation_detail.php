<?php
require_once("connection.php");
require_once("staff_files.php");

/**
 * @var PDO $dbh
 */

if (empty($_GET['organisation_id'])) {
    header('Location: dashboard_organisation.php');
    exit;
}

$stmt = $dbh->prepare("SELECT * FROM `organisation` WHERE `organisation_id` = :organisation_id");
$stmt->execute(['organisation_id' => $_GET['organisation_id']]);

if ($stmt->rowCount() == 1 && $row = $stmt->fetchObject()) {
    ?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <title>Contractor Details - <?= htmlspecialchars($row->business_name) ?></title>
    </head>
    <body class="bg-body-tertiary">
    <div class="container mt-5">
        <h1>Organisation Details</h1>
        <table class="table table-bordered">
            <tr>
                <th>Business Name</th>
                <td><?= htmlspecialchars($row->business_name) ?></td>
            </tr>
            <tr>
                <th>Business Website</th>
                <td><?= htmlspecialchars($row->business_website) ?></td>
            </tr>
            <tr>
                <th>Business Description</th>
                <td><?= htmlspecialchars($row->business_description) ?></td>
            </tr>
            <tr>
                <th>Industry</th>
                <td><?= htmlspecialchars($row->industry) ?></td>
            </tr>
        </table>
        <a href="dashboard_organisation.php" class="btn btn-primary">Back to Organisation List</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>
    <?php
} else {
    header('Location: dashboard_organisation.php');
    exit;
}
?>
