<?php
// Handle quiz search
if (isset($_POST['search'])) {
    $search_query = $_POST['search_query'];
    $conn = new mysqli("localhost", "root", "22BCS0133@a", "quiz_system");
    // Connect to DB and search quizzes
    $sql = "SELECT * FROM quizzes WHERE quiz_title LIKE '%$search_query%'  OR quiz_code LIKE '%$search_query%'";
    $result = mysqli_query($conn, $sql);
    // Handle quiz search results here
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Quiz</title>
    <style>
        /* Global Styles */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            color: #333;
        }

        /* Navbar Styles */
        .navbar {
            background-color: #3498db;
            overflow: hidden;
            padding: 10px 0;
        }

        .navbar a {
            float: left;
            display: block;
            color: white;
            padding: 14px 20px;
            text-align: center;
            text-decoration: none;
            font-size: 16px;
        }

        .navbar a:hover {
            background-color: #2980b9;
            color: white;
        }

        /* Container Styles */
        .container {
            max-width: 800px;
            margin: 40px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #3498db;
            text-align: center;
            font-size: 2rem;
            margin-bottom: 20px;
        }

        /* Search Form Styling */
        form {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 30px;
        }

        input[type="text"] {
            padding: 12px;
            font-size: 1rem;
            width: 80%;
            border: 1px solid #ccc;
            border-radius: 5px;
            transition: border-color 0.3s ease;
        }

        input[type="text"]:focus {
            border-color: #3498db;
            outline: none;
        }

        button {
            background-color: #3498db;
            color: white;
            padding: 12px 20px;
            font-size: 1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #2980b9;
        }

        /* Search Results Styling */
        h2 {
            color: #333;
            font-size: 1.5rem;
            margin-bottom: 15px;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        ul li {
            margin: 10px 0;
        }

        ul li a {
            color: #3498db;
            text-decoration: none;
            font-size: 1.1rem;
            display: block;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        ul li a:hover {
            background-color: #ecf0f1;
            color: #2980b9;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                margin: 20px;
                padding: 20px;
            }

            h1 {
                font-size: 1.8rem;
            }

            input[type="text"] {
                width: 70%;
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
        <h1>Search for a Quiz</h1>
        <form action="search_quiz.php" method="POST">
            <input type="text" name="search_query" placeholder="Enter Quiz Title or Code" required>
            <button type="submit" name="search">Search</button>
        </form>

        <?php if (isset($result)) { ?>
            <h2>Search Results:</h2>
            <ul>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <li><a href="take_quiz.php?code=<?= $row['quiz_code'] ?>"><?= $row['quiz_title'] ?></a></li>
                <?php } ?>
            </ul>
        <?php } ?>
    </div>
</body>
</html>
