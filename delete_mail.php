<?php

require_once("connection.php");

/**
 * @var PDO $dbh
 */

// Delete the record with the given record ID

if (!empty($_GET["contact_id"])) {
    $query = "DELETE FROM `contact_us` WHERE `contact_id` = ?";
    $stmt = $dbh->prepare($query);

    try {
        // Execute the query
        $stmt->execute([
            $_GET["contact_id"]
        ]);

        // And send the user back to where we were
        header('Location: dashboard_mail.php');
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