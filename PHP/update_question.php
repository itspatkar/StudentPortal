<?php

require "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $question = $_POST["question"];
    //$question_id = $_GET["question_id"];

    $sql_q = "SELECT question_id, question FROM questionset WHERE question_status = '0'";
    $result_q = $conn->query($sql_q);

    if (isset($question_id)) {
        header("location: update_question_form.php");
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

    // $sql = "DELETE FROM questionset";
    // if ($conn->query($sql) === TRUE) {
    //     // Pass
    // } else {
    //     echo "Error: " . $sql . "<br>" . $conn->error;
    // }

    // for ($i = 0; $i < count($question); $i++) {
    //     $sql = "SELECT question_id FROM questionset";
    //     $result = $conn->query($sql);

    //     if ($result->num_rows > 0) {
    //         while ($row = $result->fetch_assoc()) {
    //         }
    //     }


    //     $sql = "INSERT INTO questionset (question) VALUES ('$question[$i]')";
    //     if ($conn->query($sql) === TRUE) {
    //         echo "Questions added successfully.";
    //         header("Location: ../update_question_form.php");
    //     } else {
    //         echo "Error: " . $sql . "<br>" . $conn->error;
    //     }
    // }

    $conn->close();
}
