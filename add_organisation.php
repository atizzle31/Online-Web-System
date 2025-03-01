<?php
require_once("connection.php");
require_once("staff_files.php");

/**
 * @var PDO $dbh
 */

// If the user has completed the form:
if ($_SERVER['REQUEST_METHOD'] == 'POST'):
    // Add new record based on the form received
    $query = "INSERT INTO `organisation`(`business_name`, `business_website`, `business_description`, `industry`) VALUES (:business_name, :business_website, :business_description, :industry)";
    $stmt = $dbh->prepare($query);

    try {
        // Execute the query
        $stmt->execute([
            'business_name' => $_POST["business_name"],
            'business_website' => $_POST["business_website"],
            'business_description' => $_POST["business_description"],
            'industry' => $_POST["industry"],
        ]);


        // And send the user back to where we were
        header('Location: dashboard_organisation.php');
    } catch (PDOException $e) {
        // Set appropriate headers and HTTP response
        header('HTTP/1.1 400 Bad Request');
        header('Content-Type:text/plain');

        // Handle the exception when execution is failed
        $err = $stmt->errorInfo();
        echo "Error deleting record from database – contact System Administrator\n";
        echo "Error is: " . $err[2];
    }
else:
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Organisation Creation</title>
        <link rel='stylesheet' type='text/css' href='Organisation%20Creation.css'>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="icon" type="image/x-icon" href="images/BG.jpeg">
    </head>
    <body class = "bg-body-tertiary">
    <div class = "container">
        <br>
    </div>

    <div class="container d-flex justify-content-between align-items-center mb-4">
        <div class="go-back">
            <a href="dashboard_organisation.php" class="btn btn-secondary">Go Back</a>
        </div>
        <div class="flex-grow-1 text-center">
            <h1 class="title">Add a New Organisation</h1>
        </div>
        <div class="go-back invisible">
            <!-- Placeholder div to balance the flexbox layout -->
        </div>
    </div>
    <br>
    <div class="py-5">
        <div class = "container px-2">
            <form method="post">
                <div class="row justify-content-center">
                    <div class = "col-md-6 col-lg-6">

                        <div class="mb-3">
                            <label for="business_name" class="form-label">Business Name</label>
                            <input type="text" class="form-control" id="business_name" name = "business_name" required>
                        </div>

                        <div class="mb-3">
                            <label for="business_website" class="form-label">Current Website</label>
                            <input type="text" class="form-control" id=business_website" name = "business_website">
                        </div>

                        <div class="mb-3">
                            <label for="business_description" class="form-label">Business Description</label>
                            <textarea class="form-control" id="business_description" name="business_description" rows="6" required></textarea>
                        </div>

                        <div class="input-group mb-3">
                            <label class="input-group-text" for="industry">Industry</label>
                            <select class="form-select" id="industry" name="industry" >
                                <option value="" disabled selected>Choose</option>
                                <option value="Agriculture">Agriculture</option>
                                <option value="Manufacturing">Manufacturing</option>
                                <option value="Construction">Construction</option>
                                <option value="Transportation">Transportation</option>
                                <option value="Information Technology">Information Technology</option>
                                <option value="Healthcare">Healthcare</option>
                                <option value="Finance">Finance</option>
                                <option value="Education">Education</option>
                                <option value="Retail">Retail</option>
                                <option value="Hospitality">Hospitality</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Add Organisation</button>

                    </div>
                </div>
            </form>
        </div>
    </body>
    </html>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<?php endif; ?>