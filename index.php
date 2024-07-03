<?php

    require 'pagination.php';
    require 'connect.php';

    ?>
<!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="style.css">
        <title>Blog Posts</title>
    </head>
    <body>
    <div class="container">
        <?php foreach ($posts as $post): ?>
            <div class="card">
                <div class="card__body">
                    <span class="tag tag-blue"><?= $post['category']?></span>
                    <h4><?= $post['title'] ?></h4>
                    <p><?= $post['content'] ?></p>
                </div>
                <div class="card__footer">
                    <div class="user">
                        <img src="https://i.pravatar.cc/40?img=1" alt="user__image" class="user__image">
                        <div class="user__info">
                            <h5><?= $post['author']?></h5>
                            <small><?= $post['created_at']?></small>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="pagination">
        <?php foreach ($paginations as $pagination): ?>
            <?= $pagination; ?>
        <?php endforeach; ?>
    </div>

    </body>
</html>
