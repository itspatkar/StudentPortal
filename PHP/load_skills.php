<select name="skill[]">
    <option value="">Select Skill</option>
    <?php
    require "connection.php";
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