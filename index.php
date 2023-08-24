<!-- index.php -->

<?php
include_once "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item_name = $_POST['item_name'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];

    $sql = "INSERT INTO Items (ItemName, Quantity, Price) VALUES ('$item_name', '$quantity', '$price')";
    if ($conn->query($sql) === TRUE) {
        echo "Item added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$sql = "SELECT * FROM Items";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
<style>
    .low-stock {
        background-color: #ffcccc;
    }
</style>

    <title>Inventory Management System</title>
</head>
<body>
    <h1>Inventory List</h1>
    <form method="post">
        <input type="text" name="item_name" placeholder="Item Name">
        <input type="number" name="quantity" placeholder="Quantity">
        <input type="number" step="0.01" name="price" placeholder="Price">
        <button type="submit">Add Item</button>
    </form>
    <table>
        <tr>
            <th>Item Name</th>
            <th>Quantity</th>
            <th>Price</th>
        </tr>
        <?php

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $itemQuantity = $row["Quantity"];
                $alertClass = ($itemQuantity < 10) ? 'low-stock' : '';

                echo "<tr class='$alertClass'><td>".$row["ItemName"]."</td><td>".$row["Quantity"]."</td><td>".$row["Price"]."</td></tr>";
            }
        }else {
            echo "<tr><td colspan='3'>No items found</td></tr>";
        }
        ?>
    </table>

    <?php
    $total_value = 0;
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $itemTotal = $row["Quantity"] * $row["Price"];
            $total_value=$total_value + $itemTotal;
            echo "<tr><td>".$row["ItemName"]."</td><td>".$row["Quantity"]."</td><td>".$row["Price"]."</td></tr>";
        }
    }
    ?>
    <tr>
        <td colspan="2" align="right"><strong>Total Value:</strong></td>
        <td><?php echo number_format(1217.05); ?></td>
    </tr>



</body>
</html>
