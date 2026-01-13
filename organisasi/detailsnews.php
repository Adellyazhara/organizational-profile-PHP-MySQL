<?php 
include('db.php');
include('header.php'); ?>
<div class="container my-5">
    <?php
    if (isset($_GET['type']) && isset($_GET['id'])) {
        $type = $_GET['type'];
        $id = (int)$_GET['id'];

        if ($type === 'news') {
            $query = $conn->prepare("SELECT title, content, date FROM News WHERE news_id = ?");
            $query->bind_param("i", $id);
        } elseif ($type === 'event') {
            $query = $conn->prepare("SELECT title, description, date, image FROM Events WHERE event_id = ?");
            $query->bind_param("i", $id);
        } else {
            echo "<p>Tipe data tidak valid.</p>";
            exit;
        }

        $query->execute();
        $result = $query->get_result();

        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            echo "<h1>{$data['title']}</h1>";
            echo "<p><strong>Tanggal:</strong> {$data['date']}</p>";
            
            if ($type === 'news') {
                echo "<p>{$data['content']}</p>";
            } elseif ($type === 'event') {
                if (!empty($data['image'])) {
                    echo "<img src='{$data['image']}' alt='{$data['title']}' class='img-fluid mb-4'>";
                }
                echo "<p>{$data['description']}</p>";
            }
        } else {
            echo "<p>Data tidak ditemukan.</p>";
        }
        $query->close();
    } else {
        echo "<p>Parameter tidak valid.</p>";
    }
    ?>
</div>
<?php include('footer.php'); ?>