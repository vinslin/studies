<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD TEMP</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">CRUD APP</h1>
        <h2>List of clients</h2>
        <a class="btn btn-primary " href="create.php">New Client</a>
        <table class="table table-striped table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Creted AT</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $servername="localhost";
                $username="root";
                $password="";
                $database="vinslin";

                //crete connection
                $connection =new mysqli($servername,$username,$password,$database);

                //check connection
                if($connection->connect_error){
                    die("Connection failed: " . $connection ->connection_error);
                }
                $sql = "SELECT * FROM clients";
                //check if query is successful

                $result = $connection->query($sql);
                if(!$result){
                    die("INVALID QUERY :" . $connection->error);
                }

                while($row = $result -> fetch_assoc()){
                    echo "<tr>
                    <td>$row[id]</td>
                    <td>$row[name]</td>
                    <td>$row[email]</td>
                    <td>$row[phone]</td>
                    <td>$row[address]</td>
                    <td>$row[created_at]</td>
                    <td>
                        <a class='btn btn-success btn-sm' href='edit.php?id=$row[id]'>Edit</a>
                        <a class='btn btn-danger btn-sm' href='delete.php?id=$row[id]'>Delete</a>
                    </td>
                </tr>
                    ";
                }
                ?>

            </tbody>

        </table>
           
</div>
</body>
</html>