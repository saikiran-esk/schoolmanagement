<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "school";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'];

    if ($email) {
        $stmt = $conn->prepare("SELECT password FROM teachers WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($hashedPassword);

        if ($stmt->fetch() && password_verify($password, $hashedPassword)) {
            // Successful login, output HTML with navigation links
            echo '<!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Teacher Dashboard</title>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        background-color: #f4f4f9;
                        margin: 0;
                        padding: 0;
                    }
                    header {
                        background-color: #4CAF50;
                        color: white;
                        text-align: center;
                        padding: 1rem 0;
                    }
                    nav {
                        margin: 20px 0;
                        text-align: center;
                    }
                    nav a {
                        margin: 0 15px;
                        text-decoration: none;
                        color: #007BFF;
                        font-size: 18px;
                    }
                    nav a:hover {
                        text-decoration: underline;
                    }
                    section {
                        padding: 20px;
                    }
                    iframe {
                        width: 100%;
                        height: 500px;
                        border: none;
                    }
                </style>
            </head>
            <body>
                <header>
                    <h1>Welcome to the Teacher Dashboard</h1>
                </header>
                <nav>
                    <a href="#admissionform">Admission Form</a>
                    <a href="#progress">Progress</a>
                    <a href="#beneficiarydetails">Beneficiary Details</a>
                </nav>
                <section id="admissionform">
                    <h2>Admission Form</h2>
                    <iframe src="admissionform.html"></iframe>
                </section>
                <section id="progress">
                    <h2>Progress</h2>
                     <iframe src="ol.html"></iframe>
                </section>
                <section id="beneficiarydetails">
                    <h2>Beneficiary Details</h2>
                    <iframe src="bene.html"></iframe>
                </section>
            </body>
            </html>';
        } else {
            // Invalid login
            echo "<p>Invalid email or password. <a href='index.html'>Try again</a>.</p>";
        }
        $stmt->close();
    } else {
        echo "<p>Invalid email address. <a href='index.html'>Try again</a>.</p>";
    }
}

$conn->close();
?>
