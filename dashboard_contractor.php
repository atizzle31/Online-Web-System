<?php
require_once("connection.php");

/**
 * @var PDO $dbh
 */

// get values from database to list
$stmt = $dbh->prepare("SELECT * FROM `contractor`");
$stmt->execute();
$contractors = $stmt->fetchAll(PDO::FETCH_OBJ); // fetches and stores all the row from the database into an array store in $contractors.
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

    <title>Contractor Information</title>

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
    <h1>Contractor Information</h1>
</div>
<br>
<div class="container">
    <?php if (empty($contractors)): ?>
        <div class="alert alert-warning text-center" role="alert">
            No contractors found.
        </div>
    <?php else: ?>

        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">Contractor ID</th>
                <th scope="col">First Name</th>
                <th scope="col">Surname</th>
                <th scope="col">Specialty</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">Address</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($contractors as $row): ?>
            <?php //remember, each row was an entry from the array from the database.?>
                <tr>
                    <th><?= htmlspecialchars($row->contractor_id) ?></th>
                    <?php // getting the contractor_id from the array
                    // htmlsepcialchars also is used as an integrity feature e.g. if user input name as special character e.g. <>, it will be encoded as a certain value as to not break the code.?>
                    <td><?= htmlspecialchars($row->firstName) ?></td>
                    <td><?= htmlspecialchars($row->lastName) ?></td>
                    <td><?= htmlspecialchars($row->specialty) ?></td>
                    <td><?= htmlspecialchars($row->email) ?></td>
                    <td><?= htmlspecialchars($row->phone) ?></td>
                    <td><?= htmlspecialchars($row->address) ?></td>
                    <td>
                        <a href="update_contractor.php?contractor_id=<?= $row->contractor_id ?>"><i class="fa fa-pencil-square" style="font-size: 25px;color: blue;"></i></a>
                        <a href="delete_contractor.php?contractor_id=<?= $row->contractor_id ?>" onclick="return confirmDelete();"><i class="fa fa-trash-o" style="font-size:25px;color:red;"></i></a>
                        <a href="view_contractor_detail.php?contractor_id=<?= $row->contractor_id ?>"><i class="fa fa-eye" style="font-size:25px;color:black;"></i></a>
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
