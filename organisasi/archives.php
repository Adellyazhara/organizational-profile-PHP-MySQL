<?php
include('db.php');
include('header.php');

// Hapus berita jika ID berita dikirim lewat GET
if (isset($_GET['delete_id'])) {
    $delete_id = (int)$_GET['delete_id'];
    $deleteQuery = $conn->prepare("DELETE FROM News WHERE news_id = ?");
    $deleteQuery->bind_param("i", $delete_id);

    if ($deleteQuery->execute()) {
        echo "<p>Berita berhasil dihapus.</p>";
    } else {
        echo "<p>Terjadi kesalahan saat menghapus berita: " . $deleteQuery->error . "</p>";
    }

    $deleteQuery->close();
}

// Ambil semua berita dari database
$query = "SELECT news_id, title, date FROM News ORDER BY date DESC";
$news = $conn->query($query);
?>

<div class="container my-5">
    <h1 class="mb-4">Arsip Berita</h1>

    <?php if ($news->num_rows > 0) { ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Judul</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $news->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['news_id']; ?></td>
                        <td><?php echo $row['title']; ?></td>
                        <td><?php echo $row['date']; ?></td>
                        <td>
                            <!-- Tombol Edit -->
                            <a href="editnews.php?id=<?php echo $row['news_id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <!-- Tombol Hapus -->
                            <a href="archives.php?delete_id=<?php echo $row['news_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus berita ini?');">Hapus</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p>Tidak ada berita yang ditemukan.</p>
    <?php } ?>
</div>

<?php include('footer.php'); ?>
