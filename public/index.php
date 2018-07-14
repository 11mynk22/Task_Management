<!doctype html>
<?php include 'db.php';

$page = (isset($_GET['page']) ? (int)$_GET['page'] : 1);
$perpage = (isset($_GET['perpage']) && (int)($_GET['perpage']) <= 50 ? (int)$_GET['perpage'] : 5);
$start = ($page > 1) ? ($page * $perpage) - $perpage : 0;
$sql = "select * from tasks limit ".$start." , ".$perpage." ";
$total = $db->query("select * from tasks")->num_rows;
$pages = ceil($total / $perpage);

$rows = $db->query($sql);
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

        <center class="my-2">
            <h2>Todo List</h2>
        </center>

        <div class="row" style="margin-top: 50px;">
            <div class="col-md-10 offset-1">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">Add Task</button>
                <button type="button" class="btn btn-default float-right" onclick="print()">Print</button>
                <br>


                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add Task</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="add.php">
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Task Name</label>
                                        <input type="text" name="task" class="form-control" required autofocus>
                                    </div>
                                    <button type="submit" name="send" class="btn btn-success">Add Task</button>
                                </form>

                            </div>
                            <div class="modal-footer">

                            </div>
                        </div>
                    </div>
                </div>

                <br>
                <div class="col-md-4 text-center float-right">

                    <form action="search.php" method="post" class="form-group">
                        <input type="text" placeholder="Search" name="search" class="form-control">
                    </form>
                </div>
                <table class="table table-hover">

                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Task</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>

                            <?php
                                while($row = $rows->fetch_assoc()): ?>



                                <th>
                                    <?php echo $row['id'] ?>
                                </th>
                                <td class="col-md-10">
                                    <?php echo $row['name'] ?>
                                </td>
                                <td><a href="update.php?id=<?php echo $row['id'];?>" class="btn btn-success">Edit</a></td>
                                <td><a href="delete.php?id=<?php echo $row['id'];?>" class="btn btn-danger">Delete</a></td>
                        </tr>
                        <?php endwhile ?>
                    </tbody>
                </table>



                <ul class="pagination">
                    <?php for($i = 1 ; $i <= $pages; $i++): ?>
                    <li class="page-item">
                        <a href="?page=<?php echo $i;?>&per-page=<?php echo $perpage;?>" class="page-link">
                            <?php echo $i; ?>
                        </a>
                    </li>

                    <?php endfor; ?>
                </ul>


            </div>
        </div>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>
