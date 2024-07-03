<?php

    function getPagination($conn, $pagination_count, $current_page) {
        $stmt = $conn->prepare('SELECT COUNT(*) AS total FROM blog_posts');
        $stmt->execute();

        $total_posts = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
        $pages = ceil($total_posts / $pagination_count);

        $pagination_links = [];
        for ($i = 1; $i <= $pages; $i++) {
            if ($i == $current_page) {
                $pagination_links[] = '<span>' . $i . '</span>';
            } else {
                $pagination_links[] = '<a href="?page=' . $i . '">' . $i . '</a>';
            }
        }
        return $pagination_links;
    }