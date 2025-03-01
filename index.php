<?php
session_start();
require_once("connection.php");

if (isset($_SESSION['user_id'])) {
    header("Location: homepage_staff.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="contractor_list.css">
    <link rel="icon" type="image/x-icon" href="images/BG.jpeg">
    <title>Home</title>

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
    </style>
</head>

<?php include 'nav_bar_public.php'; ?>

<body>
<div class="container">
    <div class="row justify-content-center text-center">
        <main class="px-3">
            <h1>Welcome to Nathan Jims Recruitment</h1><br/>
            <p>At Nathan Jims Recruitment, we specialize in connecting skilled SMEs and contractors with B2B projects that drive business success</p>
            <p class="lead"><br/>
            <a href="contact_us_form.php" class="btn btn-lg btn-secondary fw-bold border-black bg-black">Contact Us</a>
            </p>
        </main>
    </div>
</div>
</body>
</html>
