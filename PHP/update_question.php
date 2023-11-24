<?php

require "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $question = $_POST["question"];

    $sql_q = "SELECT question_id, question FROM questionset WHERE question_status = '0'";
    $result_q = $conn->query($sql_q);

    if (isset($question_id)) {
        header("location: ../update_question_form.php");
    } else {
        $count = count($question);
        for ($i = 0; $i < $count; $i++) {
            $sql = "INSERT INTO questionset (question,question_status) VALUES ('$question[$i]', '0')";
            $result = $conn->query($sql);
            if (!$result) {
                echo "Error: " . $conn->error;
            }
        }
    }

    header("location: ../update_question_form.php");
}

$conn->close();
