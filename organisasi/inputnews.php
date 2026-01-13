<?php 
include('db.php');
include('header.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $title = $_POST['title'];
    $content = $_POST['content'];
    $date = $_POST['date'];  // Format tanggal YYYY-MM-DD

    // Query untuk menyimpan data
    $query = $conn->prepare("INSERT INTO news (title, content, date) VALUES (?, ?, ?)");
    $query->bind_param("sss", $title, $content, $date);

    if ($query->execute()) {
        echo "<p>Berita berhasil ditambahkan.</p>";
    } else {
        echo "<p>Terjadi kesalahan: " . $query->error . "</p>";
    }

    $query->close();
}
?>

<div class="container my-5">
    <h1 class="mb-4">Tambah Berita Baru</h1>
    <form action="inputnews.php" method="POST">
        <div class="form-group">
            <label for="title">Judul Berita</label>
            <input type="text" id="title" name="title" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="content">Konten Berita</label>
            <textarea id="content" name="content" class="form-control" rows="5" required></textarea>
        </div>
        <div class="form-group">
            <label for="date">Tanggal</label>
            <input type="date" id="date" name="date" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Tambah Berita</button>
    </form>
</div>

<?php include('footer.php'); ?>
