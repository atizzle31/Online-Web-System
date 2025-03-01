<?php
require_once("connection.php");
require_once("staff_files.php");

/**
 * @var PDO $dbh
 */

// Delete the record with the given record ID

if (!empty($_GET["contractor_id"])) { //$_GET retrieves the contract_id assosciated with the particular contracotr and checks to see whether it's valid. In our case it's always valid as it's auto generated
    $query = "DELETE FROM `contractor` WHERE `contractor_id` = ?"; //? helps protect against SQL injection. In our case not really an issue as we're deleted form fields. Not deleting from a search e.g. delete contractor_id >100
    $stmt = $dbh->prepare($query);

    try {
        // Execute the query
        $stmt->execute([
            $_GET["contractor_id"] //the array passed into execute replaces the "?"
        ]);

        // And send the user back to where we were
        header('Location: dashboard_contractor.php');
    } catch (PDOException $e) {
        // Set appropriate headers and HTTP response
        header('HTTP/1.1 400 Bad Request');
        header('Content-Type:text/plain');

        // Handle the exception when execution is failed
        $err = $stmt->errorInfo();
        echo "Error deleting record from database – contact System Administrator\n";
        echo "Error is: " . $err[2];
    }
}