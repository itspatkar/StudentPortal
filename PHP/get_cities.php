<?php
if (isset($_GET['state_id'])) {
    $state_id = $_GET['state_id'];
    require "connection.php";
    $cities = [];
    $sql = "SELECT * FROM cities WHERE state_id=$state_id";
    $result = $conn->query($sql);
    $row = mysqli_num_rows($result);
    for ($i = 1; $i <= $row; $i++) {
        $data = mysqli_fetch_assoc($result);
        $cities[$data['city_id']] = $data['city_name'];
    }

    $options = '<option value="">Select City..</option>';
    foreach ($cities as $city_id => $city_name) {
        $options .= '<option value="' . $city_id . '">' . $city_name . '</option>';
    }

    echo $options;
}
