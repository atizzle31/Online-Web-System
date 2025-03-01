<!DOCTYPE html>
<html lang = "en">
<head>
    <title>Instantiating Project</title>
</head>
<body>




<?php

use oop\Project;

require_once 'Project.php';
$project1 = new Project(
    "Sydney Opera House",
    "We are wanting to build the sydney opera house in Melbourne",
    "Machinery",
    "31/01/1999");

var_dump($project1);

$project1 -> setProjManagementToolLink("www.google.com");
var_dump($project1);
echo $project1;
?>


<pre>
    <?php
    var_dump($project1);
    echo $project1;
    ?>
</pre>


</body>
</html>