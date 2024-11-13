<?php
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Get the quiz code from the URL
if (!isset($_GET['quiz_code'])) {
    echo "Quiz code is missing.";
    exit;
}

$quiz_code = $_GET['quiz_code'];

// Database connection
$host = 'localhost';  // Database host
$db = 'quiz_system';  // Database name
$user = 'root';  // Database username
$pass = '22BCS0133@a';  // Database password

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the quiz details using the quiz code
$stmt = $conn->prepare("SELECT * FROM quizzes WHERE quiz_code = ?");
$stmt->bind_param("s", $quiz_code);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $quiz = $result->fetch_assoc(); // Fetch the quiz details

    echo "<h1>" . htmlspecialchars($quiz['quiz_title']) . "</h1>";
    echo "<p>" . nl2br(htmlspecialchars($quiz['quiz_description'])) . "</p>";

    // Get the questions for this quiz
    $stmt = $conn->prepare("SELECT * FROM questions WHERE quiz_id = ?");
    $stmt->bind_param("i", $quiz['quiz_id']);
    $stmt->execute();
    $questions_result = $stmt->get_result();

    // Create the form for the quiz
    echo '<form method="POST" action="aindex.php">';

    while ($question = $questions_result->fetch_assoc()) {
        echo "<fieldset>";
        echo "<legend>" . htmlspecialchars($question['question_text']) . "</legend>";
        echo "<input type='radio' name='question_" . $question['question_id'] . "' value='A'>" . htmlspecialchars($question['option_a']) . "<br>";
        echo "<input type='radio' name='question_" . $question['question_id'] . "' value='B'>" . htmlspecialchars($question['option_b']) . "<br>";
        echo "<input type='radio' name='question_" . $question['question_id'] . "' value='C'>" . htmlspecialchars($question['option_c']) . "<br>";
        echo "<input type='radio' name='question_" . $question['question_id'] . "' value='D'>" . htmlspecialchars($question['option_d']) . "<br>";
        echo "</fieldset>";
    }

    // Submit button
    echo "<button type='submit'>Okay</button>";
    echo "</form>";

} else {
    echo "Quiz not found.";
}

$stmt->close();
$conn->close();
?>
