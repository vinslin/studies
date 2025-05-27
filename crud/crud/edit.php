<?php
// Initialize variables
                $servername="localhost";
                $username="root";
                $password="";
                $database="vinslin";

                //crete connection
                $connection =new mysqli($servername,$username,$password,$database);

$name = '';
$email = '';
$phone = '';
$address = '';
$errorMessage = '';
$successMessage = '';
$id;

if (isset($_GET["id"])) {
    $GLOBALS['id'] = $_GET['id'];

    
    // Now use $id to fetch that specific row from your database
    // For example:
    $sql = "SELECT * FROM clients WHERE id = $id";
    $result = $connection->query($sql);
    
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row["name"];
        $email = $row["email"];
        $phone = $row["phone"];
        $address = $row["address"];
    } else {
        header("Location: index.php");
        exit;
    }
} else {
        header("Location: index.php");
        exit;
}



// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name    = $_POST['name'];
    $email   = $_POST['email'];
    $phone   = $_POST['phone'];
    $address = $_POST['address'];


do{
    // Check that values are not empty
    if (empty($name) || empty($email) || empty($phone) || empty($address)) {
        $errorMessage = 'All the fields are required';
        break;
    }
   
    //add new client to the database
$sql = "UPDATE clients SET 
            name = '$name',
            email = '$email',
            phone = '$phone',
            address = '$address'
        WHERE id = $id";

    $result = $connection->query($sql);
    // Check if the query was successful
    if (!$result) {
        $errorMessage = 'Invalid query: ' . $connection->error;
        break;
    }
  

     $successMessage = 'SUCCESSFULLY EDITED';
    

} while( false);

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDIT CUSTOMER</title>
</head>
<body>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <div class="container mt-5"  >
        <h1 class="mb-4" style="margin-left: 240px ;  font-family: 'Georgia', serif;
  font-size: 40px;
  font-weight: bold;
  font-style: italic;
  color:rgb(31, 203, 247);
  letter-spacing: 1px;
  text-shadow: 1px 1px 2px #999;">CRUD APP</h1>
        <h2 style="font-weight:bold ;margin-bottom: 20px;">Edit the Client</h2>
<?php
if (!empty($errorMessage)) {
    echo "
    <div class='alert alert-warning alert-dismissible fade show' role='alert'>
        <strong>$errorMessage</strong> 
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
}
?>
         
        <form action="edit.php?id=<?php echo $id; ?>"method="post" class="bg-light p-4 rounded shadow-sm">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required value="<?php echo $name; ?>">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required value="<?php echo $email; ?>">
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" required value="<?php echo $phone; ?>">
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" name="address" value="<?php echo $address; ?>">

            </div>
 <?php 
if (!empty($successMessage)) {
    echo "
    <div class='alert alert-warning alert-dismissible fade show' role='alert'>
        <strong>$successMessage</strong> 
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
}
?>

            <button type="submit" class="btn btn-primary" >Edit Client</button>
        </form>
        <div class="col-sm-3 d-grid" style="margin-top: 20px; margin-left: 250px;">
            <a class="btn btn-secondary mt-3" style ="  font-weight: bold; background-color:rgb(197, 172, 27);"href="index.php">Back to List</a>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>