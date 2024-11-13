<?php
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Database connection
$host = 'localhost'; // Database host
$db = 'quiz_system'; // Database name
$user = 'root'; // Database username
$pass = '22BCS0133@a'; // Database password

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve quiz details from POST data
$quiz_title = $_POST['quiz_title'];
$quiz_description = $_POST['quiz_description'];
$user_id = $_SESSION['user_id']; // Logged in user's ID

// Generate a unique quiz code (e.g., random alphanumeric string)
$quiz_code = strtoupper(bin2hex(random_bytes(5)));

// Insert the quiz into the `quizzes` table
$stmt = $conn->prepare("INSERT INTO quizzes (quiz_title, quiz_description, user_id, quiz_code) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssis", $quiz_title, $quiz_description, $user_id, $quiz_code);

if ($stmt->execute()) {
    $quiz_id = $stmt->insert_id; // Get the ID of the inserted quiz

    // Insert each question into the `questions` table
    if (isset($_POST['questions'])) {
        $questions = $_POST['questions'];
        $stmt = $conn->prepare(
            "INSERT INTO questions (quiz_id, question_text, option_a, option_b, option_c, option_d, correct_option)
             VALUES (?, ?, ?, ?, ?, ?, ?)"
        );

        foreach ($questions as $question) {
            $question_text = $question['question'];
            $option_a = $question['option_a'];
            $option_b = $question['option_b'];
            $option_c = $question['option_c'];
            $option_d = $question['option_d'];
            $correct_option = $question['correct_option'];

            $stmt->bind_param("issssss", $quiz_id, $question_text, $option_a, $option_b, $option_c, $option_d, $correct_option);
            $stmt->execute();
        }
    }

    // Redirect to a page where the user can view the quiz or take it
    header("Location: quiz_details.php?quiz_code=$quiz_code");
    exit;
} else {
    echo "Error creating quiz: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
