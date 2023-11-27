<?php

require "connection.php";

if (isset($_POST) && isset($_POST["question"])) {
    $question = $_POST["question"];
    $skill_id = $_POST["skill"];
    $count_question = $_POST["count_question"];

    for ($i = $count_question; $i < count($skill_id); $i++) {
        $sql = "INSERT INTO questionset (question, question_status, skill_id) VALUES ('$question[$i]', '0', '$skill_id[$i]')";
        $result = $conn->query($sql);
        if (!$result) {
            echo "Error: " . $conn->error;
        }
    }
} else {
    echo "Error: No questions added!";
}
header("location: ../update_question_form.php");


$conn->close();
