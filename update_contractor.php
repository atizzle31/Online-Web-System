<?php
require_once("connection.php");
require_once("staff_files.php");

/**
 * @var PDO $dbh
 */
//
if ($_SERVER['REQUEST_METHOD'] == 'POST') { // sees whether the form has been submitted using POST
    // query to get all values for form inputs
    $query = "UPDATE `contractor` SET 
              `firstName` = :firstName, 
              `lastName` = :lastName,
              `specialty` = :specialty,
              `email` = :email,
              `phone` = :phone,
              `address` = :address
              WHERE `contractor_id` = :contractor_id";
    //updates the detail based on the contractor_id

    $stmt = $dbh->prepare($query); //prepares sql statement for execution.

    try {
        // query to get update values with form inputs
        $stmt->execute([
            'contractor_id' => $_GET['contractor_id'], //get the contract ID
            'firstName' => $_POST['firstName'], //firstName gets populated with the user input value
            'lastName' => $_POST['lastName'],
            'specialty' => $_POST['specialty'],
            'email' => $_POST['email'],
            'phone' => $_POST['phone'],
            'address' => $_POST['address']
        ]);

        header('Location: dashboard_contractor.php'); //redirect back to dashboard after successful update
        exit;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
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
            <title>Update Contractor (<?= htmlspecialchars($row->firstName) ?> <?= htmlspecialchars($row->lastName) ?>)</title>
        </head>
        <body class="bg-body-tertiary">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="text-center mt-5">
                        <h1>Update Contractor - (<?= htmlspecialchars($row->contractor_id) ?>)</h1>
                        <h2><?= htmlspecialchars($row->firstName) ?> <?= htmlspecialchars($row->lastName) ?></h2>
                    </div>
                    <form method="post" class="mt-4">
                        <div class="mb-3">
                            <label for="firstName" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="firstName" name="firstName" value="<?= htmlspecialchars($row->firstName) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="lastName" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="lastName" name="lastName" value="<?= htmlspecialchars($row->lastName) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="specialty" class="form-label">Specialty</label>
                            <input type="text" class="form-control" id="specialty" name="specialty" value="<?= htmlspecialchars($row->specialty) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($row->email) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" id="phone" class="form-control" maxlength="10" pattern="0[1-9][0-9]{8}" name="phone" value="<?= htmlspecialchars($row->phone) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address" value="<?= htmlspecialchars($row->address) ?>" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Update Contractor</button>
                        </div>
                    </form>
                    <div class="text-center mt-3">
                        <a href="dashboard_contractor.php" class="btn btn-secondary">Go Back</a>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        </body>
        </html>
        <?php
    } else {
        // Redirect if the contractor does not exist
        header('Location: dashboard_contractor.php');
        exit;
    }
}
?>
