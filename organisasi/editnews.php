<?php 
include('db.php');
include('header.php');

// Cek apakah ada ID yang dikirimkan melalui URL
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    // Ambil data berita berdasarkan ID
    $query = $conn->prepare("SELECT title, content, date FROM News WHERE news_id = ?");
    $query->bind_param("i", $id);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "<p>Berita tidak ditemukan.</p>";
        exit;
    }

    $query->close();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Ambil data yang diubah
        $title = $_POST['title'];
        $content = $_POST['content'];
        $date = $_POST['date'];  // Format tanggal YYYY-MM-DD

        // Query untuk memperbarui data
        $updateQuery = $conn->prepare("UPDATE News SET title = ?, content = ?, date = ? WHERE news_id = ?");
        $updateQuery->bind_param("sssi", $title, $content, $date, $id);

        if ($updateQuery->execute()) {
            echo "<p>Berita berhasil diperbarui.</p>";
        } else {
            echo "<p>Terjadi kesalahan: " . $updateQuery->error . "</p>";
        }

        $updateQuery->close();
    }
} else {
    echo "<p>ID berita tidak ditemukan.</p>";
    exit;
}
?>

<div class="container my-5">
    <h1 class="mb-4">Edit Berita</h1>
    <form action="editnews.php?id=<?php echo $id; ?>" method="POST">
        <div class="form-group">
            <label for="title">Judul Berita</label>
            <input type="text" id="title" name="title" class="form-control" value="<?php echo $row['title']; ?>" required>
        </div>
        <div class="form-group">
            <label for="content">Konten Berita</label>
            <textarea id="content" name="content" class="form-control" rows="5" required><?php echo $row['content']; ?></textarea>
        </div>
        <div class="form-group">
            <label for="date">Tanggal</label>
            <input type="date" id="date" name="date" class="form-control" value="<?php echo $row['date']; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Perbarui Berita</button>
    </form>
</div>

<?php include('footer.php'); ?>
