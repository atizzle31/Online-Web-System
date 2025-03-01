<?php
session_start();
require_once("connection.php");
global $dbh;

// check for valid session
if (isset($_SESSION['user_id'])) {
    header("Location: homepage_staff.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="contractor_list.css">
    <link rel="icon" type="image/x-icon" href="images/BG.jpeg">
    <title>Login Page</title>

    <style>
        body {
            background-color: white;
        }
        .container {
            margin-top: 150px;
        }
        input {
            max-width: 300px;
            min-width: 300px;
        }
        .error-message {
            max-width: 300px;
            min-width: 300px;
            margin-top: 10px;
            text-align: center;
        }

        .input-group-text {
            cursor: pointer;
        }
    </style>
</head>

<?php include 'nav_bar_public.php'; ?>

<body>
<div class="container">
    <div class="row justify-content-center text-center">
        <h1>JimsConsulting</h1>

        <div class="col-md-6" align="center">
            <?php
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                $stmt = $dbh->prepare("SELECT * FROM `user` WHERE `email` = ? AND `password` = ?");
                // check if valid login
                if ($stmt->execute([
                        $_POST['email'],
                        hash('sha256', $_POST['password'])
                    ]) && $stmt->rowCount() > 0) {
                    $row = $stmt->fetchObject();
                    $_SESSION['user_id'] = $row->user_id;
                    header("Location: homepage_staff.php");
                } else {
                    echo '<div class="alert alert-danger error-message" role="alert">Incorrect email or password.</div>';
                }
            }
            ?>
            <form action="login.php" method="POST">
                <input type="text" name="email" class="form-control" placeholder="Enter Email" required> <br />
                <div class="input-group mb-3" style="max-width: 300px; min-width: 300px;">
                    <input type="password" id="password" name="password" class="form-control" placeholder="Enter Password" required>
                    <div class="input-group-addon"> <br/>
                        <input type="checkbox" id="showPasswordCheckbox" onclick="showPassword()">
                        <label for="showPasswordCheckbox">Show Password</label>
                    </div>
                </div>
                <input type="submit" value="Login" class="btn btn-primary">
            </form>
        </div>
    </div>
</div>

</body>
<script>
    // function to display password if checkbox checked
    function showPassword() {
        var togglePassword = document.getElementById("password");
        if (togglePassword.type === "password") {
            togglePassword.type = "text";
        } else {
            togglePassword.type = "password";
        }
    }
</script>
</html>
