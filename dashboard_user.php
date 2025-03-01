<?php
require_once("connection.php");
require_once("staff_files.php");

/**
 * @var PDO $dbh
 */

// get values from database to list
$stmt = $dbh->prepare("SELECT * FROM `user`");
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_OBJ); // Fetch all users as objects
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="contractor_list.css">
    <link rel="icon" type="image/x-icon" href="images/BG.jpeg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>User Information</title>

    <style>
        table, tr, th, td {
            border: 1.5px black solid;
        }
    </style>
</head>
<?php include 'nav_bar_staff.php'; ?>
<body>
<br>

<div class="container align-right ">
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
    <h1>User Information</h1>
</div>
<br>
<div class="container">
    <?php if (empty($users)): ?>
        <div class="alert alert-warning text-center" role="alert">
            No users found.
        </div>
    <?php else: ?>
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">User ID</th>
                <th scope="col">Email</th>
                <th scope="col">Password</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($users as $row): ?>
                <tr>
                    <th><?= htmlspecialchars($row->user_id) ?></th>
                    <td><?= htmlspecialchars($row->email) ?></td>
                    <td><?= htmlspecialchars($row->password) ?></td>
                    <td><?= htmlspecialchars($row->firstName) ?></td>
                    <td><?= htmlspecialchars($row->lastName) ?></td>
                    <td>
                        <a href="update_user.php?user_id=<?= $row->user_id ?>"><i class="fa fa-pencil-square" style="font-size: 25px;color: blue;"></i></a>
                        <a href="delete_user.php?user_id=<?= $row->user_id ?>" onclick="return confirmDelete();"><i class="fa fa-trash-o" style="font-size:25px;color:red;"></i></a>
                        <a href="view_user_detail.php?user_id=<?= $row->user_id ?>"><i class="fa fa-eye" style="font-size:25px;color:black;"></i></a>
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
