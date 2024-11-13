<?php
// Start session to track user login status
session_start();

// Check if the user is already logged in, if so, redirect them to the home page
/*if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}*/

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Connect to the database
    $conn = mysqli_connect('localhost', 'root', '22BCS0133@a', 'quiz_system');

    // Check the connection
    if (!$conn) {
        die('Connection failed: ' . mysqli_connect_error());
    }

    // Prepare SQL query to check if the user exists with the provided email and password
    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    // Check if any user is found
    if (mysqli_num_rows($result) == 1) {
        // User found, fetch user data
        $user = mysqli_fetch_assoc($result);
        
        // Start the session and store the user data
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] = $user['email'];

        // Redirect to the home page
        header('Location: aindex.php');
        exit;
    } else {
        // Incorrect login credentials
        $error_message = 'Invalid email or password!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        /* Global Styles */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f3f5;
            color: #333;
        }

        /* Container Styles */
        .container {
            max-width: 400px;
            margin: 80px auto;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #3498db;
            text-align: center;
            font-size: 2rem;
            margin-bottom: 20px;
        }

        /* Error Message Styling */
        .error {
            color: #e74c3c;
            font-size: 1rem;
            text-align: center;
            margin-bottom: 15px;
            padding: 10px;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            border-radius: 5px;
        }

        /* Form Styling */
        form {
            display: flex;
            flex-direction: column;
        }

        input[type="email"],
        input[type="password"] {
            padding: 12px;
            font-size: 1rem;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            transition: border-color 0.3s ease;
        }

        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: #3498db;
            outline: none;
        }

        button {
            background-color: #3498db;
            color: white;
            padding: 12px;
            font-size: 1.1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #2980b9;
        }

        /* Footer Styling */
        p {
            text-align: center;
            font-size: 1rem;
            color: #666;
        }

        p a {
            color: #3498db;
            text-decoration: none;
            font-weight: bold;
        }

        p a:hover {
            text-decoration: underline;
        }

        /* Responsive Design */
        @media (max-width: 600px) {
            .container {
                width: 90%;
                margin: 50px auto;
                padding: 25px;
            }

            h1 {
                font-size: 1.5rem;
            }

            input[type="email"],
            input[type="password"],
            button {
                font-size: 1rem;
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Login</h1>

        <?php if ($error_message) { ?>
            <p class="error"><?= $error_message ?></p>
        <?php } ?>

        <form action="login.php" method="POST">
            <input type="email" name="email" placeholder="Email" required><br><br>
            <input type="password" name="password" placeholder="Password" required><br><br>
            <button type="submit">Login</button><br>
        </form>

        <p>Don't have an account? <a href="register.php">Register here</a></p>
    </div>
</body>
</html>
