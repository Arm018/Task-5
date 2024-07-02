<?php
    $localhost = 'localhost';
    $db_name = 'blog';
    $username = 'root';
    $password = '';

    $pagination_count = 2;
    $page = $_GET['page'];
    $offset = ($page - 1) * $pagination_count;

    try {

        $conn = new PDO("mysql:host=$localhost;dbname=$db_name", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare('SELECT * FROM blog_posts LIMIT :limit OFFSET :offset');
        $stmt->bindParam(':limit',$pagination_count,PDO::PARAM_INT);
        $stmt->bindParam(':offset',$offset,PDO::PARAM_INT);

        $stmt->execute();

        $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    }catch (Exception $e){
        echo 'Error ' . $e->getMessage();
    }

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
        <?php
            $stmt = $conn->prepare('SELECT COUNT(*) AS total FROM blog_posts');
            $stmt->execute();

            $total_posts = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
            $pages = ceil($total_posts / $pagination_count);

            for ($i = 1; $i <= $pages; $i++) {
                if ($i == $page)
                {
                    echo '<span>' . $i . '</span>';
                }else
                {
                    echo '<a href="?page=' . $i . '">' . $i . '</a>';
                }
            }

    ?>
        </div>

    </body>
</html>
