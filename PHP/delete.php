<?php
if (isset($_GET['id'])) {
    include "connection.php";

    $id = $_GET['id'];

    $status = true;

    $sql = "DELETE FROM students WHERE student_id='$id'";
    if ($conn->query($sql) === TRUE) {
        // Pass
    } else {
        $status = false;
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $sql = "DELETE FROM skills WHERE student_id='$id'";
    if ($conn->query($sql) === TRUE) {
        // Pass
    } else {
        $status = false;
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $sql = "DELETE FROM certificates WHERE student_id='$id'";
    if ($conn->query($sql) === TRUE) {
        // Pass
    } else {
        $status = false;
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $sql = "DELETE FROM questions WHERE student_id='$id'";
    if ($conn->query($sql) === TRUE) {
        // Pass
    } else {
        $status = false;
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    if ($status) {
        echo "<h3>Student deleted successfully.</h3>";
    } else {
        echo "<h3>Student deletion failed!</h3>";
    }

    header("Location: ../index.php");
}

$conn->close();
?>

<div class="text-center"><button type="button" class="btn btn-outline-primary "><a href="../index.php">HOME</a></button></div>
</div>
</div>
</body>

</html>