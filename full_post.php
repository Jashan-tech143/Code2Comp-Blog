<!-- 
    Name: Jashanpreet kaur
    Date: 29-09-2024
    Description: This file shows the full blog to the user.
-->

<?php
require('connect.php');

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
    } else {
        die("Invalid post ID!.");

    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars(string: $post['title']) ?> </title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <main>
        <article class="content">
            <h1><?= htmlspecialchars(string: $post['title']) ?></h1>
            <p id="time"><?= date("F j, Y", strtotime($post['time_stamp'])) ?></p>

            <div class="post"><?= htmlspecialchars($post['content']) ?></div>

        </article>

    </main>
</body>

</html>