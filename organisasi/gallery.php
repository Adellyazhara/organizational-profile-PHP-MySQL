<?php 
include('db.php');
include('header.php'); ?>
<div class="container my-5">
    <h1 class="mb-4">Galeri Kegiatan</h1>
    <div class="row">
        <?php
        $events = $conn->query("SELECT event_id, title, image FROM events"); // Tambahkan event_id untuk link
        while ($row = $events->fetch_assoc()) {
            $detailUrl = "detailsgallery.php?id=" . $row['event_id']; // URL ke halaman detail galeri
            echo "
            <div class='col-md-3 mb-4'>
                <div class='card'>
                    <img src='{$row['image']}' class='card-img-top' alt='{$row['title']}'>
                    <div class='card-body'>
                        <h5 class='card-title'>
                            <a href='{$detailUrl}' class='text-decoration-none'>{$row['title']}</a> <!-- Judul menjadi link -->
                        </h5>
                    </div>
                </div>
            </div>";
        }
        ?>
    </div>
</div>
<?php include('footer.php'); ?>