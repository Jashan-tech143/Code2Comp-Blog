<?php

/*******w******** 
    
    Name: Jashanpreet kaur
    Date: 29-09-2024
    Description: This file shows the first 5 latest blog posts to the user along with features such as creating a new blog post and editing an existing one.

****************/

require('connect.php');


$statement = $db->query('SELECT id, title,content, time_stamp FROM blog ORDER BY time_stamp DESC');
$posts = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Welcome to my Blog!</title>
</head>

<body>
    <header class="MainHeader">
        <h1>Code2Comp</h1>
        <nav>
            <a href="post.php">New Blog Post</a>
        </nav>
    </header>

    <main>
        <section class="content">

            <h2>Blog Posts</h2>

            <?php foreach ($posts as $post): ?>
                <article class="post">
                    <header>
                        <h3>
                            <a href="full_post.php?id=<?= $post['id'] ?>"> <?= htmlspecialchars($post['title']) ?> </a>
                        </h3>

                        <p id="time"><?= htmlspecialchars($post['time_stamp']) ?></p>

                    </header>

                    <?php if (strlen(htmlspecialchars(string: $post['content'])) > 200):
                        $truncatedContent = htmlspecialchars(string: substr(string: $post['content'], offset: 0, length: 200)) . '......'; ?>
                        <p>
                            <?= $truncatedContent . ' ' ?>
                            <a href="full_post.php?id=<?= $post['id'] ?>">Read more</a>
                        </p>

                    <?php else: ?>
                        <p>
                            <?= $post['content'] ?>
                        </p>
                    <?php endif; ?>

                    <footer>
                        <a href="edit.php?id=<?= $post['id'] ?>">Edit</a>
                    </footer>
                </article>
            <?php endforeach; ?>

        </section>
    </main>

</body>

</html>