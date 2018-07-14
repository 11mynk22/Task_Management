<!doctype html>
<?php include 'db.php';

$id = (int)$_GET['id'];

$sql = "select * from tasks where id = '$id'";

$rows = $db->query($sql);

$row = $rows->fetch_assoc();

if(isset($_POST['send'])){

$task = htmlspecialchars($_POST['task']);
$sql = "update tasks set name = '$task' where id = '$id'";

$db->query($sql);

header('location: index.php');
    
}

?>



<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">

    <title>CRUD</title>
</head>

<body>

    <div class="container">

        <center>
            <h2>Update Todo List</h2>
        </center>



        <form method="post">
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Task Name</label>
                <input type="text" name="task" value="<?php echo $row['name']; ?>" class="form-control" required>
            </div>
            <button type="submit" name="send" class="btn btn-success">Update Task</button>
            <a href="index.php" class="btn btn-danger">Back</a>
        </form>

    </div>





    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>
