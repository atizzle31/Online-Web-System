<?php
require_once("connection.php");
require_once("staff_files.php");

/**
 * @var PDO $dbh
 */
// UPLOADING PROFILE PICTURE INTO THE FORM
if ($_SERVER['REQUEST_METHOD'] == 'POST'):
    // Process the file upload
    if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
        $allowed_types = ['image/jpeg', 'image/png']; //Allowed types

        if (in_array($_FILES['file']['type'], $allowed_types)) {
            // Generate a unique name for the file to avoid collisions when they have the same name.
            $fileExtension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
            $uniqueFileName = uniqid() . '.' . $fileExtension; //file name
            $fileDestination = "contractor_profiles" . DIRECTORY_SEPARATOR . $uniqueFileName;

            // Move the uploaded file to the final destination
            if (!move_uploaded_file($_FILES['file']['tmp_name'], $fileDestination)) {
                echo "<h1>File cannot be stored to the final destination!</h1>";
                exit;
            }
        }
    }

    $query = "INSERT INTO `contractor`(`firstName`, `lastName`, `specialty`, `email`, `phone`, `address`, `profile_picture`) 
              VALUES (:firstName, :lastName, :specialty, :email, :phone, :address, :profile_picture)";
    $stmt = $dbh->prepare($query);

    //The prepare method is used to prepare an SQL statement for execution.

    try {
        $stmt->execute([
            'firstName' => $_POST["firstName"], //firstName now contains the value the user submitted when they completed the form.
            'lastName' => $_POST["lastName"],
            'specialty' => $_POST["specialty"],
            'email' => $_POST["email"],
            'phone' => $_POST["phone"],
            'address' => $_POST["address"],
            'profile_picture' => $fileDestination,
        ]);

        header('Location: dashboard_contractor.php'); //If added successfully, users are directed back to the dashboard then exit
        exit;
    } catch (PDOException $e) {
        header('HTTP/1.1 400 Bad Request');
        header('Content-Type:text/plain');

        $err = $stmt->errorInfo();
        echo "Error adding record to database – contact System Administrator\n";
        echo "Error is: " . $err[2];
    }

else:
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>User Creation</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="icon" type="image/x-icon" href="images/BG.jpeg">
    </head>
    <body class="bg-body-tertiary">
    <div class="container">
        <br>
    </div>

    <div class="container d-flex justify-content-between align-items-center mb-4">
        <div class="go-back">
            <a href="dashboard_contractor.php" class="btn btn-secondary">Go Back</a>
        </div>
        <div class="flex-grow-1 text-center">
            <h1 class="title">Add a New Contractor</h1>
        </div>
        <div class="go-back invisible">
        </div>
    </div>
    <br>
    <div class="py-5">
        <div class="container px-2">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="row justify-content-center">
                    <div class="col-md-6 col-lg-6">
                        <div class="mb-3">
                            <label for="file" class="form-label">Profile Picture</label>
                            <input type="file" class="form-control" id="file" name="file" accept="image/jpeg, image/png" required>
                        </div>

                        <div class="mb-3">
                            <label for="firstName" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="firstName" name="firstName" required>
                        </div>

                        <div class="mb-3">
                            <label for="lastName" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="lastName" name="lastName">
                        </div>

                        <div class="mb-3">
                            <label for="specialty" class="form-label">Specialty</label>
                            <input type="text" class="form-control" id="specialty" name="specialty" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" maxlength="10" pattern="0[1-9][0-9]{8}" name="phone" title = "E.g - 0469435292" required>
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Add Contractor</button>
                    </div>
                </div>
            </form>
        </div>
    </body>
    </html>
<?php endif; ?>
