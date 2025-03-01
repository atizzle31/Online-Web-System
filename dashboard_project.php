<?php
require_once("connection.php");
require_once("staff_files.php");

/**
 * @var PDO $dbh
 */

// get values from database to list
$stmt = $dbh->prepare("SELECT * FROM `project`");
$stmt->execute();
$projects = $stmt->fetchAll(PDO::FETCH_OBJ);
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


    <title>Project Information</title>

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
    <h1>Project Information</h1>
    <br>
</div>
<div class="container">
    <?php if (empty($projects)): ?>
        <div class="alert alert-warning text-center" role="alert">
            No projects found.
        </div>
    <?php else: ?>
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">Project ID</th>
                <th scope="col">Project Name</th>
                <th scope="col">Project Description</th>
                <th scope="col">Technique Required</th>
                <th scope="col">Due Date</th>
                <th scope="col">Project Link</th>
                <th scope="col">Organisational ID</th>
                <th scope="col">Contractor ID</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($projects as $row): ?>
                <tr>
                    <th><?= $row->project_id ?></th>
                    <td><?= $row->project_name ?></td>
                    <td><?= $row->project_description ?></td>
                    <td><?= $row->technique_required ?></td>
                    <td><?= $row->due_date ?></td>
                    <td><?= $row->project_link ?></td>
                    <td><?= $row->organisation_id ?></td>
                    <td><?= $row->contractor_id ?></td>
                    <td>
                        <a href="update_project.php?project_id=<?= $row->project_id ?>"><i class="fa fa-pencil-square" style="font-size: 25px;color: blue;"></i></a>
                        <a href="delete_project.php?project_id=<?= $row->project_id ?>" onclick="return confirmDelete();"><i class="fa fa-trash-o" style="font-size:25px;color:red;"></i></a>
                        <a href="view_project.php?project_id=<?= $row->project_id ?>"><i class="fa fa-eye" style="font-size:25px;color:black;"></i></a>
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
        return confirm('Are you sure you want to delete this project?');
    }
</script>





</body>
</html>