<?php

require "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $question = $_POST["question"];

    for ($i = 0; $i < count($question); $i++) {
        $sql = "INSERT INTO questionset (question, question_status) VALUES ('$question[$i]', '0')";
        if ($conn->query($sql) === TRUE) {
            echo "Questions added successfully.";
            header("Location: ../add_question_form.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    $conn->close();
}
