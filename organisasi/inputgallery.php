<?php 
include('db.php');
include('header.php');

// Pastikan hanya admin yang bisa mengakses halaman ini
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $image = $_FILES['image']['name'];

    // Cek apakah gambar diupload
    if (!empty($image)) {
        // Validasi file gambar
        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($image);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Cek apakah file yang diupload valid
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array($imageFileType, $allowedTypes)) {
            // Cek apakah file berhasil diupload
            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                // Simpan data galeri ke database dengan gambar
                $query = $conn->prepare("INSERT INTO events (title, description, image) VALUES (?, ?, ?)");
                $query->bind_param("sss", $title, $description, $targetFile);
                if ($query->execute()) {
                    $success = "Galeri berhasil ditambahkan!";
                } else {
                    $error = "Gagal menambahkan galeri.";
                }
                $query->close();
            } else {
                $error = "Gagal mengupload gambar.";
            }
        } else {
            $error = "Hanya file gambar yang diperbolehkan (jpg, jpeg, png, gif).";
        }
    } else {
        // Simpan data galeri tanpa gambar
        $query = $conn->prepare("INSERT INTO events (title, description) VALUES (?, ?)");
        $query->bind_param("ss", $title, $description);
        if ($query->execute()) {
            $success = "Galeri berhasil ditambahkan tanpa gambar!";
        } else {
            $error = "Gagal menambahkan galeri.";
        }
        $query->close();
    }
}

?>

<div class="container my-5">
    <h1 class="mb-4">Input Galeri Baru</h1>
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php elseif (isset($success)): ?>
        <div class="alert alert-success"><?php echo $success; ?></div>
    <?php endif; ?>
    <form action="inputgallery.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="title" class="form-label">Judul Galeri</label>
            <input type="text" id="title" name="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi Galeri</label>
            <textarea id="description" name="description" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Gambar Galeri (Opsional)</label>
            <input type="file" id="image" name="image" class="form-control" accept="image/*">
        </div>
        <button type="submit" class="btn btn-primary">Tambah Galeri</button>
    </form>
</div>

<?php include('footer.php'); ?>
