<?php

require "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $name = $_POST['name'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $address = $_POST['address'];
    $photo = $_POST['photo'];
    $skills = $_POST['skills'];
    $certificates = $_POST["certificates"];
    $answer = $_POST["answer"];

    // Employee
    $sql = "INSERT INTO students (name, dob, gender, state, city, address, photo) VALUES ('$name', '$dob', '$gender', '$state', '$city', '$address', '$photo')";

    if ($conn->query($sql) === TRUE) {
        $id = $conn->insert_id;

        // Certificates
        for ($i = 0; $i < count($certificates); $i++) {
            $sql = "INSERT INTO certificates (student_id, cert_name) VALUES ('$id', '$certificates[$i]')";
            if ($conn->query($sql) === TRUE) {
                // Pass
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

        // Skills
        for ($i = 0; $i < count($skills); $i++) {
            $sql = "INSERT INTO skills (student_id, skill_id) VALUES ('$id', '$skills[$i]')";
            if ($conn->query($sql) === TRUE) {
                // Pass
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

        // QnS
        $i = 0;
        $sql2 = "SELECT question_id FROM questionset";
        $result2 = $conn->query($sql2);

        if ($result2->num_rows > 0) {
            while ($row = $result2->fetch_assoc()) {
                $question_id = $row['question_id'];
                $sql = "INSERT INTO questions (student_id, question_id, answer) VALUES ('$id', '$question_id', '$answer[$i]')";
                if ($conn->query($sql) === TRUE) {
                    // Pass
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
                $i++;
            }
        }

        echo "Student added successfully.";
        header("Location: ../create_form.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
