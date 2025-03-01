<?php
require_once("connection.php");
require_once("staff_files.php");
/**
 * @var PDO $dbh
 */

if (empty($_GET['contractor_id'])) {
    header('Location: dashboard_contractor.php');
    exit;
}

$stmt = $dbh->prepare("SELECT * FROM `contractor` WHERE `contractor_id` = :contractor_id");
$stmt->execute(['contractor_id' => $_GET['contractor_id']]);

if ($stmt->rowCount() == 1 && $row = $stmt->fetchObject()) {
    ?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <title>Contractor Details - <?= htmlspecialchars($row->firstName) ?> <?= htmlspecialchars($row->lastName) ?></title>
    </head>
    <body class="bg-body-tertiary">
    <div class="container mt-5">
        <h1>Contractor Details</h1>
        <table class="table table-bordered">
            <tr>
                <th>Current Profile Picture</th>
                <td><img src="<?= htmlspecialchars($row->profile_picture) ?>"style="max-width: 200px;"></td>
            </tr>
            <tr>
                <th>First Name</th>
                <td><?= htmlspecialchars($row->firstName) ?></td>
            </tr>
            <tr>
                <th>Last Name</th>
                <td><?= htmlspecialchars($row->lastName) ?></td>
            </tr>
            <tr>
                <th>Specialty</th>
                <td><?= htmlspecialchars($row->specialty) ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?= htmlspecialchars($row->email) ?></td>
            </tr>
            <tr>
                <th>Phone</th>
                <td><?= htmlspecialchars($row->phone) ?></td>
            </tr>
            <tr>
                <th>Address</th>
                <td><?= htmlspecialchars($row->address) ?></td>
            </tr>
        </table>
        <a href="dashboard_contractor.php" class="btn btn-primary">Back to Contractor List</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>
    <?php
} else {
    header('Location: dashboard_contractor.php');
    exit;
}
?>
