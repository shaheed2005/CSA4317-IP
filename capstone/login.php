
<?php
$host = 'localhost';
$db = 'registerDB';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);

    $sql = "SELECT password FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if ($row['password'] == $password) {
            
            header("refresh:1; url=main.html");
        } else {
            echo "Incorrect password!";
            header("refresh:2; url=login.html");
        }
    } else {
        echo "No user found with that email!";
        header("refresh:2; url=login.html");
    }
}

$conn->close();
?>

