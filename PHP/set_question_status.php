<?php

if (isset($_GET)) {
    $question_id = $_GET["question_id"];

    if (isset($question_id)) {
        require "connection.php";

        $sql = "UPDATE questionset SET question_status = '1'  WHERE question_id = '$question_id'";

        if ($conn->query($sql) === TRUE) {
            // Pass
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
