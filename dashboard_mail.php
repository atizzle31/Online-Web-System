<?php
require_once("connection.php");
require_once("staff_files.php");

/**
 * @var PDO $dbh
 */

// get values from database to list
$stmt = $dbh->prepare("SELECT * FROM `contact_us`");
$stmt->execute();
$messages = $stmt->fetchAll(PDO::FETCH_OBJ);
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

    <title>User Mails</title>

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
    <h1>Mails</h1>
</div>
<br>
<div class="container">

    <?php if (empty($messages)): ?>
        <div class="alert alert-warning text-center" role="alert">
            No mail found.
        </div>
    <?php else: ?>

        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">Contact ID</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Phone</th>
                <th scope="col">Messages</th>
                <th scope="col">Replied?</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($messages as $row): ?>
                <tr>
                    <th><?= htmlspecialchars($row->contact_id) ?></th>
                    <td><?= htmlspecialchars($row->firstName) ?></td>
                    <td><?= htmlspecialchars($row->lastName) ?></td>
                    <td><?= htmlspecialchars($row->phone) ?></td>
                    <td><?= htmlspecialchars($row->message) ?></td>
                    <td><?= htmlspecialchars($row->replied) ?></td>
                    <td>
                        <a href="delete_mail.php?contact_id=<?= $row->contact_id ?>" onclick="return confirmDelete();"><i class="fa fa-trash-o" style="font-size:25px;color:red;"></i></a>
                        <a href="view_messages_detail.php?contact_id=<?= $row->contact_id ?>"><i class="fa fa-eye" style="font-size: 25px;color: black;"></i></a>
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
        return confirm('Are you sure you want to delete this mail?');
    }
</script>

</body>
</html>
