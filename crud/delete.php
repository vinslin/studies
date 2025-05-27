<?php 
$servername = "localhost";
$username = "root";
$password = "";
$database = "vinslin";

// Create connection
$connection = new mysqli($servername, $username, $password, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

if (isset($_GET["id"])) {
    $id = intval($_GET['id']);  // Always sanitize input like this

    // Prepare the delete query
    $sql = "DELETE FROM clients WHERE id = ?";

    // Prepare statement to prevent SQL injection
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Successfully deleted
        echo "Record deleted successfully.";
        // Optionally redirect back to the list page
        header("Location: index.php");
        exit;
    } else {
        echo "Error deleting record: " . $connection->error;
    }

    $stmt->close();
}


?>
