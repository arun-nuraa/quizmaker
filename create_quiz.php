<?php
// Check if the user is logged in
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Add logic to handle quiz creation form submission (this will be handled below)
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Quiz</title>
    <style>
        /* Global Styles */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f4f8;
            color: #333;
        }

        /* Navbar Styles */
        .navbar {
            background-color: #2980b9;
            overflow: hidden;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .navbar a {
            float: left;
            display: block;
            color: white;
            padding: 16px 24px;
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
            max-width: 1000px;
            margin: 40px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 2.5rem;
            text-align: center;
            color: #2c3e50;
            margin-bottom: 20px;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        label {
            font-size: 1.1rem;
            color: #2c3e50;
            margin-bottom: 8px;
            display: block;
        }

        input[type="text"], textarea, select {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 1rem;
            color: #333;
        }

        textarea {
            resize: vertical;
        }

        fieldset {
            border: 1px solid #ddd;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 8px;
        }

        legend {
            font-weight: bold;
            color: #3498db;
        }

        /* Button Styles */
        button {
            background-color: #2980b9;
            color: white;
            padding: 14px 28px;
            font-size: 1.2rem;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            display: block;
            width: 100%;
            margin-top: 20px;
        }

        button:hover {
            background-color: #3498db;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .navbar {
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            .navbar a {
                width: 100%;
                padding: 14px 20px;
                text-align: center;
            }

            .container {
                padding: 20px;
                margin: 20px;
            }

            h1 {
                font-size: 2rem;
            }

            input[type="text"], textarea, select {
                font-size: 1rem;
                padding: 10px;
            }

            button {
                font-size: 1rem;
            }
        }

    </style>
</head>
<body>
    <div class="navbar">
        <a href="aindex.php">Home</a>
        <a href="create_quiz.php">Create Quiz</a>
        <a href="search_quiz.php">Search Quiz</a>
        <a href="profile.php">Profile</a>
        <a href="account.php">Account</a>
    </div>

    <div class="container">
        <h1>Create a New Quiz</h1>
        <form action="create_quiz_process.php" method="POST">
            <label for="quiz_title">Quiz Title</label>
            <input type="text" name="quiz_title" required>
            <label for="quiz_description">Quiz Description</label>
            <textarea name="quiz_description" rows="4" required></textarea>

            <!-- 10 questions form -->
            <?php for ($i = 1; $i <= 10; $i++) { ?>
                <fieldset>
                    <legend>Question <?= $i ?></legend>
                    <input type="text" name="questions[<?= $i ?>][question]" placeholder="Enter your question" required>
                    <input type="text" name="questions[<?= $i ?>][option_a]" placeholder="Option A" required>
                    <input type="text" name="questions[<?= $i ?>][option_b]" placeholder="Option B" required>
                    <input type="text" name="questions[<?= $i ?>][option_c]" placeholder="Option C" required>
                    <input type="text" name="questions[<?= $i ?>][option_d]" placeholder="Option D" required>
                    <select name="questions[<?= $i ?>][correct_option]" required>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                    </select>
                </fieldset>
            <?php } ?>

            <button type="submit">Create Quiz</button>
        </form>
    </div>
</body>
</html>
