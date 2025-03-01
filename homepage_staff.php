<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="contractor_list.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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

<?php include 'nav_bar_staff.php'; ?>

<body>
<div class="container">
    <div class="row justify-content-center text-center">
        <main class="px-3">
            <h1>Welcome to the Staff Home Page</h1>
            <p></p>
            <p class="lead"><br/>
                <a href="dashboard_mail.php" class="btn btn-lg btn-secondary fw-bold border-black bg-black">View Messages</a>
            </p>
        </main>
    </div>
</div>
</body>
</html>