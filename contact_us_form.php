<?php
require_once("connection.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = htmlspecialchars($_POST['firstName']);
    $lastName = htmlspecialchars($_POST['lastName']);
    $phone = htmlspecialchars($_POST['phone']);
    $message = htmlspecialchars($_POST['message']);

    try {
        $stmt = $dbh->prepare("INSERT INTO `contact_us` (`firstName`, `lastName`, `phone`, `message`, `replied`) VALUES (?, ?, ?, ?, 'no')");
        $stmt->execute([$firstName, $lastName, $phone, $message]);

        $messageId = $dbh->lastInsertId();

        $to = "nathan.recruiter@example.com";
        $subject = "Contact Us Message ID #$messageId";
        $txt = "Message from $firstName $lastName\n\nPhone: $phone\n\nMessage:\n$message";
        $headers = "From: " . $firstName;

        // sends data in form to $to address
        if (mail($to, $subject, $txt, $headers)) {
            echo '<div class="alert alert-success text-center">Email Sent.</div>';
        } else {
            echo '<div class="alert alert-danger text-center">Error sending email, please try again later.</div>';
        }
    } catch (PDOException $e) {
        echo '<div class="alert alert-danger text-center">Error sending email, please try again later.</div>';
    }
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
    <title>Contact Us Page</title>
    <style>
        body {
            background-color: white;
        }
        .container {
            margin-top: 150px;
        }
        .title {
            font-size: 2rem;
            font-weight: bold;
        }
    </style>
</head>

<body>

<?php include 'nav_bar_public.php'; ?>

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="flex-grow-1 text-center">
            <h1 class="title">Contact Us</h1>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <form method="post">
                <div class="mb-3">
                    <label for="firstName" class="form-label">Name</label>
                    <input type="text" class="form-control" id="firstName" name="firstName" required>
                </div>

                <div class="mb-3">
                    <label for="lastName" class="form-label">Surname</label>
                    <input type="text" class="form-control" id="lastName" name="lastName">
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" class="form-control" maxlength="10" pattern="0[1-9][0-9]{8}" name="phone"
                           title="E.g. 0405601940" required>
                </div>

                <div class="mb-3">
                    <label for="message" class="form-label">Message</label>
                    <textarea class="form-control" id="message" name="message" rows="6" required></textarea>
                </div>

                <button type="submit" class="btn btn-primary w-100">Send</button>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-...your integrity hash..." crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-...your integrity hash..." crossorigin="anonymous"></script>
</body>
</html>
