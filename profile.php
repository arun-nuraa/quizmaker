<?php
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$conn = new mysqli("localhost", "root", "22BCS0133@a", "quiz_system");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch quizzes created by the user
$stmt = $conn->prepare("SELECT * FROM quizzes WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$created_quizzes = $stmt->get_result();

// Fetch quizzes attempted by the user and their scores
$stmt = $conn->prepare("SELECT qa.*, q.quiz_title, q.quiz_code FROM quiz_attempts qa 
                        JOIN quizzes q ON qa.quiz_id = q.quiz_id 
                        WHERE qa.user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$attempted_quizzes = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Account</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: #333;
            overflow: hidden;
        }

        .navbar a {
            float: left;
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }

        .container {
            width: 80%;
            margin: 20px auto;
        }

        h1, h2 {
            color: #333;
        }

        section {
            margin-bottom: 20px;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        ul li {
            background: #fff;
            border: 1px solid #ddd;
            margin: 10px 0;
            padding: 15px;
            border-radius: 5px;
        }

        ul li a {
            text-decoration: none;
            color: #007bff;
        }

        ul li a:hover {
            text-decoration: underline;
        }

        .question ul {
            margin: 0;
            padding-left: 20px;
        }

        .question li {
            margin-bottom: 8px;
        }

        .quiz-questions {
            margin-top: 20px;
            padding: 10px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
            display: none; /* Initially hidden */
        }

        .quiz-button {
            background-color: #007bff;
            color: white;
            padding: 8px 15px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            margin-top: 10px;
        }

        .quiz-button:hover {
            background-color: #0056b3;
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
        <h1>Welcome to Your Account</h1>

        <!-- Created Quizzes Section -->
        <section class="quizzes-created">
            <h2>Your Created Quizzes</h2>
            <?php if ($created_quizzes->num_rows > 0) { ?>
                <ul>
                    <?php while ($quiz = $created_quizzes->fetch_assoc()) { ?>
                        <li>
                            <strong><?= htmlspecialchars($quiz['quiz_title']) ?></strong>
                            <p>Code: <?= htmlspecialchars($quiz['quiz_code']) ?></p>
                            <p>Description: <?= nl2br(htmlspecialchars($quiz['quiz_description'])) ?></p>

                            <!-- Button to show questions -->
                            <button class="quiz-button" onclick="toggleQuestions(<?= $quiz['quiz_id'] ?>)">Show Questions</button>

                            <!-- Questions (Initially hidden) -->
                            <div class="quiz-questions" id="quiz-questions-<?= $quiz['quiz_id'] ?>">
                                <h3>Questions</h3>
                                <?php
                                $quiz_id = $quiz['quiz_id'];
                                $questions_stmt = $conn->prepare("SELECT * FROM questions WHERE quiz_id = ?");
                                $questions_stmt->bind_param("i", $quiz_id);
                                $questions_stmt->execute();
                                $questions_result = $questions_stmt->get_result();

                                while ($question = $questions_result->fetch_assoc()) { ?>
                                    <div class="question">
                                        <p><strong>Q:</strong> <?= htmlspecialchars($question['question_text']) ?></p>
                                        <ul>
                                            <li><?= htmlspecialchars($question['option_a']) ?></li>
                                            <li><?= htmlspecialchars($question['option_b']) ?></li>
                                            <li><?= htmlspecialchars($question['option_c']) ?></li>
                                            <li><?= htmlspecialchars($question['option_d']) ?></li>
                                        </ul>
                                    </div>
                                <?php }
                                ?>
                            </div>
                        </li>
                    <?php } ?>
                </ul>
            <?php } else { ?>
                <p>You haven't created any quizzes yet.</p>
            <?php } ?>
        </section>

        <!-- Attempted Quizzes Section -->
        <section class="quizzes-attempted">
            <h2>Your Attempted Quizzes</h2>
            <?php if ($attempted_quizzes->num_rows > 0) { ?>
                <ul>
                    <?php while ($attempt = $attempted_quizzes->fetch_assoc()) { ?>
                        <li>
                            <strong><?= htmlspecialchars($attempt['quiz_title']) ?></strong>
                            <p>Quiz Code: <?= htmlspecialchars($attempt['quiz_code']) ?></p>
                            <p>Score: <?= htmlspecialchars($attempt['score']) ?> / 
                            <?php
                                // Fetch total questions for this quiz to calculate full score
                                $quiz_id = $attempt['quiz_id'];
                                $stmt = $conn->prepare("SELECT COUNT(*) as total_questions FROM questions WHERE quiz_id = ?");
                                $stmt->bind_param("i", $quiz_id);
                                $stmt->execute();
                                $result = $stmt->get_result()->fetch_assoc();
                                echo $result['total_questions'];
                            ?>
                            </p>
                        </li>
                    <?php } ?>
                </ul>
            <?php } else { ?>
                <p>You haven't attempted any quizzes yet.</p>
            <?php } ?>
        </section>
    </div>

    <script>
        // JavaScript function to toggle visibility of quiz questions
        function toggleQuestions(quiz_id) {
            var quizQuestionsDiv = document.getElementById('quiz-questions-' + quiz_id);
            if (quizQuestionsDiv.style.display === "none" || quizQuestionsDiv.style.display === "") {
                quizQuestionsDiv.style.display = "block";
            } else {
                quizQuestionsDiv.style.display = "none";
            }
        }
    </script>
</body>
</html>

<?php
// Close the connection
$stmt->close();
$conn->close();
?>
