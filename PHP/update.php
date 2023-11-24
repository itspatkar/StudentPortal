<?php

require "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $id = $_POST['id'];
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

    // Students
    $sql = "UPDATE students SET name='$name', dob='$dob', gender='$gender', state='$state', city='$city', address='$address', photo='$photo' WHERE student_id=$id";

    if ($conn->query($sql) === TRUE) {
        // Certificates
        for ($i = 0; $i < count($certificates); $i++) {
            $sql = "UPDATE certificates SET student_id='$id', cert_name='$certificates[$i]' WHERE student_id=$id";
            if ($conn->query($sql) === TRUE) {
                // Pass
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

        // Skills
        $sql = "DELETE FROM skills WHERE student_id=$id";
        if ($conn->query($sql) === TRUE) {
            // Pass
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        for ($i = 0; $i < count($skills); $i++) {
            $sql = "INSERT INTO skills (student_id, skill_id) VALUES ('$id', '$skills[$i]')";
            if ($conn->query($sql) === TRUE) {
                // Pass
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

        // QnS
        $sql = "DELETE FROM questions WHERE student_id=$id";
        if ($conn->query($sql) === TRUE) {
            // Pass
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
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

        echo "Student information updated successfully.";
        header("Location: ../update_form.php?id=$id");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
