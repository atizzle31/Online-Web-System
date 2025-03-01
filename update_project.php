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

// Fetch organizations and contractors for the dropdowns
$organizations = $dbh->query("SELECT organisation_id, business_name FROM organisation")->fetchAll(PDO::FETCH_ASSOC);
$contractors = $dbh->query("SELECT contractor_id, firstName, lastName FROM contractor")->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // query to get all values for form inputs
    $query = "UPDATE `project` SET 
              `project_name` = :project_name, 
              `project_description` = :project_description,
              `technique_required` = :technique_required,
              `due_date` = :due_date,
              `project_link` = :project_link,
              `organisation_id` = :organisation_id,
              `contractor_id` = :contractor_id
              WHERE `project_id` = :project_id";

    $stmt = $dbh->prepare($query);

    try {
        // query to get update values with form inputs
        $stmt->execute([
            'project_id' => $_GET['project_id'],
            'project_name' => $_POST['project_name'],
            'project_description' => $_POST['project_description'],
            'technique_required' => $_POST['technique_required'],
            'due_date' => $_POST['due_date'],
            'project_link' => $_POST['project_link'],
            'organisation_id' => $_POST['organisation_id'],
            'contractor_id' => $_POST['contractor_id']
        ]);

        header('Location: dashboard_project.php');
        exit;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    $stmt = $dbh->prepare("SELECT * FROM `project` WHERE `project_id` = :project_id");
    $stmt->execute(['project_id' => $_GET['project_id']]);

    if ($stmt->rowCount() == 1 && $row = $stmt->fetchObject()) {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>Update Project</title>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
            <link rel="icon" type="image/x-icon" href="images/BG.jpeg">
        </head>
        <body class="bg-body-tertiary">
        <div class="container">
            <br>
        </div>

        <div class="container d-flex justify-content-between align-items-center mb-4">
            <div class="flex-grow-1 text-center">
                <h1 class="title">Update Project</h1>
            </div>
            <div class="go-back invisible">
            </div>
        </div>
        <br>
        <div class="py-5">
            <div class="container px-2">
                <form method="post" class="mt-4">
                    <div class="row justify-content-center">
                        <div class="col-md-6 col-lg-6">

                            <div class="mb-3">
                                <label for="project_name" class="form-label">Project Name</label>
                                <input type="text" class="form-control" id="project_name" name="project_name" value="<?= htmlspecialchars($row->project_name) ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="project_description" class="form-label">Project Description</label>
                                <textarea class="form-control" id="project_description" name="project_description" rows="6" required><?= htmlspecialchars($row->project_description) ?></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="technique_required" class="form-label">Technique Required</label>
                                <input type="text" class="form-control" id="technique_required" name="technique_required" value="<?= htmlspecialchars($row->technique_required) ?>">
                            </div>

                            <div class="mb-3">
                                <label for="due_date" class="form-label">Due Date</label>
                                <input type="date" class="form-control" id="due_date" name="due_date" value="<?= htmlspecialchars($row->due_date) ?>">
                            </div>

                            <div class="mb-3">
                                <label for="project_link" class="form-label">Project Link</label>
                                <input type="text" class="form-control" id="project_link" name="project_link" value="<?= htmlspecialchars($row->project_link) ?>">
                            </div>

                            <div class="mb-3">
                                <label for="organisation_id" class="form-label">Select Organisation</label>
                                <select class="form-select" id="organisation_id" name="organisation_id" required>
                                    <option value="" disabled>Select an Organisation</option>
                                    <?php foreach ($organizations as $organization): ?>
                                        <option value="<?= htmlspecialchars($organization['organisation_id']) ?>" <?= $organization['organisation_id'] == $row->organisation_id ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($organization['business_name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="contractor_id" class="form-label">Select Contractor</label>
                                <select class="form-select" id="contractor_id" name="contractor_id" required>
                                    <option value="" disabled>Select a Contractor</option>
                                    <?php foreach ($contractors as $contractor): ?>
                                        <option value="<?= htmlspecialchars($contractor['contractor_id']) ?>" <?= $contractor['contractor_id'] == $row->contractor_id ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($contractor['firstName'] . ' ' . $contractor['lastName']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Update Project</button>
                        </div>
                    </div>
                </form>
                <div class="text-center mt-3">
                    <a href="dashboard_project.php" class="btn btn-secondary">Go Back</a>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        </body>
        </html>
        <?php
    } else {
        header('Location: dashboard_project.php');
        exit;
    }
}
?>
