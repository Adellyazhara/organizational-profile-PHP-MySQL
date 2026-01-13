<?php
include('db.php');
include('header.php');

// Pastikan hanya admin yang bisa mengakses halaman ini
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['id'])) {
    $eventId = $_GET['id'];

    // Ambil data galeri berdasarkan ID
    $query = $conn->prepare("SELECT * FROM Events WHERE event_id = ?");
    $query->bind_param("i", $eventId);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        $event = $result->fetch_assoc();
    } else {
        header("Location: archives.php");
        exit;
    }

    // Proses jika form di-submit
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $image = $_FILES['image']['name'];

        if (!empty($image)) {
            // Upload gambar baru jika ada
            $targetDir = "uploads/";
            $targetFile = $targetDir . basename($image);
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                $imageQuery = ", image = '$targetFile'"; // Update gambar
            } else {
                $error = "Gagal mengupload gambar.";
            }
        } else {
            $imageQuery = ""; // Jika gambar tidak diubah
        }

        // Update data galeri
        $updateQuery = $conn->prepare("UPDATE Events SET title = ?, description = ? $imageQuery WHERE event_id = ?");
        if (empty($imageQuery)) {
            $updateQuery = $conn->prepare("UPDATE Events SET title = ?, description = ? WHERE event_id = ?");
        }

        $updateQuery->bind_param("ssi", $title, $description, $eventId);
        if ($updateQuery->execute()) {
            $success = "Galeri berhasil diperbarui!";
        } else {
            $error = "Gagal memperbarui galeri.";
        }
    }
}
?>

<div class="container my-5">
    <h1 class="mb-4">Edit Galeri</h1>
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php elseif (isset($success)): ?>
        <div class="alert alert-success"><?php echo $success; ?></div>
    <?php endif; ?>
    <form action="editgallery.php?id=<?php echo $eventId; ?>" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="title" class="form-label">Judul Galeri</label>
            <input type="text" id="title" name="title" class="form-control" value="<?php echo htmlspecialchars($event['title']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi Galeri</label>
            <textarea id="description" name="description" class="form-control" required><?php echo htmlspecialchars($event['description']); ?></textarea>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Gambar Galeri</label>
            <input type="file" id="image" name="image" class="form-control" accept="image/*">
            <img src="<?php echo $event['image']; ?>" alt="Current Image" class="img-fluid mt-2" style="max-width: 200px;">
        </div>
        <button type="submit" class="btn btn-primary">Update Galeri</button>
    </form>
</div>

<?php include('footer.php'); ?>
