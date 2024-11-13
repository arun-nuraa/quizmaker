<?php
// Start session to track user registration
session_start();

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $name=$_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate password confirmation
    if ($password != $confirm_password) {
        $error_message = "Passwords do not match!";
    } else {
        // Connect to the database
        $conn = mysqli_connect('localhost', 'root', '22BCS0133@a', 'quiz_system');
        if (!$conn) {
            die('Connection failed: ' . mysqli_connect_error());
        }

        // Check if the email is already registered
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $error_message = 'Email is already registered!';
        } else {
            // Insert the new user into the database
            //$hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hash the password for security
            $sql_insert = "INSERT INTO users (username,email, password) VALUES ('$name','$email', '$password')";
            if (mysqli_query($conn, $sql_insert)) {
                // Redirect to login page after successful registration
                header('Location: login.php');
                exit;
            } else {
                $error_message = 'Error: ' . mysqli_error($conn);
            }
        }

        mysqli_close($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        /* Global Styles */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
        }

        /* Container Styles */
        .container {
            max-width: 400px;
            margin: 50px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #3498db;
            font-size: 2rem;
            margin-bottom: 20px;
        }

        /* Error Message Styling */
        .error {
            color: #e74c3c;
            font-size: 1rem;
            background-color: #f8d7da;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        /* Form Styling */
        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        input[type="email"], input[type="password"], input[type="text"]{
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
            width: 100%;
            transition: border 0.3s;
        }

        input[type="email"]:focus, input[type="password"]:focus {
            border: 1px solid #3498db;
            outline: none;
        }

        input::placeholder {
            color: #888;
        }

        button {
            background-color: #3498db;
            color: white;
            padding: 14px;
            font-size: 1.1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #2980b9;
        }

        /* Link Styling */
        p {
            text-align: center;
            font-size: 1rem;
        }

        p a {
            color: #3498db;
            text-decoration: none;
        }

        p a:hover {
            text-decoration: underline;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                padding: 20px;
                margin: 20px;
            }

            h1 {
                font-size: 1.8rem;
            }

            button {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Register</h1>

        <?php if ($error_message) { ?>
            <p class="error"><?= $error_message ?></p>
        <?php } ?>

        <form action="register.php" method="POST">
            <input type="text" name="name" placeholder="Name" required><br>
            <input type="email" name="email" placeholder="Email" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required><br>
            <button type="submit">Register</button><br>
        </form>

        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>
</body>
</html>
