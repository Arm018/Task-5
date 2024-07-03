<?php


    $localhost = 'localhost';
    $db_name = 'blog';
    $username = 'root';
    $password = '';

    $pagination_count = 2;
    $page = $_GET['page'];
    $offset = ($page - 1) * $pagination_count;

    try
    {

        $conn = new PDO("mysql:host=$localhost;dbname=$db_name", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare('SELECT * FROM blog_posts LIMIT :limit OFFSET :offset');
        $stmt->bindParam(':limit',$pagination_count,PDO::PARAM_INT);
        $stmt->bindParam(':offset',$offset,PDO::PARAM_INT);

        $stmt->execute();

        $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $paginations = getPagination($conn, $pagination_count,$page);

    }catch (Exception $e)
    {
        echo 'Error ' . $e->getMessage();
    }