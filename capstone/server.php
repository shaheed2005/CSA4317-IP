<?php
$servername = "localhost";
$username = "root";     
$password = "";         
$dbname = "myshop";     

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $card_number = $_POST['card_number'];
    $expiry_month = $_POST['expiry_month'];
    $expiry_year = $_POST['expiry_year'];
    $cvv = $_POST['cvv'];

    echo "Received data: Name = $name, Phone = $phone, Address = $address, Card Number = $card_number, Expiry Month = $expiry_month, Expiry Year = $expiry_year, CVV = $cvv <br>";

    $sql = "INSERT INTO customers (name, phone, address, card_number, expiry_month, expiry_year, cvv) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {

        $stmt->bind_param("sisiiii", $name, $phone, $address, $card_number, $expiry_month, $expiry_year, $cvv);

        if ($stmt->execute()) {
            echo "Record successfully saved!";
            
            header("refresh:3;url=index.html");
        } else {
            echo "Error executing statement: " . $stmt->error;
        }
        
    
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
}


$conn->close();
?>
