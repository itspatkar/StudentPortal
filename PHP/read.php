<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Read Operation</title>

    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <style>
        div {
            font-size: 1.25rem;
        }

        table {
            font-size: 1rem;
        }
    </style>
</head>

<body>
    <div>
        <div class="container">
            <h2 class="p-4 text-center">Student Information</h2>
            <div class="jumbotron">
                <?php
                include "connection.php";

                if (isset($_GET["id"])) {
                    $id = $_GET['id'];

                    $sql = "SELECT * FROM students WHERE student_id='$id'";
                    $result = $conn->query($sql);

                    if ($result == TRUE) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<b>Name :</b> " . $row['name'] . "<br>";
                            echo "<b>DOB : </b> " . $row['dob'] . "<br>";
                            echo "<b>Gender : </b> ";
                            if ($row['gender'] == "M") echo "Male" . "<br>";
                            else echo "Female" . "<br>";

                            $state_id = $row['state'];
                            $sql_state = "SELECT * FROM states WHERE state_id='$state_id'";
                            $result_state = $conn->query($sql_state);
                            if ($result_state->num_rows > 0) {
                                while ($row_state = $result_state->fetch_assoc()) {
                                    $state = $row_state['state_name'];
                                }
                            }
                            echo "<b>State : </b> " . $state . "<br>";

                            $city_id = $row['city'];
                            $sql_city = "SELECT * FROM cities WHERE city_id='$city_id'";
                            $result_city = $conn->query($sql_city);
                            if ($result_city->num_rows > 0) {
                                while ($row_city = $result_city->fetch_assoc()) {
                                    $city = $row_city['city_name'];
                                }
                            }
                            echo "<b>City : </b> " . $city . "<br>";

                            echo "<b>Address :</b> " . $row['address'] . "<br>";

                            echo "<b>Skills : </b><br>";
                            $sql2 = "SELECT skill_id FROM skills WHERE student_id='$id'";
                            $result2 = $conn->query($sql2);
                            echo '<ul>';
                            while ($row2 = $result2->fetch_assoc()) {
                                $s_id = $row2['skill_id'];
                                $sql_s = "SELECT skill_name FROM skillset WHERE skill_id=$s_id";
                                $result_s = $conn->query($sql_s);
                                while ($row_s = $result_s->fetch_assoc()) {
                                    echo "<li>" . $row_s['skill_name'] . "</li>";
                                }
                            }
                            echo "</ul>";

                            echo "<b>Questions & Answers : </b><br>";
                            $sql2 = "SELECT * FROM questions WHERE student_id='$id'";
                            $result2 = $conn->query($sql2);
                            echo '<div class="table-scroll"><table class="table table-bordered table-striped"><thead><tr>';
                            echo "<th>Question</th>";
                            echo "<th>Answer</th>";
                            echo "</tr></thead>";
                            echo "<tbody>";
                            while ($row2 = $result2->fetch_assoc()) {
                                $qs_id = $row2['question_id'];
                                $sql3 = "SELECT question FROM questionset WHERE question_id=$qs_id AND question_status='0'";
                                $result3 = $conn->query($sql3);
                                while ($row3 = $result3->fetch_assoc()) {
                                    echo "<tr><td>" . $row3['question'] . "</td>";
                                    echo "<td>" . $row2['answer'] . "</td></tr>";
                                }
                            }
                            echo "</tbody></table></div>";
                        }
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                }

                $conn->close();
                ?>

                <div class="text-center"><a type="button" class="btn btn-primary btn-sm" href="../index.php">HOME</a></div>
            </div>
        </div>
    </div>
</body>

</html>