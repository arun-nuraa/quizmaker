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
    <link rel="stylesheet" href="css/styles.css">
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
