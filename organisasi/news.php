<?php 
include('db.php');
include('header.php'); ?>
<div class="container my-5">
    <h1 class="mb-4">Berita dan Artikel</h1>
    <div class="row">
        <?php
        $news = $conn->query("SELECT news_id, title, content, date FROM News ORDER BY date DESC");
        while ($row = $news->fetch_assoc()) {
            $detailUrl = "detailsnews.php?type=news&id=" . $row['news_id']; // Membuat URL untuk halaman detail
            echo "<div class='col-md-6'>
                    <div class='card'>
                        <div class='card-body'>
                            <h5 class='card-title'><a href='{$detailUrl}'>{$row['title']}</a></h5>
                            <p class='card-text'>{$row['date']}</p>
                            <p class='card-text'>" . substr($row['content'], 0, 150) . "...</p> <!-- Menampilkan sebagian konten --></p>
                        </div>
                    </div>
                  </div>";
        }
        ?>
    </div>
</div>
<?php include('footer.php'); ?>