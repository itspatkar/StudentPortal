<?php
if (isset($_GET['x'])) {
    $x = $_GET['x'];
    $text = " ";
    for ($i = 10; $i < count($x); $i++) {
        $text += '<li>' . $x[$i] . '</li>';
    }
    echo $text;
}
