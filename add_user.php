<?php
require_once("connection.php");
require_once("staff_files.php");

/**
 * @var PDO $dbh
 */

if ($_SERVER['REQUEST_METHOD'] == 'POST'):

    // password hashed using hash256 algorithm
    $hashedPassword = hash('sha256', $_POST['password']);

    $query = "INSERT INTO `user`(`email`, `password`, `firstName`, `lastName`) VALUES (:email, :password, :firstName, :lastName)";
    $stmt = $dbh->prepare($query);

    try {
        // Execute the query
        $stmt->execute([
            'email' => $_POST["email"],
            'password' => $hashedPassword,
            'firstName' => $_POST["firstName"],
            'lastName' => $_POST["lastName"],
        ]);

        header('Location: dashboard_user.php');
        exit();
    } catch (PDOException $e) {
        $err = $stmt->errorInfo();
        if ($err[1] == 1062) {
            $error = "The email address is already in use. Please try again with a different email.";
            header('Location: add_user.php?error=' . urlencode($error));
            exit();
        } else {
            header('HTTP/1.1 400 Bad Request');
            header('Content-Type: text/plain');
            echo "Error adding user to the database – contact System Administrator\n";
            echo "Error: " . $err[2];
        }
    }
else:
    $error = isset($_GET['error']) ? htmlspecialchars($_GET['error']) : '';
    ?>


    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Add a New User</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="icon" type="image/x-icon" href="images/BG.jpeg">
    </head>
    <body class="bg-body-tertiary">
    <div class="container">
        <br>
    </div>

    <div class="container d-flex justify-content-between align-items-center mb-4">
        <div class="go-back">
            <a href="dashboard_user.php" class="btn btn-secondary">Go Back</a>
        </div>
        <div class="flex-grow-1 text-center">
            <h1 class="title">Add a New User</h1>
        </div>
        <div class="go-back invisible">
        </div>
    </div>

    <br>
    <div class="py-5">
        <div class="container px-2">
            <form action="add_user.php" method="post">
                <div class="row justify-content-center">
                    <div class="col-md-6 col-lg-6">

                        <div class="mb-3">
                            <label for="firstName" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="firstName" name="firstName" required>
                        </div>

                        <div class="mb-3">
                            <label for="lastName" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="lastName" name="lastName" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="text" class="form-control"
                                   minlength="10"
                                   pattern="(?=.*[\W_]).{10,}"
                                   title="Must be at least 10 characters long and contain at least one special character."
                                   id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Add User</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="errorModalLabel">Error</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?php echo $error; ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            <?php if (!empty($error)): ?>
            var errorModal = new bootstrap.Modal(document.getElementById('errorModal'), {
                keyboard: false
            });
            errorModal.show();
            <?php endif; ?>
        </script>
    </body>
    </html>
<?php endif; ?>
