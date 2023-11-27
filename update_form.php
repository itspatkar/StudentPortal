<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Update Information</title>

    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <!-- Select2 CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>

<body>
    <div>
        <div class="container">
            <h2 class="p-5 text-center">Update Student Information</h2>

            <div class="jumbotron">
                <?php
                include "PHP/connection.php";

                if (isset($_GET["id"])) {
                    $id = $_GET['id'];

                    $sql = "SELECT * FROM students WHERE student_id='$id'";
                    $result = $conn->query($sql);

                    if ($result == TRUE) {
                        while ($row = $result->fetch_assoc()) {
                ?>
                            <form method="post" action="PHP/update.php">
                                <label for="name"><b>Name :</b> </label>
                                <input type="text" name="name" value="<?php if (isset($row['name'])) {
                                                                            echo $row['name'];
                                                                        } ?>" autofocus>
                                <br>
                                <label for="dob"><b>Birthdate :</b> </label>
                                <input type="date" name="dob" value="<?php if (isset($row['dob'])) {
                                                                            echo $row['dob'];
                                                                        } ?>">
                                <br>
                                <label for="gender"><b>Gender :</b> </label>
                                <input type="radio" name="gender" id="male" value="M" <?php if ($row['gender'] === 'M') echo ' checked'; ?>><label>Male</label>
                                <input type="radio" name="gender" id="female" value="F" <?php if ($row['gender'] === 'F') echo ' checked'; ?>><label>Female</label>
                                <br>
                                <label for="dob"><b>State :</b> </label>
                                <select id="state" name="state" onchange="selectCity()">
                                    <option value="">Select State</option>
                                    <?php
                                    $sql_state = "SELECT state_id, state_name FROM states";
                                    $result_state = $conn->query($sql_state);
                                    if ($result_state->num_rows > 0) {
                                        while ($row_state = $result_state->fetch_assoc()) {
                                            $selected = ($row['state'] == $row_state['state_id']) ? 'selected' : '';
                                            echo '<option value="' . $row_state['state_id'] . '"' . $selected . '>' . $row_state['state_name'] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                                <br>
                                <label for="city"><b>City :</b> </label>
                                <select id="city" name="city">
                                    <option value="select">Select City</option>
                                    <?php
                                    $state_id = $row['state'];
                                    $sql_city = "SELECT city_id, city_name FROM cities WHERE state_id=$state_id";
                                    $result_city = $conn->query($sql_city);
                                    if ($result_city->num_rows > 0) {
                                        while ($row_city = $result_city->fetch_assoc()) {
                                            $selected = ($row['city'] == $row_city['city_id']) ? 'selected' : '';
                                            echo '<option value="' . $row_city['city_id'] . '"' . $selected . '>' . $row_city['city_name'] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                                <br>
                                <label for="address"><b>Address :</b> </label>
                                <textarea name="address"><?php if (isset($row['address'])) {
                                                                echo $row['address'];
                                                            } ?></textarea>
                                <br>
                                <label for="photo"><b>Photo :</b> </label>
                                <input type="file" name="photo" accept="image/*">
                                <br>
                                <label><b>Skills :</b> </label>
                                <select class="skills" name="skills[]" multiple="multiple">
                                    <?php
                                    $sql2 = "SELECT skill_id FROM skills where student_id=$id";
                                    $result2 = $conn->query($sql2);
                                    $row2 = mysqli_num_rows($result2);
                                    $skill = [];
                                    for ($i = 0; $i < $row2; $i++) {
                                        $data = mysqli_fetch_assoc($result2);
                                        $skill[$i] = $data["skill_id"];
                                    }

                                    $sql3 = "SELECT skill_id, skill_name FROM skillset";
                                    $result3 = $conn->query($sql3);

                                    if ($result3->num_rows > 0) {
                                        while ($row3 = $result3->fetch_assoc()) {
                                            echo '<option value="' . $row3['skill_id'] . '"';
                                            if (in_array($row3['skill_id'], $skill)) echo "selected";
                                            echo ">" . $row3['skill_name'] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                                <br>
                                <label for="certificates"><b>Certificates :</b> </label>
                                <input type="file" name="certificates[]" multiple>
                                <br>

                                <div>
                                    <label for="question"><b>Questions :</b> </label>
                                    <ul>
                                        <?php
                                        $sql = "SELECT question_id, question FROM questionset WHERE question_status = '0'";
                                        $result = $conn->query($sql);

                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                $q_id = $row['question_id'];
                                                $sql_a = "SELECT question_id, answer FROM questions WHERE question_id=$q_id AND student_id=$id";
                                                $result_a = $conn->query($sql_a);
                                                $ans = "";
                                                while ($row_a = $result_a->fetch_assoc()) {
                                                    $ans = $row_a['answer'];
                                                }
                                                echo '<li>';
                                                echo '<label for="question"><b>' .  $row['question'] . '</b> </label><br>';
                                                echo '<input type="text" name="answer[]" placeholder="Answer" value="' . $ans . '">';
                                                echo '</li>';
                                            }
                                        }
                                        ?>
                                    </ul>
                                </div>

                                <input type="hidden" id="id" name="id" value="<?php echo $id; ?>">

                                <input class="m-3" type="submit" name="submit" value="Submit">
                            </form>
                <?php
                        }
                    }
                }

                ?>
            </div>

            <div class="text-center"><a type="button" class="btn btn-primary btn-sm" href="index.php">HOME</a></div>
        </div>
    </div>
    <script src="JS/select_city.js"></script>
    <script>
        $(document).ready(function() {
            $('.skills').select2();
        });
    </script>
</body>

</html>