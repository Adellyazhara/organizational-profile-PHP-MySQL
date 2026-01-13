<?php
include('db.php');
include('header.php');

if (isset($_GET['id'])) {
    $eventId = $_GET['id'];

    // Query untuk mendapatkan detail event berdasarkan ID
    $query = $conn->prepare("SELECT title, image, description FROM events WHERE event_id = ?");
    $query->bind_param("i", $eventId);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        $event = $result->fetch_assoc();
    } else {
        echo "<div class='container my-5'><p class='text-danger'>Detail galeri tidak ditemukan.</p></div>";
        include('footer.php');
        exit;
    }
} else {
    header("Location: gallery.php"); // Redirect jika tidak ada ID
    exit;
}
?>

<div class="container my-5">
    <h1 class="mb-4"><?php echo htmlspecialchars($event['title']); ?></h1>
    <img src="<?php echo htmlspecialchars($event['image']); ?>" class="img-fluid mb-4" alt="<?php echo htmlspecialchars($event['title']); ?>">
    <p><?php echo nl2br(htmlspecialchars($event['description'])); ?></p> <!-- Menampilkan deskripsi -->
    <a href="gallery.php" class="btn btn-secondary">Kembali ke Galeri</a>
</div>

<?php include('footer.php'); ?>
