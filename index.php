<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <style>
    body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f9f9f9; /* added a light gray background */
    background-image: linear-gradient(to bottom, #f9f9f9, #fff); /* added a subtle gradient */
    }
    #a{
    text-align: center;
    padding: 20px;
    margin: 0;
    font-weight: bold;
    }
    header {
    background-color: #333; /* changed to a dark gray background */
    padding: 20px;
    text-align: center;
    color: #fff; /* changed text color to white */
    border-bottom: 1px solid #444; /* added a bottom border */
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* added a subtle shadow */
    }
    h1 {
    color: red;
    margin: 0;
    font-size: 5em; /* increased font size */
    font-weight: bold; /* made font bold */
    text-shadow: 0 1px 1px rgba(0, 0, 0, 0.2); /* added a subtle text shadow */
    }
    h2 {
        color:orange;
    margin: 0;
    font-size: 2em; /* increased font size */
    font-weight: bold; /* made font bold */
    text-shadow: 0 1px 1px rgba(0, 0, 0, 0.2); /* added a subtle text shadow */
    }
    nav {
    margin-top: 10px;
    font-size: 2em;
    }
    nav a {
    text-decoration: none;
    color: #337ab7;
    margin: 0 10px;
    transition: color 0.2s ease; /* added a transition effect */
    border-bottom: 2px solid transparent; /* added a transparent border */
    }
    nav a:hover {
    color: #23527c;
    text-decoration: underline; /* added an underline on hover */
    border-bottom: 2px solid #337ab7; /* changed border color on hover */
    }
    p{
     font-size:1em;
    }
    </style>
</head>
<body>
    <header>
        <h1> Quiz Maker </h1>
        <nav>
            <a href="register.php">Sign Up</a>
            <a href="login.php">Sign In</a> 
        </nav>
    </header>
    <div id="a">   
     <h2>Free online quiz maker</h2>
     <h2>please Login !</h2>
     <p>Make a quiz with different question types to engage students in a classroom,
      train employees at work, or play trivia with friends.
    </P> 
    </div>
</body>
</html>
 