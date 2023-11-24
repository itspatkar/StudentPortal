<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Add Student</title>

    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <!-- Select2 CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>

<body>
    <div>
        <h2 class="p-5 text-center">Add New Student</h2>

        <div class="container">
            <div class="jumbotron">
                <form method="post" action="PHP/create.php">
                    <label for="name"><b>Name :</b> </label>
                    <input type="text" name="name" autofocus required>
                    <br>
                    <label for="dob"><b>Birthdate :</b> </label>
                    <input type="date" name="dob" required>
                    <br>
                    <label for="gender"><b>Gender :</b> </label>
                    <input type="radio" name="gender" value="M" required> Male
                    <input type="radio" name="gender" value="F" required> Female
                    <br>
                    <label for="dob"><b>State :</b> </label>
                    <select id="state" name="state" onchange="selectCity()">
                        <option value="select">Select State</option>
                        <?php
                        require "PHP/connection.php";

                        $sql = "SELECT state_id, state_name FROM states";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<option value="' . $row['state_id'] . '">' . $row['state_name'] . '</option>';
                            }
                        }
                        $conn->close();
                        ?>
                    </select>
                    <br>
                    <label for="city"><b>City :</b> </label>
                    <select id="city" name="city">
                        <option value="select">Select City</option>
                    </select>
                    <br>
                    <label for="address"><b>Address :</b> </label>
                    <textarea name="address" required></textarea>
                    <br>
                    <label for="photo"><b>Photo :</b> </label>
                    <input type="file" name="photo" accept="image/*" required>
                    <br>
                    <label><b>Skills :</b> </label>
                    <select class="skills" name="skills[]" multiple="multiple">
                        <?php
                        require "PHP/connection.php";

                        $sql = "SELECT skill_id, skill_name FROM skillset";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<option value="' . $row['skill_id'] . '">' . $row['skill_name'] . '</option>';
                            }
                        }

                        $conn->close();
                        ?>
                    </select>
                    <br>
                    <label for="certificates"><b>Certificates :</b> </label>
                    <input type="file" name="certificates[]" multiple required>
                    <br>
                    <div>
                        <label for="question"><b>Questions :</b> </label>
                        <ul>
                            <?php
                            require "PHP/connection.php";

                            $sql = "SELECT question FROM questionset WHERE question_status = '0'";

                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo '<li>';
                                    echo '<label for="question"><b>' .  $row['question'] . '</b> </label><br>';
                                    echo '<input type="text" name="answer[]" placeholder="Answer" required>';
                                    echo '</li>';
                                }
                            } else {
                                echo "No records found!";
                            }
                            $conn->close();

                            ?>
                        </ul>
                    </div>

                    <input class="m-3" type="submit" name="submit" value="Submit">
                </form>
            </div>

            <div class="text-center"><button type="button" class="btn btn-outline-primary "><a href="index.php">HOME</a></button></div>
        </div>
    </div>

    <script src="JS/select_city.js"></script>
    <script src="JS/questions.js"></script>
    <script>
        $(document).ready(function() {
            $('.skills').select2();
        });
    </script>
</body>

</html>