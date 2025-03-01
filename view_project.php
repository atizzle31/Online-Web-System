<?php
require_once("connection.php");
require_once("staff_files.php");

/**
 * @var PDO $dbh
 */

if (empty($_GET['project_id'])) {
    header('Location: dashboard_project.php');
    exit;
}

$stmt = $dbh->prepare("SELECT * FROM `project` WHERE `project_id` = :project_id");
$stmt->execute(['project_id' => $_GET['project_id']]);

if ($stmt->rowCount() == 1 && $row = $stmt->fetchObject()) {
    ?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <title>Project Details - <?= htmlspecialchars($row->project_name) ?></title>
    </head>
    <body class="bg-body-tertiary">
    <div class="container mt-5">
        <h1>Project Details</h1>
        <table class="table table-bordered">
            <tr>
                <th>Project Name</th>
                <td><?= htmlspecialchars($row->project_name) ?></td>
            </tr>
            <tr>
                <th>Project Description</th>
                <td><?= htmlspecialchars($row->project_description) ?></td>
            </tr>
            <tr>
                <th>Technique Required</th>
                <td><?= htmlspecialchars($row->technique_required) ?></td>
            </tr>
            <tr>
                <th>Due Date</th>
                <td><?= htmlspecialchars($row->due_date) ?></td>
            </tr>

            <tr>
                <th>Project Link</th>
                <td><?= htmlspecialchars($row->project_link) ?></td>
            </tr>

            <tr>
                <th>Organisation ID</th>
                <td><?= htmlspecialchars($row->organisation_id ?? '') ?></td>
            </tr>

            <tr>
                <th>Contractor ID</th>
                <td><?= htmlspecialchars($row->contractor_id ?? '') ?></td>
            </tr>
        </table>
        <a href="dashboard_project.php" class="btn btn-primary">Back to Project List</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>
    <?php
} else {
    header('Location: dashboard_project.php');
    exit;
}
?>
