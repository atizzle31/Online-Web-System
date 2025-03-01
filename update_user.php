<?php
global $dbh;
require_once("connection.php");
require_once("staff_files.php");

if (empty($_GET['user_id'])) {
    header('Location: dashboard_user.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'):
    // query to get all values for form inputs
    $hashedPassword = hash('sha256', $_POST['password']);

    $query = "UPDATE `user` SET 
              `email` = :email, 
              `password` = :password,
              `firstName` = :firstName,
              `lastName` = :lastName
              WHERE `user_id` = :user_id";
    $stmt = $dbh->prepare($query);

    try {
        // query to get update values with form inputs
        $stmt->execute([
            'user_id' => $_GET['user_id'],
            'email' => $_POST['email'],
            'password' => $hashedPassword,
            'firstName' => $_POST['firstName'],
            'lastName' => $_POST['lastName']
        ]);

        header('Location: dashboard_user.php');
        exit;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
else:
    $stmt = $dbh->prepare("SELECT * FROM `user` WHERE `user_id` = :user_id");
    $stmt->execute(['user_id' => $_GET['user_id']]);
    if ($stmt->rowCount() == 1 && $row = $stmt->fetchObject()): ?>
        <!doctype html>
        <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
            <title>Update Users (<?= htmlspecialchars($row->firstName) ?> <?= htmlspecialchars($row->lastName) ?>)</title>
        </head>
        <body class="bg-body-tertiary">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="text-center mt-5">
                        <h1>Update User </h1>
                        <h2><?= htmlspecialchars($row->firstName) ?> <?= htmlspecialchars($row->lastName) ?></h2>
                    </div>
                    <form method="post" class="mt-4">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" maxlength="50" value="<?= htmlspecialchars($row->email) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="text" class="form-control" id="password" name="password" maxlength="128" value="<?= htmlspecialchars($row->password) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="firstName" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="firstName" name="firstName" maxlength="50" value="<?= htmlspecialchars($row->firstName) ?>">
                        </div>
                        <div class="mb-3">
                            <label for="lastName" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="lastName" name="lastName" maxlength="50" value="<?= htmlspecialchars($row->lastName) ?>">
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Update User</button>
                        </div>
                    </form>
                    <div class="text-center mt-3">
                        <a href="dashboard_user.php" class="btn btn-secondary">Go Back</a>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        </body>
        </html>
    <?php else:
        header('Location: dashboard_user.php');
        exit;
    endif;
endif; ?>
