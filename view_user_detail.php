<?php
require_once("connection.php");
require_once("staff_files.php");

/**
 * @var PDO $dbh
 */

if (empty($_GET['user_id'])) {
    header('Location: dashboard_user.php');
    exit;
}

$stmt = $dbh->prepare("SELECT * FROM `user` WHERE `user_id` = :user_id");
$stmt->execute(['user_id' => $_GET['user_id']]);

if ($stmt->rowCount() == 1 && $row = $stmt->fetchObject()) {
    ?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <title>User Details - <?= htmlspecialchars($row->firsName) ?> <?= htmlspecialchars($row->lastName) ?></title>
    </head>
    <body class="bg-body-tertiary">
    <div class="container mt-5">
        <h1>User Details</h1>
        <table class="table table-bordered">
            <tr>
                <th>Email</th>
                <td><?= htmlspecialchars($row->email) ?></td>
            </tr>
            <tr>
                <th>Password</th>
                <td><?= htmlspecialchars($row->password) ?></td>
            </tr>
            <tr>
                <th>First Name</th>
                <td><?= htmlspecialchars($row->firstName) ?></td>
            </tr>
            <tr>
                <th>Last Name</th>
                <td><?= htmlspecialchars($row->lastName) ?></td>
            </tr>
        </table>
        <a href="dashboard_user.php" class="btn btn-primary">Back to User List</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>
    <?php
} else {
    header('Location: dashboard_user.php');
    exit;
}
?>
