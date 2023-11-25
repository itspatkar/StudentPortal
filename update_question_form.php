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
    <div class="container">
        <h2 class="p-5 text-center">Update Questions</h2>

        <div class="jumbotron">
            <form method="post" action="PHP/update_question.php">
                <label for="question"><b>Questions :</b> </label>
                <ul id="questionDetails">
                    <?php
                    require "PHP/connection.php";

                    $sql = "SELECT question_id, question, skill_id FROM questionset WHERE question_status = '0'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<li class="question-row">';
                    ?>
                            <select name="skill[]">
                                <option value="">Select Skill</option>
                                <?php
                                require "PHP/connection.php";
                                $sql_s = "SELECT * FROM skillset";
                                $result_s = $conn->query($sql_s);
                                $row_s = mysqli_num_rows($result_s);

                                if ($row_s > 0) {
                                    for ($i = 1; $i <= $row_s; $i++) {
                                        $data = mysqli_fetch_assoc($result_s);
                                        $selected = ($row['skill_id'] == $data['skill_id']) ? 'selected' : '';
                                        echo '<option value="' . $data['skill_id'] . '"'  . $selected . '>' . $data['skill_name'] . '</option>';
                                    }
                                } else {
                                    echo 'No Records Found!';
                                }
                                ?>
                            </select><?php
                                        echo '&nbsp;<input type="text" name="question[]" placeholder="Question" value="' . $row['question'] . '" required>&nbsp;';
                                        echo '<input type="hidden" name="question_id" value="' . $row['question_id'] . '">';
                                        echo '<button type="button" onclick="removeQNA(this,' . $row['question_id'] . ')">Remove</button><br><br>';
                                        echo '</li>';
                                    }
                                }
                                        ?>

                    <li class="question-row">
                        <select name="skill[]">
                            <option value="">Select Skill</option>
                            <?php
                            require "PHP/connection.php";
                            $sql = "SELECT * FROM skillset";
                            $result = $conn->query($sql);
                            $row = mysqli_num_rows($result);

                            if ($row > 0) {
                                for ($i = 1; $i <= $row; $i++) {
                                    $data = mysqli_fetch_assoc($result);
                                    echo '<option value="' . $data['skill_id'] . '">' . $data['skill_name'] . '</option>';
                                }
                            } else {
                                echo 'No Records Found!';
                            }
                            ?>
                        </select>
                        <input type="text" name="question[]" placeholder="Question">
                        <button type="button" onclick="addQNA()">Add</button><br><br>
                    </li>
                </ul>

                <input class="m-3" type="submit" name="submit" value="Submit">
            </form>
        </div>
        <div class="text-center"><button type="button" class="btn btn-outline-primary "><a href="index.php">HOME</a></button></div>
    </div>
    <script src="JS/questions.js"></script>
</body>

</html>