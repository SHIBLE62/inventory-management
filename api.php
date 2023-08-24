<!-- api.php -->

<?php
include_once "config.php";

$sql = "SELECT * FROM Items";
$result = $conn->query($sql);

$items = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $items[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($items);
?>
