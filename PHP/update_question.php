<?php

require "connection.php";

// if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
if (isset($_POST)) {
    $question = $_POST["question"];
    $skill_id = $_POST["skill"];
    $count_question = $_POST["count_question"];
    // $question_id = $_GET["question_id"];

    // print_r($count_question);
    // //$count = count($question);
    // print_r(count($question));
    // die();


    if (isset($question_id)) {
        header("location: ../update_question_form.php");
    } else {
        for ($i = $count_question; $i < count($skill_id); $i++) {
            $sql = "INSERT INTO questionset (question, question_status, skill_id) VALUES ('$question[$i]', '0', '$skill_id[$i]')";
            $result = $conn->query($sql);
            if (!$result) {
                echo "Error: " . $conn->error;
            }
        }
    }

    header("location: ../update_question_form.php");
}

$conn->close();
