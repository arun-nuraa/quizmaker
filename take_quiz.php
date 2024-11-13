<?php
// Check if the user is logged in
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
$conn = new mysqli("localhost", "root", "22BCS0133@a", "quiz_system");

// Fetch quiz data by unique code
$code = $_GET['code'];
$sql = "SELECT * FROM quizzes WHERE quiz_code = '$code'";
$result = mysqli_query($conn, $sql);
$quiz = mysqli_fetch_assoc($result);

// Fetch questions for this quiz
$sql_questions = "SELECT * FROM questions WHERE quiz_id = " . $quiz['quiz_id'];
$questions_result = mysqli_query($conn, $sql_questions);
$questions = mysqli_fetch_all($questions_result, MYSQLI_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Calculate score
    $score = 0;
    foreach ($_POST['answers'] as $question_id => $answer) {
        $sql_answer = "SELECT correct_option FROM questions WHERE question_id = $question_id";
        $correct_answer = mysqli_fetch_assoc(mysqli_query($conn, $sql_answer))['correct_option'];
        if ($answer == $correct_answer) {
            $score++;
        }
    }
    // Save score to the database
    $user_id = $_SESSION['user_id'];
    $quiz_id = $quiz['quiz_id'];
    $sql_save_score = "INSERT INTO quiz_attempts (user_id, quiz_id, score) VALUES ($user_id, $quiz_id, $score)";
    mysqli_query($conn, $sql_save_score);
    echo "Your score: $score / " . count($questions);
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Take Quiz</title>
    <style>
    /* Global Styles */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7f6;
            color: #333;
            margin: 0;
            padding: 0;
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

        /* Main Container Styles */
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

        p {
            font-size: 1.2rem;
            text-align: center;
            color: #555;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        /* Quiz Form Styles */
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        fieldset {
            border: 1px solid #ddd;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 8px;
        }

        legend {
            font-size: 1.3rem;
            font-weight: bold;
            color: #3498db;
        }

        input[type="radio"] {
            margin-right: 10px;
            accent-color: #2980b9;
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

            p {
                font-size: 1rem;
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
        <h1><?= $quiz['quiz_title'] ?></h1>
        <form action="take_quiz.php?code=<?= $code ?>" method="POST">
            <?php foreach ($questions as $question) { ?>
                <fieldset>
                    <legend><?= $question['question_text'] ?></legend>
                    <input type="radio" name="answers[<?= $question['question_id'] ?>]" value="A"> <?= $question['option_a'] ?><br>
                    <input type="radio" name="answers[<?= $question['question_id'] ?>]" value="B"> <?= $question['option_b'] ?><br>
                    <input type="radio" name="answers[<?= $question['question_id'] ?>]" value="C"> <?= $question['option_c'] ?><br>
                    <input type="radio" name="answers[<?= $question['question_id'] ?>]" value="D"> <?= $question['option_d'] ?><br>
                </fieldset>
            <?php } ?>
            <button type="submit">Submit Quiz</button>
        </form>
    </div>
</body>
</html>
