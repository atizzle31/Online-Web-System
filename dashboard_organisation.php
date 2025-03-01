<?php
require_once("connection.php");
require_once("staff_files.php");

/**
 * @var PDO $dbh
 */

// get values from database to list
$stmt = $dbh->prepare("SELECT * FROM `organisation`");
$stmt->execute();
$organisations = $stmt->fetchAll(PDO::FETCH_OBJ);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="contractor_list.css">
    <link rel="icon" type="image/x-icon" href="images/BG.jpeg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Organisation Information</title>

    <style>
        table, tr, th, td {
            border: 1.5px black solid;
            table-layout: fixed;
            text-overflow: ellipsis;
            overflow: hidden;
        }
    </style>
</head>
<?php include 'nav_bar_staff.php'; ?>
<body>
<br>

<div class="container align-right">
    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
        Add New
    </button>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <li><a class="dropdown-item" href="add_contractor.php">Add New Contractor</a></li>
        <li><a class="dropdown-item" href="add_organisation.php">Add New Organisation</a></li>
        <li><a class="dropdown-item" href="add_project.php">Add New Project</a></li>
        <li><a class="dropdown-item" href="add_user.php">Add New User</a></li>
    </ul>
</div>

<br>
<div class="text-center">
    <h1>Organisation Information</h1>
    <br>
</div>
<div class="container">
    <?php if (empty($organisations)): ?>
        <div class="alert alert-warning text-center" role="alert">
            No organisations found.
        </div>
    <?php else: ?>
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">Organisation ID</th>
                <th scope="col">Business Name</th>
                <th scope="col">Website</th>
                <th scope="col">Business Description</th>
                <th scope="col">Industry</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($organisations as $row): ?>
                <tr>
                    <th><?= htmlspecialchars($row->organisation_id) ?></th>
                    <td><?= htmlspecialchars($row->business_name) ?></td>
                    <td><?= htmlspecialchars($row->business_website) ?></td>
                    <td><?= htmlspecialchars($row->business_description) ?></td>
                    <td><?= htmlspecialchars($row->industry) ?></td>
                    <td>
                        <a href="update_organisation.php?organisation_id=<?= $row->organisation_id ?>"><i class="fa fa-pencil-square" style="font-size: 25px;color: blue;"></i></a>
                        <a href="delete_organisation.php?organisation_id=<?= $row->organisation_id ?>" onclick="return confirmDelete();"><i class="fa fa-trash-o" style="font-size:25px;color:red;"></i></a>
                        <a href="view_organisation_detail.php?organisation_id=<?= $row->organisation_id ?>"><i class="fa fa-eye" style="font-size:25px;color:black;"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script type="text/javascript">
    function confirmDelete() {
        return confirm('Are you sure you want to delete this contractor?');
    }
</script>

</body>
</html>
