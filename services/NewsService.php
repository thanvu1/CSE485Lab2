<?php
require_once './models/News.php';
class NewsService
{
    public function getAllNews(){
        try {
            $conn = new PDO('mysql:host=localhost;dbname=thb2', 'root', '');
            // Thiết lập chế độ báo lỗi
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "select * from news";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $news = [];
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $new = new News($row['id'], $row['title'], $row['content'], $row['image'], $row['created_at'], $row['category_id']);
                $news[] = $new;
            }
            echo "conected";
            return $news;
        }catch (PDOException $e) {
//            echo $e->getMessage();
            return $news = [];
        }
    }
}