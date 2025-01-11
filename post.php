<?php

/*******w********     
    Name: Jashanpreet kaur
    Date: 29-09-2024
    Description: This file includes the code to post a new blog.
****************/

require('connect.php');
require('authenticate.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['title'], $_POST['content'])) {
    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);

    $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_STRING);

    if (($title) && ($content)) {
        $query = " INSERT INTO blog (title, content, time_stamp) VALUES (:title, :content, NOW())";
        $statement = $db->prepare($query);
        $statement->execute(array(":title" => $title, ":content" => $content));
    }
    header("Location: index.php");
    exit;
} ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>My Blog Post!</title>
</head>

<body>

    <div class="content">
        <h1>Create new post!</h1>
        <form method="post" class="post">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" required>


            <label for="content">Content:</label>
            <textarea name="content" id="content" required></textarea>

            <button type="submit">Submit</button>

        </form>

    </div>
</body>

</html>