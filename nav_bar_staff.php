<?php
require_once("staff_files.php");
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel='stylesheet' type='text/css' href='navbar.css'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">


</head>

<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class = "navbar-brand mb-0 h1" href="homepage_staff.php">JimsConsulting</a>

        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link" href="homepage_staff.php"><i class="fa fa-home" aria-hidden="true"></i> Home  </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="dashboard_contractor.php"><i class="fa fa-briefcase" aria-hidden="true"></i> Contractor  </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="dashboard_organisation.php"><i class="fa fa-building" aria-hidden="true"></i> Organisation  </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="dashboard_project.php"><i class="fa fa-tasks" aria-hidden="true"></i> Project </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="dashboard_user.php"><i class="fa fa-address-card-o" aria-hidden="true"></i> User Management </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="dashboard_mail.php"><i class="fa fa-envelope-open" aria-hidden="true"></i> Messages </a>
            </li>

        </ul>

        <ul class="navbar-nav ms-auto">
            <li class="nav-item">
                <a class="nav-link" href="logout.php" onclick="return confirmLogout();">Logout <i class="fa fa-sign-out" aria-hidden="true"></i>
                </a>
            </li>
        </ul>
    </div>
</nav>

</body>

<script type="text/javascript">
    function confirmLogout() {
        return confirm('Are you sure you want to logout?');
    }
</script>
</html>
