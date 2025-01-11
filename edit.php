<?php

/*******w******** 
    
    Name: Jashanpreet kaur
    Date: 29-09-2024
    Description: This file edits an existing blog.

****************/

require('connect.php');
require('authenticate.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_STRING);

    if (($title) && ($content) && ($id)) {

        $query = " UPDATE blog SET title = :title, content = :content, time_stamp = NOW()  WHERE id = :id";
        $statement = $db->prepare($query);
        $statement->execute(array(":title" => $title, ":content" => $content, 'id' => $id));
    }
    header("Location: index.php");
    exit;
} else {

    // Get to retrieve data using id
    if (isset($_GET['id'])) {
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

        if ($id) {

            $query = "SELECT id, title, content, time_stamp FROM blog WHERE id = :id";
            $statement = $db->prepare($query);
            $statement->execute([':id' => $id]);
            $post = $statement->fetch(PDO::FETCH_ASSOC);

            if (!$post) {
                die("Post not found!");
            }
        }
    } else {
        die("Invalid post ID!.");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Edit this Post!</title>
</head>

<body>
    <div class="content">


        <form method="post" class="post">

            <input type="hidden" name="id" id="id" value=" <?= htmlspecialchars($post['id']) ?>">

            <label for="title">Title</label>
            <input type="text" name="title" id="title" value="<?= htmlspecialchars($post['title']) ?>" required>
            
            <label for="content">Content: </label>

            <textarea name="content" id="content" required> <?= htmlspecialchars($post['content']) ?></textarea>
           
            <button type="submit">Update</button>
        </form>
    </div>



</body>

</html>