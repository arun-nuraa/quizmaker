<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Maker</title>
    <style>
        /* Global Styles */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
        }

        /* Navbar Styles */
        .navbar {
            background-color: #2c3e50;
            overflow: hidden;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .navbar a {
            float: left;
            display: block;
            color: white;
            padding: 16px 25px;
            text-align: center;
            text-decoration: none;
            font-size: 18px;
            font-weight: 500;
            transition: background-color 0.3s;
        }

        .navbar a:hover {
            background-color: #3498db;
            color: white;
        }

        /* Container Styles */
        .container {
            max-width: 1100px;
            margin: 50px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.1);
        }

        /* Heading Styles */
        h1 {
            font-size: 2.5em;
            text-align: center;
            color: #2c3e50;
            margin-bottom: 20px;
        }

        p {
            font-size: 1.2em;
            text-align: center;
            color: #7f8c8d;
            margin-bottom: 30px;
        }

        /* Button Styles */
        .button {
            display: inline-block;
            background-color: #3498db;
            color: white;
            padding: 15px 25px;
            text-align: center;
            font-size: 1.2rem;
            font-weight: bold;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
            margin: 10px;
        }

        .button:hover {
            background-color: #2980b9;
        }

        .button:active {
            background-color: #1d6fa5;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .navbar {
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            .navbar a {
                text-align: left;
                padding: 12px 20px;
                width: 100%;
                border-top: 1px solid #ccc;
            }

            .navbar a:first-child {
                border-top: none;
            }

            .container {
                padding: 20px;
                margin: 20px;
            }

            h1 {
                font-size: 2rem;
            }

            .button {
                font-size: 1rem;
                width: 100%;
            }
        }

    </style>
</head>
<body>
    <div class="navbar">
        <a href="create_quiz.php">Create Quiz</a>
        <a href="search_quiz.php">Search Quiz</a>
        <a href="profile.php">Profile</a>
        <a href="account.php">Account</a>
    </div>

    <div class="container">
        <h1>Welcome to Quiz Maker</h1>
        <p>Choose an option to get started:</p>
        <div class="choices">
            <a href="create_quiz.php" class="button">Create a New Quiz</a>
            <a href="search_quiz.php" class="button">Search for a Quiz</a>
        </div>
    </div>
</body>
</html>
