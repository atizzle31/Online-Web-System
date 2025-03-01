<?php
require_once("connection.php");
require_once("staff_files.php");

/**
 * @var PDO $dbh
 */
//queries to get values from organisation and contractor
$orgStmt = $dbh->prepare("SELECT organisation_id, business_name FROM organisation");
$orgStmt->execute();
$organizations = $orgStmt->fetchAll(PDO::FETCH_ASSOC);

$contractorStmt = $dbh->prepare("SELECT contractor_id, firstName, lastName FROM contractor");
$contractorStmt->execute();
$contractors = $contractorStmt->fetchAll(PDO::FETCH_ASSOC);

// If the user has completed the form:
if ($_SERVER['REQUEST_METHOD'] == 'POST'):
    // Add new record based on the form received
    $query = "INSERT INTO `project`(`project_name`, `project_description`, `technique_required`, `due_date`, `project_link`, `organisation_id`, `contractor_id`) VALUES (:project_name, :project_description, :technique_required, :due_date, :project_link, :organisation_id, :contractor_id)";
    $stmt = $dbh->prepare($query);

    try {
        // Execute the query
        $stmt->execute([
            'project_name' => $_POST["project_name"],
            'project_description' => $_POST["project_description"],
            'technique_required' => $_POST["technique_required"],
            'due_date' => $_POST["due_date"],
            'project_link' => $_POST["project_link"],
            'organisation_id' => $_POST["organisation_id"],
            'contractor_id' => $_POST["contractor_id"],

        ]);

        // Redirect the user back to the main page
        header('Location: dashboard_project.php');
        exit();
    } catch (PDOException $e) {
        // Set appropriate headers and HTTP response
        header('HTTP/1.1 400 Bad Request');
        header('Content-Type: text/plain');

        // Handle the exception if execution fails
        $err = $stmt->errorInfo();
        echo "Error adding record to the database – contact System Administrator\n";
        echo "Error is: " . $err[2];
    }
else:
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Project Creation</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="icon" type="image/x-icon" href="images/BG.jpeg">
    </head>
    <body class = "bg-body-tertiary">
    <div class = "container">
        <br>
    </div>

    <div class="container d-flex justify-content-between align-items-center mb-4">
        <div class="go-back">
            <a href="dashboard_project.php" class="btn btn-secondary">Go Back</a>
        </div>
        <div class="flex-grow-1 text-center">
            <h1 class="title">Add a New Project</h1>
        </div>
        <div class="go-back invisible">
            <!-- Placeholder div to balance the flexbox layout -->
        </div>
    </div>
    <br>
    <div class="py-5">
        <div class="container px-2">
            <form action="add_project.php" method="post">
                <div class="row justify-content-center">
                    <div class = "col-md-6 col-lg-6">

                            <div class="mb-3">
                                <label for="project_name" class="form-label">Project Name</label>
                                <input type="text" class="form-control" id="project_name" name="project_name" required>
                            </div>


                        <div class="mb-3">
                            <label for="project_description" class="form-label">Business Description</label>
                            <textarea class="form-control" id="project_description" name="project_description" rows="6" required></textarea>
                        </div>


                            <div class="mb-3">
                                <label for="technique_required" class="form-label">Technique Required</label>
                                <input type="text" class="form-control" id="technique_required" name="technique_required">
                            </div>

                            <div class="mb-3">
                                <label for="due_date" class="form-label">Due Date</label>
                                <input type="date" class="form-control" id="due_date" name="due_date" required >
                            </div>

                            <div class="mb-3">
                                <label for="project_link" class="form-label">Project Link</label>
                                <input type="text" class="form-control" id="project_link" name="project_link">
                            </div>

                            <div class="mb-3">
                                <label for="organisation_id" class="form-label">Select Organisation</label>
                                <select class="form-select" id="organisation_id" name="organisation_id" required>
                                    <option value="" disabled selected>Select an Organisation</option>
                                    <!--For each loop to display organisation names and to variable to organisation_id-->
                                    <?php foreach ($organizations as $organization): ?>
                                        <option value="<?= htmlspecialchars($organization['organisation_id']) ?>">
                                            <?= htmlspecialchars($organization['business_name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="contractor_id" class="form-label">Select Contractor</label>
                                <select class="form-select" id="contractor_id" name="contractor_id" required>
                                    <option value="" disabled selected>Select a Contractor</option>
                                    <!--For each loop to display contractor names and to variable to contractor_id-->
                                    <?php foreach ($contractors as $contractor): ?>
                                        <option value="<?= htmlspecialchars($contractor['contractor_id']) ?>">
                                            <?= htmlspecialchars($contractor['firstName'] . ' ' . $contractor['lastName']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        <button type="submit" class="btn btn-primary w-100">Add Project</button>
                    </div>
                </div>
            </form>
        </div>
    </body>
    </html>
<?php endif; ?>
