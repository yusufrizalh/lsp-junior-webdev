<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $HOST = "localhost";
    $USER = "root";
    $PSWD = "";
    $DB = "db_laravel_training";
    $conn = mysqli_connect($HOST, $USER, $PSWD, $DB);
    if (mysqli_connect_error()) {
        die("Connection failed: " . mysqli_connect_error());
    }
    //* =================================================================

    if (isset($_POST['submitBtn'])) {
        if ($stmt = $conn->prepare("SELECT id, password FROM accounts WHERE username = ?")) {
            $stmt->bind_param('s', $_POST['username']);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows() > 0) {
                echo "<script type='text/javascript'>alert('Username already in use.');</script>";
                echo "<script type='text/javascript'>location.href='index.php';</script>";
            } else {
                if ($stmt = $conn->prepare("INSERT INTO accounts (username, email, password) VALUES(?, ?, ?)")) {
                    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                    $stmt->bind_param('sss', $_POST['username'], $_POST['email'], $password);
                    $stmt->execute();
                    echo "<script type='text/javascript'>alert('Account created successfully.');</script>";
                    echo "<script type='text/javascript'>location.href='index.php';</script>";
                } else {
                    echo "Error: " . $conn->error;
                }
            }
            $stmt->close();
        }
        $conn->close();
    }
}
