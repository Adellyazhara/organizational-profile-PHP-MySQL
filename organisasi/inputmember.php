<?php
include('db.php');
include('header.php');

// Pastikan hanya admin yang bisa mengakses halaman ini
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

$success = $error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $role = $_POST['role'];
    $bio = $_POST['bio'];
    $photo = $_FILES['photo']['name'];

    // Validasi file gambar
    $targetDir = "uploads/";  // Pastikan folder ini ada di server Anda
    $targetFile = $targetDir . basename($photo);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    
    // Memastikan file yang diupload adalah gambar
    if (in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
        if (move_uploaded_file($_FILES['photo']['tmp_name'], $targetFile)) {
            // Simpan data anggota ke database
            $query = $conn->prepare("INSERT INTO members (name, role, photo, bio) VALUES (?, ?, ?, ?)");
            $query->bind_param("ssss", $name, $role, $targetFile, $bio);
            if ($query->execute()) {
                $success = "Anggota berhasil ditambahkan!";
            } else {
                $error = "Gagal menambahkan anggota.";
            }
            $query->close();
        } else {
            $error = "Gagal mengupload gambar.";
        }
    } else {
        $error = "Hanya file gambar yang diperbolehkan (jpg, jpeg, png, gif).";
    }
}
?>

<div class="container my-5">
    <h1 class="mb-4">Input Anggota Baru</h1>
    <?php if ($error): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php elseif ($success): ?>
        <div class="alert alert-success"><?php echo $success; ?></div>
    <?php endif; ?>
    <form action="inputmember.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="name" class="form-label">Nama Anggota</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="role" class="form-label">Jabatan</label>
            <input type="text" id="role" name="role" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="photo" class="form-label">Foto Anggota</label>
            <input type="file" id="photo" name="photo" class="form-control" accept="image/*" required>
        </div>
        <div class="mb-3">
            <label for="bio" class="form-label">Bio</label>
            <textarea id="bio" name="bio" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Tambah Anggota</button>
    </form>
</div>

<?php include('footer.php'); ?>
