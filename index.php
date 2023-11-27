<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Student Management</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <style>
        a {
            margin: 1.5px;
        }
    </style>
</head>

<body>
    <div>
        <h1 class="p-5 text-center">STUDENT MANAGEMENT</h1>

        <div class="container">

            <a type="button" class="btn btn-secondary" href="create_form.php">Add Student</a>
            <a type="button" class="btn btn-info float-right" href="update_question_form.php">Update Questions</a>
            <a type="button" class="btn btn-primary float-right" href="add_question_form.php">Add Questions</a>
            <br><br>

            <table id="myTable" class="display">

                <thead>
                    <tr>
                        <th>Sr No</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require 'PHP/connection.php';
                    $sql = "SELECT * from `students`";
                    $result = $conn->query($sql);
                    $row = mysqli_num_rows($result);
                    for ($i = 1; $i <= $row; $i++) {
                        $data = mysqli_fetch_assoc($result);
                        $id = $data["student_id"];
                        $name = $data["name"];
                    ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $name; ?></td>
                            <td>
                                <a type="button" class="btn btn-primary btn-sm" href="PHP/read.php?id=<?php echo $id; ?>">View</a>
                                <a type="button" class="btn btn-warning btn-sm" href="update_form.php?id=<?php echo $id; ?>">Edit</a>
                                <a type="button" class="btn btn-danger btn-sm" href="PHP/delete.php?id=<?php echo $id; ?>" onclick="return confirm('Are you sure you want to delete this item?')">Delete</a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>

                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
</body>

</html>