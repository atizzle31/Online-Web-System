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

if ($_SERVER['REQUEST_METHOD'] == 'POST'):
    // query to get all values for form inputs
    $query = "UPDATE `organisation` SET 
              `business_name` = :business_name, 
              `business_website` = :business_website,
              `business_description` = :business_description,
              `industry` = :industry
              WHERE `organisation_id` = :organisation_id";
    $stmt = $dbh->prepare($query);

    try {
        // query to get update values with form inputs
        $stmt->execute([
            'organisation_id' => $_GET['organisation_id'],
            'business_name' => $_POST['business_name'],
            'business_website' => $_POST['business_website'],
            'business_description' => $_POST['business_description'],
            'industry' => $_POST['industry']
        ]);

        header('Location: dashboard_organisation.php');
        exit;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
else:
    $stmt = $dbh->prepare("SELECT * FROM `organisation` WHERE `organisation_id` = :organisation_id");
    $stmt->execute(['organisation_id' => $_GET['organisation_id']]);
    if ($stmt->rowCount() == 1 && $row = $stmt->fetchObject()): ?>
        <!doctype html>
        <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
            <title>Update Organisation (<?= htmlspecialchars($row->business_name) ?>)</title>
        </head>
        <body class="bg-body-tertiary">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="text-center mt-5">
                        <h1>Update Organisation - ( <?= htmlspecialchars($row->organisation_id) ?> )</h1>
                        <h2><?= htmlspecialchars($row->business_name) ?></h2>
                    </div>
                    <form method="post" class="mt-4">
                        <div class="mb-3">
                            <label for="business_name" class="form-label">Business Name</label>
                            <input type="text" class="form-control" id="business_name" name="business_name" maxlength="50" value="<?= htmlspecialchars($row->business_name) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="business_website" class="form-label">Website</label>
                            <input type="text" class="form-control" id="business_website" name="business_website" maxlength="128" value="<?= htmlspecialchars($row->business_website) ?>">
                        </div>
                        <div class="mb-3">
                            <label for="business_description" class="form-label">Business Description</label>
                            <textarea class="form-control" id="business_description" name="business_description" rows="6" required><?= htmlspecialchars($row->business_description) ?></textarea>
                        </div>
                        <div class="input-group mb-3">
                            <label class="input-group-text" for="industry">Industry</label>
                            <select class="form-select" id="industry" name="industry" required>
                                <option value="" disabled>Select Industry</option>
                                <option value="Agriculture" <?= $row->industry === 'Agriculture' ? 'selected' : '' ?>>Agriculture</option>
                                <option value="Manufacturing" <?= $row->industry === 'Manufacturing' ? 'selected' : '' ?>>Manufacturing</option>
                                <option value="Construction" <?= $row->industry === 'Construction' ? 'selected' : '' ?>>Construction</option>
                                <option value="Transportation" <?= $row->industry === 'Transportation' ? 'selected' : '' ?>>Transportation</option>
                                <option value="Information Technology" <?= $row->industry === 'Information Technology' ? 'selected' : '' ?>>Information Technology</option>
                                <option value="Healthcare" <?= $row->industry === 'Healthcare' ? 'selected' : '' ?>>Healthcare</option>
                                <option value="Finance" <?= $row->industry === 'Finance' ? 'selected' : '' ?>>Finance</option>
                                <option value="Education" <?= $row->industry === 'Education' ? 'selected' : '' ?>>Education</option>
                                <option value="Retail" <?= $row->industry === 'Retail' ? 'selected' : '' ?>>Retail</option>
                                <option value="Hospitality" <?= $row->industry === 'Hospitality' ? 'selected' : '' ?>>Hospitality</option>
                                <option value="Other" <?= $row->industry === 'Other' ? 'selected' : '' ?>>Other</option>
                            </select>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Update Organisation</button>
                        </div>
                    </form>
                    <div class="text-center mt-3">
                        <a href="dashboard_organisation.php" class="btn btn-secondary">Go Back</a>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        </body>
        </html>
    <?php else:
        header('Location: dashboard_organisation.php');
        exit;
    endif;
endif; ?>
