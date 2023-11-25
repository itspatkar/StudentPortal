<?php

require "connection.php";

// if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
if (isset($_POST)) {
    $question = $_POST["question"];
    $skill = $_POST["skill"];

    // $question_id = $_GET["question_id"];

    $count = count($question);
    print_r($count);
    die();

    if (isset($question_id)) {
        header("location: ../update_question_form.php");
    } else {
        for ($i = 0; $i < $count; $i++) {
            $sql = "INSERT INTO questionset (question, question_status, skill_id) VALUES ('$question[$i]', '0', '$skill[$i]')";
            $result = $conn->query($sql);
            if (!$result) {
                echo "Error: " . $conn->error;
            }
        }
    }

    header("location: ../update_question_form.php");
}

$conn->close();
